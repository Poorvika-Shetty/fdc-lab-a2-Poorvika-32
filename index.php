<?php
include 'db.php';

// HANDLE MESSAGES
$message = "";
$type = "success";

if(isset($_GET['msg'])) {
    if($_GET['msg'] == "added") {
        $message = "Student added successfully";
    } elseif($_GET['msg'] == "updated") {
        $message = "Student updated successfully";
    } elseif($_GET['msg'] == "deleted") {
        $message = "Student deleted successfully";
    } else {
        $message = "Something went wrong";
        $type = "danger";
    }
}

// INSERT DATA
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];

    $sql = "INSERT INTO student (name, email, mobile, department) 
            VALUES ('$name', '$email', '$mobile', '$department')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?msg=added");
        exit();
    } else {
        header("Location: index.php?msg=error");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student CRUD</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #667eea, #764ba2);
            color: white;
        }
        .container-box {
            background: white;
            color: black;
            padding: 25px;
            border-radius: 12px;
            margin-top: 40px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.2);
        }
        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="container-box">

        <h2 class="text-center text-primary">🎓 Student Management System</h2>

        <?php if($message != "") { ?>
            <div class="alert alert-<?php echo $type; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <h4>Add Student</h4>

        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="mobile" class="form-control" placeholder="Mobile" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="department" class="form-control" placeholder="Department" required>
            </div>
            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-success">Add Student</button>
            </div>
        </form>

        <hr>

        <h4>Student List</h4>

        <table class="table table-bordered table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $result = $conn->query("SELECT * FROM student");

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['mobile']."</td>
                        <td>".$row['department']."</td>
                        <td>
                            <a href='edit.php?id=".$row['id']."' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete.php?id=".$row['id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?')\">Delete</a>
                        </td>
                      </tr>";
            }
            ?>

            </tbody>
        </table>

    </div>
</div>

</body>
</html>