<?php

/*Info sur le current directory*/
namespace App\Repository;

/*Permet l'importation des différentes Entity*/
use App\Entity\Survivors;
/*Les use nécessaires pour lancer le code*/
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Survivors|null find($id, $lockMode = null, $lockVersion = null)
 * @method Survivors|null findOneBy(array $criteria, array $orderBy = null)
 * @method Survivors[]    findAll()
 * @method Survivors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurvivorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Survivors::class);
    }

    // /**
    //  * @return Survivors[] Returns an array of Survivors objects
    //  */
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
    public function findOneBySomeField($value): ?Survivors
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
