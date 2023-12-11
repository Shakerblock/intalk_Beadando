<?php
session_start();

if (isset($_SESSION['user']) && $_SESSION['user'] === 'aaa') {
    header('Location: tartalom.php');
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'aaa' && $password === 'aaa') {
        $_SESSION['user'] = $username;
        header('Location: tartalom.php');
        exit();
    } else {
        $error = "Hibás felhasználónév vagy jelszó!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
</head>
<body>
    <h2>Bejelentkezés</h2>
    
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="index.php">
        <label>Felhasználónév:</label>
        <input type="text" name="username" required><br>

        <label>Jelszó:</label>
        <input type="password" name="password" required><br>

        <input type="submit" name="login" value="Belépés">
    </form>
</body>
</html>
