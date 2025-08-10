import { validateField } from "./validation.js";

document.addEventListener("DOMContentLoaded", () => {
  // Navigation bar
  const navItems = document.querySelectorAll(".nav-item");
  const sections = document.querySelectorAll(".bottem");

  navItems.forEach((item) => {
    item.addEventListener("click", () => {
      navItems.forEach((nav) => nav.classList.remove("active"));
      item.classList.add("active");

      sections.forEach((section) => {
        section.style.display = "none";
      });
      const sectionId = item.textContent.trim().toLowerCase();
      const sectionToShow = document.getElementById(sectionId);
      if (sectionToShow) sectionToShow.style.display = "flex";
    });
  });

  // add new user form validation
  const addNewUser = document.querySelector("#add-new-user");
  if (addNewUser) {
    // Real-time field validation on blur
    addNewUser.querySelectorAll("input, select").forEach((input) => {
      input.addEventListener("blur", () => validateField(input));
    });

    // Full form validator (if defined in validation.js)
    // if (typeof createValidator === "function") {
    //   createValidator({ formSelector: "#add-new-user" });
    // }

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

    userType.addEventListener("change", () => {
      // Changed from blur to change
      const selectedValue = userType.value;
      console.log("Selected user type:", selectedValue);

      // Hide all sections first
      document.querySelectorAll(userTypes.join(",")).forEach((section) => {
        section.style.display = "none";
      });

      // Show only the selected section
      if (selectedValue) {
        const sectionToShow = document.querySelector(
          `.new-user-${selectedValue}`
        );
        if (sectionToShow) {
          sectionToShow.style.display = "flex";
        }
      }
    });
  }
});
