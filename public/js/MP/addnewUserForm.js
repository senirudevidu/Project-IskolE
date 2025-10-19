import { validateField, createValidator } from "../validation.js";

export function addNewUserForm() {
  const addNewUser = document.querySelector("#add-new-user");
  if (!addNewUser) return;

  const form = addNewUser.querySelector("form");
  const userType = addNewUser.querySelector("#userType");
  const submitBtn = addNewUser.querySelector("#add-new-user-submit-btn");
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

  // Enable submit button by default (no pre-submit locking)
  if (submitBtn) submitBtn.disabled = false;

  function clearSectionErrors(container) {
    container.querySelectorAll(".error-message").forEach((el) => {
      el.textContent = "";
    });
    container.querySelectorAll(".error").forEach((el) => {
      el.classList.remove("error");
    });
  }

  // Attach live validation
  if (form) {
    form.querySelectorAll("input, select").forEach((el) => {
      const handler = () => validateField(el);
      el.addEventListener("blur", handler);
      el.addEventListener("input", handler);
      el.addEventListener("change", handler);
    });

    // Create submit validator; on success it will call form.submit()
    createValidator({ formSelector: "#add-new-user form" });
  }

  if (userType) {
    userType.addEventListener("change", () => {
      const selectedValue = userType.value;

      // Always hide all first and clear their errors
      document.querySelectorAll(userTypes.join(",")).forEach((section) => {
        section.style.display = "none";
        clearSectionErrors(section);
      });

      if (selectedValue) {
        const sectionsToShow = document.querySelectorAll(
          `.new-user-${selectedValue}`
        );
        if (sectionsToShow.length) {
          sectionsToShow.forEach((div) => {
            div.style.display = "flex";
            // Trigger validation for newly visible fields
            div.querySelectorAll("input, select").forEach((el) => {
              validateField(el);
            });
          });
        }
      }
    });
  }

  // IMPORTANT: Do not intercept form submit here. Let the validator handle submit
  // and proceed with a normal POST to the PHP controller when valid.
}
