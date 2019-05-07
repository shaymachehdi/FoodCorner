<?php

namespace FoodCorner\MenuuBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('description',TextareaType::class ,array('required'=>'required','attr' => ['class' => 'form-control']))
                 ->add('datedeb', DateTimeType::class, array('required' => true, 'widget' => 'single_text', 'attr' => ['class' => 'form-control input-inline datetimepicker', 'data-provide' => 'datetimepicker','html5' => false,
                 ]))
                 ->add('datefin' , DateTimeType::class,array('required' => true, 'widget' => 'single_text', 'attr' => ['class' => 'form-control input-inline datetimepicker', 'data-provide' => 'datetimepicker','html5' => false,
                 ]))
                 ->add('plat', EntityType::class,array('class'=>'FoodCorner\MenuuBundle\Entity\Plat','choice_label'=>'name')
                 );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FoodCorner\MenuuBundle\Entity\Offre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'foodcorner_menuubundle_offre';
    }


}
