<?php

namespace App\Repository\Internal;

use App\Entity\Internal\WebSiteType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebSiteType|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebSiteType|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebSiteType[]    findAll()
 * @method WebSiteType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebSiteTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebSiteType::class);
    }

    // /**
    //  * @return WebSiteType[] Returns an array of WebSiteType objects
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
    public function findOneBySomeField($value): ?WebSiteType
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
