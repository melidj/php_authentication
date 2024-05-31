<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user
        WHERE account_activation_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

$sql = "UPDATE user
        SET account_activation_hash = NULL
        WHERE id = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $user["id"]);

$stmt->execute();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Activated</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="register-container" id="register">
    <header>
        Signup Successful!
    </header>
    
    <div class="redirect-login">
        <p>Account activated successfully. You can now</p>
        <a href="login.php">
            <input type="submit" class="log-out" value="Log In">
        </a>
    </div>
      
</div>

</body>
</html>