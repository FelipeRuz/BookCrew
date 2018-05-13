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

    public function addLibreriaAction(Request $request){
        $libreria = new Libreria();
        $form=$this->createForm(LibreriaType::class,$libreria);               
        
        $form->handleRequest($request);
        
        If($form->isSubmitted()){
            If($form->isValid()){
                
                
                $status= "Se ha enviado al servidor su petición de libreria";
            }
            Else{
                $status = "No se ha enviado correctamente la petición de libreria. El formato no es válido";
                
            }
            //$this->session->getFlashBag()->add("status",$status);
        }            
        
        return $this->render("BcBundle:Libro:addLibro.html.twig",array(
            "form"=>$form->createView()
        ));
    }
}
