<?php

namespace App\Repository;

use App\Portmone\Entity\FolderEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FolderEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method FolderEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method FolderEntity[]    findAll()
 * @method FolderEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FolderEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FolderEntity::class);
    }

//    /**
//     * @return FolderEntity[] Returns an array of FolderEntity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FolderEntity
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
