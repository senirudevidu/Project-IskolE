function openEditModal(material) {
  // Populate form with material data
  document.getElementById("edit-materialID").value = material.materialID;
  document.getElementById("edit-grade").value = material.grade;
  document.getElementById("edit-class").value = material.class;
  document.getElementById("edit-subject").value = material.subjectID;
  document.getElementById("edit-material-title").value = material.title;
  document.getElementById("edit-material-description").value =
    material.description;
  document.getElementById("current-file-name").textContent =
    "Current file: " + material.file;

  // Show modal
  document.getElementById("editMaterialModal").style.display = "block";
  document.body.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
}

function closeEditModal() {
  document.getElementById("editMaterialModal").style.display = "none";
  document.getElementById("editMaterialForm").reset();
  document.body.style.backgroundColor = "";
}

// Close modal when clicking outside of it
window.onclick = function (event) {
  const modal = document.getElementById("editMaterialModal");
  if (event.target == modal) {
    closeEditModal();
  }
};
