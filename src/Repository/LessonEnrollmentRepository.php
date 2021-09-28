<?php

namespace App\Repository;

use App\Entity\LessonEnrollment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LessonEnrollment|null find($id, $lockMode = null, $lockVersion = null)
 * @method LessonEnrollment|null findOneBy(array $criteria, array $orderBy = null)
 * @method LessonEnrollment[]    findAll()
 * @method LessonEnrollment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessonEnrollmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LessonEnrollment::class);
    }

    // /**
    //  * @return LessonEnrollment[] Returns an array of LessonEnrollment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LessonEnrollment
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
