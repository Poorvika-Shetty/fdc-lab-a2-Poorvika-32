<?php
include 'db.php';

// CHECK ID EXISTS
if(!isset($_GET['id'])) {
    die("Invalid request");
}

$id = $_GET['id'];

// FETCH EXISTING DATA
$result = $conn->query("SELECT * FROM student WHERE id=$id");

if($result->num_rows == 0) {
    die("Record not found");
}

$row = $result->fetch_assoc();

// UPDATE DATA
if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];

    $sql = "UPDATE student 
            SET name='$name', email='$email', mobile='$mobile', department='$department'
            WHERE id=$id";

    if($conn->query($sql) === TRUE) {
        header("Location: index.php?msg=updated");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
        }
        .box {
            background: white;
            padding: 25px;
            margin-top: 50px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
<div class="box">

<h2>Edit Student</h2>

<form method="POST" class="row g-3">
    <div class="col-md-6">
        <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
    </div>
    <div class="col-md-6">
        <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
    </div>
    <div class="col-md-6">
        <input type="text" name="mobile" class="form-control" value="<?php echo $row['mobile']; ?>" required>
    </div>
    <div class="col-md-6">
        <input type="text" name="department" class="form-control" value="<?php echo $row['department']; ?>" required>
    </div>

    <div class="col-12">
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </div>
</form>

</div>
</div>

</body>
</html>