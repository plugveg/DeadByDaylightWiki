<?php

namespace App\Repository;

use App\Entity\Killers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Killers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Killers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Killers[]    findAll()
 * @method Killers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KillersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Killers::class);
    }

    // /**
    //  * @return Killers[] Returns an array of Killers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Killers
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
