<?php

namespace App\Repository;

use App\Entity\Brands;
use App\Entity\Sneaker;
use App\Entity\SneakerFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sneaker>
 *
 * @method Sneaker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sneaker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sneaker[]    findAll()
 * @method Sneaker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SneakerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sneaker::class);
    }

    public function save(Sneaker $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Sneaker $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getSneakers()
    {
        return $this->createQueryBuilder('s')
            ->setMaxResults(12)
            ->getQuery()
            ->getResult();
    }


    public function getSneakersByFilterAndPages(SneakerFilter $filter,array $brandFilters = null, int $size = null)
    {

        $query = $this->createQueryBuilder('s')
            ->select('s');

        if ($filter->getBrands()->count() > 0) {
            $query->addSelect("m")
                ->join("s.model", "m");
            foreach ($filter->getBrands() as $key => $brand) {
                $query->orWhere(":bds$key = m.brands")
                    ->setParameter(":bds$key", $brand);;
            }
        }

        if ($filter->getSize()) {
            $query->andWhere("s.shoe_size = :size")
                ->setParameter(":size", $filter->getSize());
        }


        return $query->getQuery();
    }

//    /**
//     * @return Sneaker[] Returns an array of Sneaker objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sneaker
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
