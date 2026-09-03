<?php
include 'db_connect.php';
include 'functions.php';

$report_id = isset($_GET['report_id']) ? $_GET['report_id'] : '';
$report = null;

if ($report_id) {
    $stmt = $conn->prepare("SELECT r.*, l.location_name, i.type_name 
            FROM reports r
            JOIN locations l ON r.location_id = l.location_id
            JOIN issue_types i ON r.issue_type_id = i.issue_type_id
            WHERE r.report_id = ?");
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $report = mysqli_fetch_assoc($result);
}
?>
<?php include 'navbar.php'; ?>
<?php include 'slogan.php'; ?>
<div class="container mt-4" style="max-width:500px;">
    <h2 class="mb-4">Check Report Status</h2>
    <form method="GET">
        <div class="input-group mb-3">
            <input type="text" name="report_id" class="form-control" placeholder="Enter your Report ID" value="<?php echo htmlspecialchars($report_id); ?>" required>
            <button class="btn btn-primary" type="submit">Check</button>
        </div>
    </form>

    <?php if ($report) { ?>
        <div class="card p-3">
            <p><strong>Location:</strong> <?php echo $report['location_name']; ?></p>
            <p><strong>Issue Type:</strong> <?php echo $report['type_name']; ?></p>
            <p><strong>Description:</strong> <?php echo $report['description']; ?></p>
            <p><strong>Status:</strong> 
                               <span class="badge bg-<?php echo statusColor($report['status']); ?>-subtle text-<?php echo statusColor($report['status']); ?>-emphasis border border-<?php echo statusColor($report['status']); ?>-subtle">
                    <?php echo $report['status']; ?>
                </span>
            </p>
        </div>
    <?php } elseif ($report_id) { ?>
        <div class="alert alert-warning">No report found with that ID.</div>
    <?php } ?>
</div>