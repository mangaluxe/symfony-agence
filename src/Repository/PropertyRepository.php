<?php

namespace App\Repository;

use Doctrine\ORM\Query; // Ajouté pour Filtre
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\PropertySearch; // Ajouté pour Filtre
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder; // Ajouté pour les fonctions qu'on a créé : findAllVisible() et findLatest()

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }


    // ---------- Ajoutés pour les fonctions qu'on a créé : findAllVisible() et findLatest() ----------
    /**
     *
     * @return Property[]
     */
    public function findAllVisible(): array
    {
        return $this->findVisibleQuery()
            ->getQuery()
            ->getResult();
    }

    /**
     *
     * @return Property[]
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }


    
    /**
     * // Pour Filtre :
     * @return Query
     */
    public function findAllVisibleQuery(PropertySearch $search): Query
    {
        $query = $this->findVisibleQuery();

        if ($search->getMinPrice()) {
            $query = $query
                ->andWhere('p.price >= :minprice')
                ->setParameter('minprice', $search->getMinPrice());
        }

        if ($search->getMaxPrice()) {
            $query = $query
                ->andWhere('p.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }

        if ($search->getMinSurface()) {
            $query = $query
                ->andWhere('p.surface >= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface());
        }

        if ($search->getMaxSurface()) {
            $query = $query
                ->andWhere('p.surface >= :maxsurface')
                ->setParameter('maxsurface', $search->getMaxSurface());
        }
    
        return $query->getQuery();
    }



    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');
    }



    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
