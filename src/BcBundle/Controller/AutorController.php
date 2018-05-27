<?php

namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BcBundle\Entity\Autor;
use BcBundle\Form\AutorType;

class AutorController extends Controller {

    private $session;

    /* public function __construct() {
      $this->session=new Session();
      } */
    
    public function listLibAutorAction($id) {
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT a.*, c.id_usuario FROM libro a JOIN listalibro b on a.id_libro=b.id_libro JOIN usuario c on b.id_usuario = c.id_usuario WHERE c.id_usuario = '.$id.'';
        $statement = $em->getConnection()->prepare($query);
        
        $statement->execute();
        $listados = $statement->fetchAll();
        
        return $this->render("BcBundle:Listadolibro:indexListadolibro.html.twig", array(
            "listados" => $listados
        ));
    }
    
    public function indexAutorAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $autor_repo = $em->getRepository("BcBundle:Autor");
        $autores = $autor_repo->findAll();

        return $this->render('BcBundle:Autor:indexAutor.html.twig', array(
                    "autores" => $autores
        ));
    }

    public function editAutorAction(Request $request, $id) {
        $em = $this->getDoctrine()->getEntityManager();
        $autor_repo = $em->getRepository("BcBundle:Autor");
        $autor = $autor_repo->find($id);

        $form = $this->createForm(AutorType::class, $autor);
        $form->handleRequest($request);

        If ($form->isSubmitted()) {
            If ($form->isValid()) {
                
                $autor->setNombre($form->get("nombre")->getData());
                $autor->setApellido($form->get("apellido")->getData());
                //$autor->setFoto("");

                /*Caso de no obtención de imagen, introducir campo vacío.*/
                If(($form->get("foto")->getData()) == null || ($form->get("foto")->getData()) == "")
                {
                   $autor->setPortada(""); 
                }
                Else{
                    $file=$form["foto"]->getData();
                    $ext=$file->guessExtension();
                    $file_name= time().".".$ext;
                    $file->move("uploads",$file_name);
                    
                    $autor->setFoto($file_name);
                }

                $em->persist($autor);
                $flush = $em->flush();

                If ($flush == NULL) {
                    $status = "Se ha enviado al servidor su petición de autor para ser validada";
                } Else {
                    $status = "No se ha enviado al servidor su petición de autor para ser validada. Error: 'flush inválido'";
                }
            } Else {
                $status = "No se ha enviado correctamente la petición de librería. El formato no es válido";
            }
            //$this->session->getFlashBag()->add("status",$status);
        }

        return $this->render("BcBundle:Autor:editAutor.html.twig", array(
                    "form" => $form->createView()
        ));
    }

    public function delAutorAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $autor_repo = $em->getRepository("BcBundle:Autor");
        $autor = $autor_repo->find($id);

        //if (count($autor->getEntryAutor())==0) {
        $em->remove($autor);
        $em->flush();
        //}
        return $this->redirectToRoute("bc_index_autor");
    }

    public function addAutorAction(Request $request) {
        $autor = new Autor();
        $form = $this->createForm(AutorType::class, $autor);

        $form->handleRequest($request);

        If ($form->isSubmitted()) {
            If ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $autor = new Autor();

                $autor->setNombre($form->get("nombre")->getData());
                $autor->setApellido($form->get("apellido")->getData());
                $autor->setFoto("");

                $em->persist($autor);
                $flush = $em->flush();

                If ($flush == NULL) {
                    $status = "Se ha enviado al servidor su petición de autor para ser validada";
                } Else {
                    $status = "No se ha enviado al servidor su petición de autor para ser validada. Error: 'flush inválido'";
                }
            } Else {
                $status = "No se ha enviado correctamente la petición de autor. El formato no es válido";
            }
            //$this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("bc_index_autor");
        }

        return $this->render("BcBundle:Autor:addAutor.html.twig", array(
                    "form" => $form->createView()
        ));
    }

}
