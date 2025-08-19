<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/public/assets/favicon.ico" type="image/x-icon">


  <!-- Stylesheets -->
  <link rel="stylesheet" href="../../../public/css/management.css">
  <link rel="stylesheet" href="../../../public/css/sumTab.css">
  <link rel="stylesheet" href="../../../public/css/header.css">
  <title>management Panel</title>
</head>

<body class="roboto-regular">
  <?php include "./header.php" ?>
  <!-- <?php include "./sumTab.php" ?> -->

  <!-- JavaScript -->
  <script src="../../../public/js/scripts.js"></script>
  <script type="module" src="../../../public/js/validation.js"></script>
  <script type="module" src="../../../public/js/mpDashboard.js"></script>



  <div class="mpDashboard">
    <!-- top section -->
    <div class="top">
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
    </div>

    <!-- nab bar -->
    <div class="nav">
      <div class="nav-item active" data-target="announcements">Announcements</div>
      <div class="nav-item" data-target="events">Events</div>
      <div class="nav-item" data-target="academic">Academic</div>
      <div class="nav-item" data-target="requests">Requests</div>
      <div class="nav-item  " data-target="management">Management</div>
      <div class="nav-item" data-target="reports">Reports</div>

    </div>

    <!-- management  -->
    <div class="bottem " id="management">
      <div class="box">
        <div class="container info-box-medium" id="add-new-user">
          <div class="heading-section">
            <span class="heading-text">Add New User</span>
            <span class="sub-heading-text">Create new student, teacher or staff account</span>
          </div>
          <div class="content">
            <div class="info-box content">
              <div class="row">
                <div class="text-field">
                  <span class="heading">First Name</span>
                  <input type="text" placeholder="First Name" title="Enter first name" class="select-box" id="fName" />
                </div>
                <div class="text-field">
                  <span class="heading">Last Name</span>
                  <input type="text" placeholder="Last Name" title="Enter last name" class="select-box" id="lName" />
                </div>
              </div>
              <div class="row">
                <div class="text-field">
                  <span class="heading">Email</span>
                  <input type="email" placeholder="Email" title="Enter email" class="select-box" id="email" />
                </div>
              </div>
              <div class="row">
                <div class="text-field">
                  <span class="heading">Phone</span>
                  <input type="number" placeholder="Phone number" title="Enter phone number(07xxxxxxxx)"
                    class="select-box" id="phone" />
                </div>
                <div class="text-field">
                  <span class="heading">Date of birth</span>
                  <input type="date" placeholder="Date of birth" title="Enter date of birth" class="select-box"
                    id="dob" />
                </div>
              </div>
              <div class="row">
                <div class="text-field">
                  <span class="heading">Address</span>
                  <input type="text" placeholder="address line 1" title="Enter address line 1" class="select-box"
                    id="addressL1" />
                </div>
              </div>
              <div class="row">
                <div class="text-field">
                  <input type="text" placeholder="address line 2" title="Enter address line 2" class="select-box"
                    id="addressL2" />
                </div>
              </div>
              <div class="row">
                <div class="text-field">
                  <input type="text" placeholder="address line 3" title="Enter address line 3" class="select-box"
                    id="addressL3" />
                </div>
              </div>
              <div class="row">
                <div class="text-field">
                  <span class="heading">Gender</span>
                  <select name="gender" id="gender" class="select-box">
                    <option value="" selected disabled>Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                  </select>
                </div>

                <div class="text-field">
                  <span class="heading">User Type</span>
                  <select name="User" id="userType" class="select-box">
                    <option value="" selected disabled>Select User type</option>
                    <option value="mp">Management</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                    <option value="parent">Parent</option>
                  </select>
                </div>
              </div>
              <!-- this not for student -->
              <div class="row new-user-mp new-user-teacher new-user-parent user">
                <div class="text-field">
                  <span class="heading">NIC number</span>
                  <input type="number" placeholder="NIC number" title="Enter NIC number(xxxxxxxxxxxx)"
                    class="select-box" id="nic" />
                </div>
              </div>
              <!-- this is for students and teachers -->
              <div class="row new-user-teacher new-user-student user">
                <div class="text-field">
                  <span class="heading">Grade</span>
                  <input type="number" class="select-box" placeholder="Grade" id="grade" />
                </div>
                <div class="text-field">
                  <span class="heading">Class</span>
                  <select name="User" id="class" class="select-box">
                    <option value="" selected disabled>Select Class</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                  </select>
                </div>
              </div>

              <!-- this is for teacher -->
              <div class="row new-user-teacher user">
                <div class="text-field">
                  <span class="heading">Subject</span>
                  <select name="subject" id="subject" class="select-box">
                    <option value="" selected disabled>Select subject</option>
                    <option value="A">Maths</option>
                    <option value="B">Sinhala</option>
                    <option value="B">it</option>
                  </select>
                </div>
              </div>

              <!-- this is for Parent-->
              <div class="row new-user-parent user">
                <div class="text-field">
                  <span class="heading">Student index</span>
                  <input type="number" placeholder="Student index" class="select-box" id="studentIndex" />
                </div>
                <div class="text-field">
                  <span class="heading">Relationship type</span>
                  <select type="number" class="select-box" id="relationship">
                    <option value="" selected disabled>
                      Select Relationship
                    </option>
                    <option value="father">Father</option>
                    <option value="mother">Mother</option>
                    <option value="gardian">Gardian</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="text-field">
                  <span class="info-line-item">
                    <button class="btn btn-blue" id="add-new-user-submit-btn">
                      Add New User
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container info-box-medium">
          <div class="heading-section">
            <span class="heading-text">Recent Users</span>
            <span class="sub-heading-text">Recently added users</span>
          </div>
          <div class="content">
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">M M Thasiya</span>
                <span class="info-box-sub-heding-text">Student - nov 10</span>
              </div>
              <div class="right">
                <label for="" class="label label-blue">Active</label>
              </div>
            </div>
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">M M Thasiya</span>
                <span class="info-box-sub-heding-text">Student - nov 10</span>
              </div>
              <div class="right">
                <label for="" class="label label-blue">Active</label>
              </div>
            </div>
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">M M Thasiya</span>
                <span class="info-box-sub-heding-text">Student - nov 10</span>
              </div>
              <div class="right">
                <label for="" class="label">Pending</label>
              </div>
            </div>
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">M M Thasiya</span>
                <span class="info-box-sub-heding-text">Student - nov 10</span>
              </div>
              <div class="right">
                <label for="" class="label label-blue">Active</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="container info-box-large">
          <div class="heading-section">
            <span class="heading-text">User Directory</span>
            <span class="sub-heading-text">Manage all system users</span>
          </div>
          <div class="content">
            <div class="row">
              <div class="text-field left">
                <input type="number" placeholder="Search users ..." class="select-box" />
              </div>
              <div class="text-field" style="flex: 0.1">
                <button class="btn">Search</button><br />
              </div>
              <div style="flex: 0.2">
                <select name="Filter" id="" class="select-box text-field">
                  <option value="" selected disabled>Filter</option>
                  <option value="Teacher"></option>
                  <option value="Student "></option>
                </select>
              </div>
            </div>
            <table class="table">
              <tr class="table-row">
                <th class="table-head">Name</th>
                <th class="table-head">Type</th>
                <th class="table-head">Email</th>
                <th class="table-head">Status</th>
                <th class="table-head">Actions</th>
              </tr>
              <tr class="table-row">
                <td class="table-data">Adiya</td>
                <td class="table-data">Student</td>
                <td class="table-data">adith@gmail.com</td>
                <td class="table-data">
                  <label for="status" class="label label-blue">Active</label>
                </td>
                <td class="table-data">
                  <div class="row">
                    <button class="btn">Edit</button>
                    <button class="btn btn-red">Delete</button>
                  </div>
                </td>
              </tr>
              <tr class="table-row">
                <td class="table-data">Adiya</td>
                <td class="table-data">Student</td>
                <td class="table-data">adith@gmail.com</td>
                <td class="table-data">
                  <label for="status" class="label">Pending</label>
                </td>
                <td class="table-data">
                  <div class="row">
                    <button class="btn">Edit</button>
                    <button class="btn btn-red">Delete</button>
                  </div>
                </td>
              </tr>
              <tr class="table-row">
                <td class="table-data">Adiya</td>
                <td class="table-data">Teacher</td>
                <td class="table-data">adith@gmail.com</td>
                <td class="table-data">
                  <label for="status" class="label label-blue">Active</label>
                </td>
                <td class="table-data">
                  <div class="row">
                    <button class="btn">Edit</button>
                    <button class="btn btn-red">Delete</button>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- academic panel -->
    <div class="bottem" id="academic">
      <div class="box">
        <div class="container info-box-medium left-most">
          <div class="heading-section">
            <span class="heading-text">Academic Perfomance Overview</span>
            <span class="sub-heding-text">school-wide academic statistics</span>
          </div>
          <div class="content">
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">Grade 10</span>
                <span class="info-box-sub-heding-text">120 students</span>
              </div>
              <div class="right">
                <span class="info-box-heading-text">86.5%</span>
                <span class="info-box-sub-heding-text">Average</span>
              </div>
            </div>
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">Grade 10</span>
                <span class="info-box-sub-heding-text">120 students</span>
              </div>
              <div class="right">
                <span class="info-box-heading-text">86.5%</span>
                <span class="info-box-sub-heding-text">Average</span>
              </div>
            </div>
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">Grade 10</span>
                <span class="info-box-sub-heding-text">120 students</span>
              </div>
              <div class="right">
                <span class="info-box-heading-text">86.5%</span>
                <span class="info-box-sub-heding-text">Average</span>
              </div>
            </div>
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">Grade 10</span>
                <span class="info-box-sub-heding-text">120 students</span>
              </div>
              <div class="right">
                <span class="info-box-heading-text">86.5%</span>
                <span class="info-box-sub-heding-text">Average</span>
              </div>
            </div>
          </div>
        </div>

        <div class="container info-box-medium right-most">
          <div class="heading-section">
            <span class="heading-text">Subject Performance</span>
            <span class="sub-heding-text">Average performance by subject</span>
          </div>
          <div class="content">
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">Mathematics</span>
                <span class="info-box-sub-heding-text">8 teachers</span>
              </div>
              <div class="right">
                <span class="info-box-heading-text">86.5%</span>
                <!-- <span class="info-box-sub-heding-text">Average</span> -->
              </div>
            </div>
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">Mathematics</span>
                <span class="info-box-sub-heding-text">8 teachers</span>
              </div>
              <div class="right">
                <span class="info-box-heading-text">86.5%</span>
                <!-- <span class="info-box-sub-heding-text">Average</span> -->
              </div>
            </div>
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">Mathematics</span>
                <span class="info-box-sub-heding-text">8 teachers</span>
              </div>
              <div class="right">
                <span class="info-box-heading-text">86.5%</span>
                <!-- <span class="info-box-sub-heding-text">Average</span> -->
              </div>
            </div>
            <div class="info-box-content border-container">
              <div class="left">
                <span class="info-box-heading-text">Mathematics</span>
                <span class="info-box-sub-heding-text">8 teachers</span>
              </div>
              <div class="right">
                <span class="info-box-heading-text">86.5%</span>
                <!-- <span class="info-box-sub-heding-text">Average</span> -->
              </div>
            </div>
          </div>
        </div>
      </div>

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

    <!-- requests panel -->
    <div class="bottem" id="requests">
      <div class="box">
        <div class="container info-box-large">
          <div class="heading-section">
            <span class="heading-text">Pending Leave Requests</span>
            <span class="sub-heding-text">Review and approve leave requests</span>
          </div>
          <div class="info-box border-container">
            <div class="left">
              <span class="heading-name">K K Jina</span>
              <span class="sub-heading">Teacher - Nov 25 2025</span>
              <span class="sub-heading-bolt">Medical Leave</span>
              <span class="sub-heading">Submitted on Nov 15 2025</span>
            </div>
            <div class="right">
              <button class="btn btn-green">Approve</button>
              <button class="btn btn-red">Reject</button>
              <button class="btn">View</button>
            </div>
          </div>
          <div class="info-box border-container">
            <div class="left">
              <span class="heading-name">K K Jina</span>
              <span class="sub-heading">Teacher - Nov 25 2025</span>
              <span class="sub-heading-bolt">Medical Leave</span>
              <span class="sub-heading">Submitted on Nov 15 2025</span>
            </div>
            <div class="right">
              <button class="btn btn-green">Approve</button>
              <button class="btn btn-red">Reject</button>
              <button class="btn">View</button>
            </div>
          </div>
          <div class="info-box border-container">
            <div class="left">
              <span class="heading-name">K K Jina</span>
              <span class="sub-heading">Teacher - Nov 25 2025</span>
              <span class="sub-heading-bolt">Medical Leave</span>
              <span class="sub-heading">Submitted on Nov 15 2025</span>
            </div>
            <div class="right">
              <button class="btn btn-green">Approve</button>
              <button class="btn btn-red">Reject</button>
              <button class="btn">View</button>
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
                <span>Parent & Teachers</span>
              </div>
              <div class="right two-com">
                <label class="label com">Pending</label>
                <button class="btn com">Edit</button>
                <button class="btn btn-red">Remove</button>
              </div>
            </div>
            <div class="border-container info-box">
              <div class="left">
                <span class="heading-name">Parent Teacher Conferance</span>
                <span class="sub-heading">Nov 25 2025</span>
                <span>Parent & Teachers</span>
              </div>
              <div class="right two-com">
                <label class="label com">Pending</label>
                <button class="btn com">Edit</button>
                <button class="btn btn-red">Remove</button>
              </div>
            </div>
            <div class="border-container info-box">
              <div class="left">
                <span class="heading-name">Parent Teacher Conferance</span>
                <span class="sub-heading">Nov 25 2025</span>
                <span>Parent & Teachers</span>
              </div>
              <div class="right two-com">
                <label class="label com">Pending</label>
                <button class="btn com">Edit</button>
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
                <input type="text" placeholder="Event Name" class="select-box" />
              </div>

              <div class="text-field">
                <span class="heading">Evant Type</span>
                <select name="Event" id="" class="select-box">
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
                <input type="date" placeholder="dd/mm/yyyy" class="select-box" />
              </div>
              <div class="text-field">
                <span class="heading">Time</span>
                <input type="time" placeholder="../.." class="select-box" />
              </div>
            </div>
            <div class="row">
              <div class="text-field">
                <span class="heading">Description</span>
                <textarea type="text" placeholder="Event Description" class="select-box deescription"
                  rows="8"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="text-field">
                <span class="heading">Target Audience</span>
                <select name="Event" id="" class="select-box">
                  <option value="" selected disabled>Select Audience</option>
                  <option value="">Teachers</option>
                  <option value="">Student</option>
                  <option value="">Parent</option>
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

      <div class="box">
        <div class="container info-box-large">
          <div class="heading-section">
            <span class="heading-text">Generate Reports</span>
            <span class="sub-heding-text">Generate comprehensive school report</span>
          </div>
          <div class="content">
            <div class="center-container">
              <div class="search-container">
                <input type="text" placeholder="Search..." id="searchInput" />
                <button type="submit">Search</button>
              </div>

              <div class="student-container">
                <div class="details">
                  <h2 class="student-name">John Doe</h2>
                  <p class="student-grade">Grade: 12</p>
                  <p class="student-class">Class: A</p>
                  <p class="student-roll-number">Roll Number: 101</p>
                  <p class="student-email">Email: john.doe@example.com</p>
                  <p class="student-phone">Phone: +1234567890</p>
                  <p class="student-address">Address: 123 Main St, City, Country</p>
                  <p class="student-dob">Date of Birth: 2005-01-01</p>
                </div>

                <div class="performance-report">
                  <h3 class="report-title">Performance Report</h3>
                  <div class="marksofthestudent">
                    <table>
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
                    </table>
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
                      <textarea id="behavior-update" name="behavior-update" rows="4"
                        placeholder="Enter behavior update..."></textarea>
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
          </div>

        </div>
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
    <!-- announcement panel -->
    <div class="bottem active" id="announcements">

      <div class="box">
        <div class="container info-box-large">
          <div class="heading-section">
            <span class="heading-text">Recent Announcements</span>
            <span class="sub-heding-text">Manage publish announcements</span>
          </div>
          <div class="content">
            <div class="border-container info-box">
              <div class="left">
                <span class="heading-name">Teachers Conferance</span>
                <span class="sub-heading">TO : Teachers</span>
                <span class="sub-heading">NOV 06</span>
              </div>
              <div class="right two-com">
                <button class="btn">Edit</button>
                <button class="btn btn-red">Delete</button>
              </div>
            </div>
            <div class="border-container info-box">
              <div class="left">
                <span class="heading-name">2<sup>nd</sup> Term Test Schedule</span>
                <span class="sub-heading">TO : All Users</span>
                <span class="sub-heading">NOV 10</span>
              </div>
              <div class="right two-com">
                <button class="btn">Edit</button>
                <button class="btn btn-red">Delete</button>
              </div>
            </div>
            <div class="border-container info-box">
              <div class="left">
                <span class="heading-name">1<sup>st</sup> Term Test Schedule</span>
                <span class="sub-heading">TO : All Users</span>
                <span class="sub-heading">NOV 10</span>
              </div>
              <div class="right two-com">
                <button class="btn">Edit</button>
                <button class="btn btn-red">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="box">
        <div class="container info-box-large">
          <div class="heading-section">
            <span class="heading-text">Create Announcements</span>
            <span class="sub-heding-text">Create announcements according to groups</span>
          </div>
          <form action="">
            <div class="content">
              <div class="row">
                <div class="text-field">
                  <span class="heading">Target Audience</span>
                  <select name="group" class="select-box" id="targetAudience">
                    <option value="" selected disabled>Select Audience</option>
                    <option value="all">All</option>
                    <option value="mp">Management Panel</option>
                    <option value="teachers">Teachers</option>
                    <option value="mp_teachers">Management Panel & Teachers</option>
                    <option value="students">Students</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="text-field">
                  <span class="heading">announcement Title</span>
                  <input type="text" class="select-box" placeholder="Enter the announcement title"
                    id="announcementTitle" />
                </div>
              </div>

              <div class=" row">
                <div class="text-field">
                  <span class="heading">Message</span>
                  <textarea name="Message" rows="10" placeholder="Type your announcement message here"
                    id="announcementMessage" class="select-box"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="text-field">
                  <span>
                    <button class="btn btn-blue">Publish Announcemnt</button>
                  </span>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- footer section -->
    <div class="footer">
      <div class="container info-large-box">
        <div class="heading-section">
          <span class="heading-text">School Perfomance Overview</span>
          <span class="sub-heding-text">Key performance indicators</span>
        </div>
        <div class="content">
          <div class="row">
            <div class="data-box">
              <span class="heading heading-green"> 94.2% </span>
              <span class="sub-heading-text">Student Attendence</span>
            </div>
            <div class="data-box">
              <span class="heading heading-blue"> 83.2% </span>
              <span class="sub-heading-text">Staff Average </span>
            </div>
            <div class="data-box">
              <span class="heading heading-red"> 86.6% </span>
              <span class="sub-heading-text">Pass Rate</span>
            </div>
            <!-- <div class="data-box">
            <span class="heading heading-green"> 92.2% </span>
            <span class="sub-heading-text">Parent Satisfaction</span>
          </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>