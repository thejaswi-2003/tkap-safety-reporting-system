<?php
include 'db_connect.php';
include 'phpqrcode/qrlib.php';

if (!file_exists('qrcodes')) {
    mkdir('qrcodes');
}

$locations = mysqli_query($conn, "SELECT * FROM locations");

while ($loc = mysqli_fetch_assoc($locations)) {
    $location_id = $loc['location_id'];
    $url = "http://10.28.49.146/safety-report/report.php?location_id=" . $location_id;
    $filename = "qrcodes/location_" . $location_id . ".png";

    QRcode::png($url, $filename, QR_ECLEVEL_L, 6);
}
?>

<?php include 'navbar.php'; ?>
<?php include 'slogan.php'; ?>
<div class="container mt-4">
    <h2 class="mb-4">Generated QR Codes</h2>
    <div class="alert alert-success">QR codes generated successfully!</div>

    <div class="row">
        <?php
        $locations = mysqli_query($conn, "SELECT * FROM locations");
        while ($loc = mysqli_fetch_assoc($locations)) {
            $location_id = $loc['location_id'];
            $name = $loc['location_name'];
            $filename = "qrcodes/location_" . $location_id . ".png";
            echo "<div class='col-md-3 text-center mb-4'>";
            echo "<div class='card p-3'>";
            echo "<img src='$filename' class='mx-auto d-block' style='width:150px;'>";
            echo "<p class='mt-2 mb-0'><b>$name</b></p>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>