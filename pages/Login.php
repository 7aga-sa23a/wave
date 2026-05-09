<?php
session_start();
include("connect.php");

if (isset($_POST["login"])) {

    $user_email    = trim($_POST["email"]);
    $user_password = trim($_POST["password"]);

   // validate email format
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["login_error"] = "Please enter a valid email address.";
        header("Location: signIn.php");
        exit();
    }

    // check if email exists
   $select = "SELECT * FROM users WHERE email = '$user_email'";
    $result = mysqli_query($conn, $select);
    
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {

        if ($user_password == $row["password"]) {
            $_SESSION["user_id"]   = $row["id"];
            $_SESSION["user_name"] = $row["name"];
            header("Location: index.php");
        } else {
            $_SESSION["login_error"] = "Incorrect password.";
            header("Location: signIn.php");
        }

    } else {
        $_SESSION["login_error"] = "No account found with this email.";
        header("Location: signIn.php");
    }
    exit();
}
?>