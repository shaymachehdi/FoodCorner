<?php

namespace FoodCorner\MenuuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Bundle\Bundle;


class DefaultController extends Controller
{


    public function getParent()
    {
        return 'FOSUserBundle';
    }



    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('FoodCornerMenuuBundle:Default:index.html.twig');
    }




}
