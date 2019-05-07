<?php

namespace FoodCorner\ReservationnBundle\Controller;

use FoodCorner\ReservationnBundle\Entity\Reservation;
use FoodCorner\ReservationnBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reservation controller.
 *
 * @Route("reservation")
 */
class ReservationController extends Controller
{
    /**
     * Lists all reservation entities.
     *
     * @Route("/", name="reservation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservations = $em->getRepository('FoodCornerReservationnBundle:Reservation')->findAll();

        return $this->render('@FoodCornerReservationn/Administration/index.html.twig', array(
            'reservations' => $reservations,
        ));
    }

    /**
     * Creates a new reservation entity.
     *
     * @Route("/new", name="reservation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $user = $this->getUser();
        $reservation = new Reservation();
        $form = $this->createForm('FoodCorner\ReservationnBundle\Form\ReservationType', $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $reservation->setUser($user);
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('reservation_show_user', array('id' => $reservation->getId()));
        }
        return $this->render('@FoodCornerReservationn/User/new.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
        ));


    }

    /**
     * Finds and displays a reservation entity.
     *
     * @Route("/{id}", name="reservation_show")
     * @Method("GET")
     */
    public function showAction(Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);

        return $this->render('@FoodCornerReservationn/Administration/show.html.twig', array(
            'reservation' => $reservation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a reservation entity.
     *
     * @Route("user/{id}", name="reservation_show_user")
     * @Method("GET")
     */
    public function showUserAction(Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);

        return $this->render('@FoodCornerReservationn/User/show.html.twig', array(
            'reservation' => $reservation,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a reservation entity.
     *
     * @Route("/{id}", name="reservation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reservation $reservation)
    {
        $form = $this->createDeleteForm($reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }


    /**
     * @Route("/remove/{id}")
     */
    public function removeAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $plat=$em->getRepository('FoodCornerReservationnBundle:Reservation')->find($id);
        $em->remove($plat);
        $em->flush();
        $this->addFlash(
            'delete',
            'reservation supprimè'
        );
        return $this->redirectToRoute('reservation_index');
    }



    private $reservation;
    function createCreateForm(Reservation $reservation)
    {
        $form = $this->createForm(new ReservationType(), $reservation, array(
            'action' => $this->generateUrl('reservation_new'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));
        return $form;
    }

    /**
     * Creates a form to delete a reservation entity.
     *
     * @param Reservation $reservation The reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */

    private $resrvation;
    private function createDeleteForm(Reservation $reservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservation_delete', array('id' => $reservation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
