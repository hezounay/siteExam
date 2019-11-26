<?php

namespace App\Repository;

use App\Entity\Occasions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Occasions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Occasions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Occasions[]    findAll()
 * @method Occasions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OccasionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Occasions::class);
    }

    // /**
    //  * @return Occasions[] Returns an array of Occasions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Occasions
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
