    <!--Nav2 : Attendance-->
    <section class="attendance-entry tab-panel">
      <div class="heading">
        <h1 class="first-heading">Mark Attendance</h1>
        <p class="first-description">
          Record daily attendence for your classes
        </p>
      </div>

      <div class="attendance-filter">
        <form action="#" method="POST">
          <div class="form-filter-tabs">
            <div class="grade-tab">
              <label for="grade" class="tab-label">Select Grade:</label>
              <select name="Grade" id="Grade" class="tab-select">
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

            <div class="date-tab">
              <label for="date" class="tab-label">Select Date:</label>
              <input type="date" name="date" id="date" class="tab-select" id="date" onchange="onlyTodayAllowed()" />
            </div>

            <div class="search-btn-container">
              <button type="submit" class="search-btn">
                <img
                  src="../../../public/assests/search.png"
                  alt="search icon"
                  height="40px"
                  width="40px"
                />
              </button>
            </div>
          </div>
        </form>
      </div>

      <div class="attendance-table">
        <form action="#">
          <!-- Attendance Table -->
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
              <tr>
                <td>101</td>
                <td>Kalana J</td>
                <td>Present</td>
                <td>
                  <button class="present-btn">Present</button>
                  <button class="absent-btn">Absent</button>
                </td>
              </tr>
              <tr>
                <td>102</td>
                <td>Dinura R</td>
                <td>Absent</td>
                <td>
                  <button class="present-btn">Present</button>
                  <button class="absent-btn">Absent</button>
                </td>
              </tr>
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
        </form>
      </div>
    </section>
