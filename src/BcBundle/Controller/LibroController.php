<?php

namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BcBundle\Entity\Libro;
use BcBundle\Form\LibroType;
use BcBundle\Form\FindLibroType;

class LibroController extends Controller {

    private $session;

    /* public function __construct() {
      $this->session=new Session();
      } */

    public function perfilLibroAction($id) {
        $em = $this->getDoctrine()->getManager();
        $em = $this->getDoctrine()->getEntityManager();
        $libro_repo = $em->getRepository("BcBundle:Libro");
        $libros = $libro_repo->find($id);

        /* $em = $this->getDoctrine()->getManager();
          $query = 'SELECT l.*,a.nombre AS autor_nom,a.apellido ,c.* '
          . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
          . 'JOIN categoria c ON c.id_categoria=l.categoria '
          . 'WHERE validacion = 1 and l.id_libro = "'.$id.'"';
          $statement = $em->getConnection()->prepare($query);
          $statement->execute();
          $libro = $statement->fetchAll(); */

        return $this->render("BcBundle:Libro:perfilLibro.html.twig", array(
                    "libros" => $libros
        ));
    }

    public function indexLibroValAction() {
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT l.*,a.nombre AS autor_nom,a.apellido ,c.* '
                . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
                . 'JOIN categoria c ON c.id_categoria=l.categoria '
                . 'WHERE validacion = 1 ';
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $libros = $statement->fetchAll();

        return $this->render("BcBundle:Libro:indexLibro.html.twig", array(
                    "libros" => $libros
        ));
    }

    public function indexLibroNoValAction() {
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT l.*,a.nombre AS autor_nom,a.apellido ,c.* '
                . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
                . 'JOIN categoria c ON c.id_categoria=l.categoria '
                . 'WHERE validacion = 0 ORDER BY l.fech_public';
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $libros = $statement->fetchAll();

        return $this->render("BcBundle:Libro:indexNoValLibro.html.twig", array(
                    "libros" => $libros
        ));
    }

    public function ValidarAction(Request $request, $id) {
        //Buscamos el libro por su ID,y editamos el campo "validacion"
        $em = $this->getDoctrine()->getEntityManager();
        $libro_repo = $em->getRepository("BcBundle:Libro");
        $libro = $libro_repo->find($id);
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        $libro->setIsbn($form->get("isbn")->getData());
        $libro->setTitulo($form->get("titulo")->getData());
        $libro->setFormato($form->get("formato")->getData());
        $libro->setFechPublic($form->get("fechPublic")->getData());
        $libro->setPortada($form->get("portada")->getData());
        //////////////////////////////////////////////////
        $libro->setValidacion(1);
        //////////////////////////////////////////////////
        $libro->setAutor($form->get("autor")->getData());
        $libro->setCategoria($form->get("categoria")->getData());


        $em->persist($libro);
        $flush = $em->flush();

        $em->persist($libro);
        $flush = $em->flush();

        //Retornamos la vista de todos los libros "no validados"
        $query2 = 'SELECT l.*,a.nombre AS autor_nom,a.apellido ,c.*  FROM libro l JOIN autor a ON a.id_autor=l.autor JOIN categoria c ON c.id_categoria=l.categoria WHERE validacion = 0';
        $statement = $em->getConnection()->prepare($query2);
        $statement->execute();
        $libros = $statement->fetchAll();

        return $this->render("BcBundle:Libro:indexNoValLibro.html.twig", array(
                    "libros" => $libros
        ));
    }

    public function editLibroAction(Request $request, $id) {
        $em = $this->getDoctrine()->getEntityManager();
        $libro_repo = $em->getRepository("BcBundle:Libro");
        $libro = $libro_repo->find($id);

        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        If ($form->isSubmitted()) {
            If ($form->isValid()) {
                $libro->setIsbn($form->get("isbn")->getData());
                $libro->setTitulo($form->get("titulo")->getData());
                $libro->setFormato($form->get("formato")->getData());
                $libro->setFechPublic($form->get("fechPublic")->getData());

                /* Caso de no obtención de imagen, introducir campo vacío. */
                If (($form->get("portada")->getData()) == null || ($form->get("portada")->getData()) == "") {
                    $libro->setPortada("");
                } Else {
                    $isbn = ($form->get("isbn")->getData());
                    $file = $form["portada"]->getData();
                    $ext = $file->guessExtension();
                    $file_name = "uploads/" . $isbn . "-" . time() . "." . $ext;
                    $file->move("uploads", $file_name);
                    $libro->setPortada($file_name);
                }

                $libro->setValidacion(0);
                $libro->setAutor($form->get("autor")->getData());
                $libro->setCategoria($form->get("categoria")->getData());

                $em->persist($libro);
                $flush = $em->flush();

                If ($flush == NULL) {
                    $status = "Se ha enviado al servidor su petición de libro para ser validada";
                } Else {
                    $status = "No se ha enviado al servidor su petición de libro para ser validada. Error: 'flush inválido'";
                }
            } Else {
                $status = "No se ha enviado correctamente la petición de libro. El formato no es válido";
            }
            //$this->session->getFlashBag()->add("status",$status);
        }

        return $this->render("BcBundle:Libro:editLibro.html.twig", array(
                    "form" => $form->createView()
        ));
    }

    public function delLibroAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $libro_repo = $em->getRepository("BcBundle:Libro");
        $libro = $libro_repo->find($id);

        $em->remove($libro);
        $em->flush();

