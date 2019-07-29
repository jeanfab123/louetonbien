<?php

namespace App\Repository;

use App\Entity\ItemRequestAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ItemRequestAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemRequestAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemRequestAnswer[]    findAll()
 * @method ItemRequestAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRequestAnswerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ItemRequestAnswer::class);
    }

    // /**
    //  * @return ItemRequestAnswer[] Returns an array of ItemRequestAnswer objects
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
    public function findOneBySomeField($value): ?ItemRequestAnswer
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
