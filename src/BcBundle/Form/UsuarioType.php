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

class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nick',TextType::class, array("label"=>"Nick de usuario","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"10"
                )))
                ->add('pass',PasswordType::class, array("label"=>"Contraseña","required"=>"required","attr"=>array(
                    "class"=> "form-password form-control", "maxlength"=>"10"
                )))
                ->add('nombre',TextType::class, array("label"=>"Nombre","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"15"
                )))
                ->add('apellido',TextType::class, array("label"=>"Apellidos","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"30" 
                )))
                ->add('email',EmailType::class, array("label"=>"Email","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"25"
                )))
                ->add('tlf',TextType::class, array("label"=>"Teléfono","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control", "maxlength"=>"9"
                )))
                /*->add('provincia',ChoiceType::class, array("label"=>"Provincia","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                    "choices"=> array("Álava"=>"Álava", "Albacete"=>"Albacete", "Alicante"=>"Alicante", "Almería"=>"Almería", "Asturias"=>"Asturias", "Ávila"=>"Ávila", "Badajoz"=>"Badajoz", "Barcelona"=>"Barcelona", "Burgos"=>"Burgos", "Cáceres"=>"Cáceres", "Cádiz"=>"Cádiz", 
                        "Cantabria"=>"Cantabria", "Castellón"=>"Cantabria", "Ciudad Real"=>"Cantabria", "Córdoba"=>"Córdoba", "Cuenca"=>"Cuenca", "Gerona"=>"Gerona", "Granada"=>"Granada", "Guadalajara"=>"Guadalajara", "Guipúzcoa"=>"Guipúzcoa", "Huelva"=>"Huelva", 
                        "Huesca"=>"Huesca", "Islas Baleares"=>"Islas Baleares", "Jaén"=>"Jaén", "La Coruña"=>"La Coruña", "La Rioja"=>"La Rioja", "Las Palmas"=>"Las Palmas", "León"=>"León", "Lérida"=>"Lérida", "Lugo"=>"Lugo", "Madrid"=>"Madrid", "Málaga"=>"Málaga", 
                        "Murcia"=>"Murcia", "Navarra"=>"Navarra", "Orense"=>"Orense", "Palencia"=>"Palencia", "Pontevedra"=>"Pontevedra", "Salamanca"=>"Salamanca", "Santa Cruz de Tenerife"=>"Santa Cruz de Tenerife", "Segovia"=>"Segovia", "Sevilla"=>"Sevilla", "Soria"=>"Soria", 
                        "Tarragona"=>"Tarragona", "Teruel"=>"Teruel", "Toledo"=>"Toledo", "Valencia"=>"Valencia", "Valladolid"=>"Valladolid", "Vizcaya"=>"Vizcaya", "Zamora"=>"Zamora", "Zaragoza"=>"Zaragoza")
                )))*/
                ->add('poblacion',TextType::class, array("label"=>"Población","required"=>"required","attr"=>array(
                    "class"=> "form-name form-control",
                )))
                ->add('direccion',TextType::class, array("label"=>"Dirección","required"=>"required","attr"=>array(
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
