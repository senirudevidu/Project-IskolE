const addNewUser = document.querySelector("#add-new-user");
if (addNewUser) {
  // Real-time field validation on blur
  addNewUser.querySelectorAll("input, select").forEach((input) => {
    input.addEventListener("blur", () => validateField(input));
  });

  // Full form validator (if defined in validation.js)
  // if (typeof createValidator === "function") {
  //   createValidator({ formSelector: "#add-new-user" });
  // }

  const userType = addNewUser.querySelector("#userType");
  const userTypes = [
    ".new-user-student",
    ".new-user-teacher",
    ".new-user-mp",
    ".new-user-parent",
  ];

  // Hide all user sections initially
  document.querySelectorAll(userTypes.join(",")).forEach((section) => {
    section.style.display = "none";
  });

  userType.addEventListener("change", () => {
    const selectedValue = userType.value;
    console.log("Selected user type:", selectedValue);
    if (selectedValue) {
      const sectionsToShow = document.querySelectorAll(
        `.new-user-${selectedValue}`
      );
      console.log(sectionsToShow);

      document.querySelectorAll(userTypes.join(",")).forEach((section) => {
        section.style.display = "none";
      });

      if (sectionsToShow) {
        sectionsToShow.forEach((div) => {
          div.style.display = "flex";
        });
      }
    }
  });
}
