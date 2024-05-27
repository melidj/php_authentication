<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="register-container" id="register">
    
    <header>Home</header>

    <div class="form-box">
    
    <?php if (isset($user)): ?>
        
        <div class="container">
            <div class="p-style">
                <p>Hello <?= htmlspecialchars($user["name"]) ?></p>          
            </div>
        
            <div class="button-container">
                <a href="logout.php">
                    <input type="submit" class="log-out" value="Log Out">
                </a>
            </div>
        </div>

    <?php else: ?>
        <div class="container">
            <a href="login.php">
                <input type="submit" class="re-loggin" value="Log In">
            </a>
            
            <a href="signup.html">
                <input type="submit" class="re-loggin" value="Sign Up">
            </a>
    <?php endif; ?> 

    </div>

</div>
    
    
</body>
</html>  