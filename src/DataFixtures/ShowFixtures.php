<?php

namespace App\DataFixtures;

use App\Entity\Show;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ShowFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $shows = [
            ['name' => 'Spectacle de 15h',
                'price_adult' => 17,
                'price_child' => 10,
                'time-slot' => '15h'],
            ['name' => 'Spectacle de 20h',
                'price_adult' => 20,
                'price_child' => 13,
                'time-slot' => '20h'],
        ];

        foreach ($shows as $key => $row) {
            $show = new Show();
            $show->setName($row['name']);
            $show->setPriceAdult($row['price_adult']);
            $show->setPriceChild($row['price_child']);
            $show->setTimeSlot($row['time-slot']);
            $manager->persist($show);

            $manager->flush();
        }
    }
}
