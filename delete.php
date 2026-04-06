<?php
include 'db.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    if($conn->query("DELETE FROM student WHERE id=$id") === TRUE) {
        header("Location: index.php?msg=deleted");
        exit();
    } else {
        header("Location: index.php?msg=error");
        exit();
    }
}
?>