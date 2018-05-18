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

    public function indexLibroAction(){
        $em=$this->getDoctrine()->getEntityManager();
        $libro_repo = $em->getRepository("BcBundle:Libro");
        $libros=$libro_repo->findAll();
        
        return $this->render("BcBundle:Libro:indexLibro.html.twig",array(
            "libros"=>$libros
        ));
    }
    
    
    public function addLibroAction(Request $request){
        $libro = new Libro();
        $form=$this->createForm(LibroType::class,$libro);               
        
        $form->handleRequest($request);
        
        If($form->isSubmitted()){
            If($form->isValid()){
                $em=$this->getDoctrine()->getEntityManager();
                $libro = new Usuario();
                
                $libro->setIsbn($form->get("isbn")->getData());
                $libro->setFormato($form->get("formato")->getData());
                $libro->setFechPublic($form->get("fechpublic")->getData());
                $libro->setPortada("");
                $libro->setValidacion(0);
                $libro->setAutor($form->get("autor")->getData());
                $libro->setCategoria($form->get("categoria")->getData());
                
                $em->persist($libro);
                $flush=$em->flush();
                
                If($flush== NULL){
                    $status= "Se ha enviado al servidor su petición de libro para ser validada"; 
                }
                Else{
                    $status= "No se ha enviado al servidor su petición de libro para ser validada. Error: 'flush inválido'";
                }
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
