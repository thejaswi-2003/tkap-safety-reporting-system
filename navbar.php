<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">TKAP Safety Reporting</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
       <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
<li class="nav-item"><a class="nav-link" href="view_reports.php"><i class="bi bi-list-check"></i> All Reports</a></li>
<li class="nav-item"><a class="nav-link" href="report.php"><i class="bi bi-exclamation-triangle"></i> Report Issue</a></li>
<li class="nav-item"><a class="nav-link" href="add_department.php"><i class="bi bi-building"></i> Add Department</a></li>
<li class="nav-item"><a class="nav-link" href="add_location.php"><i class="bi bi-geo-alt"></i> Add Location</a></li>
<li class="nav-item"><a class="nav-link" href="generate_qr.php"><i class="bi bi-qr-code"></i> QR Codes</a></li>
<li class="nav-item"><a class="nav-link" href="check_status.php"><i class="bi bi-search"></i> Check Status</a></li>
  <a class="nav-link position-relative" href="notifications.php">
    <i class="bi bi-bell"></i> Notifications
    <span id="notif-badge" class="badge bg-danger rounded-pill" style="display:none; position:relative; top:-8px;">0</span>
  </a>
</li>
      </ul>
    </div>
  </div>
</nav>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
function updateNotifBadge() {
    fetch('get_unread_count.php')
        .then(res => res.text())
        .then(count => {
            const badge = document.getElementById('notif-badge');
            count = parseInt(count);
            if (count > 0) {
                badge.textContent = count;
                badge.style.display = 'inline-block';
            } else {
                badge.style.display = 'none';
            }
        });
}
updateNotifBadge();
setInterval(updateNotifBadge, 15000);
</script>