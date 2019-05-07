<?php

namespace FoodCorner\MenuuBundle\Controller;

use FoodCorner\MenuuBundle\Entity\Menu;
use FoodCorner\MenuuBundle\Form\MenuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Menu controller.
 *
 * @Route("menu")
 */
class MenuController extends Controller
{
    /**
     * Lists all menu entities.
     *
     * @Route("/", name="menu_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $menus = $em->getRepository('FoodCornerMenuuBundle:Menu')->findAll();

        return $this->render('@FoodCornerMenuu/Administration/Menu/index.html.twig', array(
            'menus' => $menus,
        ));
    }



    /**
     * Lists all commande entities.
     *
     * @Route("/panier/menu", name="panier_index_menu")
     * @Method("GET")
     */
    public function indexPanierMenuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $menus = $em->getRepository('FoodCornerMenuuBundle:Menu')->findAll();

        return $this->render('@FoodCornerCommande/Panier/choix.html.twig', array(
            'menus' => $menus,
        ));
    }

//    /**
//     * Lists all menu entities.
//     *
//     * @Route("/user", name="menu_index_user")
//     * @Method("GET")
//     */
//    public function indexMenuAction()
//    {
//
//        $em = $this->getDoctrine()->getManager();
//
//        $menus = $em->getRepository('FoodCornerMenuuBundle:Menu')->findAll();
//        $plats = $em->getRepository('FoodCornerMenuuBundle:Plat')->findAll();
//
//        return $this->render('@FoodCornerMenuu/User/Menu/Menu.html.twig', array(
//            'menus' => $menus,
//            'plats' => $plats,
//        ));
//    }


    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="plat_show_s")
     * @Method("GET")
     */
    public function showPlatAction($id)
    {
        $menu= $this -> getDoctrine()->getRepository('FoodCornerMenuuBundle:Menu')->find($id);

        $plats=$menu->getPlat();

        return $this->render('@FoodCornerCommande/Panier/choix_plat.html.twig', array(
            'plats'=>$plats

       ));
    }




    /**
     * Finds and displays a user entity.
     *
     * @Route("user/{id}", name="plat_show_user_plat")
     * @Method("GET")
     */
    public function showPlatUserAction($id)

        {


            $menus= $this -> getDoctrine()
                ->getRepository('FoodCornerMenuuBundle:Menu')
                ->find($id);

            $plats=$menus->getPlat();

            return $this->render('@FoodCornerMenuu/User/Menu/menu_type.html.twig', array(
                'plats'=>$plats,
                'menus'=>$menus

            ));
        }



    /**
     * Finds and displays a user entity.
     *
     * @Route("plat/{id}", name="plat_show_admin")
     * @Method("GET")
     */
    public function showPlatAdminAction($id)
    {
        $menu= $this -> getDoctrine()->getRepository('FoodCornerMenuuBundle:Menu')->find($id);

        $plats=$menu->getPlat();

        return $this->render('@FoodCornerMenuu/Administration/Plat/index.html.twig', array(
            'plats'=>$plats

        ));
    }


    /**
     * Creates a new menu entity.
     *
     * @Route("/new", name="menu_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $menu = new Menu();
        $form = $this->createForm('FoodCorner\MenuuBundle\Form\MenuType', $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();

            return $this->redirectToRoute('menu_index', array('id' => $menu->getId()));
        }

        return $this->render('@FoodCornerMenuu/Administration/Menu/new.html.twig', array(
            'menu' => $menu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a menu entity.
     *
     * @Route("/{id}", name="menu_show")
     * @Method("GET")
     */
    public function showAction(Menu $menu)
    {
        $deleteForm = $this->createDeleteForm($menu);

        return $this->render('@FoodCornerMenuu/Administration/Menu/show.html.twig', array(
            'menu' => $menu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing menu entity.
     *
     * @Route("/{id}/edit", name="menu_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Menu $menu)
    {
        $deleteForm = $this->createDeleteForm($menu);
        $editForm = $this->createForm('FoodCorner\MenuuBundle\Form\MenuType', $menu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menu_edit', array('id' => $menu->getId()));
        }

        return $this->render('@FoodCornerMenuu/Administration/Menu/edit.html.twig', array(
            'menu' => $menu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a menu entity.
     *
     * @Route("supprime/{id}", name="menu_supprime")
     */
    public function deleteAction(Request $request ,$id)
    {

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $menus = $em->getRepository('FoodCornerMenuuBundle:Menu')->find($id);
            if (!$menus) {
                throw $this->createNotFoundException('Unable to find Pages entity.');
            }
            $em->remove($menus);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('menu_index'));
    }




    /**
     * @Route("/remove/{id}")
     */
    public function removeAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $menu=$em->getRepository('FoodCornerMenuuBundle:Menu')->find($id);
        $em->remove($menu);
        $em->flush();
        $this->addFlash(
            'delete',
            'Menu removed'
        );
        return $this->redirectToRoute('menu_index');
    }

    /**
         * Creates a form to create a Menu entity.
         *
         * @param Menu $menu The entity
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private
        function createCreateForm(Menu $menu)
        {
            $form = $this->createForm(new MenuType(), $menu, array(
                'action' => $this->generateUrl('menu_new'),
                'method' => 'POST',
            ));
            $form->add('submit', 'submit', array('label' => 'Create'));
            return $form;
        }

        /**
         * Creates a form to edit a menu entity.
         *
         * @param Menu $menu The entity
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private
        function createEditForm(Menu $menu)
        {
            $form = $this->createForm(new MenuType(), $menu, array(
                'action' => $this->generateUrl('menu_edit', array('id' => $menu->getId())),
                'method' => 'PUT',
            ));
            $form->add('submit', 'submit', array('label' => 'Update'));
            return $form;
        }

        /**
         * Creates a form to delete a menu entity.
         *
         * @param Menu $menu The menu entity
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private $menu;
        function createDeleteForm(Menu $menu)
        {
            return $this->createFormBuilder()
                ->setAction($this->generateUrl('menu_supprime', array('id' => $menu->getId())))
                ->setMethod('DELETE')
                ->getForm();

        }
}