<?php 

    session_start();
    require_once '../../config/db.php';

    if (isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = $_POST['urole'];
       

        if (empty($firstname)) {
            $_SESSION['error'] = 'please enter your name';
            header("location: director.php");
        } else if (empty($lastname)) {
            $_SESSION['error'] = 'please enter your last name';
            header("location: director.php");
        } else if (empty($phone)) {
            $_SESSION['error'] = 'please enter your last name';
            header("location:director.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'please enter email';
            header("location: director.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'invalid email format';
            header("location: director.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'please enter your password';
            header("location: director.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 10) {
            $_SESSION['error'] = 'password must be between 10 and 20 characters long.';
            header("location: director.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'please confirm your password.';
            header("location: director.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'passwords do not match';
            header("location:director.php");
        } else {
            try {

                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['warning'] = "this email is already in the system.";
                    header("location: director.php");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, phone, email, password) 
                                            VALUES(:firstname, :lastname, :phone , :email, :password)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":phone", $phone);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);

                    if ($stmt->execute()) {
                        $_SESSION = "Insert Successfully...";
                        header("refresh:2;director.php");
                    }
                } else {
                    $_SESSION['error'] = "something went wrong!";
                    header("location:director.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>