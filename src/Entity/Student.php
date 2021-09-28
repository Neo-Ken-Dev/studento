<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student extends User
{

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $degree;

    /**
     * @ORM\OneToMany(targetEntity=LessonEnrollment::class, mappedBy="student")
     */
    protected $lessonEnrollments;

    public function __construct()
    {
        $this->lessonEnrollments = new ArrayCollection();
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(string $degree): self
    {
        $this->degree = $degree;

        return $this;
    }
}
