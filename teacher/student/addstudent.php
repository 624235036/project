<?php 

    session_start();
    require_once '../../config/db.php';

    if (isset($_POST['submit'])) {
        $student_name = $_POST['student_name'];
        $student_lastname = $_POST['student_lastname'];
        $id_room = $_POST['id_room'];
        $school = $_POST['school_id'];
        $id_teacher = $_POST['id_teacher'];
    

                    $stmt = $conn->prepare("INSERT INTO student(student_name, student_lastname, id_room, school_id, id_teacher) 
                                            VALUES(:student_name, :student_lastname, :id_room, :school_id, :id_teacher)");
                    $stmt->bindParam(":student_name", $student_name);
                    $stmt->bindParam(":student_lastname", $student_lastname);
                    $stmt->bindParam(":id_room", $id_room);
                    $stmt->bindParam(":school_id", $school);
                    $stmt->bindParam(":id_teacher", $id_teacher);
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