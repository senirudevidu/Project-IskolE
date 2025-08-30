    <!--Nav6 : leave-request-->
    <section class="leave-request tab-panel">
      <div class="submit-leave-req">
        <div class="heading">
          <h1 class="first-heading">Request For Leaves</h1>
          <p class="first-description">Fill this leave request form</p>
        </div>
        <form action="" class="leave-form">
          <label for="date-from">Date From</label>
          <input type="date" name="date-from" id="date-from" required />

          <label for="date-to">Date To</label>
          <input type="date" name="date-to" id="date-to" required />

          <label>Type of leave</label>
          <div class="radio-group">
            <div class="radio-option">
              <input
                type="radio"
                name="leave-type"
                id="medical-leave"
                value="medical"
                required
              />
              <label for="medical-leave">Medical Leave</label>
            </div>
            <div class="radio-option">
              <input
                type="radio"
                name="leave-type"
                id="personal-leave"
                value="personal"
                required
              />
              <label for="personal-leave">Personal Leave</label>
            </div>
            <div class="radio-option">
              <input
                type="radio"
                name="leave-type"
                id="Duty-leave"
                value="Duty"
                required
              />
              <label for="Duty-leave">Duty Leave</label>
            </div>
          </div>

          <div class="buttons">
            <button type="reset">Reset</button>
            <button type="submit">Submit</button>
          </div>
        </form>
      </div>

      <div class="view-leave-req">
        <div class="heading">
          <h1 class="first-heading">My Leave Requests</h1>
          <p class="first-description">You requested following leaves</p>
        </div>

        <div class="leave-item">
          <div class="leave-item-container1">
            <h2 class="leave-title">Sick Leave</h2>
            <span class="announcemt-sender">From: 01/01/2025</span>
            <span class="announcemt-sender">To: 02/01/2025</span>
            <p class="leave-content">This is the reason for leave</p>
          </div>

          <p class="leave-date">Requested Date: 2023-10-01</p>
        </div>

        <div class="leave-item">
          <div class="leave-item-container1">
            <h2 class="leave-title">Sick Leave</h2>
            <span class="announcemt-sender">From: 01/01/2025</span>
            <span class="announcemt-sender">To: 02/01/2025</span>
            <p class="leave-content">This is the reason for leave</p>
          </div>

          <p class="leave-date">Requested Date: 2023-10-01</p>
        </div>
      </div>
    </section>
