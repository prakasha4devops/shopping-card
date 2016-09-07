<?php
/**
 *
 * Prakash Admane <prakashadmane@gmaill.com>
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FrontEndController
 * @package AppBundle\Controller
 */
class FrontEndController extends Controller
{

    /**
     * List products
     *
     * @Route("/home", name="home")
     * @return Response
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findAll();

        return $this->render('front-end/list.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * Product Details
     *
     * @Route("/product/{id}", name="product_details")
     * @param $id
     * @return Response
     */
    public function productDetailsAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository('AppBundle:Product')
            ->findOneBy(['id' => $id]);

        if (!$product) {
            throw $this->createNotFoundException('product not found');
        }

        return $this->render('front-end/details.html.twig', [
            'product' => $product,
        ]);
    }
}