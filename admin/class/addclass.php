<?php 

    session_start();
    require_once '../../config/db.php';

    if (isset($_POST['submit'])) {
        $schoolname = $_POST['schoolname'];
        $class = $_POST['id_class'];
        // $class_group = $_POST['class_group'];
        $school_id = $_POST['school_id'];
    

                    $stmt = $conn->prepare("INSERT INTO class_room(class_name, id_class, id_school) 
                                            VALUES(:class_name, :id_class, :id_school)");
                    $stmt->bindParam(":class_name", $schoolname);
                    $stmt->bindParam(":id_class", $class);
                    // $stmt->bindParam(":id_class_group", $class_group);
                    $stmt->bindParam(":id_school", $school_id);
                    $stmt->execute();
                    
                   
                   if ($stmt){
                   $_SESSION['success'] = "เพิ่มข้อมูลสำเร็จ";
                    header("location:class.php");
                } else {
                    $_SESSION['error'] = "เพิ่มข้อมูลล้มเหลว";
                    header("location:class.php");
                }
    
                }

?>