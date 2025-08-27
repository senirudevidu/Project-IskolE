    <!--Nav5 : Reports-->
    <section class="reports-entry tab-panel">
      <div class="heading">
        <h1 class="first-heading">Student Reports</h1>
        <p class="first-description">
          View student progress reports & Behavior reports
        </p>
      </div>

      <div class="center-container">
        <div class="search-container">
          <input type="text" placeholder="Search..." id="searchInput" />
          <button type="submit">Search</button>
        </div>

        <div class="student-container">
          <div class="details">
            <h2 class="student-name">Seniru Senaweera</h2>
            <p class="student-grade">Grade: 06</p>
            <p class="student-class">Class: A</p>
            <p class="student-roll-number">Student Number: 101</p>
            <p class="student-email">Email: seniru@gmail.com</p>
            <p class="student-phone">Phone: +94702222676</p>
            <p class="student-address">Address: 123 Main St, City, Sri Lanka</p>
            <p class="student-dob">Date of Birth: 2005-01-01</p>
          </div>

          <div class="performance-report">
            <h3 class="report-title">Performance Report</h3>
            <div class="marksofthestudent">
              <!-- <table>
                <thead>
                  <tr>
                    <th>Subject</th>
                    <th>Term 1</th>
                    <th>Term 2</th>
                    <th>Term 3</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Mathematics</td>
                    <td>60</td>
                    <td>70</td>
                    <td>80</td>
                  </tr>
                  <tr>
                    <td>Science</td>
                    <td>60</td>
                    <td>70</td>
                    <td>80</td>
                  </tr>
                </tbody>
              </table> -->

              <h3>Bar graph will be added here after completing backend</h3>
            </div>
            <div class="overall-averages">
              <ul>
                <li>Overall Average: 70%</li>
                <li>Secttion Rank: 5</li>
                <li>Class Rank: 1</li>
              </ul>
            </div>
          </div>

          <div class="behavior-report">
            <h3 class="report-title">Behavior Report</h3>
            <div class="behavior-update">
              <form action="">
                <label for="behavior-update">Update Behavior:</label>
                <textarea
                  id="behavior-update"
                  name="behavior-update"
                  rows="4"
                  placeholder="Enter behavior update..."
                ></textarea>
                <button type="submit" class="update-behavior-btn">
                  Update Behavior
                </button>
              </form>
            </div>
          </div>

          <div class="recent-behavior-updates behavior-report">
            <h3 class="report-title">Recent Behavior Updates</h3>
            <ul>
              <li>Improved participation in class discussions.</li>
              <li>Completed all homework assignments on time.</li>
              <li>Helped classmates with difficult subjects.</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
