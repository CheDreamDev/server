<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $cities = [
        'Київ',
        'Одеса',
        'Миколаїв',
        'Харків',
        'Черкаси',
        'Ужгород',
        'Дніпропетровськ',
        'Суми',
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->cities as $cityName) {
            $city = new City();
            $city->setName($cityName);
            $manager->persist($city);
        }

        $manager->flush();
    }
}
