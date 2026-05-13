<?php

require_once __DIR__ . '/../core/connect.php';
require_once __DIR__ . '/../core/config.php';

session_start();

if(isset($_POST["register"])) {

    $user_name = $_POST["name"];
    $user_email = $_POST["email"];
    $user_password = $_POST["password"];

     //  validate email
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["signup_error"] = "Please enter a valid email address.";
        header("Location: " . TEMPLATES_URL . "/signUp.php");
        
    }

    $select = "SELECT name FROM users WHERE email = '$user_email'";

    $result = mysqli_query($conn, $select);
    echo mysqli_num_rows($result);
    if(mysqli_num_rows($result) > 0) {

        $_SESSION["signup_error"] = "This email is already registered.";
        header("Location: " . TEMPLATES_URL . "/signUp.php");

    } else {
        $insert = "INSERT INTO users (name, email, password) VALUES ('$user_name', '$user_email', '$user_password')";
        if(mysqli_query($conn, $insert) === TRUE) {
            $_SESSION["login_success"] = "Your account has been created successfully. Please log in.";
            header("Location: " . TEMPLATES_URL . "/signIn.php");
        } else {
            $_SESSION["signup_error"] = "Error: " . mysqli_error($conn);
        }

    }
    exit();
}
?>