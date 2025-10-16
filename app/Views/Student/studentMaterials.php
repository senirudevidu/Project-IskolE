<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/../../Controllers/materialController.php';

$controller = new MaterialController();
$materials = $controller->getStudentMaterial($_SESSION['grade'], $_SESSION['class']);
// Ensure $materials is an array
if (!is_array($materials)) {
  $materials = [];
}
?>

<div id="materials" class="content-section">
  <div>
    <h2>Study Materials</h2>
  </div>
  <div class="subtitle">Access lesson plans, worksheets, and assignments.</div>

  <?php if (empty($materials)): ?>
    <p>No materials available for your class.</p>
  <?php else: ?>
    <?php foreach ($materials as $material): ?>
      <div class="material-card">
        <div class="material-info">
          <h4><?php echo htmlspecialchars($material['title']); ?></h4>
          <p><?php echo htmlspecialchars($material['description']); ?></p>
          <p>
            <?php echo htmlspecialchars($material['subjectName']); ?> •
            By <?php echo htmlspecialchars($material['fName'] . " " . $material['lName']); ?> •
            <?php echo htmlspecialchars($material['date']); ?>
          </p>
        </div>
        <div class="material-actions">
          <form method="POST" action="../../app/Controllers/materialController.php" target="_blank">
            <input type="hidden" name="download" value="1">
            <input type="hidden" name="materialID" value="<?= htmlspecialchars($material['materialID']); ?>">
            <button type="submit" class="download-btn">Download</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>