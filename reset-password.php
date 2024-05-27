<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="signup.css">
</head>
<body>

<div class="register-container" id="register">

    <header>Reset Password</header>

    <div class="form-box">

    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <div class="input-box">
            <input type="password" id="password" name="password" placeholder="New Password" class="input-field">
            <i class="bx bx-lock-alt"></i>
        </div>

        <div class="input-box">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" class="input-field">
            <i class="bx bx-lock-alt"></i>
        </div>

        <div class="input-box">
            <input type="submit" class="submit" value="Send">
        </div>

    </form>

    </div>

</div>

</body>
</html>