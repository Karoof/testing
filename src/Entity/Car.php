<?php


namespace App\Entity;


class Car
{
    const LARGE = 5;

    const HUGE = 30;

    private $length = 0;

    private $brand;

    private $isConvertible;

    private $isElectric;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Parking", inversedBy="cars",)
     */
    private $parking;

    public function __construct(string $brand = 'Unknown', bool $isElectric = false)
    {
        $this->brand = $brand;
        $this->isElectric = $isElectric;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
    }

    public function getSpecification()
    {
        $specification = 'The %s %selectric car is %d meters long';

        return sprintf($specification, $this->brand, $this->isElectric ? '' : 'non-', $this->length);
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function isElectric(): bool
    {
        return $this->isElectric;
    }

    public function isConvertible(): bool
    {
        return $this->isConvertible;
    }
}