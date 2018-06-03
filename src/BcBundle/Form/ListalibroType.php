<?php

namespace BcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
class ListalibroType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('idUsuario', TextType::class, array("label" => "ID Usuario", "required" => "required", "attr" => array(
                        "class" => "form-name form-control", "maxlength" => "10"
            )))
                ->add('idLibro', TextType::class, array("label" => "ID Libro", "required" => "required", "attr" => array(
                        "class" => "form-name form-control", "maxlength" => "10"
            ))) 
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BcBundle\Entity\Listalibro'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bcbundle_Listalibro';
    }

}
