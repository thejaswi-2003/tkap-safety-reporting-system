<?php
include 'db_connect.php';
include 'phpqrcode/qrlib.php';

if (!file_exists('qrcodes')) {
    mkdir('qrcodes');
}

// Auto-detect the current server IP so QR codes work on any network
// Hardcoded local network IP — update this if your PC's Wi-Fi IP changes (check via ipconfig)
$host = "10.103.36.146";
$base_url = "http://" . $host . "/safety-report";

$locations = mysqli_query($conn, "SELECT * FROM locations");

while ($loc = mysqli_fetch_assoc($locations)) {
    $location_id = $loc['location_id'];
    $url = $base_url . "/report.php?location_id=" . $location_id;
    $filename = "qrcodes/location_" . $location_id . ".png";

    QRcode::png($url, $filename, QR_ECLEVEL_L, 6);
}
?>


<?php include 'navbar.php'; ?>
<?php include 'slogan.php'; ?>
<div class="container mt-4">

    <h2 class="mb-4">Generated QR Codes</h2>
    <div class="alert alert-success">QR codes generated successfully!</div>
    <p class="text-muted">Server IP used for: <strong><?php echo htmlspecialchars($host); ?></strong></p>

    <div class="row">
        <?php
        // Re-run the query since the earlier $locations cursor is exhausted
        $locations_display = mysqli_query($conn, "SELECT * FROM locations");
        while ($loc = mysqli_fetch_assoc($locations_display)) {
            $location_id = $loc['location_id'];
            $location_name = htmlspecialchars($loc['location_name'] ?? 'Location ' . $location_id);
            $img_path = "qrcodes/location_" . $location_id . ".png";
        ?>
            <div class="col-md-3 col-sm-6 mb-4 text-center">
                <div class="card p-3">
                    <img src="<?php echo $img_path; ?>" alt="QR Code for <?php echo $location_name; ?>" class="img-fluid mb-2">
                    <p class="mb-1"><strong><?php echo $location_name; ?></strong></p>
                    <a href="<?php echo $img_path; ?>" download class="btn btn-sm btn-outline-primary">Download</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>