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
  }
}
