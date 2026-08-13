<?php
include 'db_connect.php';

$type_data = mysqli_query($conn, "
    SELECT i.type_name, COUNT(*) as count 
    FROM reports r 
    JOIN issue_types i ON r.issue_type_id = i.issue_type_id 
    GROUP BY i.type_name
");

$labels = [];
$counts = [];
while ($row = mysqli_fetch_assoc($type_data)) {
    $labels[] = $row['type_name'];
    $counts[] = $row['count'];
}

$status_data = mysqli_query($conn, "SELECT status, COUNT(*) as count FROM reports GROUP BY status");
$status_labels = [];
$status_counts = [];
while ($row = mysqli_fetch_assoc($status_data)) {
    $status_labels[] = $row['status'];
    $status_counts[] = $row['count'];
}

$total_reports = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM reports"))['c'];
$open_reports = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM reports WHERE status='Open'"))['c'];
$closed_reports = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM reports WHERE status='Closed'"))['c'];
?>

<?php include 'navbar.php'; ?>
<?php include 'slogan.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">EHS Dashboard</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Reports</h5>
                    <p class="card-text fs-3"><?php echo $total_reports; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Open</h5>
                    <p class="card-text fs-3"><?php echo $open_reports; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Closed</h5>
                    <p class="card-text fs-3"><?php echo $closed_reports; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h5>Reports by Issue Type</h5>
            <canvas id="typeChart"></canvas>
        </div>
        <div class="col-md-6">
       <h5>Reports by Status</h5>
       <div style="max-width:300px; margin:auto;">
           <canvas id="statusChart"></canvas>
       </div>
   </div>
    </div>

    <div class="mt-4">
        <a href="view_reports.php">View All Reports →</a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('typeChart'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'Number of Reports',
            data: <?php echo json_encode($counts); ?>,
            backgroundColor: '#377ADD'
        }]
    }
});

new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($status_labels); ?>,
        datasets: [{
            data: <?php echo json_encode($status_counts); ?>,
            backgroundColor: ['#F2A623','#EF8B2C','#63992a','#37ADD3']
        }]
    }
});
</script>