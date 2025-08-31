<!--Nav4 : Materials-->

<?php
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
?>
<section class="material-entry tab-panel">
  <div class="heading">
    <h1 class="first-heading">Upload Teaching Materials</h1>
    <p class="first-description">
      Share lesson plans and worksheets with students
    </p>
  </div>
  <?php include "uploadMaterials.php"; ?>
  <?php $controller->getTeacherMaterials(); ?>
</section>