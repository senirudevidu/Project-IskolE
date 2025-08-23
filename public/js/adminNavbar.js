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