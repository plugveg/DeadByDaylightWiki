<?php

/*Info sur le current directory*/
namespace App\Repository;

/*Permet l'importation des différentes Entity*/
use App\Entity\PerksKillers;
/*Les use nécessaires pour lancer le code*/
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PerksKillers|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerksKillers|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerksKillers[]    findAll()
 * @method PerksKillers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerksKillersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerksKillers::class);
    }

    // /**
    //  * @return PerksKillers[] Returns an array of PerksKillers objects
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
    public function findOneBySomeField($value): ?PerksKillers
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
