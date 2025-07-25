// const li = document.getElementsByTagName("li");
// const tabPanel = document.getElementsByClassName("tab-panel");
// var activeIndex = 0;

// function tabChange(index) {
//     // Remove active class from the current active tab
//     li[activeIndex].classList.remove("active-item");

//     // Add active class to the new tab
//     li[index].classList.add("active-item");

//     // Hide the current tab panel
//     tabPanel[activeIndex].classList.remove("active-tab");

//     // Show the new tab panel
//     tabPanel[index].classList.add("active-tab");

//     // Update the active index
//     activeIndex = index;

// }

// const navItems = document.querySelectorAll(".nav-item");
// const sections = document.querySelectorAll(".bottom");

// console.log(sections);

// navItems.forEach((item) => {
//   item.addEventListener("click", () => {
//     navItems.forEach((nav) => nav.classList.remove("active"));
//     item.classList.add("active");

//     sections.forEach((section) => {
//       section.style.display = "none";
//     });
//     const sectionId = item.textContent.trim().toLowerCase();
//     const sectionToShow = document.getElementById(sectionId);
//     if (sectionToShow) sectionToShow.style.display = "block";
//   });
// });

const navItems = document.querySelectorAll(".nav-item");
const sections = document.querySelectorAll(".bottom");
console.log(sections);

navItems.forEach((item) => {
  item.addEventListener("click", () => {
    // Remove active class from all nav items
    navItems.forEach((nav) => nav.classList.remove("active"));
    item.classList.add("active");

    // Hide all sections
    sections.forEach((section) => {
      section.style.display = "none";
    });

    // Get the correct section ID from data-target
    const sectionId = item.getAttribute("data-target");
    const sectionToShow = document.getElementById(sectionId);

    // Show the matching section
    if (sectionToShow) {
      sectionToShow.style.display = "block";
    }
  });
});
