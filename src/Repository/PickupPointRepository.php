<?php

namespace App\Repository;

use App\Entity\PickupPoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PickupPoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method PickupPoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method PickupPoint[]    findAll()
 * @method PickupPoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PickupPointRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PickupPoint::class);
    }

    // /**
    //  * @return PickupPoint[] Returns an array of PickupPoint objects
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
    public function findOneBySomeField($value): ?PickupPoint
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
