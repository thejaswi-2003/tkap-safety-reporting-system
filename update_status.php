<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report_id = $_POST['report_id'];
    $new_status = $_POST['status'];

    $sql = "UPDATE reports SET status = '$new_status' WHERE report_id = '$report_id'";
    mysqli_query($conn, $sql);

    $log_sql = "INSERT INTO status_history (report_id, status, changed_by) 
                VALUES ('$report_id', '$new_status', 'EHS Officer')";
    mysqli_query($conn, $log_sql);

    header("Location: view_reports.php");
    exit;
}
?>