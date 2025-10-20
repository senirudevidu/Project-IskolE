<div class="container">
  <div class="heading-section">
    <div class="heading-text">Absence Requests Status</div>
    <div class="sub-heading-text">
      Track your submitted absence requests
    </div>
  </div>

  <div class="requests-list">
    <div class="request-card">
      <div class="request-info">
        <div class="request-date">August 25-26, 2025</div>
        <div class="request-reason">Family Wedding</div>
        <div class="request-sub-date">Submitted: August 16,2025</div>
      </div>
      <div class="request-status">
        <span class="status-badge approved">Approved</span>
      </div>
    </div>
    <div class="request-card">
      <div class="request-info">
        <div class="request-date">August 15, 2025</div>
        <div class="request-reason">Medical Appointment</div>
        <div class="request-sub-date">Submitted: July 14,2025</div>
      </div>
      <div class="report-action">
        <span class="status-badge pending">Pending</span>
      </div>
    </div>
    <div class="request-card">
      <div class="request-info">
        <div class="request-date">June 10, 2024</div>
        <div class="request-reason">Sudden Illness</div>
        <div class="request-sub-date">Submitted: June 9,2024</div>
      </div>
      <div class="report-action">
        <span class="status-badge approved">Approved</span>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="heading-section">
    <div class="heading-text">Submit Absence Request</div>
    <div class="sub-heading-text">Request absence in advance</div>
  </div>

  <form class="leave-request-form" action="../../app/Controllers/leaveReqController.php" method="POST">
    <div class="date-row">
      <div class="form-group">
        <label for="from-date">From Date</label>
        <input type="date" id="from-date" name="fromDate" class="input-date" placeholder="dd/mm/yyyy" />
      </div>
      <div class="form-group">
        <label for="to-date">To Date</label>
        <input type="date" id="to-date" name="toDate" class="input-date" placeholder="dd/mm/yyyy" />
      </div>
    </div>

    <div class="form-group">
      <label for="reason">Reason</label>
      <textarea id="reason" name="reason" class="textarea-details" placeholder="Provide necessary details"></textarea>
    </div>

    <button type="submit" class="btn-submit">Submit Request</button>
  </form>
</div>