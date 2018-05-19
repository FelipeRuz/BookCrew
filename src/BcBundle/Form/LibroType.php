<?php

namespace BcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;


class LibroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('isbn',TextType::class, array("label"=>"ISBN","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"14"
                )))
                ->add('titulo',TextType::class, array("label"=>"Título","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"50"
                )))
                ->add('formato',TextType::class, array("label"=>"Formato disponible","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"10"
                )))
                ->add('fechPublic',DateType::class, array("label"=>"Fecha de publicación","required"=>"required","attr"=>array(
                    "class"=> "form-name", 
                )))
                ->add('portada',TextType::class, array("label"=>"Portada","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"25"
                )))
                ->add('autor',TextType::class, array("label"=>"Autor","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"30"
                )))
                ->add('categoria',TextType::class, array("label"=>"Categoría","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
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
            'data_class' => 'BcBundle\Entity\Libro'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bcbundle_Libro';
    }


}
