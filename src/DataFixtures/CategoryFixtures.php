<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__.'/data/Category.json'), true);
        foreach ($data as $elmt) {
            $catg = new Category();
            $catg->setName($elmt['name']);
            $manager->persist($catg);
        }

        $manager->flush();
    }
}
