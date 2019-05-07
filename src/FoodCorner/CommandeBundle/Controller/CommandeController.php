<?php

namespace FoodCorner\CommandeBundle\Controller;

use FoodCorner\CommandeBundle\Entity\Commande;
use FoodCorner\CommandeBundle\Form\CommandeType;
use FoodCorner\MenuuBundle\Entity\Plat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commande controller.
 *
 * @Route("commande")
 */
class CommandeController extends Controller
{
    /**
     * Lists all commande entities.
     *
     * @Route("/", name="commande_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('FoodCornerCommandeBundle:Commande')->findAll();

        return $this->render('@FoodCornerCommande/Administration/commande/index.html.twig', array(
            'commandes' => $commandes,
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

    /**
     * Creates a new commande entity.
     *
     * @Route("/new/{id}", name="commande_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request , $id )
    {
         $em=$this->getDoctrine()->getManager();
         $plat=$em->getRepository('FoodCornerMenuuBundle:Plat')->find($id);

        $user= $this->getUser();

        $commande = new Commande();
        $commande->setPlat($plat);
        $form = $this->createForm('FoodCorner\CommandeBundle\Form\CommandeType', $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $commande->setUser($user);
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('commande_show', array('id' => $commande->getId()));
        }

        return $this->render('@FoodCornerCommande/FormUser/new.html.twig', array(
            'commande' => $commande,
            'form' => $form->createView(),

        ));
    }

    /**
     * Finds and displays a commande entity.
     * @Route("/{id}", name="commande_show")
     * @Method("GET")
     */
    public function showAction(Commande $commande)
    {
        $deleteForm = $this->createDeleteForm($commande);
        return $this->render('@FoodCornerCommande/FormUser/show.html.twig', array(
            'commande' => $commande,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Finds and displays a commande entity.
     * @Route("admin/{id}", name="commande_show_admin")
     * @Method("GET")
     */
    public function showAdminAction(Commande $commande)
    {
        $deleteForm = $this->createDeleteForm($commande);
        return $this->render('@FoodCornerCommande/Administration/commande/show.html.twig', array(
            'commande' => $commande,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * @Route("/remove/{id}")
     */
    public function removeAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository('FoodCornerCommandeBundle:Commande')->find($id);
        $em->remove($commande);
        $em->flush();
        $this->addFlash(
            'delete',
            'commande supprimè'
        );
        return $this->redirectToRoute('commande_index');
    }


    /**
     * Creates a form to create a Offre entity.
     *
     * @param Commande $commande The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private $commandee;
    function createCreateForm(Commande $commande)
    {
        $form = $this->createForm(new CommandeType(), $commande, array(
            'action' => $this->generateUrl('offre_new'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }

    /**
     * Creates a form to edit a offre entity.
     *
     * @param Commande $commande The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */

    function createEditForm(Commande $commande)
    {
        $form = $this->createForm(new CommandeType(), $commande, array(

            'action' => $this->generateUrl('offre_edit', array('id' => $commande->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        return $form;
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param Commande $commande The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private $commande;
    private function createDeleteForm(Commande $commande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('foodcorner_commande_commande_remove', array('id' => $commande->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}

