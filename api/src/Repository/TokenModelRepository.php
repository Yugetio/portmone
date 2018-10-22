<?php

namespace App\Repository;

use App\Portmone\Entity\TokenModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TokenModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method TokenModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method TokenModel[]    findAll()
 * @method TokenModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TokenModelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TokenModel::class);
    }

//    /**
//     * @return UserModel[] Returns an array of UserModel objects
//     */
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
    public function findOneBySomeField($value): ?UserModel
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
