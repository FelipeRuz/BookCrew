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
            ->add('provincia', ChoiceType::class, array(
                "label" => "Provincia",
                "choices" => array(
                    'Álava' => 'Álava', 'Albacete' => 'Albacete', 'Alicante' => 'Alicante', 'Almería' => 'Almería', 'Asturias' => 'Asturias', 'Avila' => 'Avila', 'Badajoz' => 'Badajoz', 'Barcelona' => 'Barcelona', 'Burgos' => 'Burgos', 'Cáceres' => 'Cáceres',
                    'Cádiz' => 'Cádiz', 'Cantabria' => 'Cantabria', 'Castellón' => 'Castellón', 'Ciudad Real' => 'Ciudad Real', 'Córdoba' => 'Córdoba', 'La Coruña' => 'La Coruña±a', 'Cuenca' => 'Cuenca', 'Gerona' => 'Gerona', 'Granada' => 'Granada', 'Guadalajara' => 'Guadalajara',
                    'Guipúzcoa' => 'Guipúzcoa', 'Huelva' => 'Huelva', 'Huesca' => 'Huesca', 'Islas Baleares' => 'Islas Baleares', 'Jaén' => 'Jaén©n', 'León' => 'León', 'Lérida' => 'Lérida', 'Lugo' => 'Lugo', 'Madrid' => 'Madrid', 'Málaga' => 'Málaga', 'Murcia' => 'Murcia', 'Navarra' => 'Navarra',
                    'Orense' => 'Orense', 'Palencia' => 'Palencia', 'Las Palmas' => 'Las Palmas', 'Pontevedra' => 'Pontevedra', 'La Rioja' => 'La Rioja', 'Salamanca' => 'Salamanca', 'Segovia' => 'Segovia', 'Sevilla' => 'Sevilla', 'Soria' => 'Soria', 'Tarragona' => 'Tarragona',
                    'Santa Cruz de Tenerife' => 'Santa Cruz de Tenerife', 'Teruel' => 'Teruel', 'Toledo' => 'Toledo', 'Valencia' => 'Valencia', 'Valladolid' => 'Valladolid', 'Vizcaya' => 'Vizcaya', 'Zamora' => 'Zamora', 'Zaragoza' => 'Zaragoza',
                    "attr" => array("class" => "form-control")
                ),
                "required" => "required",
            ))
                ->add('provincia',TextType::class, array("label"=>"Provincia","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('direccion',TextType::class, array("label"=>"Dirección","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control","maxlength"=>"20"
                )))
                ->add('ubicacion',TextType::class, array("label"=>"Ubicación","attr"=>array(
                    "class"=> "form-name form-control","maxlength"=>"20"
                )))
                ->add('web',TextType::class, array("label"=>"Web","required"=>"required","attr"=>array(
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
