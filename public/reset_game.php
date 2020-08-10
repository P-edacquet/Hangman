<?php

use App\GameSlot;
use App\Http;

require '../src/autoload.php';

session_start();

$slot = new GameSlot();

$slot->resetGame();

// go back to play
Http::redirect('/game.php');
