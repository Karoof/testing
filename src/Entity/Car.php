<?php


namespace App\Entity;


class Car
{
    private $length = 0;

    private $brand;

    private $isConvertible;

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
}