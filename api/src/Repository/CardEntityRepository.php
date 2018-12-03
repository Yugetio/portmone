<?php

namespace App\Repository;

use App\Portmone\Entity\CardEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CardEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardEntity[]    findAll()
 * @method CardEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CardEntity::class);
    }

    // /**
    //  * @return CardEntity[] Returns an array of CardEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CardEntity
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
