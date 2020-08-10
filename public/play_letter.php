<?php

use App\GameSlot;
use App\Http;

require '../src/autoload.php';

session_start();

if (empty($_SESSION['game'])) {
    header('', true, 404);
    exit;
}

$slot = new GameSlot();

$game = $slot->loadGame();

$game->tryLetter($_GET['letter']);

$slot->saveGame($game);

if ($game->isWon()) {
    Http::redirect('/won.php');
    exit();
}

if ($game->isFailed()) {
    Http::redirect('/failed.php');
    exit();
}

// go back to play
Http::redirect('/game.php');
