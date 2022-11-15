<?php

namespace App\DataFixtures;

use App\Entity\Auth\User;
use App\Entity\Music;
use App\Entity\MusicStyle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin->setEmail('admin@localhost');
        $password = $this->hasher->hashPassword($admin, 'pass_1234');
        $admin->setPassword($password);
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        $user1 = new User();
        $user1->setEmail('user1@localhost');
        $password = $this->hasher->hashPassword($user1, 'pass_1234');
        $user1->setPassword($password);
        $user1->setRoles(['ROLE_USER']);

        $user2 = new User();
        $user2->setEmail('user2@localhost');
        $password = $this->hasher->hashPassword($user2, 'pass_1234');
        $user2->setPassword($password);
        $user2->setRoles(['ROLE_USER']);

        $manager->persist($admin);
        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }

}
