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
        $user->setRoles(array("ROLE_ADMIN"));

        $manager->persist($user);


        $user2 = new User();
        $user2->setLastname("Fenestre");
        $user2->setFirstname("Dorian");
        $user2->setUsername("fenD");
        $user2->setEmail("fenestre.dorian@free.fr");
        $password = $this->encoder->encodePassword($user2, "12345");
        $user2->setPassword($password);
        $user2->setRoles(array("ROLE_ADMIN"));
        $manager->persist($user2);

        $userStudent = new User();
        $userStudent->setLastname("student");
        $userStudent->setFirstname("o");
        $userStudent->setUsername("studento");
        $userStudent->setEmail("student.o@free.fr");
        $password = $this->encoder->encodePassword($userStudent, "1234");
        $userStudent->setPassword($password);
        $userStudent->setRoles(array("ROLE_STUDENT"));
        $manager->persist($userStudent);

        $userTeacher = new User();
        $userTeacher->setLastname("Teacher");
        $userTeacher->setFirstname("o");
        $userTeacher->setUsername("teachero");
        $userTeacher->setEmail("teacher.o@free.fr");
        $password = $this->encoder->encodePassword($userTeacher, "1234");
        $userTeacher->setPassword($password);
        $userTeacher->setRoles(array("ROLE_TEACHER"));
        $manager->persist($userTeacher);


        $manager->flush();
    }
}
