<?php

session_start();
require_once '../config/db.php';

if (isset($_POST['submit'])) {
    $hdnRows = $_POST['hdnRows'];


    $stmt = $conn->prepare("INSERT INTO score( score) VALUES( :score)");
    $stmt->bindParam(":score", $hdnRows);
    $stmt->execute();
    $conn = null;

    if ($stmt) {
        $_SESSION['success'] = "registered successfully!";
        header("refresh:1; url=student.php");
    } else {
        $_SESSION['error'] = "something went wrong!";
        header("refresh:1; url=student.php");
    }
}
