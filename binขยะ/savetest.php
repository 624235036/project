<?php

session_start();
require_once '../../config/db.php';

if (isset($_POST['submit'])) {
    $q01 = $_POST['q01'];


    $stmt = $conn->prepare("INSERT INTO scoretest( score, id_queustion) 
                                        VALUES( :score, :id_queustion)");
    $stmt->bindParam(":score", $q01);
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
