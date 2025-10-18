<section class="student-absence tab-panel">
  <div class="view-student-absence">
    <div class="heading">
      <h1 class="first-heading">Student Absence Requests</h1>
      <p class="first-description">Review and manage student absence requests</p>
    </div>

    <?php if (empty($rows)): ?>
      <p>No absence requests found.</p>
    <?php else: ?>
      <?php foreach ($rows as $r): ?>
        <?php
          $name = $r['full_name'] ?: $r['student_name'];
          $reg  = $r['regNumber'] ?? '';
          $cls  = ($r['grade'] ?? '') . '-' . ($r['class'] ?? '');
        ?>
        <div class="absence-item">
          <div class="absence-item-container1">
            <h2 class="absence-title">
              Student: <?= htmlspecialchars($name) ?>
              <?php if ($reg!==''): ?>(Reg: <?= htmlspecialchars($reg) ?>)<?php endif; ?>
            </h2>
            <span class="absence-details">Class: <?= htmlspecialchars($cls) ?></span>
            <span class="absence-details">From: <?= htmlspecialchars($r['from_date']) ?></span>
            <span class="absence-details">To: <?= htmlspecialchars($r['to_date']) ?></span>
            <p class="absence-reason">Reason: <?= htmlspecialchars($r['reason']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>
