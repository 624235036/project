<?php 

    session_start();
    require_once '../../config/db.php';

    if (isset($_POST['submit'])) {
        $student_name = $_POST['student_name'];
        $student_lastname = $_POST['student_lastname'];
        $class_years = $_POST['class_years'];
        $school = $_POST['school_id'];
    

                    $stmt = $conn->prepare("INSERT INTO student(student_name, student_lastname, class_years, school_id) 
                                            VALUES(:student_name, :student_lastname, :class_years, :school_id)");
                    $stmt->bindParam(":student_name", $student_name);
                    $stmt->bindParam(":student_lastname", $student_lastname);
                    $stmt->bindParam(":class_years", $class_years);
                    $stmt->bindParam(":school_id", $school);
                    $stmt->execute();
                    $conn = null;
                   
                   if ($stmt > 0){
                   $_SESSION['success'] = "registered successfully!";
                    header("location:student.php");
                } else {
                    $_SESSION['error'] = "something went wrong!";
                    header("location:student.php");
                }
    
                }

?>