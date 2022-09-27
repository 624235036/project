<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signup'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = $_POST['urole'];
        $school = $_POST['school_id'];

        if (empty($firstname)) {
            $_SESSION['error'] = 'please enter your name';
            header("location: index.php");
        } else if (empty($lastname)) {
            $_SESSION['error'] = 'please enter your last name';
            header("location: index.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'please enter email';
            header("location: index.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'invalid email format';
            header("location: index.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'please enter your password';
            header("location: index.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 10) {
            $_SESSION['error'] = 'password must be between 10 and 20 characters long.';
            header("location: index.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'please confirm your password.';
            header("location: index.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'passwords do not match';
            header("location: index.php");
        } else if (empty($school)) {
            $_SESSION['error'] = 'please enter school';
            header("location: index.php");
        } else if(empty($urole)) {
            $_SESSION['error'] = 'please enter urole';
            header("location: index.php");
        } else {
            try {

                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['warning'] = "this email is already in the system. <a href='signin.php'>Click here to </a> login ";
                    header("location: index.php");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, email, password, urole, school_id) 
                                            VALUES(:firstname, :lastname, :email, :password, :urole, :school_id)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->bindParam(":school_id", $school);
                    $stmt->execute();
                    $_SESSION['success'] = "registered successfully! <a href='signin.php' class='alert-link'>Click here to </a> login";
                    header("location: index.php");
                } else {
                    $_SESSION['error'] = "something went wrong!";
                    header("location: index.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>