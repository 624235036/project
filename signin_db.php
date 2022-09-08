<?php 
    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signin'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];
 
       if (empty($email)) {
            $_SESSION['error'] = 'please enter email';
            header("location: signin.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'invalid email format';
            header("location: signin.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'please enter your password';
            header("location: signin.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 10) {
            $_SESSION['error'] = 'password must be between 10 and 20 characters long.';
            header("location: signin.php");
    
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $check_data->bindParam(":email", $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data ->rowCount()> 0) {

               if ($email == $row['email']) {
                        if (password_verify($password, $row['password'])) {
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['id'];
                                header("location: admin/admin.php");//ผู้ดูแล
                            } else if ($row['urole'] == 'director'){
                                $_SESSION['director_login'] = $row['id'];
                                header("location: director.php");//ผู้อำนวยการ user 
                            }else {
                                $_SESSION['tech_login'] = $row['id'];
                                header("location: tech.php");
                            }//คุณครู User
                            
                         } else {
                            $_SESSION['error'] = 'password error';
                            header("location: signin.php");
                        }
                    } else {
                        $_SESSION['error'] = 'e-mail error';
                        header("location: signin.php");
                    }
                } else {
                    $_SESSION['error'] = "No information in the system";
                    header("location: signin.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>