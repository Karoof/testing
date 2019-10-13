<?php


namespace App\Service;


use App\Entity\Car;

class CarLengthDeterminator
{
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