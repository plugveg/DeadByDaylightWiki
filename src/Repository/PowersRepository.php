<?php

/*Info sur le current directory*/
namespace App\Repository;

/*Permet l'importation des différentes Entity*/
use App\Entity\Powers;
/*Les use nécessaires pour lancer le code*/
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Powers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Powers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Powers[]    findAll()
 * @method Powers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PowersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Powers::class);
    }

    // /**
    //  * @return Powers[] Returns an array of Powers objects
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
    public function findOneBySomeField($value): ?Powers
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
