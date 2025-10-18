import { navigationBar } from "./navigationBar.js";
import { addNewUserForm } from "./addnewUserForm.js";
import { createAnnouncementForm } from "./createAnnouncementForm.js";
import { userSearch } from "./userSearch.js";
import { editUserModal } from "./editUserModal.js";

document.addEventListener("DOMContentLoaded", () => {
  // Navigation bar
  navigationBar();

  // add new user form validation
  addNewUserForm();

  // Create Announcements form validation
  createAnnouncementForm();

  // Initialize user directory search
  userSearch();

  // Initialize edit user modal handlers
  editUserModal();

  // Toggle see more/less for academic
  // toggleSeeMore(".hideSection");
});
