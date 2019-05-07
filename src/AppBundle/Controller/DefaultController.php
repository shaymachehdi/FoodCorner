<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $menus = $em->getRepository('FoodCornerMenuuBundle:Menu')->findAll();
        $plats = $em->getRepository('FoodCornerMenuuBundle:Plat')->findAll();
        return $this->render('base.html.twig', array(
            'menus' => $menus,
            'plats' => $plats,
        ));
    }


}
