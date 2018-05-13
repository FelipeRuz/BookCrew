<?php
namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BcBundle\Entity\Autor;
use BcBundle\Form\AutorType;

class AutorController extends Controller
{
    private $session;
    
    /*public function __construct() {
        $this->session=new Session();
    }*/

    public function addAutorAction(Request $request){
        $autor = new Autor();
        $form=$this->createForm(AutorType::class,$autor);               
        
        $form->handleRequest($request);
        
        If($form->isSubmitted()){
            If($form->isValid()){
                
                
                $status= "Se ha enviado al servidor su petición de autor";
            }
            Else{
                $status = "No se ha enviado correctamente la petición de autor. El formato no es válido";
                
            }
            //$this->session->getFlashBag()->add("status",$status);
        }            
        
        return $this->render("BcBundle:Autor:addAutor.html.twig",array(
            "form"=>$form->createView()
        ));
    }
}
