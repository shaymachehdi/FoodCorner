<?php

namespace FoodCorner\MenuuBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PlatType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('image', FileType::class, array('label' => 'Photo','data_class' => null, 'required'=> false))
            ->add('menu')
            ->add('description')
            ->add('type',ChoiceType::class,array('choices'=> array('Plat principle' =>'Plat principle','Entrée'=>'Entrée','Salade'=>'Salade' ,'Dessert'=>'Dessert', 'Boisson'=>'Boisson' ),'attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
            ->add('prix')
            ->add('qte')
            ->add('disponible');
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FoodCorner\MenuuBundle\Entity\Plat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'foodcorner_menuubundle_plat';
    }


}
