<?php


namespace App\Entity;


use App\Exception\CarsAreParkedInWrongPlacesException;
use App\Exception\NotACrashException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Parking
{
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="parking", cascade={"persist"})
     */
    private $cars;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Space", mappedBy="parking", cascade={"persist"})
     */
    private $spaces;

    public function __construct(bool $withReservedSpaces = false)
    {
        $this->cars = new ArrayCollection();
        $this->spaces = new ArrayCollection();
        if ($withReservedSpaces) {
            $this->addSpace(new Space('Reserved', true, $this));
        }
    }

    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car)
    {
        if (!$this->isSpaceEmpty()) {
            throw new CarsAreParkedInWrongPlacesException('Are you craaazy?!?');
        }
        if (!$this->canParkACar($car)) {
            throw new NotACrashException();
        }
        $this->cars[] = $car;
    }

    public function canParkACar(Car $car): bool
    {
        return count($this->cars) === 0 || $this->cars->first()->isElectric() === $car->isElectric();
    }

    public function isSpaceEmpty(): bool
    {
        foreach ($this->spaces as $space) {
            /** @var $space Space */
            if ($space->getIsEmpty()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Collection
     */
    public function getSpaces(): Collection
    {
        return $this->spaces;
    }

    /**
     * @param Space $space
     */
    public function addSpace(Space $space): void
    {
        $this->spaces[] = $space;
    }
}