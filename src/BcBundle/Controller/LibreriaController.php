<?php
namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BcBundle\Entity\Libreria;
use BcBundle\Form\LibreriaType;

class LibreriaController extends Controller
{
    private $session;
    
    /*public function __construct() {
        $this->session=new Session();
    }*/
    
    public function indexLibreriaAction(){
        $em=$this->getDoctrine()->getEntityManager();
        $libreria_repo = $em->getRepository("BcBundle:Libro");
        $librerias=$libreria_repo->findAll();
        
        return $this->render("BcBundle:Libreria:indexLibreria.html.twig",array(
            "librerias"=>$librerias
        ));
    }
    
    public function addLibreriaAction(Request $request){
        $libreria = new Libreria();
        $form=$this->createForm(LibreriaType::class,$libreria);               
        
        $form->handleRequest($request);
        
        If($form->isSubmitted()){
            If($form->isValid()){
                $em=$this->getDoctrine()->getEntityManager();
                $libreria = new Libreria();
                
                $libreria->setNif($form->get("nif")->getData());
                $libreria->setNombre($form->get("nombre")->getData());
                $libreria->setTlf($form->get("nombre")->getData());
                $libreria->setEmail($form->get("email")->getData());
                $libreria->setPoblacion($form->get("poblacion")->getData());
                $libreria->setProvincia($form->get("provincia")->getData());
                $libreria->setDireccion($form->get("direccion")->getData());
                $libreria->setUbicacion($form->get("ubicacion")->getData());
                $libreria->setWeb($form->get("web")->getData());
                
                $em->persist($libreria);
                $flush=$em->flush();
                
                If($flush== NULL){
                    $status= "Se ha enviado al servidor su petición de librería para ser validada"; 
                }
                Else{
                    $status= "No se ha enviado al servidor su petición de librería para ser validada. Error: 'flush inválido'";
                }
            }
            Else{
                $status = "No se ha enviado correctamente la petición de librería. El formato no es válido";
                
            }
            //$this->session->getFlashBag()->add("status",$status);
        }            
        
        return $this->render("BcBundle:Libro:addLibro.html.twig",array(
            "form"=>$form->createView()
        ));
    }
}