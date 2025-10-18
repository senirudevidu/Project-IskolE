import { navigationBar } from "./navigationBar.js";
import { addNewUserForm } from "./addnewUserForm.js";
import { createAnnouncementForm } from "./createAnnouncementForm.js";
import { userSearch } from "./userSearch.js";

document.addEventListener("DOMContentLoaded", () => {
  // Navigation bar
  navigationBar();

  // add new user form validation
  addNewUserForm();

  // Create Announcements form validation
  createAnnouncementForm();

  // Initialize user directory search
  userSearch();

  // Toggle see more/less for academic
  // toggleSeeMore(".hideSection");
});
