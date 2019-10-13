<?php


namespace App\Tests\Service;


use App\Entity\Car;
use App\Service\CarLengthDeterminator;
use PHPUnit\Framework\TestCase;

class CarLengthDeterminatorTest extends TestCase
{
    /**
     * @dataProvider getSpecLengthTests
     */
    public function testItReturnCorrectLengthRange($spec, $minExpectedSize, $maxExpectedSize)
    {
        $determinator = new CarLengthDeterminator();
        $actualSize = $determinator->getLengthFromSpecification($spec);

        $this->assertGreaterThanOrEqual($minExpectedSize, $actualSize);
        $this->assertLessThanOrEqual($maxExpectedSize, $actualSize);
    }

    public function getSpecLengthTests()
    {
        return [
            // specification, min length, max length
            ['large carnivorous dinosaur', Car::LARGE, Car::HUGE - 1],
            'default response' => ['give me all the cookies!!!', 0, Car::LARGE - 1],
            ['large herbivore', Car::LARGE, Car::HUGE - 1],
            ['huge dinosaur', Car::HUGE, 100],
            ['huge dino', Car::HUGE, 100],
            ['huge', Car::HUGE, 100],
            ['OMG', Car::HUGE, 100]
        ];
    }
}