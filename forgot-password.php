<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="signup.css">
</head>
<body>

<div class="register-container" id="register">

    <header>Forgot Password</header>

    <div class="form-box">

    <form method="post" action="send-password-reset.php">

        <div class="input-box">
            <input type="email" id="email" name="email" placeholder="Email" class="input-field">
            <i class="bx bx-envelope"></i>
        </div>

        <div class="input-box">
            <input type="submit" class="submit" value="Send">
        </div>

    </form>

    </div>

</div>

</body>
</html>