// Handle delete announcement
document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".delete-announcement-btn");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      const announcementID = this.getAttribute("data-id");

      if (!announcementID) {
        alert("Invalid announcement ID");
        return;
      }

      // Confirm deletion
      if (!confirm("Are you sure you want to delete this announcement?")) {
        return;
      }

      // Send delete request
      fetch(
        "../../../app/Controllers/announcement/deleteAnnouncementController.php",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            announcementID: announcementID,
          }),
        }
      )
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert(data.message);
            // Reload the page to reflect changes
            window.location.reload();
          } else {
            alert("Error: " + data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          alert("An error occurred while deleting the announcement");
        });
    });
  });
});
