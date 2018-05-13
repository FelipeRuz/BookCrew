<?php

namespace BcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;


class AutorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nombre',TextType::class, array("label"=>"Nombre del autor","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"20"
                )))
                ->add('apellido',TextType::class, array("label"=>"Apellido del autor","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"30"
                )))
                ->add('foto',TextType::class, array("label"=>"Foto del autor","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"50"
                )))
                ->add('Guardar',SubmitType::class,array("attr"=>array(
                    "class"=> "form-submit btn btn-success"
                )))
                ->add('Cancelar',ButtonType::class,array("attr"=>array(
                    "class"=> "form-submit btn btn-danger", 
                )))
                ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BcBundle\Entity\Autor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bcbundle_Autor';
    }


}
