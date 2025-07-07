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

window.addEventListener("DOMContentLoaded", () => {
  const active = document.querySelector(".nav-item.active");
  if (active) {
    const sectionId = active.textContent.trim().toLowerCase();
    sections.forEach((section) => (section.style.display = "none"));
    const sectionToShow = document.getElementById(sectionId);
    if (sectionToShow) sectionToShow.style.display = "flex";
  }
});
