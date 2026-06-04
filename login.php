<?php
session_start();
$error = "";

$admin_user = "admin";
$admin_pass = "museum2026";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: exhibits.php');
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>David Korunoski - Museum DB Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 450px; margin-top: 60px;">
        <h1>System Login</h1>
        <?php if ($error) echo "<p style='color:var(--danger); font-weight:bold; margin-bottom: 20px;'>$error</p>"; ?>
        
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required autocomplete="off">
            
            <label>Password:</label>
            <input type="password" name="password" required style="width: 100%; padding: 12px; margin: 10px 0 25px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box;">
            
            <div style="margin-top: 10px;">
                <button type="submit" style="width: 100%;">Sign In</button>
            </div>
        </form>
        <p style="text-align: center; margin-top: 20px;">
            <a href="index.php" style="color: #7f8c8d;">&larr; Back to Welcome Screen</a>
        </p>
    </div>
</body>
</html>