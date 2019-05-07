<?php

namespace FoodCorner\MenuuBundle\Controller;

use FoodCorner\MenuuBundle\Entity\Offre;
use FoodCorner\MenuuBundle\Form\OffreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Offre controller.
 *
 * @Route("offre")
 */
class OffreController extends Controller
{
    /**
     * Lists all offre entities.
     *
     * @Route("/", name="offre_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offres = $em->getRepository('FoodCornerMenuuBundle:Offre')->findAll();

        return $this->render('@FoodCornerMenuu/Administration/Offre/index.html.twig', array(
            'offres' => $offres,
        ));
    }


    /**
     * Lists all offre entities.
     *
     * @Route("/user", name="offre_index_user")
     * @Method("GET")
     */
    public function indexUserAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offres = $em->getRepository('FoodCornerMenuuBundle:Offre')->findAll();

        return $this->render('@FoodCornerMenuu/User/Offre/index.html.twig', array(
            'offres' => $offres,
        ));
    }



    /**
     * Creates a new offre entity.
     *
     * @Route("/new", name="offre_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $offre = new Offre();
        $form = $this->createForm('FoodCorner\MenuuBundle\Form\OffreType', $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();

            return $this->redirectToRoute('offre_show', array('id' => $offre->getId()));
        }

        return $this->render('@FoodCornerMenuu/Administration/Offre/new.html.twig', array(
            'offre' => $offre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a offre entity.
     *
     * @Route("/{id}", name="offre_show")
     * @Method("GET")
     */
    public function showAction(Offre $offre)
    {
        $deleteForm = $this->createDeleteForm($offre);

        return $this->render('@FoodCornerMenuu/Administration/Offre/show.html.twig', array(
            'offre' => $offre,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Finds and displays a offre entity.
     *
     * @Route("user/{id}", name="offre_show_user")
     * @Method("GET")
     */
    public function showUserAction(Offre $offre)
    {
        $deleteForm = $this->createDeleteForm($offre);

        return $this->render('@FoodCornerMenuu/User/Offre/show.html.twig', array(
            'offre' => $offre,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing offre entity.
     *
     * @Route("/{id}/edit", name="offre_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Offre $offre)
    {
        $deleteForm = $this->createDeleteForm($offre);
        $editForm = $this->createForm('FoodCorner\MenuuBundle\Form\OffreType', $offre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offre_edit', array('id' => $offre->getId()));
        }

        return $this->render('@FoodCornerMenuu/Administration/Offre/edit.html.twig', array(
            'offre' => $offre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a offre entity.
     *
     * @Route("/{id}", name="offre_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Offre $offre)
    {
        $form = $this->createDeleteForm($offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offre);
            $em->flush();
        }

        return $this->redirectToRoute('offre_index');
    }

    /**
     * @Route("/remove/{id}")
     */
    public function removeAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $offre=$em->getRepository('FoodCornerMenuuBundle:Offre')->find($id);
        $em->remove($offre);
        $em->flush();
        $this->addFlash(
            'delete',
            'offre supprimè'
        );
        return $this->redirectToRoute('offre_index');
    }


    /**
     * Creates a form to create a Offre entity.
     *
     * @param Offre $offre The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private $offree;
    function createCreateForm(Offre $offre)
    {
        $form = $this->createForm(new OffreType(), $offre, array(
            'action' => $this->generateUrl('offre_new'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }

    /**
     * Creates a form to edit a offre entity.
     *
     * @param Offre $offre The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */

    function createEditForm(Offre $offre)
    {
        $form = $this->createForm(new OffreType(), $offre, array(
            'action' => $this->generateUrl('offre_edit', array('id' => $offre->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        return $form;
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param Offre $offre The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private $offre;
    private function createDeleteForm(Offre $offre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('foodcorner_menuu_plat_remove', array('id' => $offre->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}

