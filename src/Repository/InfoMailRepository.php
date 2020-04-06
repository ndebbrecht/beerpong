<?php

namespace App\Repository;

use App\Entity\InfoMail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method InfoMail|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoMail|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoMail[]    findAll()
 * @method InfoMail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoMailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoMail::class);
    }

    // /**
    //  * @return InfoMail[] Returns an array of InfoMail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfoMail
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
