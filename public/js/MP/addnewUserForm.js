import { validateField, createValidator } from "../validation.js";

export function addNewUserForm() {
  const addNewUser = document.querySelector("#add-new-user");
  console.log(addNewUser);
  if (addNewUser) {
    // Real-time field validation on blur (only if validateField exists)
    addNewUser.querySelectorAll("input, select").forEach((input) => {
      input.addEventListener("blur", () => {
        if (typeof validateField === "function") validateField(input);
      });
    });

    // Submit-time validation scoped to the add form
    createValidator({ formSelector: "#add-new-user form" });

    const userType = addNewUser.querySelector("#userType");
    const userTypes = [
      ".new-user-student",
      ".new-user-teacher",
      ".new-user-mp",
      ".new-user-parent",
    ];

    // Helper to (re)apply visibility within this container only
    const applyUserTypeVisibility = () => {
      // Hide all user sections within this form only
      addNewUser.querySelectorAll(userTypes.join(",")).forEach((section) => {
        section.style.display = "none";
      });

      const selectedValue = userType?.value;
      if (selectedValue) {
        const sectionsToShow = addNewUser.querySelectorAll(
          `.new-user-${selectedValue}`
        );
        if (sectionsToShow.length) {
          sectionsToShow.forEach((div) => {
            div.style.display = "flex"; // or '' / use a CSS class to restore layout
          });
        }
      }
    };

    // Initialize visibility once on load (scoped to this form)
    applyUserTypeVisibility();

    if (userType) {
      userType.addEventListener("change", applyUserTypeVisibility);
    }
  }
}
