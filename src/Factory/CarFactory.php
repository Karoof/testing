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
        $length = $this->getLengthFromSpecification($specification);
        $isConvertible = false;
        if (stripos($specification, 'convertible') !== false) {
            $isConvertible = true;
        }
        $car = $this->makeCar($brand, $isConvertible, $length);

        return $car;
    }
    public function getLengthFromSpecification(string $specification): int
    {
        $availableLengths = [
            'huge' => ['min' => Car::HUGE, 'max' => 100],
            'omg' => ['min' => Car::HUGE, 'max' => 100],
            '😱' => ['min' => Car::HUGE, 'max' => 100],
            'large' => ['min' => Car::LARGE, 'max' => Car::HUGE - 1],
        ];
        $minLength = 1;
        $maxLength = Car::LARGE - 1;

        foreach (explode(' ', $specification) as $keyword) {
            $keyword = strtolower($keyword);

            if (array_key_exists($keyword, $availableLengths)) {
                $minLength = $availableLengths[$keyword]['min'];
                $maxLength = $availableLengths[$keyword]['max'];

                break;
            }
        }

        return random_int($minLength, $maxLength);
    }
}