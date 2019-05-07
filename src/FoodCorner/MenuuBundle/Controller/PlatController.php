<?php

namespace FoodCorner\MenuuBundle\Controller;

use FoodCorner\MenuuBundle\Entity\Plat;
use FoodCorner\MenuuBundle\Form\PlatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Plat controller.
 *
 * @Route("plat")
 */
class PlatController extends Controller
{
//    /**
//     * Lists all plat entities.
//     *
//     * @Route("/", name="plat_index")
//     * @Method("GET")
//     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $plats = $em->getRepository('FoodCornerMenuuBundle:Plat')->findAll();
//
//        return $this->render('@FoodCornerMenuu/Administration/Plat/index.html.twig', array(
//            'plats' => $plats,
//        ));
//    }

   /**
     * Lists all plat entities.
     *
     * @Route("panier/", name="plat_index_panier")
     * @Method("GET")
     */
    public function indexPanierAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plats = $em->getRepository('FoodCornerMenuuBundle:Plat')->findAll();

        return $this->render('@FoodCornerCommande/Panier/panier.html.twig', array(
            'plats' => $plats,
        ));
    }

    /**
     * Creates a new plat entity.
     *
     * @Route("/new", name="plat_new")
     *
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plat = new Plat();
        $form = $this->createForm('FoodCorner\MenuuBundle\Form\PlatType', $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$plat->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images_directory'),$fileName
            );
            $plat->setImage($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();

            return $this->redirectToRoute('plat_index', array('id' => $plat->getId()));
        }

        return $this->render('@FoodCornerMenuu/Administration/Plat/new.html.twig', array(
            'plat' => $plat,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a plat entity.
     *
     * @Route("/{id}", name="plat_show")
     * @Method("GET")
     */
    public function showAction(Plat $plat)
    {
        $deleteForm = $this->createDeleteForm($plat);

        return $this->render('@FoodCornerMenuu/Administration/Plat/show.html.twig', array(
            'plat' => $plat,
            'delete_form' => $deleteForm->createView(),
        ));
    }



     /**
     * Finds and displays a plat entity.
     *
     * @Route("panier/{id}", name="plat_show_panier_user")
     * @Method("GET")
     */
    public function showPanierPlatAction(Plat $plat)
    {
        $deleteForm = $this->createDeleteForm($plat);

        return $this->render('@FoodCornerCommande/Panier/panier_info.html.twig', array(
            'plat' => $plat,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Finds and displays a plat entity.
     *
     * @Route("panier/{id}", name="plat_show_panier")
     * @Method("GET")
     */
    public function showPanierAction(Plat $plat)
    {
        $deleteForm = $this->createDeleteForm($plat);

        return $this->render('@FoodCornerCommande/Panier/panier_info.html.twig', array(
            'plat' => $plat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plat entity.
     *
     * @Route("/{id}/edit", name="plat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Plat $plat)
    {
        $deleteForm = $this->createDeleteForm($plat);
        $editForm = $this->createForm('FoodCorner\MenuuBundle\Form\PlatType', $plat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file=$plat->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images_directory'),$fileName
            );
            $plat->setImage($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plat_edit', array('id' => $plat->getId()));
        }

        return $this->render('@FoodCornerMenuu/Administration/Plat/edit.html.twig', array(
            'plat' => $plat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }




    /**
     * Deletes a plat entity.
     *
     * @Route("/{id}", name="plat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Plat $plat)
    {
        $form = $this->createDeleteForm($plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plat);
            $em->flush();
        }

        return $this->redirectToRoute('plat_index');
    }


    /**
     * @Route("/remove/{id}")
     */
    public function removeAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $plat=$em->getRepository('FoodCornerMenuuBundle:Plat')->find($id);
        $em->remove($plat);
        $em->flush();
        $this->addFlash(
            'delete',
            'plat supprimè'
        );
        return $this->redirectToRoute('plat_index');
    }


    /**
     * Creates a form to create a Plat entity.
     *
     * @param Plat $plat The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private $plat;
    function createCreateForm(Plat $plat)
    {
        $form = $this->createForm(new PlatType(), $plat, array(
            'action' => $this->generateUrl('plat_new'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }

    /**
     * Creates a form to edit a plat entity.
     *
     * @param Plat $plat The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */

    function createEditForm(Plat $plat)
    {
        $form = $this->createForm(new PLatType(), $plat, array(
            'action' => $this->generateUrl('plat_edit', array('id' => $plat->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        return $form;
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param Plat $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private $us;
    private function createDeleteForm(Plat $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('foodcorner_menuu_plat_remove', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}

