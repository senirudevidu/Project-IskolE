<<<<<<< HEAD
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
      const selectedValue = userType.value;
      console.log("Selected user type:", selectedValue);
      if (selectedValue) {
        const sectionsToShow = document.querySelectorAll(
          `.new-user-${selectedValue}`
        );
        console.log(sectionsToShow);

        document.querySelectorAll(userTypes.join(",")).forEach((section) => {
          section.style.display = "none";
        });

        if (sectionsToShow) {
          sectionsToShow.forEach((div) => {
            div.style.display = "flex";
          });
        }
      }
    });
  }

  // Create Announcements form validation
  const createEvent = document.querySelector("#announcements");
  if (createEvent) {
    // Real-time field validation on blur
    createEvent.querySelectorAll("input, select, textarea").forEach((input) => {
      input.addEventListener("blur", () => validateField(input));
    });
  }

  const createAnnouncement = document.querySelector("#events");
  console.log(
    "createAnnouncement",
    createAnnouncement.querySelectorAll("input, select, textarea")
  );
  if (createAnnouncement) {
    // Real-time field validation on blur
    createAnnouncement
      .querySelectorAll("input, select, textarea")
      .forEach((input) => {
        input.addEventListener("blur", () => validateField(input));
      });
  }
});
=======
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

function logout() {
  // Clear the session storage
  sessionStorage.clear();

  // Redirect to the login page
  window.location.href = "/projectIskole/app/Views/login/login.html";
}
>>>>>>> admin
