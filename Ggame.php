<?php
session_start();

if (isset($_POST['reset'])) {
    unset($_SESSION['random_number']);
    unset($_SESSION['attempts']);
    $message = "Game has been reset! Start guessing again.";
}


if (!isset($_SESSION['random_number'])) {
    $_SESSION['random_number'] = rand(1, 100);
    $_SESSION['attempts'] = 0;
}


if (isset($_POST['guess_submit'])) {
    $guess = (int)$_POST['guess'];
    $randomNumber = $_SESSION['random_number'];
    $_SESSION['attempts']++; 

    if ($guess < $randomNumber) {
        $message = "Too low! Try again.";
    } elseif ($guess > $randomNumber) {
        $message = "Too high! Try again.";
    } else {
        $message = "Congratulations! You guessed the number in " . $_SESSION['attempts'] . " attempts!";
        unset($_SESSION['random_number']);
        unset($_SESSION['attempts']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Guessing Game</title>
</head>
<body>
    <h1>Guess the Number!</h1>
    <p>I'm thinking of a number between 1 and 100. Can you guess what it is?</p>

    <?php if (isset($message)): ?>
        <p><strong><?php echo htmlspecialchars($message); ?></strong></p>
    <?php endif; ?>

    <form method="post">
        <label for="guess">Enter your guess:</label>
        <input type="number" name="guess" id="guess" min="1" max="100" required>
        <button type="submit" name="guess_submit">Submit</button>
        <button type="submit" name="reset">Reset</button>
    </form>
</body>
</html>
