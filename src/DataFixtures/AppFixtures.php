<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use App\Entity\LessonEnrollment;
use App\Entity\Student;
use App\Entity\Teacher;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)

    {
        $faker = Factory::create('fr_FR');

        $user = new Student();
        $user->setLastname("Lemonnier");
        $user->setFirstname("Ken");
        $user->setUsername("kenL");
        $user->setEmail("lemonnier.ken@gmail.com");
        $password = $this->encoder->encodePassword($user, "1234");
        $user->setPassword($password);
        $user->setRoles(array("ROLE_ADMIN"));
        $user->setDegree("CM2");

        $manager->persist($user);

        $user2 = new Teacher();
        $user2->setLastname("Fenestre");
        $user2->setFirstname("Dorian");
        $user2->setUsername("fenD");
        $user2->setEmail("fenestre.dorian@free.fr");
        $password = $this->encoder->encodePassword($user2, "12345");
        $user2->setPassword($password);
        $user2->setRoles(array("ROLE_ADMIN"));
        $user2->setSpeciality("Histoire");

        $manager->persist($user2);

        for ($i=0; $i < 10; $i++) {
            $student = new Student();
            $student->setLastname($faker->lastName())
                ->setFirstname($faker->firstNameMale())
                ->setUsername("Student" . $i)
                ->setPhone($faker->phoneNumber())
                ->setEmail($faker->email())
                ->setDegree($faker->randomElement($array = array('CM2', 'CE1', 'Terminal', '5eme')))
                ->setRoles(array("ROLE_STUDENT"));

            $password = $this->encoder->encodePassword($student, "1234");
            $student->setPassword($password);

            $manager->persist($student);

            $teacher = new Teacher();
            $teacher->setLastname($faker->lastName())
                ->setFirstname($faker->firstNameMale())
                ->setUsername("Teacher" . $i)
                ->setPhone($faker->phoneNumber())
                ->setEmail($faker->email())
                ->setSpeciality($faker->randomElement($array = array('Histoire', 'Geo', 'Math', 'Français')))
                ->setRoles(array("ROLE_TEACHER"));

            $password = $this->encoder->encodePassword($teacher, "1234");
            $teacher->setPassword($password);

            $manager->persist($teacher);

            $lesson = null;
            for ($j=0; $j < 2; $j++) {
                $lesson= new Lesson();
                $lesson->setTitle($faker->sentence($nbWords = 5))
                    ->setTopic($faker->randomElement($array = array('Histoire', 'Geo', 'Math', 'Français')))
                    ->setDegree($faker->randomElement($array = array('CM2', 'CE1', 'Terminal', '5eme')))
                    ->setTeacher($teacher);

                    $manager->persist($lesson);
            }

            $lessonEnrollment = new LessonEnrollment();
            $lessonEnrollment->setEndLesson($faker->dateTime())
                ->setStartLesson($faker->dateTime())
                ->setLesson($lesson);
            $lessonEnrollment->setStudent($student);


            $manager->persist($lessonEnrollment);

        }

        $manager->flush();
    }
}
