<?php

namespace App\Repository;

use App\Entity\WithdrawalPointDayHour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WithdrawalPointDayHour|null find($id, $lockMode = null, $lockVersion = null)
 * @method WithdrawalPointDayHour|null findOneBy(array $criteria, array $orderBy = null)
 * @method WithdrawalPointDayHour[]    findAll()
 * @method WithdrawalPointDayHour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WithdrawalPointDayHourRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WithdrawalPointDayHour::class);
    }

    // /**
    //  * @return WithdrawalPointDayHour[] Returns an array of WithdrawalPointDayHour objects
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
    public function findOneBySomeField($value): ?WithdrawalPointDayHour
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
