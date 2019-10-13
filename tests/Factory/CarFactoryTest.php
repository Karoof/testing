<?php


namespace App\Tests\Factory;


use App\Entity\Car;
use App\Factory\CarFactory;
use App\Service\CarLengthDeterminator;
use PHPUnit\Framework\TestCase;

class CarFactoryTest extends TestCase
{
    private $carFactory;

    public function setUp(): void
    {
        $mockLengthDeterminator = $this->createMock(CarLengthDeterminator::class);
        $this->carFactory = new CarFactory($mockLengthDeterminator);
    }

    public function testItMakesALargeHummer()
    {
        /** @var Car $car */
        $car = $this->carFactory->makeHummer(6);
        $this->assertInstanceOf(Car::class, $car);
        $this->assertIsString($car->getBrand());
        $this->assertSame('Hummer', $car->getBrand());
        $this->assertSame(6, $car->getLength());
    }

//    public function testItMakesAHugeMini()
//    {
//        $this->markTestIncomplete('Model is canceled');
//    }
//
//    public function testItMakesAScooter()
//    {
//        if (!class_exists('Scooter')) {
//            $this->markTestSkipped('Scooter class does not exist');
//        }
//    }

    /**
     * @dataProvider getSpecificationTests
     */
    public function testItMakesACarFromSpecification(string $spec, bool $expectedIsElectric)
    {
        $car = $this->carFactory->makeFromSpecification($spec);

        $this->assertSame($expectedIsElectric, $car->isElectric());
    }

    public function getSpecificationTests()
    {
        return [
            ['large Electric', true],
            ['small car', false],
            ['I like my bycicle', false],
        ];
    }
}