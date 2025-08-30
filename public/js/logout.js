function logout() {
  // Clear the session storage
  sessionStorage.clear();

  // Redirect to the login page
<<<<<<< HEAD
<<<<<<< HEAD
  window.location.href = "/Project-Iskole/app/Views/login/login.html";
=======
  window.location.href = "/projectIskole/app/Views/login/login.html";
>>>>>>> 94d743e3dab8bb84ae93e4c5b41966eae28cbc99
=======
  window.location.href = "/index.html";
}

function toggleSeeMore(hide) {
  console.log("Toggle See More/Less Clicked");
  const seeMoreBtn = document.querySelector(`.see-more-${hide}`);
  console.log(seeMoreBtn);
  const content = document.querySelector(`.hide-box-${hide}`);
  content.style.display = content.style.display === "none" ? "block" : "none";
  seeMoreBtn.textContent =
    content.style.display === "none" ? "See More ..." : "See Less ...";
>>>>>>> d2ca82abac7378418f3d1e4e3fc50394ff8d32c3
}
