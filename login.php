<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user && $user["account_activation_hash"] === null) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="register-container" id="register">
    
    <header>Login</header>
    
    <div class="form-box">
    
        <form method="post">

            <div class="input-box">
                <input type="email" name="email" id="email" placeholder="Email" class="input-field"
                    value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                <i class="bx bx-user"></i>
            </div>
        
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" class="input-field">
                <i class="bx bx-lock-alt"></i>
            </div>
        
            <div class="input-box">
                <input type="submit" class="submit" value="Log In">
            </div>

        </form>

        <div class="forgot-password">
            <a href="forgot-password.php">Forgot password?</a>
        </div>
        

    </div>
</div>
    
</body>
</html>







