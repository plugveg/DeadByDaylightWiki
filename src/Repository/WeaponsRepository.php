<?php

namespace App\Repository;

use App\Entity\Weapons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Weapons|null find($id, $lockMode = null, $lockVersion = null)
 * @method Weapons|null findOneBy(array $criteria, array $orderBy = null)
 * @method Weapons[]    findAll()
 * @method Weapons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeaponsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Weapons::class);
    }

    // /**
    //  * @return Weapons[] Returns an array of Weapons objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Weapons
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
