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

class FindLibroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('campBusq', ChoiceType::class, array(
                    "label" => "Campo Búsqueda",
                    "choices" => array(
                        'Nada' => 'nada', 
                        'Titulo del Libro' => 'titulo',
                        'Nombre del Autor' => 'autor', 
                        'Categoria' => 'categoria',
                    ),
                    "attr"=>array(
                    "class"=> "form-name btn btn-secondary"),
                    "required" => "required"
                ))
                
                ->add('paramBusq',TextType::class, array("label"=>"Parámetro de busqueda","attr"=>array(
                    "class"=> "form-name form-control","maxlength"=>"30"
                )))
                ->add('Buscar',SubmitType::class,array("attr"=> array(
                    "class"=> "form-submit btn btn-dark",
                    "target"=> "_blank"
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
