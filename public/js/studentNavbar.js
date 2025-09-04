// const li = document.getElementsByTagName('li');
// const tabPanel = document.getElementById('tab-panel');
// var activeTab = 0;

// function showSection(sectionId) {

//     const sections = document.querySelectorAll('.content');
//     sections.forEach(sec => sec.style.display = 'none');

//     document.getElementById(sectionId).style.display = 'block';


//     const buttons = document.querySelectorAll('.nav button');
//     buttons.forEach(btn => btn.classList.remove('active'));

//     document.querySelector(`.nav button[onclick="showSection('${sectionId}')"]`).classList.add('active');
//   }


//   window.onload = () => showSection('marks');


// public/js/studentNavbar.js
document.addEventListener("DOMContentLoaded", () => {
  const tabContent = document.querySelector(".tab-content");
  if (!tabContent) return;

  // Only the direct children of .tab-content are considered tabs
  const sections = Array.from(tabContent.children)
    .filter(el => el.classList.contains("content-section"));

  const navItems = document.querySelectorAll(".nav .nav-item");

  // Initialize: show only the active top-level section
  sections.forEach(sec => {
    const isActive = sec.classList.contains("active");
    sec.style.display = isActive ? "block" : "none";

    // If an include created an inner wrapper with the same ID, mirror the visibility
    const innerSameId = sec.querySelector(`#${CSS.escape(sec.id)}`);
    if (innerSameId) {
      innerSameId.style.display = isActive ? "block" : "none";
      if (isActive) innerSameId.classList.add("active");
      else innerSameId.classList.remove("active");
    }
  });

  // If none active, default to first
  if (!sections.some(s => s.classList.contains("active")) && sections[0]) {
    sections[0].classList.add("active");
    sections[0].style.display = "block";
  }

  navItems.forEach(item => {
    item.addEventListener("click", () => {
      const targetId = item.dataset.target;
      if (!targetId) return;

      // Nav active state
      navItems.forEach(n => n.classList.remove("active"));
      item.classList.add("active");

      // Hide all tabs (and their inner duplicate wrappers, if any)
      sections.forEach(sec => {
        sec.classList.remove("active");
        sec.style.display = "none";
        sec.querySelectorAll(".content-section").forEach(inner => {
          inner.classList.remove("active");
          inner.style.display = "none";
        });
      });

      // Show the requested tab
      const toShow = sections.find(sec => sec.id === targetId);
      if (toShow) {
        toShow.classList.add("active");
        toShow.style.display = "block";

        // Unhide inner duplicate wrapper if your include has one
        const innerSameId = toShow.querySelector(`#${CSS.escape(targetId)}`);
        if (innerSameId) {
          innerSameId.classList.add("active");
          innerSameId.style.display = "block";
        }
      }
    });
  });
});
