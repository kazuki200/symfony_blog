<?php

namespace App\Repository;

use App\Entity\PostChild;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostChild>
 *
 * @method PostChild|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostChild|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostChild[]    findAll()
 * @method PostChild[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostChildRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostChild::class);
    }

//    /**
//     * @return PostChild[] Returns an array of PostChild objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PostChild
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
