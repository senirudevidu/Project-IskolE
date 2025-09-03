import { navigationBar } from "./navigationBar.js";
import { addNewUserForm } from "./addnewUserForm.js";
import { createAnnouncementForm } from "./createAnnouncementForm.js";

document.addEventListener("DOMContentLoaded", () => {
  // Navigation bar
  navigationBar();

  // add new user form validation
  addNewUserForm();

  // Create Announcements form validation
  createAnnouncementForm();

  // Toggle see more/less for academic
  // toggleSeeMore(".hideSection");
});
