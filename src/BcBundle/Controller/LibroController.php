<?php

namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BcBundle\Entity\Libro;
use BcBundle\Form\LibroType;
use BcBundle\Form\FindLibroType;
use Doctrine\ORM\Tools\Pagination\Paginator;

class LibroController extends Controller {

    private $session;

    /* public function __construct() {
      $this->session=new Session();
      } */
    
    /*Funcion para obtener los datos de un perfil de un libro en concreto
     * @param: $id - El id del libro para editar sus datos
     */
    public function perfilLibroAction($id) {
        $em = $this->getDoctrine()->getManager();
        $em = $this->getDoctrine()->getEntityManager();
        $libro_repo = $em->getRepository("BcBundle:Libro");
        $libros = $libro_repo->find($id);

        return $this->render("BcBundle:Libro:perfilLibro.html.twig", array(
                    "libros" => $libros
        ));
    }

    /*Funcion para obtener todos los datos libros
     *
     */
    public function indexLibroValAction() {
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT l.*,a.id_autor,a.nombre AS autor_nom,a.apellido ,c.* '
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

    /*Funcion para obtener los datos de un perfil de un libro en concreto
     * @param: $id - El id del libro para editar sus datos
     */
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

    /*Funcion para cambiar el estado de validación de un libro
     * @param: Request $request
     * @param: $id - El id del libro para editar sus datos
     */
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

    /*Funcion para editar los datos de un libro
     * @param: Request $request
     * @param: $id - El id del libro para editar sus datos
     */
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
                    $isbn = $form->get("isbn")->getData();
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

    /*Funcion para eliminar datos de un libro
     * @param: $id - El id del libro para eliminar sus datos
     */
    public function delLibroAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $libro_repo = $em->getRepository("BcBundle:Libro");
        $libro = $libro_repo->find($id);

        $em->remove($libro);
        $em->flush();

        return $this->redirectToRoute("bc_index_libro");
    }

    /*Funcion para añadir un libro
     * @param: Request $request
     */
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

    /*Funcion para buscar un libro
     * @param: Request $request
     * @param: $id - El id del libro para editar sus datos
     * @param: $campBusq - Campo de búsqueda
     * @param: $paramBusq - Parametro de búsqueda
     */
    public function findLibroAction(Request $request/* , $campBusq, $paramBusq */) {
        $query = 'SELECT l.*,a.nombre AS autor_nom,a.apellido ,c.*  '
                . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
                . 'JOIN categoria c ON c.id_categoria=l.categoria '
                . 'WHERE validacion = 1 ';
        /*
          If ($form->isSubmitted()) {
          If ($form->isValid()) {
          $em = $this->getDoctrine()->getEntityManager();
          $libro_repo = $em->getRepository("BcBundle:Libro");

          //Según las condiciones, alteraremos la query para obtener un resultado u otro
          if ($campBusq != null || $campBusq != "") {
          //Si se ha introducido algun parámetro de búsqueda.
          if ($paramBusq != null || $paramBusq != "") {
          switch ($campBusq) {
          case "nada":
          //No introduciremos nada, buscará todos los libros ordenador por orden alfabético
          $query = $query . " ORDER BY l.titulo ";
          break;
          case "titulo":
          $query = $query . " AND l.titulo LIKE " . $paramBusq . "% ";
          break;
          case "autor":
          $query = $query . " AND autor_nom LIKE " . $paramBusq . "% ";
          break;
          case "categoria":
          $query = $query . " AND c.nombre LIKE " . $paramBusq . "% ";
          break;
          }
          }
          } else {
          $campBusq = "";
          $paramBusq = "";
          }
          }
          } */
        $em = $this->getDoctrine()->getEntityManager();

        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $libros = $statement->fetchAll();
        //var_dump($libros); die();
        $form = $this->createForm(FindLibroType::class);
        $form->handleRequest($request);

        return $this->render("BcBundle:Libro:findLibro.html.twig", array(
                    "form" => $form->createView(),
                    "libros" => $libros
        ));
    }

    public function resultLibroAction(Request $request, $campBusq, $paramBusq) {
        $query = 'SELECT l.*,a.nombre AS autor_nom,a.apellido ,c.*  '
                . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
                . 'JOIN categoria c ON c.id_categoria=l.categoria '
                . 'WHERE validacion = 1 ';

        If ($form->isSubmitted()) {
            If ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $libro_repo = $em->getRepository("BcBundle:Libro");

                //Según las condiciones, alteraremos la query para obtener un resultado u otro
                if ($campBusq != null || $campBusq != "") {
                    //Si se ha introducido algun parámetro de búsqueda.
                    if ($paramBusq != null || $paramBusq != "") {
                        switch ($campBusq) {
                            case "nada":
                                //No introduciremos nada, buscará todos los libros ordenador por orden alfabético
                                $query = $query . " ORDER BY l.titulo ";
                                break;
                            case "titulo":
                                $query = $query . " AND l.titulo LIKE " . $paramBusq . "% ";
                                break;
                            case "autor":
                                $query = $query . " AND autor_nom LIKE " . $paramBusq . "% ";
                                break;
                            case "categoria":
                                $query = $query . " AND c.nombre LIKE " . $paramBusq . "% ";
                                break;
                        }
                    }
                } else {
                    $campBusq = "";
                    $paramBusq = "";
                }
            }
        }
        $em = $this->getDoctrine()->getEntityManager();

        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $libros = $statement->fetchAll();

        return $this->render("BcBundle:Libro:resultLibro.html.twig", array(
                    "libros" => $libros
        ));
    }

    ///////////////////////////////////
    public function getPaginateLibro($pageSize = 5, $currenPage = 1) {
        $em = $this->getManager();
        $dql = "SELECT e FROM BcBundle\Entity\Libro e ORDER BY e.id DESC";

        $query = $em->createQuery($dql)
                ->setFirstResult($pageSize * ($currenPage - 1))
                ->setMaxResults($pageSize);

        $paginator = new Paginator($query, $fetchJoinCollection = true);
        return $paginator;
    }
    /////////////////////////////////
}
