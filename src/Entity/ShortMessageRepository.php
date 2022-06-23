<?php

namespace App\Entity;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<ShortMessage>
 *
 * @method ShortMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShortMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShortMessage[]    findAll()
 * @method ShortMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShortMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShortMessage::class);
    }

    public function add(ShortMessage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ShortMessage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByUuid($value): ?ShortMessage
    {

        return $this->createQueryBuilder('s')
            ->andWhere('s.uuid = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

//    public function findOneBySomeField($value): ?ShortMessage
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
