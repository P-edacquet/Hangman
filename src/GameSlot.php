<?php

namespace App;

class GameSlot
{
    public function createGame(): void
    {
        // load a list of words
        $wordList = new WordList();
        $wordList->loadTextFile(__DIR__.'/../data/words.txt');

        // save the state in the session
        $game = new Game($wordList->getRandomWord());

        $this->saveGame($game);
    }

    public function saveGame(Game $game): void
    {
        $_SESSION['game'] = $game;
    }

    public function loadGame(): Game
    {
        return $_SESSION['game'];
    }

    public function resetGame(): void
    {
        if (isset($_SESSION['game'])) {
            $_SESSION['game'] = null;
        }
    }
}
