<?php

namespace App\Repository;

use App\Entity\WithdrawalPoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WithdrawalPoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method WithdrawalPoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method WithdrawalPoint[]    findAll()
 * @method WithdrawalPoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WithdrawalPointRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WithdrawalPoint::class);
    }

    // /**
    //  * @return WithdrawalPoint[] Returns an array of WithdrawalPoint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WithdrawalPoint
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
