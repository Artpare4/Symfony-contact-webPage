<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Factory\CategoryFactory;
use App\Factory\ContactFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ContactFactory::createMany(150, function () {
            if (ContactFactory::faker()->boolean(90)) {
                return [
                  'category' => CategoryFactory::random(),
                ];
            } else {
                return [
                'category' => null,
                ];
            }
        });
    }

    public function getDependencies(): array
    {
        return [
            Category::class,
        ];
    }
}
