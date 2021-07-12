<?php

namespace App\Repository;

use App\Entity\Mascota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Query\Expr\Select;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mascota|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mascota|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mascota[]    findAll()
 * @method Mascota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MascotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mascota::class);
    }

    public function listarMascotas(){
        return $this ->getEntityManager()
        -> createQuery(
            'Select mascota.Id, mascota.nombre, mascota.edad,
            mascota.raza, mascota.raza, mascota.color, mascota.tamanio
            mascota.fechaIngreso, mascota.activo
            from App:Mascota mascota'
        )-> getResult();
    }
    // /**
    //  * @return Mascota[] Returns an array of Mascota objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mascota
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
