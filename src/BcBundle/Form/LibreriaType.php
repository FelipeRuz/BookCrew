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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LibreriaType extends AbstractType {

    public $provincias = ['Alava', 'Albacete', 'Alicante', 'Almería', 'Asturias', 'Avila', 'Badajoz', 'Barcelona', 'Burgos', 'Cáceres',
        'Cádiz', 'Cantabria', 'Castellón', 'Ciudad Real', 'Córdoba', 'La Coruña', 'Cuenca', 'Gerona', 'Granada', 'Guadalajara',
        'Guipúzcoa', 'Huelva', 'Huesca', 'Islas Baleares', 'Jaén', 'León', 'Lérida', 'Lugo', 'Madrid', 'Málaga', 'Murcia', 'Navarra',
        'Orense', 'Palencia', 'Las Palmas', 'Pontevedra', 'La Rioja', 'Salamanca', 'Segovia', 'Sevilla', 'Soria', 'Tarragona',
        'Santa Cruz de Tenerife', 'Teruel', 'Toledo', 'Valencia', 'Valladolid', 'Vizcaya', 'Zamora', 'Zaragoza'];

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nif', TextType::class, array("label" => "Nif de la librería", "required" => "required", "attr" => array(
                        "class" => "form-name form-control", "maxlength" => "10","placeholder"=>"Ejem: 11223344Z"
            )))
                ->add('nombre', TextType::class, array("label" => "Nombre", "required" => "required", "attr" => array(
                        "class" => "form-name form-control", "maxlength" => "15","placeholder"=>"Ejem: libreria"
            )))
                ->add('email', EmailType::class, array("label" => "Email", "required" => "required", "attr" => array(
                        "class" => "form-name form-control", "maxlength" => "25","placeholder"=>"Ejem:libreria@gmail.com"
            )))
                ->add('tlf', TextType::class, array("label" => "Teléfono", "required" => "required", "attr" => array(
                        "class" => "form-name form-control", "maxlength" => "9","placeholder"=>"Ejem: 900556677"
            )))
                ->add('provincia', ChoiceType::class, array(
                    "label" => "Provincia",
                    "choices" => array(
                        'Álava' => 'Álava', 'Albacete' => 'Albacete', 'Alicante' => 'Alicante', 'Almería' => 'Almería', 'Asturias' => 'Asturias', 'Avila' => 'Avila', 'Badajoz' => 'Badajoz', 'Barcelona' => 'Barcelona', 'Burgos' => 'Burgos', 'Cáceres' => 'Cáceres',
                        'Cádiz' => 'Cádiz', 'Cantabria' => 'Cantabria', 'Castellón' => 'Castellón', 'Ciudad Real' => 'Ciudad Real', 'Córdoba' => 'Córdoba', 'La Coruña' => 'La Coruña±a', 'Cuenca' => 'Cuenca', 'Gerona' => 'Gerona', 'Granada' => 'Granada', 'Guadalajara' => 'Guadalajara',
                        'Guipúzcoa' => 'Guipúzcoa', 'Huelva' => 'Huelva', 'Huesca' => 'Huesca', 'Islas Baleares' => 'Islas Baleares', 'Jaén' => 'Jaén©n', 'León' => 'León', 'Lérida' => 'Lérida', 'Lugo' => 'Lugo', 'Madrid' => 'Madrid', 'Málaga' => 'Málaga', 'Murcia' => 'Murcia', 'Navarra' => 'Navarra',
                        'Orense' => 'Orense', 'Palencia' => 'Palencia', 'Las Palmas' => 'Las Palmas', 'Pontevedra' => 'Pontevedra', 'La Rioja' => 'La Rioja', 'Salamanca' => 'Salamanca', 'Segovia' => 'Segovia', 'Sevilla' => 'Sevilla', 'Soria' => 'Soria', 'Tarragona' => 'Tarragona',
                        'Santa Cruz de Tenerife' => 'Santa Cruz de Tenerife', 'Teruel' => 'Teruel', 'Toledo' => 'Toledo', 'Valencia' => 'Valencia', 'Valladolid' => 'Valladolid', 'Vizcaya' => 'Vizcaya', 'Zamora' => 'Zamora', 'Zaragoza' => 'Zaragoza',
                    ),
                    "required" => "required",
                    "attr" => array("class" => "form-name btn btn-dark")
                ))
                ->add('poblacion', TextType::class, array("label" => "Población", "attr" => array(
                        "class" => "form-name form-control", "maxlength" => "20","placeholder"=>"Ejem: Huelva"
            )))
                ->add('ubicacion', TextType::class, array("label" => "Ubicación", "attr" => array(
                        "class" => "form-name form-control", "maxlength" => "50", "placeholder"=>"Ubicación gráfica de la librería"
            )))
                ->add('direccion', TextType::class, array("label" => "Dirección", "required" => "required", "attr" => array(
                        "class" => "form-name form-control", "maxlength" => "30","placeholder"=>"Ejem: C Prueba,1"
            )))
                ->add('web', TextType::class, array("label" => "Web", "required" => "required", "attr" => array(
                        "class" => "form-name form-control", 
                        "maxlength" => "50",
                        "placeholder"=>"Ejem: libreria-pag.com",
                        "required" => "false"
            )))
                ->add('Guardar', SubmitType::class, array("attr" => array(
                        "class" => "form-submit btn btn-success",
                        "onclick" => "confirmarCambios('/libreria/addLibreria')"
            )))
                ->add('Cancelar', ButtonType::class, array("attr" => array(
                        "class" => "form-submit btn btn-danger",
                        "onclick" => "confirmarAtras()"
            )))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BcBundle\Entity\Libreria'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bcbundle_Libreria';
    }

}
