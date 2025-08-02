document.addEventListener("DOMContentLoaded", function () {
  // Select all nav items and content sections
  const navItems = document.getElementsByClassName("nav-item");
  // Support both .content-section and .bottem as content panels
  const contentSections = document.getElementsByClassName("content-section");
  const bottemSections = document.getElementsByClassName("bottem");

  // Combine all possible content panels into one array
  const panels = [...contentSections, ...bottemSections];
  let activeIndex = 0;

  function tabChange(index) {
    if (navItems[activeIndex]) navItems[activeIndex].classList.remove("active");
    if (navItems[index]) navItems[index].classList.add("active");
    if (panels[activeIndex]) panels[activeIndex].classList.remove("active");
    if (panels[index]) panels[index].classList.add("active");
    activeIndex = index;
  }

  // Add click event listeners to nav items
  for (let i = 0; i < navItems.length; i++) {
    navItems[i].addEventListener("click", function () {
      tabChange(i);
    });
  }
});
