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

    /* Función para obtener los datos de un perfil de un autor en concreto
     * @param: $id - El id representativo de la entidad
     */
    public function perfilAutorAction($id) {
        $em = $this->getDoctrine()->getManager();
        $em = $this->getDoctrine()->getEntityManager();
        $autor_repo = $em->getRepository("BcBundle:Autor");
        $autor = $autor_repo->find($id);

        return $this->render("BcBundle:Autor:perfilAutor.html.twig", array(
                    "autor" => $autor
        ));
    }

    /* Función para obtener los libros favoritos de un perfil del usuario
     * @param: $id - El id del autor para mostrar sus libros
     */
    public function listLibAutorAction($id) {
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT l.*,a.id_autor, a.nombre AS autor_nom,a.apellido ,c.* '
                . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
                . 'JOIN categoria c ON c.id_categoria=l.categoria '
                . 'WHERE validacion = 1 '
                . 'AND a.id_autor = '.$id.'';
        $statement = $em->getConnection()->prepare($query);

        $statement->execute();
        $listados = $statement->fetchAll();

        return $this->render("BcBundle:Autor:listAutor.html.twig", array(
                    "listados" => $listados
        ));
    }

    /* Función para obtener todos los autores de la BD
     * 
     */
    public function indexAutorAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $autor_repo = $em->getRepository("BcBundle:Autor");
        $autores = $autor_repo->findAll();

        return $this->render('BcBundle:Autor:indexAutor.html.twig', array(
                    "autores" => $autores
        ));
    }

    /*Funcion para editar un autor
     * @param: Request $request
     * @param: $id - El id del autor para editar sus datos
     */
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

                /* Caso de no obtención de imagen, introducir campo vacío. */
                If (($form->get("foto")->getData()) == null || ($form->get("foto")->getData()) == "") {
                    $autor->setFoto("");
                } Else {
                    $file = $form["foto"]->getData();
                    $ext = $file->guessExtension();
                    $file_name = "uploads/" . time() . "." . $ext;
                    $file->move("uploads", $file_name);
                    //Asignamos la fotografía que hemos seleccionado
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

    /*Funcion para eliminar un autor
     * @param: $id - El id del autor para editar sus datos
     */
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

    /*Funcion para añadir un autor
     * @param: Request $request
     */
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

                /* Caso de no obtención de imagen, introducir campo vacío. */
                If (($form->get("foto")->getData()) == null || ($form->get("foto")->getData()) == "") {
                    $autor->setFoto("");
                } Else {
                    $file = $form["foto"]->getData();
                    $ext = $file->guessExtension();
                    $file_name = "uploads/" . time() . "." . $ext;
                    $file->move("uploads", $file_name);

                    $autor->setFoto($file_name);
                }

                //$autor->setFoto("");

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
