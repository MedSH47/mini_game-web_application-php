<?php 
session_start();

if (!isset($_SESSION['user'])) {
    die("Name parameter missing");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    return;
}

$moves = ['Rock', 'Paper', 'Scissors'];
$computer_move = null;
$human_move = null;
$result = null;

// The "Test" scenario implementation
if (isset($_POST['human']) && $_POST['human'] == 3) {
    $test_results = '';
    for ($c = 0; $c < 3; $c++) {
        for ($h = 0; $h < 3; $h++) {
            $test_results .= "Human={$moves[$h]} Computer={$moves[$c]} Result=" . check($c, $h) . "<br>\n";
        }
    }
    echo $test_results;
} else if (isset($_POST['human']) && $_POST['human'] != -1) {
    $human_move = $moves[$_POST['human']];
    $computer_move = $moves[array_rand($moves)];
    $result = check(array_search($computer_move, $moves), $_POST['human']);
}

function check($computer, $human) {
    if ($human == $computer) {
        return "Tie";
    } else if (($human == 0 && $computer == 2) ||
               ($human == 1 && $computer == 0) ||
               ($human == 2 && $computer == 1)) {
        return "You Win";
    } else {
        return "You Lose";
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
    <h1>Rock Paper Scissors</h1>
    <?php
        if (isset($_SESSION['user'])) {
            echo "<p>Welcome: ".htmlentities($_SESSION['user'])."</p>\n";
        }
    ?>
    <form method="post">
        <select name="human">
            <option value="-1">Select</option>
            <option value="0">Rock</option>
            <option value="1">Paper</option>
            <option value="2">Scissors</option>
            <option value="3">Test</option>
        </select>
        <input type="submit" value="Play">
        <input type="submit" name="logout" value="Logout">
    </form>
    <?php
        if ($result !== null) {
            echo "<p>Your Play={$moves[$_POST['human']]} Computer Play=$computer_move Result=$result</p>\n";
        }
    ?>
</div>
</body>
</html>
