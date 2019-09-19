<?php


namespace App\Tests\Entity;


use App\Entity\Car;
use App\Entity\Parking;
use PHPUnit\Framework\TestCase;

class ParkingTest extends TestCase
{
    public function testItHasNoCarsByDefault()
    {
        $parking = new Parking();

        $this->assertCount(0, $parking->getCars());
    }

    public function testItAddsCar()
    {
        $parking = new Parking();
        $parking->addCar(new Car());
        $parking->addCar(new Car());

        $this->assertCount(2, $parking->getCars());
    }
}