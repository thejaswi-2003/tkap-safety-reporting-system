<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location_name = $_POST['location_name'];
    $dept_id = $_POST['dept_id'];
    $sql = "INSERT INTO locations (location_name, dept_id) VALUES ('$location_name', '$dept_id')";
    mysqli_query($conn, $sql);
}

$dept_result = mysqli_query($conn, "SELECT * FROM departments");
?>

<?php include 'navbar.php'; ?>
<?php include 'slogan.php'; ?>
<div class="container mt-4" style="max-width:450px;">
    <h2 class="mb-4">Add Location</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Location Name</label>
            <input type="text" name="location_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="dept_id" class="form-select" required>
                <option value="">-- Select Department --</option>
                <?php while ($row = mysqli_fetch_assoc($dept_result)) { ?>
                    <option value="<?php echo $row['dept_id']; ?>"><?php echo $row['dept_name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Add Location</button>
    </form>
    <div class="mt-3">
        <a href="generate_qr.php">Go to Generate QR Codes →</a> |
        <a href="view_reports.php">View Reports →</a>
    </div>
</div>