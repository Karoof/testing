<?php


namespace App\Tests\Factory;


use App\Entity\Car;
use App\Factory\CarFactory;
use PHPUnit\Framework\TestCase;

class CarFactoryTest extends TestCase
{
    private $carFactory;

    public function setUp(): void
    {
        $this->carFactory = new CarFactory();
    }

    public function testItMakesALargeHummer()
    {
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
    public function testItMakesACarFromSpecification(string $spec, bool $expectedIsLarge, bool $expectedIsElectric)
    {
        $car = $this->carFactory->makeFromSpecification($spec);

        if ($expectedIsLarge) {
            $this->assertGreaterThan(Car::LARGE, $car->getLength());
        } else {
            $this->assertLessThan(Car::LARGE, $car->getLength());
        }
        $this->assertSame($expectedIsElectric, $car->isElectric());
    }

    public function getSpecificationTests()
    {
        return [
            ['large Electric', true, true],
            ['small car', false, false],
            ['I like my bycicle', false, false],
        ];
    }

    /**
     * @dataProvider getHugeCarSpecificationTests
     */
    public function testItMakesAHugeCar($spec)
    {
        $car = $this->carFactory->makeFromSpecification($spec);

        $this->assertGreaterThanOrEqual(Car::HUGE, $car->getLength());
    }

    public function getHugeCarSpecificationTests()
    {
        return [
            ['huge car'],
            ['huge'],
            ['omg']
        ];
    }

}