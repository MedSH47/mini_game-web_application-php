<?php 
session_start();

if (isset($_POST['cancel'])) {
    
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // Pw is 'php123'

$failure = false;

if (isset($_POST['who']) && isset($_POST['pass'])) {
    if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1) {
        $failure = "User name and password are required";
    } else {
        $check_hash = hash('md5', $salt.$_POST['pass']);
        if ($check_hash == $stored_hash) {
            $_SESSION['user'] = $_POST['who'];
            header("Location: game.php?name=".urlencode($_POST['who']));
            return;
        } else {
            $failure = "Incorrect password";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>2d5ee89c</title>
</head>
<body>
    <div>
        <h1>Please Log In</h1>
        <?php
        if ($failure !== false) {
            echo('<p style="color: red;">'.htmlentities($failure).'</p>');
        }
        ?>
        <form method="post">
            <label for="nam">User Name</label>
            <input type="text" name="who" id="nam"><br/>
            <label for="id_1723">Password</label>
            <input type="password" name="pass" id="id_1723"><br/>
            <input type="submit" value="Log In">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>
</body>
</html>
