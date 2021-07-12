<?php

namespace App\Repository;

use App\Entity\RazaMascota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RazaMascota|null find($id, $lockMode = null, $lockVersion = null)
 * @method RazaMascota|null findOneBy(array $criteria, array $orderBy = null)
 * @method RazaMascota[]    findAll()
 * @method RazaMascota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RazaMascotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RazaMascota::class);
    }

    // /**
    //  * @return RazaMascota[] Returns an array of RazaMascota objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RazaMascota
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
