<?php

namespace App\Repository\Internal;

use App\Entity\Internal\Edition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Edition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Edition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Edition[]    findAll()
 * @method Edition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Edition::class);
    }

    // /**
    //  * @return Edition[] Returns an array of Edition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Edition
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}