<div class="mpDashboard">
  <!-- top section -->
  <!-- <div class="top">
    <div class="container info-box-small data-box">
      <span class="info-box-heading">Total Students</span>
      <span class="info-box-sub-heading heading-blue">1245</span>
    </div>
    <div class="container info-box-small data-box">
      <span class="info-box-heading">Total Teachers</span>
      <span class="info-box-sub-heading heading-blue">108</span>
    </div>
    <div class="container info-box-small data-box">
      <span class="info-box-heading">Pending Requests</span>
      <span class="info-box-sub-heading heading-red">1245</span>
    </div>
    <div class="container info-box-small data-box">
      <span class="info-box-heading">School Average</span>
      <span class="info-box-sub-heading heading-green">86.1%</span>
    </div>
  </div> -->
  <!-- nab bar -->

  <div class="nav">
    <div class="nav-item active" data-target="announcements">Announcements</div>
    <div class="nav-item" data-target="management">Management</div>
    <!--<div class="nav-item" data-target="academic">Academic</div>-->
    <!-- <div class="nav-item" data-target="requests">Requests</div> -->
    <!--<div class="nav-item" data-target="events">Events</div>-->
    <!-- <div class="nav-item" data-target="reports">Reports</div> -->
  </div>

  <!-- announcement panel -->
  <?php include_once("../MP/announcementSection.php") ?>
</div>


<!-- management panel -->
<?php include_once("../MP/managementSection.php") ?>


<!-- academic panel -->
<div class="bottem" id="academic">
  <div class="box">
    <div class="container info-box-large">
      <div class="heading-section">
        <span class="heading-text">Teachers Workload Management</span>
        <span class="sub-heding-text">Assign and manage teacher schedule</span>
      </div>

      <div class="content">
        <table class="table">
          <tr class="table-row">
            <th class="table-head">Class</th>
            <th class="table-head">Period</th>
            <th class="table-head">Select Teacher</th>
          </tr>
          <tr class="table-row">
            <td class="table-data">6 - A</td>
            <td class="table-data">2</td>
            <td class="table-data">
              <select name="select-teacher" id="select-teacher" class="select-box">
                <option value="" disabled selected>Select Teacher</option>
                <option value="jinendra">R K K Jinendra</option>
                <option value="senuru">Senuru D S Senaweera</option>
                <option value="rasmsitha">S K T Rasmsitha</option>
                <option value="ananda">R S R G A A Ananda</option>
              </select>
            </td>
          </tr>
          <tr class="table-row">
            <td class="table-data">9 - A</td>
            <td class="table-data">5</td>
            <td class="table-data">
              <select name="select-teacher" id="select-teacher" class="select-box">
                <option value="" disabled selected>Select Teacher</option>
                <option value="jinendra">R K K Jinendra</option>
                <option value="senuru">Senuru D S Senaweera</option>
                <option value="rasmsitha">S K T Rasmsitha</option>
                <option value="ananda">R S R G A A Ananda</option>
              </select>
            </td>
          </tr>
          <tr class="table-row">
            <td class="table-data">7 - B</td>
            <td class="table-data">8</td>
            <td class="table-data">
              <select name="select-teacher" id="select-teacher" class="select-box">
                <option value="" disabled selected>Select Teacher</option>
                <option value="jinendra">R K K Jinendra</option>
                <option value="senuru">Senuru D S Senaweera</option>
                <option value="rasmsitha">S K T Rasmsitha</option>
                <option value="ananda">R S R G A A Ananda</option>
              </select>
            </td>
          </tr>
        </table>
        <div class="info-line">
          <span class="info-line-item">
            <button class="btn btn-blue">Assign Class</button>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- events panel -->
