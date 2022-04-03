<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\UserFactory;
use App\Factory\MakeFactory;
use App\Factory\PhoneFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'username' => 'customer',
            'password' => '1111',
            'role' => 'ROLE_CUSTOMER'
        ]);

        UserFactory::createOne([
            'username' => 'chef',
            'password' => '1111',
            'role' => 'ROLE_CHEF'
        ]);

        UserFactory::createOne([
            'username' => 'waiter',
            'password' => '1111',
            'role' => 'ROLE_WAITER'
        ]);

        UserFactory::createOne([
            'username' => 'admin',
            'password' => '1111',
            'role' => 'ROLE_ADMIN'
        ]);

        UserFactory::createOne([
            'username' => 'manager',
            'password' => '1111',
            'role' => 'ROLE_MANAGER'
        ]);
    }
}
