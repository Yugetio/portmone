<?php

namespace App\Repository;

use App\Portmone\Entity\TransactionEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityManager;

/**
 * @method TransactionEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransactionEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransactionEntity[]    findAll()
 * @method TransactionEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionEntityRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TransactionEntity::class);
    }


//    /**
//     * @return TransactionEntity[] Returns an array of TransactionEntity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TransactionEntity
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
