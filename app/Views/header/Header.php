<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<header class="dashboard-header">
  <div class="dashboard-header-left">
    <div class="logo-title">
      <img src="../../../public/assests/logo.png" alt="logo" class="logo" />
    </div>

    <div class="dashboard-heading">
      <div class="dashboard-heading">
        <span class="dashboard-heading-text"><?php echo htmlspecialchars($_SESSION['role'] ?? 'User') . ' Dashboard'; ?></span>
      </div>

      <div class="dashboard-sub-heading">
        <span class="dashboard-sub-heading-text">Welcome</span>
        <span class="dashboard-sub-heading-text"><?php echo htmlspecialchars(($_SESSION['fName'] ?? '') . ' ' . ($_SESSION['lName'] ?? '')); ?></span>
      </div>
    </div>
  </div>

  <div class="dashboard-header-right">
    <div class="dashbboard-header-btn">
      <button class="logout-btn" onclick="logout()">Log out</button>
    </div>
  </div>
</header>