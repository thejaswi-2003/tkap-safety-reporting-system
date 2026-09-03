<?php
$host     = getenv('DB_HOST') ?: 'localhost';
$user     = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$database = getenv('DB_NAME') ?: 'safety_report_db';
$port     = getenv('DB_PORT') ?: 3306;

$conn = mysqli_init();

if ($host !== 'localhost') {
    mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
    mysqli_real_connect($conn, $host, $user, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL);
} else {
    mysqli_real_connect($conn, $host, $user, $password, $database, $port);
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>