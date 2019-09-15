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

    public function testItMakesAHugeMini()
    {
        $this->markTestIncomplete('Model is canceled');
    }

    public function testItMakesAScooter()
    {
        if (!class_exists('Scooter')) {
            $this->markTestSkipped('Scooter class does not exist');
        }
    }
}