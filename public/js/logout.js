function logout() {
  // Clear the session storage
  sessionStorage.clear();

  // Redirect to the login page
  window.location.href = "../../../app/views/login/login.html";
}
