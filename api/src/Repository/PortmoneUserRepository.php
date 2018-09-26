<?php

namespace App\Repository;

use App\Entity\PortmoneUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PortmoneUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortmoneUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortmoneUser[]    findAll()
 * @method PortmoneUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortmoneUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PortmoneUser::class);
    }

//    /**
//     * @return PortmoneUser[] Returns an array of PortmoneUser objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PortmoneUser
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
