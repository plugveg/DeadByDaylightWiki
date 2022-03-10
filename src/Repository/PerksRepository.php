<?php

namespace App\Repository;

use App\Entity\Perks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Perks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Perks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Perks[]    findAll()
 * @method Perks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perks::class);
    }

    // /**
    //  * @return Perks[] Returns an array of Perks objects
    //  */
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
    public function findOneBySomeField($value): ?Perks
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
