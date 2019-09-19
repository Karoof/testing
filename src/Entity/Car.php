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

    public function __construct(string $brand = 'Unknown', bool $isConvertible = false)
    {
        $this->brand = $brand;
        $this->isConvertible = $isConvertible;
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
        $specification = 'The %s %sconvertible car is %d meters long';

        return sprintf($specification, $this->brand, $this->isConvertible ? '' : 'non-', $this->length);
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