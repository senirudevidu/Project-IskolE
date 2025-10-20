<!--Nav4 : Materials-->

<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/../../../Controllers/materialController.php';
$controller = new MaterialController();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
  $controller->addMaterial(
    $_POST['grade'],
    $_POST['class'],
    $_POST['subject'],
    $_POST['material-title'],
    $_POST['material-description'],
    $_FILES['file-upload']
  );
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['remove'])) {
  $controller->removeMaterial($_POST['materialID']);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['hide'])) {
  $controller->hideMaterial($_POST['materialID']);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['show'])) {
  $controller->unhideMaterial($_POST['materialID']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editMaterial']) && $_POST['editMaterial'] == '1') {
  // Handle file upload if a new file is provided
  $file = null;
  if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $target_dir = __DIR__ . '/../../../storage/';
    if (!is_dir($target_dir)) {
      mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
      $file = basename($_FILES['file']['name']);
    }
  }

  $controller->editMaterial(
    $_POST['materialID'],
    $_POST['grade'],
    $_POST['class'],
    $_POST['subject'],
    $_POST['title'],
    $_POST['description'],
    $file,
    $_SESSION['teacherID'] ?? NULL
  );
}
?>
<section class="material-entry tab-panel">
  <?php include "uploadMaterials.php"; ?>
  <?php $controller->getTeacherMaterials(); ?>
</section>