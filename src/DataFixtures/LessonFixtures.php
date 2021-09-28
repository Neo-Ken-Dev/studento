<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use App\Entity\Teacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class LessonFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new Teacher();
        $user->setLastname("Monsieur Michou");
        $user->setFirstname("Jean-claude");
        $user->setRoles(array("ROLE_TEACHER"));
        $user->setPassword("12");
        $user->setEmail("michou.jeanjean@gmail.com");
        $user->setSpeciality("histoire");
        $user->setUsername("michto");

        $manager->persist($user);

        $lesson = new Lesson();
        $lesson->setDegree("CM2");
        $lesson->setTopic("Histoire");
        $lesson->setTitle("ces cognios de rois de France");
        $lesson->setTeacher($user);

        $manager->persist($lesson);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
