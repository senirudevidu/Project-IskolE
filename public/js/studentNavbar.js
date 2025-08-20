// const li = document.getElementsByTagName('li');
// const tabPanel = document.getElementById('tab-panel');
// var activeTab = 0;

// function showSection(sectionId) {

//     const sections = document.querySelectorAll('.content');
//     sections.forEach(sec => sec.style.display = 'none');

//     document.getElementById(sectionId).style.display = 'block';


//     const buttons = document.querySelectorAll('.nav button');
//     buttons.forEach(btn => btn.classList.remove('active'));
<<<<<<< HEAD

//     document.querySelector(`.nav button[onclick="showSection('${sectionId}')"]`).classList.add('active');
//   }


//   window.onload = () => showSection('marks');




document.addEventListener("DOMContentLoaded", function () {
  const navItems = document.querySelectorAll(".nav-item");
  const sections = document.querySelectorAll(".content-section");

  // Hide all sections except the one with .active on load
  sections.forEach((section) => {
    if (!section.classList.contains("active")) {
      section.style.display = "none";
    } else {
      section.style.display = "block";
    }
  });

  navItems.forEach((item) => {
    item.addEventListener("click", () => {
      // Remove active class from all nav items
      navItems.forEach((nav) => nav.classList.remove("active"));
      item.classList.add("active");

      // Hide all sections
      sections.forEach((section) => {
        section.classList.remove("active");
        section.style.display = "none";
      });

      // Get the correct section ID from data-target
      const sectionId = item.getAttribute("data-target");
      const sectionToShow = document.getElementById(sectionId);

      // Show the matching section
      if (sectionToShow) {
        sectionToShow.classList.add("active");
        sectionToShow.style.display = "block";
      }
    });
  });
});



=======

//     document.querySelector(`.nav button[onclick="showSection('${sectionId}')"]`).classList.add('active');
//   }


//   window.onload = () => showSection('marks');




document.addEventListener("DOMContentLoaded", function () {
  const navItems = document.querySelectorAll(".nav-item");
  const sections = document.querySelectorAll(".content-section");

  // Hide all sections except the one with .active on load
  sections.forEach((section) => {
    if (!section.classList.contains("active")) {
      section.style.display = "none";
    } else {
      section.style.display = "block";
    }
  });

  navItems.forEach((item) => {
    item.addEventListener("click", () => {
      // Remove active class from all nav items
      navItems.forEach((nav) => nav.classList.remove("active"));
      item.classList.add("active");

      // Hide all sections
      sections.forEach((section) => {
        section.classList.remove("active");
        section.style.display = "none";
      });

      // Get the correct section ID from data-target
      const sectionId = item.getAttribute("data-target");
      const sectionToShow = document.getElementById(sectionId);

      // Show the matching section
      if (sectionToShow) {
        sectionToShow.classList.add("active");
        sectionToShow.style.display = "block";
      }
    });
  });
});
>>>>>>> admin
