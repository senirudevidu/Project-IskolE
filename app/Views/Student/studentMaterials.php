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
  <div class="subtitle">Access lesson plans,worksheets and assignment.</div>

  <div class="material-card">
    <?php if (empty($materials)): ?>
      <p>No materials available for your grade and class.</p>
    <?php else: ?>
      <?php foreach ($materials as $material): ?>
        <div class="material-info">
          <h4><?php echo htmlspecialchars($material['title']); ?></h4>
          <p><?php echo htmlspecialchars($material['subjectName']); ?> • By <?php echo htmlspecialchars($material['fName'] . " " . $material['lName']); ?> • <?php echo htmlspecialchars($material['date']); ?></p>
        </div>
        <div class="material-actions">
          <!-- <span class="badge pdf">PDF</span> -->
          <button class="download-btn">Download</button>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</div>