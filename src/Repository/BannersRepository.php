<?php

namespace App\Repository;

use App\Entity\Banners;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Banners|null find($id, $lockMode = null, $lockVersion = null)
 * @method Banners|null findOneBy(array $criteria, array $orderBy = null)
 * @method Banners[]    findAll()
 * @method Banners[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Banners[] findByRole(string $role)
 */
class BannersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Banners::class);
    }

    // /**
    //  * @return Banners[] Returns an array of Banners objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Banners
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
