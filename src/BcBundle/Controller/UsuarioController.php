<?php
namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BcBundle\Entity\Usuario;
use BcBundle\Form\UsuarioType;

class UsuarioController extends Controller
{
    private $session;
    
    /*public function __construct() {
        $this->session = new Session();
    }*/
    
    public function indexAction()
    {
        return $this->render('BcBundle:Default:index.html.twig');
    }
    
    public function loginAction(Request $request){
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        /*Esta parte la añadimos hasta poder usar la zona de adicion de usuario independiente de login*/
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class,$usuario);
        
        $form->handleRequest($request);
        
        If($form->isSubmitted()){
            //Verificación si los datos de registro son válidos
            If($form->isValid()){
                $em=$this->getDoctrine()->getEntityManager();
                $usu_repo=$em->getRepository("BcBundle:Usuario");
                $usuario = $usu_repo->findOneBy(array("email"=>$form->get("email")->getData()));
               
                //If((count($usuario))==0){
                    //$status = "Se ha registrado correctamente";
                    $usuario = new Usuario();
                    $usuario->setNick($form->get("nick")->getData());
                    //Codificación de la contraseña
                    $factory=$this->get("security.encoder_factory");
                    $encoder=$factory->getEncoder($usuario);
                    $password=$encoder->encodePassword($form->get("pass")->getData(),$usuario->getSalt());
                    $usuario->setPassword($password);
                    //
                    $usuario->setRol("USER");  
                    $usuario->setNombre($form->get("nombre")->getData());
                    $usuario->setApellido($form->get("apellido")->getData());
                    $usuario->setEmail($form->get("email")->getData());        
                    $usuario->setTlf($form->get("tlf")->getData());
                    $usuario->setPoblacion($form->get("poblacion")->getData());
                    $usuario->setProvincia($form->get("provincia")->getData());
                    $usuario->setDireccion($form->get("direccion")->getData());

                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($usuario);
                    $flush=$em->flush();

                    If($flush == null ){
                        $status="El usuario se ha registrado correctamente";
                    }
                    Else{
                        $status = "NO se ha registrado correctamente";
                    }
                    //Mostramos el mensaje flash data
                    $this->session->getFlashBag()->add("status",$status);
                /*}
                Else{
                    $status = "El usuario ya ha sido registrado";
                }*/
            }
            Else{
                $status = "NO se ha registrado correctamente";
            }
        }

        return $this->render("BcBundle:Usuario:login.html.twig",array(
            "error" => $error,
            "last_username"=>$lastUsername,
            "form" => $form->createView()
        ));
        /*return $this->render("BcBundle:Usuario:login.html.twig",array(
           "error" => $error,
           "last_username" => $lastUsername
        ));*/
    }
    
    public function AddAction(Request $request){
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class,$usuario);
        
        $form->handleRequest($request);
        
        If($form->isValid()){
            $status = "Se ha registrado correctamente";
        }
        Else{
            $status = "NO se ha registrado correctamente";
        }
        
        return $this->render("BcBundle:Usuario:login.html.twig",array(
            "error" => $error,
            "last_username"=>$lastUsername,
            "form" => $form->createView()
        ));
    }
}
