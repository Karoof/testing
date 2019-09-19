<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Parking
{
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="parking", cascade={"persist"})
     */
    private $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car)
    {
        $this->cars[] = $car;
    }
}