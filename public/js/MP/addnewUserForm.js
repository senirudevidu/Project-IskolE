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
    const userTypes = [
      ".new-user-student",
      ".new-user-teacher",
      ".new-user-mp",
      ".new-user-parent",
    ];

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
      });
    }

    // AJAX submit to avoid full page refresh
    const form = addNewUser.querySelector(
      "form[action*='addNewUser/addNewUser.php']"
    );
    const tableBody = document.querySelector("#user-table-body");
    if (form && tableBody) {
      form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const fd = new FormData(form);
        // Flag as AJAX request
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
          }
        } catch (err) {
          // Failed silently; you can show a toast here
        }
      });
    }
  }
}
