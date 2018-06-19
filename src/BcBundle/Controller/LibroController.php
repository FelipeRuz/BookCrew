<?php

namespace BcBundle\Controller;
use BcBundle\Repository\LibroRepository;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BcBundle\Entity\Libro;
use BcBundle\Form\LibroType;
use BcBundle\Form\FindLibroType;
use Doctrine\ORM\Tools\Pagination\Paginator;


class LibroController extends Controller {

    private $session;

    /*public function __construct() {
      $this->session=new Session();
    }*/ 
    
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
    public function indexLibroValAction($page,$size) {
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT l.*,a.id_autor,a.nombre AS autor_nom,a.apellido ,c.* '
                . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
                . 'JOIN categoria c ON c.id_categoria=l.categoria '
                . 'WHERE validacion = 1';
        /*$query = 'SELECT l.*,a.id_autor,a.nombre AS autor_nom,a.apellido ,c.* '
                . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
                . 'JOIN categoria c ON c.id_categoria=l.categoria '
                . 'WHERE validacion = 1 AND fila < 2 '
                . 'ORDER BY l.id_libro ASC '
                . 'LIMIT 5';*/
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
    
    /**
     * Generacion de PDF con la información de los Libros
     * @param Request $request
     */
    public function pdfLibroAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $libros_repo = $em->getRepository("BcBundle:Libro");
        $libros = $libros_repo->findAll();

        $htmlpdf = $this->renderView("BcBundle:Libro:Libropdf.html.twig", array("libros" => $libros));

        return $this->returnPDFResponseFromHTML($htmlpdf);
    }

    public function returnPDFResponseFromHTML($html) {
        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('BOOKCREW´S WEB');
        $pdf->SetTitle('Información de LIBROS');
        $pdf->SetSubject('Our Code World Subject');
        $pdf->SetFont('helvetica', '', 11, '', true);
        $pdf->AddPage();

        $file_name = "librosINFO_PDF";

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($file_name . ".pdf", 'I');
    }
}
