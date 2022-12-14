<?php

namespace App\Repository\Music;

use App\Entity\MusicStyle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MusicStyle>
 *
 * @method MusicStyle|null find($id, $lockMode = null, $lockVersion = null)
 * @method MusicStyle|null findOneBy(array $criteria, array $orderBy = null)
 * @method MusicStyle[]    findAll()
 * @method MusicStyle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MusicStyleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MusicStyle::class);
    }

    public function save(MusicStyle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MusicStyle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function countStyleNameLike(string $name): int
    {

        return $this->createQueryBuilder('ms')
            ->select('count(ms.id)')
            ->where("LOWER(ms.name) like LOWER('%".$name."%')")
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function findStyleNameWithLimit(string $name, int $limit, int $offset = 0): array
    {
        return $this->createQueryBuilder('ms')
            ->orderBy('ms.id', 'ASC')
            ->where("LOWER(ms.name) like LOWER('%".$name."%')")
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findManyByIds(array $ids) : array {

        $idsSql = '';

        return $this->createQueryBuilder('ms')
            ->orderBy('ms.id', 'ASC')
            ->where('ms.id IN (:id)')
            ->setParameter(':id', $ids)
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return MusicStyle[] Returns an array of MusicStyle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MusicStyle
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
