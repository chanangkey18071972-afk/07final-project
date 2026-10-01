<?php
session_start();

require_once __DIR__ . '/config/db.php';
$error = '';
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $statement->execute([$email]);
    $user = $statement->fetch(PDO::FETCH_OBJ);

     if($user && password_verify($password, $user->password)){

        $_SESSION['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
            ];
         header('Location: home.html');
        exit;
        } else {
    $error = "Invalid email or password. ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="logo-container">
        <img src="logo.png" alt="" class="auth-logo">
    </div>

    <div class="auth-wrapper">
        <div class="auth-card">
            <h1 class="title">Welcome back to ALV <span class="red-text">Racing</span></h1>
            <p class="subtitle">Log in to your account</p>

            <?php if ($error): ?>
                <div class="error-msg"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="handsome@gmail.com  " required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-auth">Log In</button>
            </form>

            <p class="auth-switch">
                Don't have an account? <a href="register.php">Sign up</a>
            </p>
        </div>
    </div>
    </div>
</body>
</html>