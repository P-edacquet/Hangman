<?php

use App\GameSlot;

require '../src/autoload.php';

session_start();

if (empty($_SESSION['game'])) {
    header('HTTP/2', true, 404);
    exit();
}

$slot = new GameSlot();

$game = $slot->loadGame();

if (!$game->isWon()) {
    header('HTTP/2', true, 404);
    exit();
}

$slot->resetGame();

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hangman Game - You won!</title>
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
                    <a href="/game/">Game</a>
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

            <h2>Congratulations!</h2>

            <p>
                You found the word
                    <strong>
                        <?php echo $game->getWord() ?>
                    </strong>
                and won this game.
            </p>

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
