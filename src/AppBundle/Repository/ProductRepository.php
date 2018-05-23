<?php

namespace AppBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Get list of product from a specific category and page
     *
     * @param $category the selected category
     * @param $page the selected page
     * @param $limit the number of products per page
     * @return array
     */
    public function getProductsFromCategoryByPage($category, $page, $limit){

        $dql = "SELECT p FROM AppBundle:Product p WHERE p.category = :category";

        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('category', $category)
            ->setFirstResult(($page-1)*$limit)
            ->setMaxResults($limit);

        return $query->getResult();
    }

    /**
     * @param $category the selected category
     * @return Collection of categories
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countProductsInCategory($category){

        $dql = "SELECT count(p) FROM AppBundle:Product p WHERE p.category = :category";

        $query = $this->getEntityManager()->createQuery($dql)
                    ->setParameter('category', $category);

        return (int)$query->getSingleScalarResult();
    }

}
