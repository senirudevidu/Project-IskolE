export function deleteAnnouncement() {
  // Get all delete buttons for announcements
  const deleteButtons = document.querySelectorAll(
    "#announcements .btn-red[data-id]"
  );

  deleteButtons.forEach((button) => {
    button.addEventListener("click", async function (e) {
      e.preventDefault();

      const announcementID = this.getAttribute("data-id");

      // Confirm deletion
      if (
        !confirm(
          "Are you sure you want to delete this announcement? This action cannot be undone."
        )
      ) {
        return;
      }

      try {
        const response = await fetch(
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
        );

        const result = await response.json();

        if (result.success) {
          // Show success message
          alert(result.message);

          // Remove the announcement from the DOM
          const announcementBox = this.closest(".info-box");
          if (announcementBox) {
            announcementBox.remove();
          }

          // Reload the page to refresh the list
          window.location.reload();
        } else {
          // Show error message
          alert("Error: " + result.message);
        }
      } catch (error) {
        console.error("Error deleting announcement:", error);
        alert("An error occurred while deleting the announcement.");
      }
    });
  });
}
