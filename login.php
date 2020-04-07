<?php
require_once './includes/init.php';

use MySqlSessions\Sessions\AutoLogin;

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $pwd = trim($_POST['pwd']);
    $stmt = $db->prepare('SELECT pwd FROM users WHERE username = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $stored = $stmt->fetchColumn();
    if (password_verify($pwd, $stored)) {
        session_regenerate_id(true);
        $_SESSION['username'] = $username;
        $_SESSION['authenticated'] = true;
        if (isset($_POST['remember'])) {
            // create persistent login
            $autologin = new AutoLogin($db);
            $autologin->persistentLogin();
        }
        header('Location: restricted1.php');
        exit;
    } else {
        $error = 'Login failed. Check username and password.';
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Auto Login</title>
    <style>
        body {
            background-color: #fff;
            color: #1B1B1B;
            font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
            margin-left: 50px;
        }
        label {
            display: inline-block;
            width: 5em;
            text-align: right;
        }
        label[for=remember] {
            width: auto;
        }
    </style>
</head>

<body>
<h1>Persistent Login</h1>
<?php
if (isset($error)) {
    echo "<p>$error</p>";
}
?>
<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
    <p>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
    </p>
    <p>
        <label for="pwd">Password:</label>
        <input type="password" name="pwd" id="pwd">
    </p>
    <p>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me </label>
    </p>
    <p>
        <input type="submit" name="login" id="login" value="Log In">
    </p>
</form>
</body>
</html>