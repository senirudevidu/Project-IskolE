import { navigationBar } from "./navigationBar.js";
import { addNewUserForm } from "./addnewUserForm.js";
import { editUserForm } from "./editUserForm.js";
import { createAnnouncementForm } from "./createAnnouncementForm.js";

document.addEventListener("DOMContentLoaded", () => {
  // Navigation bar
  navigationBar();

  // add new user form validation

  addNewUserForm();

  // edit user form validation
  editUserForm();

  // Create Announcements form validation
  createAnnouncementForm();

  // Toggle see more/less for academic
  // toggleSeeMore(".hideSection");
});
