<?php

class Person
{
    private $name;
    private $gender;
    public $age;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }
}

$toto = new Person();
$tata = new Person('tata');

$toto->setGender('female');

echo $toto->;

var_dump($toto->getName());

echo $toto->getName();
