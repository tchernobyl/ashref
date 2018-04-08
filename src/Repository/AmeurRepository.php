<?php

namespace App\Repository;

use App\Entity\Ameur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ameur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ameur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ameur[]    findAll()
 * @method Ameur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmeurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ameur::class);
    }

//    /**
//     * @return Ameur[] Returns an array of Ameur objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ameur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
