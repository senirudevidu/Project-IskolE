import { validateField } from "../validation.js";

export function createAnnouncementForm() {
  const createEvent = document.querySelector("#announcements");
  if (createEvent) {
    // Real-time field validation on blur
    createEvent.querySelectorAll("input, select, textarea").forEach((input) => {
      input.addEventListener("blur", () => validateField(input));
    });
  }
  const createAnnouncement = document.querySelector("#events");
  // console.log(
  //   "createAnnouncement",
  //   createAnnouncement.querySelectorAll("input, select, textarea")
  // );
  if (createAnnouncement) {
    // Real-time field validation on blur
    createAnnouncement
      .querySelectorAll("input, select, textarea")
      .forEach((input) => {
        input.addEventListener("blur", () => validateField(input));
      });
  }
}
