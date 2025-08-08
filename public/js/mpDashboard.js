import { validateField } from "./vlidation.js";

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

  // Add new user Form
  //   const addNewUserForm = document.getElementById("add-new-user");
  //   const addNewUserSubmitBtn = document.getElementById(
  //     "add-new-user-submit-btn"
  //   );

  //   console.log(addNewUserForm.querySelectorAll("input"));

  //   addNewUserForm
  //     .querySelectorAll("input")
  //     .forEach((input) => input.addEventListener("blur", () => {}));
  // });

  // document.getElementById("username").addEventListener("blur", function (e) {
  //   validateField(e.target);
  // });

  // // Or for form submission
  // function validateForm() {
  //   const inputs = document.querySelectorAll("input, textarea");
  //   let isValid = true;

  //   inputs.forEach((input) => {
  //     if (!validateField(input)) {
  //       isValid = false;
  //     }
  //   });

  //   return isValid;
  // }

  // Add new user form
  const addNewUserForm = document.getElementById("add-new-user");
  const addNewUserSubmitBtn = document.getElementById(
    "add-new-user-submit-btn"
  );

  console.log(addNewUserForm.querySelector("input"));
});
