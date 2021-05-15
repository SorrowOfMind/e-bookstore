<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }

    public function getBestsellers()
    {
        $conn = $this->getEntityManager()->getConnection();
        $query = "SELECT p.id, p.category, p.name, p.creator, p.price, p.rating 
                FROM products p
                RIGHT JOIN bestsellers b
                    ON b.product_id = p.id
                WHERE p.is_available = 1
                LIMIT 5";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAllAssociative();
    }

    public function getTopDeals()
    {
        $conn = $this->getEntityManager()->getConnection();
        $query = "SELECT p.id, p.category, p.name, p.creator, p.price, p.rating  
                FROM products p
                RIGHT JOIN topdeals t
                    ON t.product_id = p.id
                WHERE p.is_available = 1
                LIMIT 5";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAllAssociative();
    }

    public function getPreviews()
    {
        $conn = $this->getEntityManager()->getConnection();
        $query = "SELECT p.id, p.category, p.name, p.creator
                FROM products p
                RIGHT JOIN previews pr
					ON pr.product_id = p.id
                WHERE p.is_available = 0
                LIMIT 10";

		$stmt = $conn->prepare($query);
		$stmt->execute();

		return $stmt->fetchAllAssociative();
    }
   
}