<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location_id = $_POST['location_id'];
    $issue_type_id = $_POST['issue_type_id'];
    $description = $_POST['description'];
    $reported_by = $_POST['reported_by'];

    $stmt = $conn->prepare("INSERT INTO reports (location_id, issue_type_id, description, reported_by, status) VALUES (?, ?, ?, ?, 'Open')");
    $stmt->bind_param("iiss", $location_id, $issue_type_id, $description, $reported_by);

    if ($stmt->execute()) {
        $report_id = $stmt->insert_id;

        $notif_msg = "New issue reported at location ID " . $location_id;
        $notif_stmt = $conn->prepare("INSERT INTO notifications (report_id, message) VALUES (?, ?)");
        $notif_stmt->bind_param("is", $report_id, $notif_msg);
        $notif_stmt->execute();

        echo "<link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css' rel='stylesheet'>";
        echo "<div class='container mt-5 text-center'>";
        echo "<div class='alert alert-success'>";
        echo "<h4>Report submitted successfully. Thank you!</h4>";
        echo "<p>Your Report ID is: <strong>#" . $report_id . "</strong></p>";
        echo "<p>Save this ID to check your report's status later.</p>";
        echo "<a href='check_status.php?report_id=" . $report_id . "' class='btn btn-primary mt-2'>Check Status Now</a>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {

$scanned_location_id = isset($_GET['location_id']) ? $_GET['location_id'] : '';

$location_result = mysqli_query($conn, "SELECT * FROM locations");
$issue_result = mysqli_query($conn, "SELECT * FROM issue_types");
?>

<?php include 'navbar.php'; ?>
<?php include 'slogan.php'; ?>
<div class="container mt-4" style="max-width:500px;">
    <h2 class="mb-4">Report a Safety Issue</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Location</label>
            <select name="location_id" class="form-select" required>
                <option value="">-- Select Location --</option>
                <?php while ($row = mysqli_fetch_assoc($location_result)) { 
                    $selected = ($row['location_id'] == $scanned_location_id) ? 'selected' : '';
                ?>
                    <option value="<?php echo $row['location_id']; ?>" <?php echo $selected; ?>><?php echo $row['location_name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Issue Type</label>
            <select name="issue_type_id" class="form-select" required>
                <option value="">-- Select Issue Type --</option>
                <?php while ($row = mysqli_fetch_assoc($issue_result)) { ?>
                    <option value="<?php echo $row['issue_type_id']; ?>"><?php echo $row['type_name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Your Name/ID (optional)</label>
            <input type="text" name="reported_by" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit Report</button>
    </form>
</div>

<?php } ?>