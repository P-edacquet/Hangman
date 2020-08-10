<?php

// todo class WordList

function getRandomWord(array $wordList): string
{
    return $wordList[array_rand($wordList)];
}
