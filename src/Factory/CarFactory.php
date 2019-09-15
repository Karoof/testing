<?php


namespace App\Factory;


use App\Entity\Car;

class CarFactory
{
    public function makeHummer(int $length)
    {
        return $this->makeCar('Hummer', false, $length);
    }

    public function makeCar(string $brand, bool $isConvertible, int $length)
    {
        $car = new Car($brand, $isConvertible);
        $car->setLength($length);

        return $car;
    }
}