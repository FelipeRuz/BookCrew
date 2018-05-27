<?php

namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListadolibroController extends Controller {

    /*public function indexListadolibroAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $data_repo = $em->getRepository("BcBundle:Listalibro");
        $listados = $data_repo->findAll();

        /* foreach($listados as $listado){
          echo $listado->getidUsuario()->getNombre()."<br>";
          echo $listado->getidLibro()->getTitulo()."<br>";
          } */
        /*return $this->render("BcBundle:Listadolibro:indexListadolibro.html.twig", array(
            "listados" => $listados
        ));*/
    //}
    public function indexListadolibroAction($id) {
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT a.*, c.id_usuario FROM libro a JOIN listalibro b on a.id_libro=b.id_libro JOIN usuario c on b.id_usuario = c.id_usuario WHERE c.id_usuario = '.$id.'';
        $statement = $em->getConnection()->prepare($query);
        
        $statement->execute();
        $listados = $statement->fetchAll();
        
        return $this->render("BcBundle:Listadolibro:indexListadolibro.html.twig", array(
            "listados" => $listados
        ));
    }

    public function addListadolibroAction(Request $request) {
        $listalibro = new Listalibro();
        $form = $this->createForm(LibroType::class, $listalibro);
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
                } Else {
                    $isbn = ($form->get("isbn")->getData());
                    $file = $form["portada"]->getData();
                    $ext = $file->guessExtension();
                    $file_name = $isbn." - ".time().".".$ext;
                    $file->move("uploads", $file_name);
                    $libro->setPortada($file_name);
                }

                //$libro->setPortada("");
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
                /* }
                  Else{
                  $status = "El libro ya ha sido registrado";
                  } */
            } Else {
                $status = "No se ha enviado correctamente la petición de libro. El formato no es válido";
            }
            //$this->session->getFlashBag()->add("status",$status);
        }

        return $this->render("BcBundle:Libro:addLibro.html.twig", array(
                    "form" => $form->createView()
        ));
    }

}
