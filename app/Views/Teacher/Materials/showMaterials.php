<div class="material-list-tab">
    <div class="heading">
        <h1 class="first-heading">Uploaded Materials</h1>
        <p class="first-description">Materials uploaded by you</p>
    </div>

    <div class="material-list">
        <?php if (empty($materials)) { ?>
            <p class="material-content">No materials found.</p>
        <?php } ?>

        <?php foreach ($materials as $material): ?>
            <div class="material-item" onclick="openEditModal(<?= htmlspecialchars(json_encode($material)) ?>)">
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
                        <!--<button type="button" class="edit-btn" onclick="openEditModal(<?= htmlspecialchars(json_encode($material)) ?>)">Edit</button> -->

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

<!-- Edit Material Modal -->
<div id="editMaterialModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <div class="upload-section">
            <div class="heading">
                <h1 class="first-heading">Edit Teaching Material</h1>
                <p class="first-description">Update your lesson plans and worksheets</p>
            </div>
            <form id="editMaterialForm" action="../Teacher/teacherDashboard.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="editMaterial" value="1">
                <input type="hidden" name="materialID" id="edit-materialID">

                <div class="form-filter-tabs">
                    <div class="grade-tab">
                        <label for="edit-grade" class="tab-label">Select Grade:</label>
                        <select name="grade" id="edit-grade" class="tab-select" required>
                            <option value="null"></option>
                            <option value="6" class="mark-tabs-option">06</option>
                            <option value="7" class="mark-tabs-option">07</option>
                            <option value="8" class="mark-tabs-option">08</option>
                            <option value="9" class="mark-tabs-option">09</option>
                        </select>
                    </div>

                    <div class="class-tab">
                        <label for="edit-class" class="tab-label">Select Class:</label>
                        <select name="class" id="edit-class" class="tab-select" required>
                            <option value="null"></option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>

                    <div class="subject-tab">
                        <label for="edit-subject" class="tab-label">Select subject:</label>
                        <select name="subject" id="edit-subject" class="tab-select" required>
                            <option value="null"></option>
                            <option value="1">Maths</option>
                            <option value="2">Science</option>
                            <option value="3">English</option>
                            <option value="4">History</option>
                            <option value="5">Geography</option>
                            <option value="6">Aesthetics</option>
                            <option value="7">PTS</option>
                            <option value="8">Religion</option>
                            <option value="9">Health and Physical Education</option>
                            <option value="10">Tamil</option>
                            <option value="11">Citizenship Education</option>
                            <option value="12">Sinhala</option>
                        </select>
                    </div>
                </div>

                <div class="uploadform-elements">
                    <label for="edit-material-title" class="material-label">Material Title:</label>
                    <input type="text" id="edit-material-title" name="title" class="material-input" placeholder="Enter title" required />

                    <label for="edit-material-description" class="material-label">Description:</label>
                    <textarea id="edit-material-description" name="description" class="material-textarea" placeholder="Write a brief description..." rows="4" required></textarea>

                    <label for="edit-file-upload" class="material-label">Upload New File (Optional):</label>
                    <input type="file" id="edit-file-upload" name="file" class="material-file-input" />
                    <p id="current-file-name" class="material-content" style="margin-top: 5px;"></p>
                </div>

                <div class="submit-btn">
                    <button type="submit" class="publish-material-btn">Update Material</button>
                    <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>