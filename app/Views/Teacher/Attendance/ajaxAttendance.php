<?php
require_once __DIR__ . '/../../../../app/Controllers/studentController.php';
$studentController = new StudentController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['grade']) && isset($_POST['class'])) {
    $students = $studentController->getSpecificClass($_POST['grade'], $_POST['class']);
    if (!empty($students)) {
?>
        <table class="attendance-table-content">
            <thead>
                <tr>
                    <th class="rollnumber">Reg Number</th>
                    <th class="studentName">Student Name</th>
                    <th class="status">Status</th>
                    <th class="change-attendence">Change</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['studentID']; ?></td>
                        <td><?php echo $student['fName'] . ' ' . $student['lName']; ?></td>
                        <td>present</td>
                        <td>
                            <button class="present-btn">Present</button>
                            <button class="absent-btn">Absent</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="save-cancel-btns">
            <button type="reset" class="cancel-attendance-btn">Cancel</button>


            <button type="submit" class="save-attendance-btn">
                Submit Attendance
            </button>

        </div>
<?php
    }
}
?>