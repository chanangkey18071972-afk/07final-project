<?php
session_start();

require_once __DIR__ . '/config/db.php';
$error = '';
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $statement->execute([$email]);
    $user = $statement->fetch();

    if ($user) {
        echo 'That email is already registered.';
    } else {

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $statement = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $statement->execute([$name, $email, $hashedPassword]);

    $id = $pdo->lastInsertId();
        $_SESSION['user'] = [
            'id' => $id,
            'name' => $name,
            'email' => $email ,
        ];

    header('Location: products.php');
    exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            <h1>Welcome to <span class="text-red">ALV Racing</span></h1>
            <p class="subtitle">Sign up to start shopping</p>

            <?php if ($error): ?>
                <div class="error-msg"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Jane Smith" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-auth">Create Account</button>
            </form>

            <p class="auth-switch">
                Already have an account? <a href="login.php">Log in</a>
            </p>
        </div>
    </div>

</body>
</html>