<?php


namespace App\Tests\Entity;


use App\Entity\Car;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    public function testTrue()
    {
        $this->assertTrue(true);
    }

    public function testLength()
    {
        $car = new Car();
        $this->assertSame(0, $car->getLength());
    }

    public function testSettingLength()
    {
        $car = new Car();
        $car->setlength(9);
        $this->assertSame(9, $car->getLength());
    }

    public function testReturnsFullSpecificationOfCar()
    {
        $car = new Car();
        $this->assertSame('The Unknown non-electric car is 0 meters long', $car->getSpecification());
    }

    public function testReturnsFullSpecificationForFerrari()
    {
        $car = new Car('Ferrari', true);

        $car->setLength(4);
        $this->assertSame('The Ferrari electric car is 4 meters long', $car->getSpecification());
    }
}