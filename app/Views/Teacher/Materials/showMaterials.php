<div class="material-list">
    <div class="heading">
        <h1 class="first-heading">Uploaded Materials</h1>
        <p class="first-description">Materials uploaded by you</p>
    </div>

    <div class="material-list">
        <?php if (empty($materials)) { ?>
            <p class="material-content">No materials found.</p>
        <?php } ?>

        <?php foreach ($materials as $material): ?>
            <div class="material-item">
                <div class="material-item-container1">
                    <h2 class="material-title"><?= htmlspecialchars($material['title']) ?></h2>
                    <p class="material-content">
                        Class :
                        <?= htmlspecialchars($material['grade']) ?>
                        <?= htmlspecialchars($material['class']) ?> |
                        <?= htmlspecialchars($material['subjectName']) ?>
                    </p>
                    <p class="material-content">
                        <?= htmlspecialchars($material['description']) ?>
                    </p>
                </div>
                <div class="material-item-right">
                    <p class="material-date">Date: <?= htmlspecialchars($material['date']) ?></p>
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>