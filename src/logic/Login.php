<?php
session_start();
// session_unset();
require_once __DIR__ . '/../core/connect.php';
require_once __DIR__ . '/../core/config.php';

if (isset($_POST["login"])) {

    $user_email    = trim($_POST["email"]);
    $user_password = trim($_POST["password"]);

   // validate email format
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["login_error"] = "Please enter a valid email address.";
        header("Location: " . TEMPLATES_URL . "/signIn.php");
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
            $_SESSION["id"]        = $row["id"];
            $_SESSION["user_name"] = $row["name"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["streak"] = $row["streak"];
            $_SESSION["max_streak"] = $row["max_streak"];
            $_SESSION["points"] = $row["points"];
            $_SESSION["last_week_points"] = $row["last_week_points"];
            $_SESSION["sessions"] = $row["sessions"];
            $_SESSION["achievements"] = $row["achievements"];
            $_SESSION["achievements_points"] = $row["achievements_points"];
            $_SESSION["created_at"] = $row["created_at"];
              
            echo "<script>
                    localStorage.setItem('loggedIn', 'true');
                    window.location.href = '" . TEMPLATES_URL . "/study-session.php';
                  </script>";
        } else {
            $_SESSION["login_error"] = "Incorrect password.";
           header("Location: " . TEMPLATES_URL . "/signin.php");
        }

    } else {
        $_SESSION["login_error"] = "No account found with this email.";
         header("Location: " . TEMPLATES_URL . "/signin.php");
    }
    exit();
}
?>