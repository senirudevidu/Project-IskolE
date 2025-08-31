<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!--Nav2 : Attendance-->
<?php
require_once __DIR__ . '/../../../app/Controllers/studentController.php';
$studentController = new StudentController();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['grade']) && isset($_POST['class'])) {
  $students = $studentController->getSpecificClass($_POST['grade'], $_POST['class']);
}
?>

<section class="attendance-entry tab-panel">
  <div class="heading">
    <h1 class="first-heading">Mark Attendance</h1>
    <p class="first-description">
      Record daily attendence for your classes
    </p>
  </div>

  <div class="attendance-filter">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
      <div class="form-filter-tabs">
        <div class="grade-tab">
          <label for="grade" class="tab-label">Select Grade:</label>
          <select name="grade" id="Grade" class="tab-select">
            <option value="null"></option>
            <option value="6" class="mark-tabs-option">6</option>
            <option value="7" class="mark-tabs-option">7</option>
            <option value="8" class="mark-tabs-option">8</option>
            <option value="9" class="mark-tabs-option">9</option>

          </select>
        </div>

        <div class="class-tab">
          <label for="class" class="tab-label">Select Class:</label>
          <select name="class" id="Grade" class="tab-select">
            <option value="null"></option>
            <option value="A">A</option>
            <option value="B">B</option>
          </select>
        </div>

        <div class="search-btn-container">
          <button type="submit" class="search-btn">
            <img
              src="../../../public/assests/search.png"
              alt="search icon"
              height="40px"
              width="40px" />
          </button>
        </div>
      </div>
    </form>
  </div>

  <div class="attendance-table">
    <form action="#">
      <!-- Attendance Table -->
      <?php if (isset($students) && !empty($students)): ?>
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
          <div class="cancel-btn">
            <button type="reset" class="cancel-attendance-btn">Cancel</button>
          </div>

          <div class="save-btn">
            <button type="submit" class="save-attendance-btn">
              Submit Attendance
            </button>
          </div>
        </div>
      <?php endif; ?>
    </form>
  </div>
</section>