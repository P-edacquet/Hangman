<?php

namespace App;

class WordList
{
    private $words;

    public function __construct(array $words = [])
    {
        $this->words = $words;
    }

    public function loadTextFile(string $path)
    {
        $this->words = array_map(function ($word) {
            return trim($word);
        }, file($path));

        // version décomposée :
        $words = file($path);
        $trimCallback = function ($word) {
            return trim($word);
        };

        $this->words = array_map($trimCallback, $words);
    }

    public function getRandomWord(): string
    {
        if (empty($this->words)) {
            throw new \RuntimeException('The word list is empty. Did you forget to call "loadTextFile" first?');
        }

        $index = array_rand($this->words);

        return $this->words[$index];
    }
}

// todo TextFileLoader -> function file()

// todo XmlFileLoader -> SimpleXmlElement class

// todo WordListLoader::loadFile(),  xml ? -> XmlFileLoader->load()
//                                   txt ? -> TextFileLoader->load()

