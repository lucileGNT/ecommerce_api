<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class CategoryController
 *
 * API methods related to Category Entity
 *
 * @author Lucile Gentner
 * @package AppBundle\Controller
 */

class CategoryController extends Controller
{
    //Default values for pagination
    const DEFAULT_PAGE = 1;
    const DEFAULT_PAGE_LENGTH = 10;
    /**
     * Add a new category
     *
     * @Route("/api/categories/", name="add_category")
     * @Method({"POST"})
     */
    public function addCategoryAction(Request $request)
    {

        //Get posted params
        $categoryName = $request->query->get('name') !== "" ? $request->query->get('name') : null;
        $result = [];

        if ($categoryName !== null) { //If a category name is posted, insert the new category in database
            $category = new Category();
            $category->setName($categoryName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            //Send the new category details

            $result['id'] = $category->getId();
            $result['name'] = $category->getName();

        }

        //Encode in JSON
        $response = new Response();
        $categoriesJSON = json_encode(array('category' => $result));

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($categoriesJSON);

        return $response;

    }

    /**
     * Get list of all categories
     *
     * @Route("/api/categories/", name="list_categories")
     * @Method({"GET"})
     */
    public function getCategoryListAction(Request $request)
    {
        //Find all categories in database
        $categories = $this->getDoctrine()
            ->getRepository("AppBundle:Category")
            ->findAll();

        //Build array of results
        $results = [];

        foreach ($categories as $category) {
            $results[]= ['id' => $category->getId(), 'name' => $category->getName()];
        }

        //Encode in JSON
        $response = new Response();
        $categoriesJSON = json_encode(array('categories' => $results));

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($categoriesJSON);

        return $response;
    }

    /**
     * Get list of products from a specified category
     *
     * @Route("/api/categories/{id}/products/", name="get_products_from_category")
     * @Method({"GET"})
     */
    public function getProductsFromCategoryAction($id, Request $request)
    {

        //Get pagination params
        $page = $request->query->get('page') !== null ? (int)$request->query->get('page') : self::DEFAULT_PAGE;
        $limit = $request->query->get('limit') !== null ? (int)$request->query->get('limit') : self::DEFAULT_PAGE_LENGTH;

        $category = $this->getDoctrine()
            ->getRepository("AppBundle:Category")
            ->find($id);

        //Get total number of products for this category
        $nbProducts = $this->getDoctrine()
            ->getRepository("AppBundle:Product")
            ->countProductsInCategory($category);


        //Get products from a specific category and a specific page
        $products = $this->getDoctrine()
            ->getRepository("AppBundle:Product")->getProductsFromCategoryByPage($category, $page, $limit);

        //Build array of results
        $results = [];

        foreach ($products as $product) {
            $results[]= ['id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'stock' => $product->getStock(),
                'category' => $category->getName()];
        }

        //Encode in JSON
        $response = new Response();
        $productsJSON = json_encode(array(
            'nbProducts' => $nbProducts,
            'pageNumber' => (int)($nbProducts/$limit+1),
            'products' => $results
        ));

        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($productsJSON);

        return $response;

    }
}