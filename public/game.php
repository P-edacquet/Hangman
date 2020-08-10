<?php

use App\GameSlot;

require '../src/autoload.php';

error_reporting(E_ALL);

session_start();

$slot = new GameSlot();

if (empty($_SESSION['game'])) {
    $slot->createGame();
}

$game = $slot->loadGame();

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hangman Game</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>
<div id="wrapper">
<div id="header">
    <div id="logo">
        <h1>
            <a href="/">Hangman</a>
        </h1>
    </div>
    <div id="menu">
        <ul>
            <li class="first current_page_item">
                <a href="/public/game.php">Game</a>
            </li>
            <li>
                <a href="/signup">Register</a>
            </li>
            <li>
                <a href="/signin">Login</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
        <br class="clearfix" />
    </div>
</div>

<div id="page">
<div id="content">

    <h2>Guess the mysterious word</h2>

    <p class="attempts">
        You still have <?php echo $game->getRemainingAttempts() ?> remaining attempts.
    </p>

    <ul class="word_letters">
        <?php foreach ($game->getWordLetters() as $letter) : ?>
            <li class="letter hidden">
                <?php if ($game->isLetterFound($letter)) {
                    echo $letter;
                } else {
                    echo '?';
                }
                ?>
                <?php //echo $game->isLetterFound($letter) ? $letter : '?' ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <br class="clearfix" />

    <p class="attempts">
        <a href="/public/reset_game.php">Reset the game</a>
    </p>

    <br class="clearfix" />

    <h2>Try a letter</h2>

    <ul>
        <?php foreach (range('A', 'Z') as $letter) : ?>
            <li class="letter">
                <a href="play_letter.php?letter=<?php echo $letter ?>">
                    <?php echo $letter ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Try a word</h2>

    <form action="play_word.php" method="post">
        <p>
            <label for="word">Word:</label>
            <input type="text" id="word" name="word"/>
            <button type="submit">Let me guess...</button>
        </p>
    </form>

</div>
<div id="sidebar">
    <h3>Last Games</h3>
    <div class="date-list">
        <ul class="list date-list">

            <li class="first"><span class="date">Jan 13</span> <a href="#">Ultrices quisque molestie</a></li>
            <li><span class="date">Jan 7</span> <a href="#">Neque dolor eget</a></li>
            <li><span class="date">Jan 1</span> <a href="#">Sollicitudin interdum</a></li>
            <li class="last"><span class="date">Dec 26</span> <a href="#">Varius dignissim</a></li>

        </ul>
    </div>
    <h3>Last players</h3>
    <ul>
        <li>user 1</li>
        <li>user 2</li>
        <li>user 3</li>
        <li>user 4</li>
        <li>user 5</li>
    </ul>
</div>
<br class="clearfix" />
</div>
</div>

</body>
</html>
