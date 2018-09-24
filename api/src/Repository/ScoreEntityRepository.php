<?php

namespace App\Repository;

use App\Entity\ScoreEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ScoreEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScoreEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScoreEntity[]    findAll()
 * @method ScoreEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ScoreEntity::class);
    }

//    /**
//     * @return ScoreEntity[] Returns an array of ScoreEntity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ScoreEntity
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
