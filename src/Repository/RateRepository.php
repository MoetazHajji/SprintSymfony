<?php

namespace App\Repository;

use App\Entity\Rate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @method Rate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rate[]    findAll()
 * @method Rate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rate::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Rate $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Rate $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Rate[] Returns an array of Rate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rate
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function stat5($id)
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT count(s.id) as prod FROM APP\Entity\Rate s WHERE s.produit=:id AND s.rate=5")
            ->setParameter('id',$id)
           ;

        return $query->getResult();
    }
    public function stat4($id)
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT count(s.id) as prod FROM APP\Entity\Rate s WHERE s.produit=:id AND s.rate=4")
            ->setParameter('id',$id)
        ;

        return $query->getResult();
    }
    public function stat3($id)
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT count(s.id) as prod FROM APP\Entity\Rate s WHERE s.produit=:id AND s.rate=3")
            ->setParameter('id',$id)
        ;

        return $query->getResult();
    }
    public function stat2($id)
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT count(s.id) as prod FROM APP\Entity\Rate s WHERE s.produit=:id AND s.rate=2")
            ->setParameter('id',$id)
        ;

        return $query->getResult();
    }
    public function stat1($id)
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT count(s.id) as prod FROM APP\Entity\Rate s WHERE s.produit=:id AND s.rate=1")
            ->setParameter('id',$id)
        ;

        return $query->getResult();
    }
    public function nbrproduit($id)
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager
            ->createQuery("SELECT count(s.id) as prod FROM APP\Entity\Rate s WHERE s.produit=:id")
            ->setParameter('id',$id)
        ;

        return $query->getResult();
    }
}
