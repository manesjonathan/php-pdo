<?php

namespace model;
class Hiking
{
    private $id;
    private $name;
    private $difficulty;
    private $distance;
    private $duration;
    private $height_difference;
    private bool $available;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDifficulty()
    {
        return $this->difficulty;
    }

    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    public function getDistance()
    {
        return $this->distance;
    }

    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getHeightDifference()
    {
        return $this->height_difference;
    }

    public function setHeightDifference($height_difference)
    {
        $this->height_difference = $height_difference;
    }


    public function getAvailability(): bool
    {
        return $this->available;
    }

    public function setAvailability($availability)
    {
        $this->available = $availability;
    }
}