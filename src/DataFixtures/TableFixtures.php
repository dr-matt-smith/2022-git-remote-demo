<?php

namespace App\DataFixtures;


use App\Entity\Status;
use App\Entity\Table;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Twig\Node\Expression\Test\SameasTest;

class TableFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Fixtures for Status for table to access
        $available = new Status();
        $available->setStatusType('Available');

        $occupied = new Status();
        $occupied->setStatusType('Occupied');

        $reserved = new Status();
        $reserved->setStatusType('Reserved');

        $manager->persist($available);
        $manager->persist($occupied);
        $manager->persist($reserved);

        for ($i = 1; $i <= 12; $i++) {
            $table = new Table();
            $table
                ->setTableCapacity(mt_rand(2, 8))
                ->setStatusType($available);
            $manager->persist($table);
        }
        $manager->flush();
    }
}
