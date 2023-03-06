<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Product::class);
  }

  public function save(Product $entity, bool $flush = false): void
  {
    $this->getEntityManager()->persist($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function remove(Product $entity, bool $flush = false): void
  {
    $this->getEntityManager()->remove($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

    /**
     * @return product[]
     */
    public function getAllDiscountProducts(): array
    {
      return $this->createQueryBuilder('p')
              ->andWhere('p.Discount IS NOT NULL')
              ->orderBy('p.Discount', 'DESC')
              ->setMaxResults(10)
              ->getQuery()
              ->getResult() // le getResult permet d'afficher tout les résultats dans un tableau
      ;
    }

    // getSingleResult() récupere un seul et unique objet. SI malheureusement il y a plus d'un objet, cela affichera un message d'erreur
    // getOneOrNullResult() retourne un seul objet, s'il y a plusieurs objet, cela afficcher un message d'erreur. Si null, rien ne sera retourné
    // getArrayresult() retourne les résult sous forme de tableaux imbriqués au lieu de renvoyer un collection array
    // getScalarResult() retourne des values scalaire pouvant contenir des données en double
    // getOneScalarResult() retourne une seule value scalaire pouvant contenir des données en double



  //    /**
  //     * @return Product[] Returns an array of Product objects
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

  //    public function findOneBySomeField($value): ?Product
  //    {
  //        return $this->createQueryBuilder('p')
  //            ->andWhere('p.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->getQuery()
  //            ->getOneOrNullResult()
  //        ;
  //    }
}
