const createEvent = document.querySelector("#announcements");
if (createEvent) {
  // Real-time field validation on blur
  createEvent.querySelectorAll("input, select, textarea").forEach((input) => {
    input.addEventListener("blur", () => validateField(input));
  });
}
