<?php


namespace App\Factory;


use App\Entity\Car;
use App\Service\CarLengthDeterminator;

class CarFactory
{
    private $lengthDeterminator;

    public function __construct(CarLengthDeterminator $lengthDeterminator)
    {
        $this->lengthDeterminator = $lengthDeterminator;
    }

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

    public function makeFromSpecification(string $specification)
    {
        $brands = [
            'Audi',
            'BMW',
            'Mercedes-Benz',
            'Porsche',
            'Volvo',
        ];
        $brand = array_rand($brands);
        $length = $this->lengthDeterminator->getLengthFromSpecification($specification);
        $isConvertible = false;
        if (stripos($specification, 'electric') !== false) {
            $isConvertible = true;
        }
        $car = $this->makeCar($brand, $isConvertible, $length);

        return $car;
    }
}