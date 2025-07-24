const li = document.getElementsByTagName("li");
const tabPanel = document.getElementsByClassName("tab-panel");
var activeIndex = 0;

function tabChange(index) {
    // Remove active class from the current active tab
    li[activeIndex].classList.remove("active-item");
    
    // Add active class to the new tab
    li[index].classList.add("active-item");

    // Hide the current tab panel
    tabPanel[activeIndex].classList.remove("active-tab");
    
    // Show the new tab panel
    tabPanel[index].classList.add("active-tab");

    // Update the active index
    activeIndex = index;

}