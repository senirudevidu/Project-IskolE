import { validateField } from "../validation.js";

export function addNewUserForm() {
  const addNewUser = document.querySelector("#add-new-user");
  if (addNewUser) {
    // Real-time field validation on blur (only if validateField exists)
    addNewUser.querySelectorAll("input, select").forEach((input) => {
      input.addEventListener("blur", () => {
        if (typeof validateField === "function") validateField(input);
      });
    });

    const userType = addNewUser.querySelector("#userType");
    const submitBtn = addNewUser.querySelector("#add-new-user-submit-btn");
    const userTypes = [
      ".new-user-student",
      ".new-user-teacher",
      ".new-user-mp",
      ".new-user-parent",
    ];

    // Helper: check if an element is visible (not display:none and in DOM)
    const isVisible = (el) => {
      if (!el) return false;
      const style = window.getComputedStyle(el);
      if (style.display === "none" || style.visibility === "hidden")
        return false;
      // Also ensure no hidden ancestor with display:none
      let parent = el.parentElement;
      while (parent) {
        const s = window.getComputedStyle(parent);
        if (s.display === "none" || s.visibility === "hidden") return false;
        parent = parent.parentElement;
      }
      return true;
    };

    // Helper: get visible inputs/selects relevant to this form
    const getVisibleControls = () => {
      return (
        Array.from(addNewUser.querySelectorAll("input, select"))
          // ignore hidden inputs and buttons
          .filter(
            (el) =>
              el.type !== "hidden" && el.tagName.toLowerCase() !== "button"
          )
          // only visible ones
          .filter((el) => isVisible(el))
      );
    };

    // Evaluate form validity considering only visible controls
    let checking = null;
    const updateSubmitState = async () => {
      if (!submitBtn) return;
      // Optimistically disable while checking
      submitBtn.disabled = true;
      const controls = getVisibleControls();
      const results = await Promise.all(
        controls.map((c) =>
          typeof validateField === "function" ? validateField(c) : true
        )
      );
      const allValid = results.every(Boolean);
      submitBtn.disabled = !allValid;
    };

    // Hide all user sections initially
    document.querySelectorAll(userTypes.join(",")).forEach((section) => {
      section.style.display = "none";
    });

    if (userType) {
      userType.addEventListener("change", () => {
        const selectedValue = userType.value;

        // Always hide all first
        document.querySelectorAll(userTypes.join(",")).forEach((section) => {
          section.style.display = "none";
        });

        if (selectedValue) {
          const sectionsToShow = document.querySelectorAll(
            `.new-user-${selectedValue}`
          );
          if (sectionsToShow.length) {
            sectionsToShow.forEach((div) => {
              div.style.display = "flex"; // or '' / use a CSS class to restore layout
            });
          }
        }
        // Re-evaluate validity when role changes
        updateSubmitState();
      });
    }

    // Listen to changes/inputs to toggle button state
    addNewUser.addEventListener("input", updateSubmitState);
    addNewUser.addEventListener("change", updateSubmitState);

    // Initialize submit button state
    if (submitBtn) submitBtn.disabled = true;
    updateSubmitState();

    // AJAX submit to avoid full page refresh
    const form = addNewUser.querySelector(
      "form[action*='addNewUser/addNewUser.php']"
    );
    const tableBody = document.querySelector("#user-table-body");
    if (form && tableBody) {
      form.addEventListener("submit", async (e) => {
        e.preventDefault();
        // Guard: prevent submission if disabled/invalid
        if (submitBtn && submitBtn.disabled) return;
        const fd = new FormData(form);
        const url = form.getAttribute("action");
        try {
          const res = await fetch(url, {
            method: "POST",
            headers: { "X-Requested-With": "fetch" },
            body: fd,
          });
          const json = await res.json();
          if (json?.success && json?.data) {
            const u = json.data;
            // Prepend new row in the table
            const newRow = document.createElement("tr");
            newRow.className = "table-row";
            newRow.setAttribute("data-user-id", u.userID);
            newRow.innerHTML = `
              <td class="table-data">${u.fName} ${u.lName}</td>
              <td class="table-data">${u.role ?? ""}</td>
              <td class="table-data">${u.email ?? ""}</td>
              <td class="table-data">
                <div class="row">
                  <button class="btn edit-user-btn" data-user-id="${
                    u.userID
                  }">Edit</button>
                  <button class="btn btn-red">Delete</button>
                </div>
              </td>
            `;
            tableBody.prepend(newRow);

            // Reset form after success
            form.reset();
            // Hide all conditional sections again
            document
              .querySelectorAll(userTypes.join(","))
              .forEach((section) => {
                section.style.display = "none";
              });
            // Disable button again until valid
            if (submitBtn) submitBtn.disabled = true;

            // Success alert
            alert("User added successfully.");
          } else {
            // Failure alert with message if available
            alert(json?.message || "Failed to add user.");
          }
        } catch (err) {
          // Network or unexpected error
          alert("Something went wrong. Please try again.");
        } finally {
          // Re-check button state
          updateSubmitState();
        }
      });
    }
  }
}
