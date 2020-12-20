<?php

namespace App\Repository\Internal;

use App\Entity\Internal\EditionMode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EditionMode|null find($id, $lockMode = null, $lockVersion = null)
 * @method EditionMode|null findOneBy(array $criteria, array $orderBy = null)
 * @method EditionMode[]    findAll()
 * @method EditionMode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditionModeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EditionMode::class);
    }

    // /**
    //  * @return EditionMode[] Returns an array of EditionMode objects
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
    public function findOneBySomeField($value): ?EditionMode
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
