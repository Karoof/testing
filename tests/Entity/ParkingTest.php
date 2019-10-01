<?php


namespace App\Tests\Entity;


use App\Entity\Car;
use App\Entity\Parking;
use App\Exception\CarsAreParkedInWrongPlacesException;
use App\Exception\NotACrashException;
use PHPUnit\Framework\TestCase;

class ParkingTest extends TestCase
{
    public function testItHasNoCarsByDefault()
    {
        $parking = new Parking(true);

        $this->assertCount(0, $parking->getCars());
    }

    public function testItAddsCar()
    {
        $parking = new Parking(true);
        $parking->addCar(new Car());
        $parking->addCar(new Car());

        $this->assertCount(2, $parking->getCars());
    }

    public function testItDoesNotAllowToParkElectricAndNonElectricCars()
    {
        $parking = new Parking(true);
        $parking->addCar(new Car());
        $this->expectException(NotACrashException::class);
        $parking->addCar(new Car('Lada', true));
    }

    /**
     * @expectedException \App\Exception\NotACrashException
     */
    public function testItDoesNotAllowToParkNonElectricCarsWithElectric()
    {
        $parking = new Parking(true);
        $parking->addCar(new Car('Lada', true));
        $parking->addCar(new Car());
    }

    public function testItDoesNotAllowToParkInParkingWithoutSpaces()
    {
        $parking = new Parking();

        $this->expectException(CarsAreParkedInWrongPlacesException::class);
        $this->expectExceptionMessage('Are you craaazy?!?');
        $parking->addCar(new Car());
    }
}