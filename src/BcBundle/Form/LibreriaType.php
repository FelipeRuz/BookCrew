<?php

namespace BcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class LibreriaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nif',TextType::class, array("label"=>"Nif de la librería","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"10"
                )))
                ->add('nombre',TextType::class, array("label"=>"Nombre","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"15"
                )))
                ->add('email',EmailType::class, array("label"=>"Email","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"25"
                )))
                ->add('tlf',TextType::class, array("label"=>"Teléfono","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"9"
                )))
                ->add('poblacion',TextType::class, array("label"=>"Población","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('provincia',TextType::class, array("label"=>"Provincia","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('direccion',TextType::class, array("label"=>"Dirección","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control","maxlength"=>"20"
                )))
                ->add('ubicacion',TextType::class, array("label"=>"Dirección","attr"=>array(
                    "class"=> "form-name form-control","maxlength"=>"20"
                )))
                ->add('web',TextType::class, array("label"=>"Dirección","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control","maxlength"=>"20"
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
            'data_class' => 'BcBundle\Entity\Libreria'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bcbundle_Libreria';
    }


}
