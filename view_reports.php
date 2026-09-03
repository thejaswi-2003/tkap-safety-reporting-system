<?php
include 'db_connect.php';
include 'functions.php';

$sql = "SELECT r.report_id, l.location_name, i.type_name, r.description, 
               r.reported_by, r.reported_at, r.status
        FROM reports r
        JOIN locations l ON r.location_id = l.location_id
        JOIN issue_types i ON r.issue_type_id = i.issue_type_id
        ORDER BY r.reported_at DESC";

$result = mysqli_query($conn, $sql);
$highlight_id = isset($_GET['highlight']) ? $_GET['highlight'] : null;
?>

<?php include 'navbar.php'; ?>
<?php include 'slogan.php'; ?>
<div class="container mt-4">
    <h2 class="mb-4">All Safety Reports</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Issue Type</th>
                <th>Description</th>
                <th>Reported By</th>
                <th>Date/Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
               <?php while ($row = mysqli_fetch_assoc($result)) { 
            $is_highlighted = ($highlight_id == $row['report_id']);
        ?>
        <tr id="report-<?php echo $row['report_id']; ?>" class="<?php echo $is_highlighted ? 'table-warning' : ''; ?>">
            <td><?php echo $row['report_id']; ?></td>
            <td><?php echo $row['location_name']; ?></td>
            <td><?php echo $row['type_name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['reported_by']; ?></td>
            <td><?php echo $row['reported_at']; ?></td>
            <td>
                                <span class="badge bg-<?php echo statusColor($row['status']); ?>-subtle text-<?php echo statusColor($row['status']); ?>-emphasis border border-<?php echo statusColor($row['status']); ?>-subtle mb-1"><?php echo $row['status']; ?></span><br>
                <form method="POST" action="update_status.php" class="d-flex gap-1 mt-1">
                    <input type="hidden" name="report_id" value="<?php echo $row['report_id']; ?>">
                    <select name="status" class="form-select form-select-sm">
                        <option value="Open">Open</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Action Taken">Action Taken</option>
                        <option value="Closed">Closed</option>
                    </select>
                                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                </form>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
 
<?php if ($highlight_id): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('report-<?php echo $highlight_id; ?>');
    if (el) el.scrollIntoView({ behavior: 'smooth', block: 'center' });
});
</script>
<?php endif; ?>