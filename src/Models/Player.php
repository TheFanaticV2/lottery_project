<?php 
// Models/Player.php

class Player {
    protected $name;
    protected $numbers;
    protected $chanceNumber;

    public function __construct($name, $numbers, $chanceNumber) {
        $this->name = $name;
        $this->numbers = $numbers;
        $this->chanceNumber = $chanceNumber;
    }

    // Getters et setters
    public function getName() {
        return $this->name;
    }
    public function getNumbers() {
        return $this->numbers;
    }
    public function getChanceNumber() {
        return $this->chanceNumber;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setNumbers($numbers) {
        $this->numbers = $numbers;
    }
    public function setChanceNumber($chanceNumber) {
        $this->chanceNumber = $chanceNumber;
    }
}
