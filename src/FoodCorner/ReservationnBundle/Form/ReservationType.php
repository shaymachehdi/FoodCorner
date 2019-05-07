<?php

namespace FoodCorner\ReservationnBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ReservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type' ,ChoiceType::class,array('choices'=> array('Normale'=>'Normale','Familiale'=>'Familiale','Romantique' =>'Romantique','Anniversaire'=>'Anniversaire' ),'attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
            ->add('nbrepers' ,  ChoiceType::class, array('choices'=>array('1' => 1, '2' => 2, '3' =>3, '4' =>4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, '11' => 11, '12' => 12, '13' => 13, '14' => 14, '15' => 15, '16' => 16, '17' => 17, '18' => 18, '19' => 19, '20' => 20, '21' => 21, '22' => 22, '23' => 23, '24' => 24, '25' => 25, '26' => 26, '27' => 27, '28' => 28, '29' => 29, '30'=>30)))
            ->add('date', DateTimeType::class, array('required' => true, 'widget' => 'single_text', 'attr' => ['class' => 'form-control input-inline datetimepicker', 'data-provide' => 'datetimepicker','html5' => false,
                ],
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FoodCorner\ReservationnBundle\Entity\Reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'foodcorner_reservationnbundle_reservation';
    }


}
