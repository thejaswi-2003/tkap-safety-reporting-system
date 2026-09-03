<?php
include 'db_connect.php';

$id = $_GET['id'];
$report_id = $_GET['report_id'];

$stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: view_reports.php?highlight=" . intval($report_id));
exit;
?>