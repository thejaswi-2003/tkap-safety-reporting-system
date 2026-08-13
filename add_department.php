<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_name = $_POST['dept_name'];
    $sql = "INSERT INTO departments (dept_name) VALUES ('$dept_name')";
    mysqli_query($conn, $sql);
}
?>

<?php include 'navbar.php'; ?>
<?php include 'slogan.php'; ?>
<div class="container mt-4" style="max-width:450px;">
    <h2 class="mb-4">Add Department</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <input type="text" name="dept_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Add Department</button>
    </form>
    <div class="mt-3">
        <a href="add_location.php">Go to Add Location →</a>
    </div>
</div>