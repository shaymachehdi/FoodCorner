<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Security:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/valide")
     */
    public function redirectAction()
    {

        $authCheker = $this->container->get('security.authorization_checker');

        if ($authCheker->isGranted('ROLE_ADMIN')) {
            return $this->render('@App/Security/admin_home.html.twig');
        } else if ($authCheker->isGranted('ROLE_USER')) {
            return $this->render('@App/Security/user_home.html.twig');

        } else {
            return $this->render('AppBundle:FOSUserBundle:views:Profile:show_content.html.twig');
        }


    }

}
