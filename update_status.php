<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report_id = $_POST['report_id'];
    $new_status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE reports SET status = ? WHERE report_id = ?");
    $stmt->bind_param("si", $new_status, $report_id);
    $stmt->execute();

    $log_stmt = $conn->prepare("INSERT INTO status_history (report_id, status, changed_by) VALUES (?, ?, 'EHS Officer')");
    $log_stmt->bind_param("is", $report_id, $new_status);
    $log_stmt->execute();

    header("Location: view_reports.php");
    exit;
}
?>