        return $this->redirectToRoute("bc_index_libro");
    }

    public function addLibroAction(Request $request) {
        $libro = new Libro();
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        If ($form->isSubmitted()) {
            If ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $libro = new Libro();

                $libro->setIsbn($form->get("isbn")->getData());
                $libro->setTitulo($form->get("titulo")->getData());
                $libro->setFormato($form->get("formato")->getData());
                $libro->setFechPublic($form->get("fechPublic")->getData());

                /* Caso de no obtención de imagen, introducir campo vacío. */
                If (($form->get("portada")->getData()) == null || ($form->get("portada")->getData()) == "") {
                    $libro->setPortada("");

                    //Sino, guardaremos la imagen con titulo de isbn que pertenece y la hora de guardado.
                } Else {
                    $isbn = ($form->get("isbn")->getData());
                    $file = $form["portada"]->getData();
                    $ext = $file->guessExtension();
                    $file_name = "uploads/" . $isbn . "-" . time() . "." . $ext;
                    $file->move("uploads", $file_name);
                    $libro->setPortada($file_name);
                }

                $libro->setValidacion(0);
                $libro->setAutor($form->get("autor")->getData());
                $libro->setCategoria($form->get("categoria")->getData());

                $em->persist($libro);
                $flush = $em->flush();

                If ($flush == NULL) {
                    $status = "Se ha enviado al servidor su petición de libro para ser validada";
                } Else {
                    $status = "No se ha enviado al servidor su petición de libro para ser validada. Error: 'flush inválido'";
                }
            } Else {
                $status = "No se ha enviado correctamente la petición de libro. El formato no es válido";
            }
            //$this->session->getFlashBag()->add("status",$status);
        }

        return $this->render("BcBundle:Libro:addLibro.html.twig", array(
                    "form" => $form->createView()
        ));
    }

    public function findLibroAction(Request $request/* , $campBusq, $paramBusq */) {
        $em = $this->getDoctrine()->getEntityManager();

        $libro = new Libro();
        $form = $this->createForm(FindLibroType::class, $libro);
        $form->handleRequest($request);

        If ($form->isSubmitted()) {
            If ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $query = 'SELECT l.*,a.nombre AS autor_nom,a.apellido ,c.*  '
                        . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
                        . 'JOIN categoria c ON c.id_categoria=l.categoria '
                        . 'WHERE validacion = 1 ';
                $campo_busqueda = $request->get("campo");
                $var_busqueda = $request->get("parametro");
                //Segun las variables que se le pasen, deberá ejecutar una query u otra conforme la búsqueda.
                //Caso basico; Si una de las variables de busqueda esta vacia, obtendra la vista normal
                if ($campo_busqueda == "titulo" && $var_busqueda != "nada") {
                    $query = $query . 'AND l.titulo '
                            . 'LIKE "' . $var_busqueda . '" '
                            . 'ORDER BY l.fech_public';
                } //Si es por autor
                elseif ($campo_busqueda == "autor" && $var_busqueda != "nada") {
                    $query = $query . 'AND a.nombre LIKE " ' . $var_busqueda . ' " '
                            . 'ORDER BY l.fech_public';
                }  //Si es por categoria
                elseif ($campo_busqueda == "categoria" && $var_busqueda != "nada") {
                    $query = $query . 'AND c.nombre LIKE "' . $var_busqueda . '" '
                            . 'ORDER BY l.fech_public';
                } //Si es por localizacion de libreria
                elseif ($campo_busqueda == "categoria" && $var_busqueda != "nada") {
                    $query = 'SELECT l.*,a.nombre AS autor_nom,a.apellido ,c.* '
                            . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
                            . 'JOIN categoria c ON c.id_categoria=l.categoria '
                            . 'JOIN stock s ON s.id_libro = l.id_libro '
                            . 'JOIN libreria x ON x.id_libreria = s.id_libreria '
                            . 'WHERE validacion = 1 '
                            . 'AND x.provincia LIKE "' . $var_busqueda . '" '
                            . 'ORDER BY l.fech_public';
                }

                $statement = $em->getConnection()->prepare($query);
                $statement->execute();
                $libros = $statement->fetchAll();
                //Comprobar la consulta null || ""
                return $this->render("BcBundle:Libro:findLibro.html.twig", array(
                    "form" => $form->createView(),
                    "libros" => $libros
                ));
            }
        }


        return $this->render("BcBundle:Libro:findLibro.html.twig", array(
                    "form" => $form->createView()
        ));

        /* return $this->render("BcBundle:Libro:FindLibro.html.twig", array(

          )); */
    }

    /////////////////////////////////


    public function addListadoLibroAction(Request $request, $idlibro, $idusuario) {
        $em = $this->getDoctrine()->getEntityManager();
        $listalibro = new Listalibro();
        $form = $this->createForm(ListalibroType::class, $listalibro);
        $form->handleRequest($request);

        $listalibro->setIdUsuario($idusuario);
        $listalibro->setIdLibro($idlibro);

        $em->persist($listalibro);
        $flush = $em->flush();

        If ($flush == NULL) {
            $status = "Se ha enviado al servidor su petición de libro para ser validada";
        } Else {
            $status = "No se ha enviado al servidor su petición de libro para ser validada. Error: 'flush inválido'";
        }

        indexLibroValAction();
        //return $this->redirectToRoute("bc_index_libro");
        //Retornamos la vista de todos los libros "no validados"
        /* $query = 'SELECT l.*,a.nombre AS autor_nom,a.apellido ,c.* '
          . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
          . 'JOIN categoria c ON c.id_categoria=l.categoria '
          . 'WHERE validacion = 1 ';
          $statement = $em->getConnection()->prepare($query);
          $statement->execute();
          $libro = $statement->fetchAll();

          return $this->render("BcBundle:Libro:indexLibro.html.twig", array(
          "libro" => $libro
          )); */
    }

}
