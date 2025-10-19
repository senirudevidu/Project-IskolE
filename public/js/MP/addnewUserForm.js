import { validateField, createValidator } from "../validation.js";

export function addNewUserForm() {
  const addNewUser = document.querySelector("#add-new-user");
  if (!addNewUser) return;

  // Validate on blur for better UX
  addNewUser.querySelectorAll("input, select").forEach((input) => {
    input.addEventListener("blur", () => {
      if (typeof validateField === "function") validateField(input);
    });
  });

  // Run validation on submit and then let the form submit normally (redirect handled by PHP)
  createValidator({ formSelector: "#add-new-user form" });

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
            div.style.display = "flex";
          });
        }
      }
    });
  }

  // Important: no button disabling, no AJAX — native submit will follow server redirect
}
