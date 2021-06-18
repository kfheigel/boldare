<?php

namespace App\DataFixtures;

use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class WorkerFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $worker = new Worker();
        $worker->setName('Adam');
        $worker->setSurname('Kowalski');
        $worker->setSalary(4500);
        $worker->setUuid(Uuid::v4());
        $worker->setStreetName('Zbożowa');
        $worker->setHouseNo('13/13');
        $worker->setZipCode('70-700');
        $worker->setCity('Szczecin');
        $worker->setWorkerType('CEO');

        $manager->persist($worker);
        $manager->flush();
    }
}
