<?php

class Game
{
    // UPPER_SNAKE_CASE
    public const MAX_ATTEMPTS = 11;

    // camelCase
    private $word;
    private $attempts;
    private $foundLetters;
    private $triedLetters;

    public function __construct(string $word, int $attempts = 0, array $foundLetters = [], array $triedLetters = [])
    {
        $this->word = strtolower($word);
        $this->attempts = $attempts;
        $this->foundLetters = $foundLetters;
        $this->triedLetters = $triedLetters;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getWordLetters(): array
    {
        return str_split($this->word); // 'toto' -> ['t', 'o', 't', 'o']
    }

    public function isLetterFound(string $letter): bool
    {
        return in_array($letter, $this->foundLetters, true);
    }

    public function getAttempts(): int
    {
        return $this->attempts;
    }

    public function getRemainingAttempts(): int
    {
        return self::MAX_ATTEMPTS - $this->attempts;
    }

    public function getFoundLetters(): array
    {
        return $this->foundLetters;
    }

    public function getTriedLetters(): array
    {
        return $this->triedLetters;
    }

    public function tryLetter(string $letter): void
    {
        $letter = strtolower($letter);

        if (in_array($letter, $this->triedLetters)) {
            $this->attempts++;
        } elseif (false !== strpos($this->word, $letter)) {
            $this->foundLetters[] = $letter;
            $this->triedLetters[] = $letter;
        } else {
            $this->attempts++;
            $this->triedLetters[] = $letter;
        }
    }

    public function tryWord(string $word): bool
    {
        $word = strtolower($word);

        // play the word
        if ($word === $this->word) {
            $this->foundLetters = array_unique(str_split($this->word));

            return true;
        } else {
            $this->attempts = self::MAX_ATTEMPTS;

            return false;
        }
    }

    public function isWon(): bool
    {
        $wordLetters = array_unique($this->getWordLetters());
        sort($wordLetters);
        sort($this->foundLetters);

        return $wordLetters === $this->foundLetters;
    }

    public function isFailed(): bool
    {
        return $this->attempts === self::MAX_ATTEMPTS;
    }
}

// todo class GameLoader or GameSlot (PascalCase)

function createGame(): void
{
    // load a list of words
    $wordList = [
        'horse',
        'carnivale',
        'random',
    ];

    // save the state in the session
    $randomWord = getRandomWord($wordList);
    $game = new Game($randomWord);
    saveGame($game);
}

function saveGame(Game $game): void
{
    $_SESSION['game'] = $game;
}

function loadGame(): Game
{
    return $_SESSION['game'];
}

function resetGame(): void
{
    if (isset($_SESSION['game'])) {
        $_SESSION['game'] = null;
    }
}
