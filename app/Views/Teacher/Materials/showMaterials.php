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
                    <div class="material-item-right-btns">
                        <?php if ($material['visibility'] == 1): ?>
                            <form method="POST" action="../Teacher/teacherDashboard.php">
                                <input type="hidden" name="materialID" value="<?= htmlspecialchars($material['materialID']) ?>">
                                <button type="submit" name="hide" class="hide-btn">Hide</button>
                            </form>
                        <?php else: ?>
                            <form method="POST" action="../Teacher/teacherDashboard.php">
                                <input type="hidden" name="materialID" value="<?= htmlspecialchars($material['materialID']) ?>">
                                <button type="submit" name="show" class="hide-btn">Show</button>
                            </form>
                        <?php endif; ?>

                        <form method="POST" action="../Teacher/teacherDashboard.php">
                            <input type="hidden" name="materialID" value="<?= htmlspecialchars($material['materialID']) ?>">
                            <button type="submit" name="remove" class="remove-btn">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>