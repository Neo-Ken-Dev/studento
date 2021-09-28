<?php

namespace App\Entity;

use App\Repository\LessonEnrollmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LessonEnrollmentRepository::class)
 */
class LessonEnrollment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startLesson;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endLesson;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="lessonEnrollments")
     */
    protected $student;

    /**
     * @ORM\ManyToOne(targetEntity=Lesson::class)
     */
    protected $lesson;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartLesson(): ?\DateTimeInterface
    {
        return $this->startLesson;
    }

    public function setStartLesson(?\DateTimeInterface $startLesson): self
    {
        $this->startLesson = $startLesson;

        return $this;
    }

    public function getEndLesson(): ?\DateTimeInterface
    {
        return $this->endLesson;
    }

    public function setEndLesson(?\DateTimeInterface $endLesson): self
    {
        $this->endLesson = $endLesson;

        return $this;
    }
}
