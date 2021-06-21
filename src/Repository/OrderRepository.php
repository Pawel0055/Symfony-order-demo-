<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\OrderIngredient;
use App\Entity\Ingredients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    /**
    * @return Oder[]
    */
    public function orderIngredientsList(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
                'SELECT i.name, i.id, oi.id, oi.order_id, oi.ingredient_id
                FROM App\Entity\Ingredients i JOIN App\Entity\OrderIngredient oi
                WHERE i.id = oi.ingredient_id ORDER BY i.id'
            );

        return $query->getResult();
    }

    /**
    * @return Ingredients[]
    */
    public function ingredientsList($id): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
                            'SELECT i.name, oi.ingredient_id FROM App\Entity\OrderIngredient oi
                            JOIN App\Entity\Ingredients i
                             WHERE oi.order_id = :id AND oi.ingredient_id = i.id'
                        )->setParameter('id', $id);
                        $categorias = $query->getArrayResult();
        return $categorias;
    }



    // /**
    //  * @return Order[] Returns an array of Order objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
