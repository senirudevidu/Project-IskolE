// filepath: /public/js/MP/announcementSection.js
// Centralized JS for the Announcements section: popup handling + form validation

import { validateField } from "../validation.js";

function initAnnouncementFormValidation() {
  const announcementsRoot = document.querySelector("#announcements");
  if (!announcementsRoot) return;

  // Real-time field validation on blur for all inputs inside announcements section
  announcementsRoot
    .querySelectorAll("input, select, textarea")
    .forEach((input) => {
      input.addEventListener("blur", () => validateField(input));
    });
}

function openPopup(announcement) {
  // Fill the form with announcement data
  const idEl = document.getElementById("edit_announcement_id");
  const titleEl = document.getElementById("edit_announcementTitle");
  const msgEl = document.getElementById("edit_announcementMessage");
  const audienceEl = document.getElementById("edit_targetAudience");

  if (idEl) idEl.value = announcement.announcement_id ?? "";
  if (titleEl) titleEl.value = announcement.title ?? "";
  if (msgEl) msgEl.value = announcement.content ?? "";
  if (audienceEl) audienceEl.value = announcement.audienceID ?? "";

  const overlay = document.getElementById("popupForm");
  if (overlay) {
    overlay.classList.add("active");
    document.body.style.overflow = "hidden";
  }
}

function closePopup() {
  const overlay = document.getElementById("popupForm");
  if (overlay) {
    overlay.classList.remove("active");
    document.body.style.overflow = "auto";
  }
}

function initPopupGlobalHandlers() {
  // Make functions available to inline HTML (e.g., onclick='openPopup(...)')
  window.openPopup = openPopup;
  window.closePopup = closePopup;

  // Close popup when clicking outside content
  window.addEventListener("click", (event) => {
    const overlay = document.getElementById("popupForm");
    if (overlay && event.target === overlay) {
      closePopup();
    }
  });

  // Close popup with Escape key
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closePopup();
    }
  });
}

function initAnnouncements() {
  initAnnouncementFormValidation();
  initPopupGlobalHandlers();
}

// Initialize on DOM ready
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initAnnouncements);
} else {
  initAnnouncements();
}
