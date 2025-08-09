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

  const signupForm = document.querySelector("#add-new-user");
  if (signupForm) {
    // Real-time field validation on blur
    signupForm.querySelectorAll("input, select").forEach((input) => {
      input.addEventListener("blur", () => validateField(input));
    });

    // Full form validator (if defined in validation.js)
    if (typeof createValidator === "function") {
      createValidator({ formSelector: "#add-new-user" });
    }
  }
});
