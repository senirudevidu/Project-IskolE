import { navigationBar } from "./navigationBar.js";
import { addNewUserForm } from "./addnewUserForm.js";
import { editUserForm } from "./editUserForm.js";
import { createAnnouncementForm } from "./createAnnouncementForm.js";
import { userSearch } from "./userSearch.js";
import { editUserModal } from "./editUserModal.js";
import { deleteAnnouncement } from "./deleteAnnouncement.js";

document.addEventListener("DOMContentLoaded", () => {
  // Navigation bar
  navigationBar();

  // add new user form validation

  addNewUserForm();

  // edit user form validation
  editUserForm();

  // Create Announcements form validation
  createAnnouncementForm();

  // Initialize user directory search
  userSearch();

  // Initialize edit user modal handlers
  editUserModal();

  // Initialize delete announcement handlers
  deleteAnnouncement();

  // Toggle see more/less for academic
  // toggleSeeMore(".hideSection");
});
