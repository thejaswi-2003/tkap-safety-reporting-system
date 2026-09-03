<?php
include 'db_connect.php';

$sql = "SELECT n.*, r.description FROM notifications n
        JOIN reports r ON n.report_id = r.report_id
        ORDER BY n.created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<?php include 'navbar.php'; ?>
<?php include 'slogan.php'; ?>
<div class="container mt-4">
    <h2 class="mb-4">Notifications</h2>
    <ul class="list-group">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <li class="list-group-item d-flex justify-content-between align-items-center <?php echo $row['is_read'] ? '' : 'bg-light fw-bold'; ?>">
            <a href="mark_notification_read.php?id=<?php echo $row['id']; ?>&report_id=<?php echo $row['report_id']; ?>" class="text-decoration-none text-dark flex-grow-1">
                <?php echo $row['message']; ?>
                <br><small class="text-muted fw-normal"><?php echo $row['created_at']; ?></small>
            </a>
            <?php if ($row['is_read']) { ?>
                <span class="text-success ms-2">✔ Done</span>
            <?php } else { ?>
                <span class="badge bg-danger ms-2">New</span>
            <?php } ?>
        </li>
    <?php } ?>
    </ul>
</div>



