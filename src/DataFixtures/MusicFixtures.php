<?php

namespace App\DataFixtures;

use App\Entity\Music;
use App\Entity\MusicStyle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MusicFixtures extends Fixture
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

        
        $twoStepFromHellArmada = new Music();
        $twoStepFromHellArmada
            ->setName("twoStepFromHellArmada")
            ->setPublicIdentifier("nxn0mf2xj27t9vv6ggdalf7ggjh4755w")
            ->setFile("865ac372-65f3-11ed-9022-0242ac120002")
            ->addMusicStyle($styleClassic)
        ;

        $amaranthElectroheart = new Music();
        $amaranthElectroheart
            ->setName("Electroheart")
            ->setPublicIdentifier("nxn0mf2xj27t9vv6ggdalf7ggjh4755w")
            ->setFile("65462426-6515-11ed-9022-0242ac120002")
            ->addMusicStyle($styleRock)
            ->addMusicStyle($stylePop)
        ;

        $museHysteria = new Music();
        $museHysteria
            ->setName("Hysteria")
            ->setPublicIdentifier("fjnnscn5aapt4m4t8x8weqd66oxu18vu")
            ->setFile("76784516-6516-11ed-9022-0242ac120002")
            ->addMusicStyle($styleHardrock)
            ->addMusicStyle($stylePop)
        ;

        $imagineDragonWarriors = new Music();
        $imagineDragonWarriors
            ->setName("Warriors")
            ->setPublicIdentifier("cdd4bvr61tvq0wuqs4t41vlm5b4txlsg")
            ->setFile("c53d435e-6516-11ed-9022-0242ac120002")
            ->addMusicStyle($styleRock)
            ->addMusicStyle($stylePop)
        ;

        $nekfeuNiqueLesClones = new Music();
        $nekfeuNiqueLesClones
            ->setName("Nique Les Clones")
            ->setPublicIdentifier("nxn0mf2xj27t9vv6ggdalf7ggjh4755w")
            ->setFile("4570f6c4-6517-11ed-9022-0242ac120002")
            ->addMusicStyle($stylePop)
            ->addMusicStyle($styleRap)
        ;

        $twoStepFromHellBlackhearth = new Music();
        $twoStepFromHellBlackhearth
            ->setName("Blackhearth")
            ->setPublicIdentifier("46brga2ipf3v78sqgummtdlfafw5pxfn")
            ->setFile("e452e3ce-6517-11ed-9022-0242ac120002")
            ->addMusicStyle($styleClassic)
        ;

        $evidemmentTroisCafesGourmands = new Music();
        $evidemmentTroisCafesGourmands
            ->setName("Evidemment")
            ->setPublicIdentifier("87jlnt369huit15u5y21x6dabs4rc81p")
            ->setFile("8eadcf6e-6518-11ed-9022-0242ac120002")
            ->addMusicStyle($stylePop)
        ;

        $audiomachineGuardiansAtTheGate = new Music();
        $audiomachineGuardiansAtTheGate
            ->setName("Guardians At The Gate")
            ->setPublicIdentifier("9bi2b5e0eibmmi7c4tl6e4t0skpol0mk")
            ->setFile("303a4f56-6519-11ed-9022-0242ac120002")
            ->addMusicStyle($styleElectro)
        ;

        $otherWorldsWhiteGalaxy = new Music();
        $otherWorldsWhiteGalaxy
            ->setName("White Galaxy")
            ->setPublicIdentifier("2e2tbwz6h3e127nhuardgrcp0oc28wfl")
            ->setFile("7c27c678-6519-11ed-9022-0242ac120002")
            ->addMusicStyle($styleElectro)
        ;

        $OMFGHello = new Music();
        $OMFGHello
            ->setName("Hello")
            ->setPublicIdentifier("p0ue7c0xl9t10gddbujotxqqcahpyxvt")
            ->setFile("194fbfb4-651a-11ed-9022-0242ac120002")
            ->addMusicStyle($styleElectro)
            ->addMusicStyle($stylePop)
        ;

        $britneySpearsBabyOneMoreTime = new Music();
        $britneySpearsBabyOneMoreTime
            ->setName("Baby One More Time")
            ->setPublicIdentifier("pjuom5cusr9uimntwysimqz22eg1fppw")
            ->setFile("d70fb260-651b-11ed-9022-0242ac120002")
            ->addMusicStyle($stylePop)
        ;

        $littleVUGotThat = new Music();
        $littleVUGotThat
            ->setName("U Got That")
            ->setPublicIdentifier("n7dslhjrh8y94xfmqitpyjz6heg92skp")
            ->setFile("6d144e00-651d-11ed-9022-0242ac120002")
            ->addMusicStyle($styleMetal)
        ;

        $manager->persist($twoStepFromHellArmada);
        $manager->persist($amaranthElectroheart);
        $manager->persist($museHysteria);
        $manager->persist($imagineDragonWarriors);
        $manager->persist($nekfeuNiqueLesClones);
        $manager->persist($twoStepFromHellBlackhearth);
        $manager->persist($evidemmentTroisCafesGourmands);
        $manager->persist($audiomachineGuardiansAtTheGate);
        $manager->persist($otherWorldsWhiteGalaxy);
        $manager->persist($OMFGHello);
        $manager->persist($britneySpearsBabyOneMoreTime);
        $manager->persist($littleVUGotThat);

        $manager->flush();
    }

}
