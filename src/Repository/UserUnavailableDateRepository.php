<?php

namespace App\Repository;

use App\Entity\UserUnavailableDate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserUnavailableDate|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserUnavailableDate|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserUnavailableDate[]    findAll()
 * @method UserUnavailableDate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserUnavailableDateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserUnavailableDate::class);
    }

    // /**
    //  * @return UserUnavailableDate[] Returns an array of UserUnavailableDate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserUnavailableDate
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
