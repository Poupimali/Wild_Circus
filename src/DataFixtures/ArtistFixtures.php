<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $artists = [
            ['name' => 'Anna',
                'type' => 'Animatrice principale',
                'description' => 'C’est la maîtresse de la piste, la cheffe d’orchestre des numéros, 
                particulièrement des entrées de clowns.',
                'role' => 'MONSIEUR LOYAL'],
            ['name' => 'Elisa',
                'type' => 'Clown',
                'description' => 'Ses origines : un écuyer étourdi au Circus Renz à Berlin, trébuche sur la piste et 
                s’effondre de tout son long dans la sciure, comme s’il s’était fait un croche-pied à lui-même. 
                Sans faire exprès. Le public se tord de rire. Et traite le maladroit d’« idiot », qui se dit « august »
                 en argot berlinois. Elle accompagne Monsieur loyal dans la présentation du spectacle.',
                'role' => 'AUGUSTE'],
            ['name' => 'Joséphine',
                'type' => 'Directrice de création',
                'description' => 'Spécialiste du théâtre au départ, Joséphine s’est spécialisée dans le cirque 
                il y a 4 ans et est devenue incontournable sur la scène bordelaise.',
                'role' => 'SCENOGRAPHE'],
            ['name' => 'Aurélien',
                'type' => 'Performeur',
                'description' => 'Inventeur du célèbre tour « le temps Aurélien », il est spécialisé dans le jonglage 
                entre différents outils allant de la simple cuillère à la tronçonneuse.',
                'role' => 'JONGLEUR'],
            ['name' => 'Alexandre',
                'type' => 'Artiste',
                'description' => 'Il a commencé comme formateur javascript au sein d’une école de développement.
                 En 2019, il choisit de revenir à ses premiers amours : la manipulation de marionnettes, pas si 
                 éloignée de son premier métier. Pour votre plus grand plaisir.',
                'role' => 'MARIONNETISTE'],
            ['name' => 'Florent',
                'type' => 'Artiste',
                'description' => 'Maître incontesté du jeux de mots, il est magistral dans toutes les situations. 
                Toujours prêts à vous amuser.',
                'role' => 'CLOWN'],
            ['name' => 'Claire',
                'type' => 'Performeuse',
                'description' => 'Mondialement connue, elle a notamment participé au cirque du Soleil pendant 6 ans.',
                'role' => 'TRAPÉZISTE'],

        ];

        foreach ($artists as $key => $row) {
            $artist = new Artist();
            $artist->setName($row['name']);
            $artist->setType($row['type']);
            $artist->setDescription($row['description']);
            $artist->setRole($row['role']);
            $manager->persist($artist);

            $manager->flush();
        }
    }
}
