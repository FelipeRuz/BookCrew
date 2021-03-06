<?php

namespace BcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


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
                ->add('foto',FileType::class, array("label"=>"Foto del autor","data_class" => null,"attr"=>array(
                    "class"=> "form-name btn btn-dark"),
                    "required"=>false,
                    'empty_data' => '',
                    "data_class" => null
                    ))
                ->add('Guardar',SubmitType::class,array("attr"=>array(
                    "class"=> "form-submit btn btn-success",
                    "onclick" => "confirmarCambios('/autor/addAutor')"
                )))
                ->add('Cancelar',ButtonType::class,array("attr"=>array(
                    "class"=> "form-submit btn btn-danger",
                    "onclick" => "confirmarAtras()" 
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
