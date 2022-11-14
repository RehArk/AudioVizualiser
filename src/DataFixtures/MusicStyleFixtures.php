<?php

namespace App\DataFixtures;

use App\Entity\MusicStyle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MusicStyleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $styleRock = (new MusicStyle())->setName('Rock');
        $styleHardrock = (new MusicStyle())->setName('Hardrock');
        $styleMetal = (new MusicStyle())->setName('Metal');
        $styleClassic = (new MusicStyle())->setName('Classic');
        $styleElectro = (new MusicStyle())->setName('Electro');
        $styleRap = (new MusicStyle())->setName('Rap');
        $stylePop = (new MusicStyle())->setName('Pop');

        $manager->persist($styleRock);
        $manager->persist($styleHardrock);
        $manager->persist($styleMetal);
        $manager->persist($styleClassic);
        $manager->persist($styleElectro);
        $manager->persist($styleRap);
        $manager->persist($stylePop);

        $manager->flush();
    }
}
