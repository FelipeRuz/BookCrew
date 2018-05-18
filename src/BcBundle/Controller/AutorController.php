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

    public function indexAutorAction()
    {
        $em= $this->getDoctrine()->getEntityManager();
        $autor_repo=$em->getRepository("BcBundle:Autor");
        $autores=$autor_repo->findAll();
        
        return $this->render('BcBundle:Autor:indexAutor.html.twig',array(
            "autores"=> $autores
        ));
    }
    
    public function addAutorAction(Request $request){
        $autor = new Autor();
        $form=$this->createForm(AutorType::class,$autor);               
        
        $form->handleRequest($request);
        
        If($form->isSubmitted()){
            If($form->isValid()){
                $em=$this->getDoctrine()->getEntityManager();
                $autor = new Autor();
                
                $autor->setNombre($form->get("nombre")->getData());
                $autor->setApellido($form->get("apellido")->getData());
                $autor->setFoto("");
                
                $em->persist($autor);
                $flush=$em->flush();
                
                If($flush== NULL){
                    $status= "Se ha enviado al servidor su petición de autor para ser validada"; 
                }
                Else{
                    $status= "No se ha enviado al servidor su petición de autor para ser validada. Error: 'flush inválido'";
                }
            }
            Else{
                $status = "No se ha enviado correctamente la petición de autor. El formato no es válido";
            }
            //$this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("bc_index_autor");
        }            
        
        return $this->render("BcBundle:Autor:addAutor.html.twig",array(
            "form"=>$form->createView()
        ));
    }
}
