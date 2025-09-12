function logout() {
  // Clear the session storage
  sessionStorage.clear();

  // Redirect to the login page
  window.location.href = "/";
}

function toggleSeeMore(hide) {
  console.log("Toggle See More/Less Clicked");
  const seeMoreBtn = document.querySelector(`.see-more-${hide}`);
  console.log(seeMoreBtn);
  const content = document.querySelector(`.hide-box-${hide}`);
  content.style.display = content.style.display === "none" ? "block" : "none";
  seeMoreBtn.textContent =
    content.style.display === "none" ? "See More ..." : "See Less ...";
}
