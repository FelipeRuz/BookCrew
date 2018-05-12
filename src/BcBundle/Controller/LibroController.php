<?php
namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BcBundle\Entity\Libro;
use BcBundle\Form\LibroType;

class LibroController extends Controller
{
    private $session;
    
    /*public function __construct() {
        $this->session=new Session();
    }*/

    public function addLibroAction(Request $request){
        $libro = new Libro();
        $form=$this->createForm(LibroType::class,$libro);               
        
        $form->handleRequest($request);
        
        If($form->isSubmitted()){
            If($form->isValid()){
                
                
                $status= "Se ha enviado al servidor su petición de libro para ser validada";
            }
            Else{
                $status = "No se ha enviado correctamente la petición de libro. El formato no es válido";
                
            }
            //$this->session->getFlashBag()->add("status",$status);
        }            
        
        return $this->render("BcBundle:Libro:addLibro.html.twig",array(
            "form"=>$form->createView()
        ));
    }
}
