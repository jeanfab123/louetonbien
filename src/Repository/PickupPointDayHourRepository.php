<?php

namespace App\Repository;

use App\Entity\PickupPointDayHour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PickupPointDayHour|null find($id, $lockMode = null, $lockVersion = null)
 * @method PickupPointDayHour|null findOneBy(array $criteria, array $orderBy = null)
 * @method PickupPointDayHour[]    findAll()
 * @method PickupPointDayHour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PickupPointDayHourRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PickupPointDayHour::class);
    }

    // /**
    //  * @return PickupPointDayHour[] Returns an array of PickupPointDayHour objects
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
    public function findOneBySomeField($value): ?PickupPointDayHour
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
