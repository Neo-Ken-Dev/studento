<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setLastname("Lemonnier");
        $user->setFirstname("Ken");
        $user->setUsername("kenL");
        $user->setEmail("ken.lemonnier@gmail.com");
        $password = $this->encoder->encodePassword($user, "1234");
        $user->setPassword($password);
        $user->setRoles("admin");

        $manager->persist($user);


        $user2 = new User();
        $user2->setLastname("Fenestre");
        $user2->setFirstname("Dorian");
        $user2->setUsername("fenD");
        $user2->setEmail("fenestre.dorian@free.fr");
        $password = $this->encoder->encodePassword($user2, "12345");
        $user2->setPassword($password);
        $user2->setRoles("visiteur");
        $manager->persist($user2);

        $manager->flush();
    }
}
