<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Enum\DayType;
use App\Enum\TransportType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $employee = (new Employee())
            ->setName('Paul')
            ->setTransportType(TransportType::Car)
            ->setTravelDistance(60)
            ->setWorkingDays([
                DayType::Monday,
                DayType::Tuesday,
                DayType::Wednesday,
                DayType::Thursday,
                DayType::Friday,
            ]);
        $manager->persist($employee);

        $employee = (new Employee())
            ->setName('Martin')
            ->setTransportType(TransportType::Bus)
            ->setTravelDistance(8)
            ->setWorkingDays([
                DayType::Monday,
                DayType::Tuesday,
                DayType::Wednesday,
                DayType::Thursday,
            ]);
        $manager->persist($employee);

        $employee = (new Employee())
            ->setName('Jeroen')
            ->setTransportType(TransportType::Bike)
            ->setTravelDistance(9)
            ->setWorkingDays([
                DayType::Monday,
                DayType::Tuesday,
                DayType::Wednesday,
                DayType::Thursday,
                DayType::Friday
            ]);
        $manager->persist($employee);

        $employee = (new Employee())
            ->setName('Tineke')
            ->setTransportType(TransportType::Bike)
            ->setTravelDistance(4)
            ->setWorkingDays([
                DayType::Monday,
                DayType::Tuesday,
                DayType::Wednesday,
            ]);
        $manager->persist($employee);

        $employee = (new Employee())
            ->setName('Arnout')
            ->setTransportType(TransportType::Train)
            ->setTravelDistance(23)
            ->setWorkingDays([
                DayType::Monday,
                DayType::Tuesday,
                DayType::Wednesday,
                DayType::Thursday,
                DayType::Friday
            ]);
        $manager->persist($employee);

        $employee = (new Employee())
            ->setName('Matthijs')
            ->setTransportType(TransportType::Bike)
            ->setTravelDistance(11)
            ->setWorkingDays([
                DayType::Monday,
                DayType::Tuesday,
                DayType::Wednesday,
                DayType::Thursday,
                DayType::Friday
            ]);
        $manager->persist($employee);

        $employee = (new Employee())
            ->setName('Rens')
            ->setTransportType(TransportType::Car)
            ->setTravelDistance(12)
            ->setWorkingDays([
                DayType::Monday,
                DayType::Tuesday,
                DayType::Wednesday,
                DayType::Thursday,
                DayType::Friday
            ]);
        $manager->persist($employee);

        $manager->flush();
    }
}
