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

// load the game
$game = $slot->loadGame();


if (empty($_POST['word'])) {
    header('', true, 400);
}

if ($game->tryWord($_POST['word'])) {
    Http::redirect('/won.php');
} else {
    Http::redirect('/failed.php');
}

$slot->saveGame($game);
