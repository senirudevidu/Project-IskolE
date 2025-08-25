    <!--Nav1 : Marks Entry-->
    <section class="marks-entry tab-panel">
      <div class="heading">
        <h1 class="first-heading">Enter Student Marks</h1>
        <p class="first-description">Record marks for recent examination</p>
      </div>

      <div class="markentry-form">
        <form action="#" method="POST">
          <div class="form-filter-tabs">
            <div class="grade-tab">
              <label for="grade" class="tab-label">Select Grade:</label>
              <select name="Grade" id="Grade" class="tab-select">
                <option value="null"></option>
                <option value="6" class="mark-tabs-option">06</option>
                <option value="7" class="mark-tabs-option">07</option>
                <option value="8" class="mark-tabs-option">08</option>
                <option value="9" class="mark-tabs-option">09</option>
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

            <div class="semester-tab">
              <label for="semester" class="tab-label">Select Term:</label>
              <select name="semester" id="semester" class="tab-select">
                <option value="null"></option>
                <option value="1">Term 1</option>
                <option value="2">Term 2</option>
                <option value="3">Term 3</option>
              </select>
            </div>

            <div class="search-btn-container">
              <button type="submit" class="search-btn">
                <img
                  src="/projectIskole/public/assests/search.png"
                  alt="search icon"
                  height="40px"
                  width="40px"
                />
              </button>
            </div>
          </div>
        </form>
      </div>

      <div class="marks-table">
        <form action="#">
          <!-- Marks Entering Table -->
          <table class="marks-table-content">
            <thead>
              <tr>
                <th class="rollnumber">Reg Number</th>
                <th class="studentName">Student Name</th>
                <th class="studentMarks">Marks</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>101</td>
                <td>Aditha Anusara</td>
                <td class="input-coloumn">
                  <input
                    type="number"
                    name="marks"
                    min="0"
                    max="100"
                    class="marks-input"
                    placeholder="0-100"
                  />
                  / 100
                </td>
              </tr>
              <tr>
                <td>102</td>
                <td>Kalana J</td>
                <td class="input-coloumn">
                  <input
                    type="number"
                    name="marks"
                    min="0"
                    max="100"
                    class="marks-input"
                    placeholder="0-100"
                  />
                  / 100
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Submit Marks Button -->
          <div class="submit-btn">
            <button type="submit" class="submit-marks-btn">Submit Marks</button>
          </div>
        </form>
      </div>
    </section>