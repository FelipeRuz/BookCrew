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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LibroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('isbn',TextType::class, array("label"=>"ISBN ","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control","maxlength"=>"14","placeholder"=>"Identificador del libro. Ejem: 11223344A"
                )))
                ->add('titulo',TextType::class, array("label"=>"Título ","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"50","placeholder"=>"Ejem: The Crow"
                )))
                ->add('formato', ChoiceType::class, array(
                    "label" => "Formato ",
                    "choices" => array(
                        'Físico' => 0, 'Digital' => 1, 'Digital y físico' => 2
                    ),
                    "attr"=>array(
                    "class"=> "form-name btn btn-secondary"),
                    "required" => "required"
                ))
                ->add('fechPublic',DateType::class, array("label"=>"Fecha de publicación ","required"=>"required","attr"=>array(
                    "class"=> "form-name",'input'=> 'timestamp', 'widget' => 'choice', "model_timezone"
                )))  
                ->add('portada',FileType::class, array("label"=>"Portada ","attr"=>array(
                    "class"=> "form-name btn btn-dark"),
                    "required"=>false,
                    'empty_data' => ''
                    ))
                ->add('autor',EntityType::class, array("label"=>"Autor ->","required"=>"required",
                    "class"=>'BcBundle:Autor',
                    "attr"=>array("class"=> "form-name btn btn-primary","placeholder"=>"Ejem: Edgar Allan Poe"
                )))
                ->add('categoria',EntityType::class, array("label"=>"Categoría ->","required"=>"required",
                    "class"=>'BcBundle:Categoria',
                    "attr"=>array("class"=> "form-name btn btn-secondary",
                )))
                ->add('Guardar',SubmitType::class,array("attr"=> array(
                    "class"=> "form-submit btn btn-success",
                    "onclick" => "confirmarCambios('/libro/addLibro')"
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
