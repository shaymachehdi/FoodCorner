<?php

namespace FoodCorner\ContactBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FoodCorner\ContactBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FoodCorner\ContactBundle\Form\ContactType;



class ContactController extends Controller
{
    public function sendAction(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form ->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return new Response('votre message à été bien envoyé!');
        }

        return $this->render('@Contact/Contact/User/send.html.twig',array(
            'contact' => $contact,
            'form'=>$form->createView()));
    }




    public function aproposAction()
    {
        return $this->render('@App/Apropos/a_propos.html.twig');
    }





}
