<?php

namespace BcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nick',TextType::class, array("label"=>"Nick de usuario","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('pass',PasswordType::class, array("label"=>"Contraseña","required"=>"required","attr"=>array(
                    "class"=> "form-password form-control",
                )))
                ->add('nombre',TextType::class, array("label"=>"Nombre","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('apellido',TextType::class, array("label"=>"Apellidos","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('email',EmailType::class, array("label"=>"Email","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('tlf',TextType::class, array("label"=>"Teléfono","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('poblacion',TextType::class, array("label"=>"Población","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('provincia',TextType::class, array("label"=>"Provincia","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('direccion',TextType::class, array("label"=>"Dirección","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('Guardar',SubmitType::class,array("attr"=>array(
                    "class"=> "form-submit btn btn-success"
                )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BcBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bcbundle_usuario';
    }


}
