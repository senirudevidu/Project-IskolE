<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Management Dashboard</title>
    <!-- <link rel="stylesheet" href="../../../public/css/management.css"> -->
    <link rel="stylesheet" href="/public/css/management.css">
</head>
<body>

  <!-- <header class="dashboard-header">
    <div class="logo-title">
      <img src="images/logo.png" alt="Logo" class="logo">
      <div>
        <h2>Management Dashboard</h2>
        <p>Welcome Dr. Anderson</p>
      </div>
    </div>
    <button class="logout-btn">Logout</button>
  </header> -->

  <header class = >

  <main class="dashboard-main">
    <section class="stats-cards">
      <div class="card">
        <h3>Total Students</h3>
        <p>1,245</p>
      </div>
      <div class="card">
        <h3>Total Teachers</h3>
        <p>68</p>
      </div>
      <div class="card">
        <h3>Pending Requests</h3>
        <p class="warning">15</p>
      </div>
      <div class="card">
        <h3>School Average</h3>
        <p class="success">84.2%</p>
      </div>
    </section>

    <nav class="tab-nav">
      <button class="active">User Management</button>
      <button>Academics</button>
      <button>Requests</button>
      <button>Events</button>
      <button>Reports</button>
      <button>Announcements</button>
    </nav>

    <section class="user-panels">
      <div class="add-user">
        <h3>Add New User</h3>
        <form>
          <select>
            <option>Select user type</option>
            <option>Student</option>
            <option>Teacher</option>
            <option>Parent</option>
          </select>
          <input type="text" placeholder="First Name">
          <input type="text" placeholder="Last Name">
          <button type="submit">Create User</button>
        </form>
      </div>

      <div class="recent-users">
        <h3>Recent Users</h3>
        <ul>
          <li><strong>Emily Carter</strong><span>Student – Nov 16</span><button class="status active">Active</button></li>
          <li><strong>Mr. James Wilson</strong><span>Teacher – Nov 15</span><button class="status active">Active</button></li>
          <li><strong>Mrs. Karen Lee</strong><span>Teacher – Nov 14</span><button class="status pending">Pending</button></li>
          <li><strong>Mark Thompson</strong><span>Student – Nov 13</span><button class="status active">Active</button></li>
        </ul>
      </div>
    </section>

    <section class="user-directory">
      <div class="directory-header">
        <input type="search" placeholder="Search users...">
        <select>
          <option>Filter</option>
        </select>
      </div>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>John Smith</td>
            <td>Teacher</td>
            <td>johnsmith@school.edu</td>
            <td><span class="status active">Active</span></td>
            <td>
              <button class="edit">Edit</button>
              <button class="delete">Delete</button>
            </td>
          </tr>
          <tr>
            <td>Ms. Sachi</td>
            <td>Parent</td>
            <td>sachi@gmail.com</td>
            <td><span class="status active">Active</span></td>
            <td>
              <button class="edit">Edit</button>
              <button class="delete">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>






  <!-- <style>
    .Hello{
    color: #1232b6;
}

body {
  font-family: 'Inter', sans-serif;
  background: #1232b6;
  margin: 0;
  padding: 0;
  color: #2c3e50;
}

.dashboard-header {
    background-color: aquamarine;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 20px 40px;
    border-bottom: 1px solid #ddd;
}

.logo-title {
  display: flex;
  align-items: center;
}

.logo {
  width: 40px;
  height: 40px;
  margin-right: 15px;
}

.logout-btn {
  background: #e74c3c;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  cursor: pointer;
}

.dashboard-main {
  padding: 30px 40px;
}

.stats-cards {
  display: flex;
  gap: 20px;
  margin-bottom: 25px;
}

.card {
  background: white;
  padding: 20px;
  border-radius: 8px;
  flex: 1;
  box-shadow: 0 0 6px rgba(0,0,0,0.05);
}

.card h3 {
  margin: 0;
  font-size: 14px;
  color: #888;
}

.card p {
  margin-top: 10px;
  font-size: 24px;
  font-weight: bold;
}

.card .success {
  color: #27ae60;
}

.card .warning {
  color: #e67e22;
}

.tab-nav {
  margin-top: 10px;
  display: flex;
  gap: 10px;
  margin-bottom: 30px;
}

.tab-nav button {
  padding: 10px 15px;
  background: #ecf0f1;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.tab-nav .active {
  background: #2980b9;
  color: white;
}

.user-panels {
  display: flex;
  gap: 30px;
  margin-bottom: 40px;
}

.add-user, .recent-users {
  background: white;
  padding: 20px;
  flex: 1;
  border-radius: 8px;
}

.add-user form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.add-user select, .add-user input {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.add-user button {
  padding: 10px;
  background: #2980b9;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.recent-users ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.recent-users li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.recent-users span {
  font-size: 12px;
  color: #888;
}

.status {
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 12px;
  border: none;
}

.status.active {
  background: #2ecc71;
  color: white;
}

.status.pending {
  background: #f39c12;
  color: white;
}

.user-directory {
  background: white;
  padding: 20px;
  border-radius: 8px;
}

.directory-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.directory-header input, .directory-header select {
  padding: 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background: #f0f0f0;
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

.edit, .delete {
  padding: 6px 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 12px;
}

.edit {
  background: #3498db;
  color: white;
  margin-right: 5px;
}

.delete {
  background: #e74c3c;
  color: white;
}


.dashboard-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: white;
  padding: 20px 40px;
  border-bottom: 1px solid #ddd;
}

.logo-title {
  display: flex;
  align-items: center;
}

.logo {
  width: 40px;
  height: 40px;
  margin-right: 15px;
}

.logout-btn {
  background: #e74c3c;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  cursor: pointer;
}

.dashboard-main {
  padding: 30px 40px;
}

.stats-cards {
  display: flex;
  gap: 20px;
  margin-bottom: 25px;
}

.card {
  background: white;
  padding: 20px;
  border-radius: 8px;
  flex: 1;
  box-shadow: 0 0 6px rgba(0,0,0,0.05);
}

.card h3 {
  margin: 0;
  font-size: 14px;
  color: #888;
}

.card p {
  margin-top: 10px;
  font-size: 24px;
  font-weight: bold;
}

.card .success {
  color: #27ae60;
}

.card .warning {
  color: #e67e22;
}

.tab-nav {
  margin-top: 10px;
  display: flex;
  gap: 10px;
  margin-bottom: 30px;
}

.tab-nav button {
  padding: 10px 15px;
  background: #ecf0f1;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.tab-nav .active {
  background: #2980b9;
  color: white;
}

.user-panels {
  display: flex;
  gap: 30px;
  margin-bottom: 40px;
}

.add-user, .recent-users {
  background: white;
  padding: 20px;
  flex: 1;
  border-radius: 8px;
}

.add-user form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.add-user select, .add-user input {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.add-user button {
  padding: 10px;
  background: #2980b9;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.recent-users ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.recent-users li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.recent-users span {
  font-size: 12px;
  color: #888;
}

.status {
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 12px;
  border: none;
}

.status.active {
  background: #2ecc71;
  color: white;
}

.status.pending {
  background: #f39c12;
  color: white;
}

.user-directory {
  background: white;
  padding: 20px;
  border-radius: 8px;
}

.directory-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.directory-header input, .directory-header select {
  padding: 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background: #f0f0f0;
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

.edit, .delete {
  padding: 6px 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 12px;
}

.edit {
  background: #3498db;
  color: white;
  margin-right: 5px;
}

.delete {
  background: #e74c3c;
  color: white;
}

  </style> -->

</body>
</html>
