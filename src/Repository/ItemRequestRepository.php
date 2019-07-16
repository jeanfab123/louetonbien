<?php

namespace App\Repository;

use App\Entity\ItemRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ItemRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemRequest[]    findAll()
 * @method ItemRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRequestRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ItemRequest::class);
    }

    // /**
    //  * @return ItemRequest[] Returns an array of ItemRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ItemRequest
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
