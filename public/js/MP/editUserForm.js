import { validateField, createValidator } from "../validation.js";

export function editUserForm() {
  console.log("editUserForm function called");
  const editUser = document.querySelector("#edit-user");
  if (editUser) {
    // Real-time field validation on blur (only if validateField exists)
    editUser.querySelectorAll("input, select").forEach((input) => {
      input.addEventListener("blur", () => {
        if (typeof validateField === "function") validateField(input);
      });
    });

    // Submit-time validation scoped to the popup form, close popup on success
    createValidator({
      formSelector: "#edit-user form",
      onValid: () => {
        const popup = document.getElementById("popup");
        if (popup) popup.style.display = "none";
      },
    });

    const userType = editUser.querySelector("#userType");
    console.log("User type select element:", userType);
    const userTypes = [
      ".edit-user-student",
      ".edit-user-teacher",
      ".edit-user-mp",
      ".edit-user-parent",
    ];

    // Helper to (re)apply visibility within this container only
    const applyUserTypeVisibility = () => {
      // Hide all user sections within this popup only
      editUser.querySelectorAll(userTypes.join(",")).forEach((section) => {
        section.style.display = "none";
      });

      const selectedValue = userType?.value;
      if (selectedValue) {
        const sectionsToShow = editUser.querySelectorAll(
          `.edit-user-${selectedValue}`
        );
        if (sectionsToShow.length) {
          sectionsToShow.forEach((div) => {
            div.style.display = "flex"; // or '' / use a CSS class to restore layout
          });
        }
      }
    };

    // Initialize visibility once on load (scoped to this popup)
    applyUserTypeVisibility();

    if (userType) {
      userType.addEventListener("change", applyUserTypeVisibility);
    }
  }
}
