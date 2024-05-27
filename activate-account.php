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
    <link rel="stylesheet" href="signup.css">
</head>
<body>

<div class="register-container" id="register">
    <header>
        Signup Successful!
    </header>

    <div class="redirect-login">
        <p>Account activated successfully. You can now
       <a href="login.php">Log in</a>.</p>
    </div>
      
</div>

</body>
</html>