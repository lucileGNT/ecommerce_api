<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * DB initialization script
     *
     * @Route("/init/", name="init")
     */
    public function initAction(Request $request)
    {
        $html= "Initialization script<br/>";
        $em = $this->getDoctrine()->getEntityManager();

        $html.= "Category insertion...<br/>";
        $category = new Category();

        $category->setName('Food');
        $em->persist($category);
        $em->flush();

        $category2 = new Category();

        $category2->setName('Clothes');
        $em->persist($category2);
        $em->flush();


        $category3 = new Category();

        $category3->setName('Electronics');
        $em->persist($category3);
        $em->flush();

        $html.= "Product insertion...<br/>";

        $product = new Product();
        $product->setCategory($category);
        $product->setName('Ice Cream');
        $product->setPrice('30$');
        $product->setStock(10);
        $em->persist($product);
        $em->flush();

        $product2 = new Product();
        $product2->setCategory($category);
        $product2->setName('Nutella');
        $product2->setPrice('3$');
        $product2->setStock(25);
        $em->persist($product2);
        $em->flush();

        $product3 = new Product();
        $product3->setCategory($category);
        $product3->setName('Oreo');
        $product3->setPrice('5$');
        $product3->setStock(1);
        $em->persist($product3);
        $em->flush();

        $product4 = new Product();
        $product4->setCategory($category2);
        $product4->setName('Black sweatshirt');
        $product4->setPrice('29$');
        $product4->setStock(40);
        $em->persist($product4);
        $em->flush();

        $product5 = new Product();
        $product5->setCategory($category2);
        $product5->setName('Maxi dress');
        $product5->setPrice('59$');
        $product5->setStock(7);
        $em->persist($product5);
        $em->flush();

        $product6 = new Product();
        $product6->setCategory($category2);
        $product6->setName('White T-shirt');
        $product6->setPrice('15$');
        $product6->setStock(12);
        $em->persist($product6);
        $em->flush();

        $product7 = new Product();
        $product7->setCategory($category3);
        $product7->setName('TV');
        $product7->setPrice('1200$');
        $product7->setStock(3);
        $em->persist($product7);
        $em->flush();

        $product8 = new Product();
        $product8->setCategory($category3);
        $product8->setName('Dishwasher');
        $product8->setPrice('400$');
        $product8->setStock(10);
        $em->persist($product8);
        $em->flush();

        $product9 = new Product();
        $product9->setCategory($category3);
        $product9->setName('Vacuum cleaner');
        $product9->setPrice('79$');
        $product9->setStock(30);
        $em->persist($product9);
        $em->flush();

        $product10 = new Product();
        $product10->setCategory($category3);
        $product10->setName('IPhone');
        $product10->setPrice('1000$');
        $product10->setStock(19);
        $em->persist($product10);
        $em->flush();

        $product11 = new Product();
        $product11->setCategory($category3);
        $product11->setName('Laptop');
        $product11->setPrice('700$');
        $product11->setStock(15);
        $em->persist($product11);
        $em->flush();

        $product12 = new Product();
        $product12->setCategory($category3);
        $product12->setName('Tablet');
        $product12->setPrice('300$');
        $product12->setStock(7);
        $em->persist($product12);
        $em->flush();

        $product13 = new Product();
        $product13->setCategory($category3);
        $product13->setName('Kettle');
        $product13->setPrice('30$');
        $product13->setStock(45);
        $em->persist($product13);
        $em->flush();

        $product14 = new Product();
        $product14->setCategory($category3);
        $product14->setName('Smart Watch');
        $product14->setPrice('150$');
        $product14->setStock(4);
        $em->persist($product14);
        $em->flush();


        $html.= "Insertion done. The project is now ready!<br/>";

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'html' => $html
        ]);

    }
}
