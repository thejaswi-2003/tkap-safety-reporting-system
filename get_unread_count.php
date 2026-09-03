<?php
include 'db_connect.php';

$sql = "SELECT COUNT(*) AS unread FROM notifications WHERE is_read = 0";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo $row['unread'];
?>