<div class="bottem" id="events">
  <div class="box">
    <div class="container info-box-large">
      <div class="heading-section">
        <span class="heading-text">Upcomming Event</span>
        <span class="sub-heding-text">Manage schedule events</span>
      </div>
      <div class="content">
        <div class="border-container info-box">
          <div class="left">
            <span class="heading-name">Parent Teacher Conferance</span>
            <span class="sub-heading">Nov 25 2025</span>
            <span class="sub-heading">11.00 AM</span>
            <span>Parent & Teachers</span>
          </div>
          <div class="right three-com">
            <label class="label com">Pending</label>
            <button class="btn">Edit</button>
            <button class="btn btn-red">Remove</button>
          </div>
        </div>
        <div class="border-container info-box">
          <div class="left">
            <span class="heading-name">Parent Teacher Conferance</span>
            <span class="sub-heading">Nov 25 2025</span>
            <span class="sub-heading">11.00 AM</span>
            <span>Parent & Teachers</span>
          </div>
          <div class="right three-com">
            <label class="label com">Pending</label>
            <button class="btn com">Edit</button>
            <button class="btn btn-red">Remove</button>
          </div>
        </div>
        <div class="border-container info-box">
          <div class="left">
            <span class="heading-name">Parent Teacher Conferance</span>
            <span class="sub-heading">Nov 25 2025</span>
            <span class="sub-heading">11.00 AM</span>
            <span>Parent & Teachers</span>
          </div>
          <div class="right three-com">
            <label class="label com">Pending</label>
            <button class="btn com">Edit</button>
            <button class="btn btn-red">Remove</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="box">
    <div class="container info-box-large">
      <div class="heading-section">
        <span class="heading-text">Create School Event</span>
        <span class="sub-heding-text">Schedule new event and add to calender</span>
      </div>
      <div class="content">
        <div class="row">
          <div class="text-field">
            <span class="heading">Event Title</span>
            <input type="text" placeholder="Event Name" id="eventTitle" class="select-box" />
          </div>

          <div class="text-field">
            <span class="heading">Event Type</span>
            <select name="Event" id="eventType" class="select-box">
              <option value="" selected disabled>Select type</option>
              <option value="">Metting</option>
              <option value="">Audience</option>
              <option value="">Sport</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="text-field">
            <span class="heading">Date</span>
            <input type="date" placeholder="dd/mm/yyyy" id="eventDate" class="select-box" />
          </div>
          <div class="text-field">
            <span class="heading">Time</span>
            <input type="time" placeholder="../.." id="eventTime" class="select-box" />
          </div>
        </div>
        <div class="row">
          <div class="text-field">
            <span class="heading">Description</span>
            <textarea type="text" placeholder="Event Description" id="eventDescription" class="select-box deescription"
              rows="8"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="text-field">
            <span class="heading">Target Audience</span>
            <select name="Event" id="eventAudience" class="select-box">
              <option value="" selected disabled>Select Audience</option>
              <option value="">Management Panel</option>
              <option value="">Teachers</option>
              <option value="">Student</option>
              <option value="">Parent</option>
              <option value="">All</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="text-field">
            <button class="btn btn-blue">Create Event</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- report panel -->
<div class="bottem" id="reports">
  <!-- <div class="box">
      <div class="container info-box-medium">
        <div class="heading-section">
          <span class="heading-text">Generate Reports</span>
          <span class="sub-heding-text"
            >Grenerate comprehensive school report</span
          >
        </div>
        <div class="content">
          <div class="row">
            <div class="text-field">
              <span class="heading">Report Type</span>
              <select name="Event" id="" class="select-box">
                <option value="" selected disabled>Select report type</option>
                <option value="">Teachers</option>
                <option value="">Student</option>
                <option value="">Parent</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="text-field">
              <span class="heading">From Date</span>
              <input type="date" placeholder="dd/mm/yyyy" class="select-box" />
            </div>
            <div class="text-field">
              <span class="heading">To Date</span>
              <input type="date" placeholder="dd/mm/yyyy" class="select-box" />
            </div>
          </div>
          <div class="row">
            <div class="text-field">
              <button class="btn btn-blue">Generate Report</button>
            </div>
          </div>
        </div>
      </div>
      <div class="container info-box-medium">
        <div class="heading-section">
          <span class="heading-text">System Analytics</span>
          <span class="sub-heding-text">Real-time system usage statistics</span>
        </div>
        <div class="content">
          <div class="row">
            <span>Active Users Today</span>
            <span class="heading heading-blue">867</span>
          </div>
          <div class="row">
            <span>Login Success Rate</span>
            <span class="heading">97.3%</span>
          </div>
          <div class="row">
            <span>System Uptime</span>
            <span class="heading">99.9%</span>
          </div>
          <div class="row">
            <span>Data Backup Status</span>
            <span class="label label-green">Current</span>
          </div>
        </div>
      </div>
    </div> -->
</div>
</div>