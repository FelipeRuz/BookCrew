<?php

namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BcBundle\Entity\Listalibro;
use BcBundle\Form\ListalibroType;

class ListadolibroController extends Controller {

    public function indexListadolibroAction($id) {
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT a.*, c.id_usuario FROM libro a JOIN listalibro b on a.id_libro=b.id_libro JOIN usuario c on b.id_usuario = c.id_usuario WHERE c.id_usuario = ' . $id . '';
        $statement = $em->getConnection()->prepare($query);

        $statement->execute();
        $listados = $statement->fetchAll();

        return $this->render("BcBundle:Listadolibro:indexListadolibro.html.twig", array(
                    "listados" => $listados
        ));
    }

    public function delListadoAction($idlibro, $idusuario) {
        $em = $this->getDoctrine()->getManager();
        $query = 'DELETE FROM listalibro WHERE id_usuario = ' . $idusuario . ' AND id_libro = ' . $idlibro;
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();

        return $this->redirectToRoute("bc_index_listadolibros");
    }


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

        return $this->redirectToRoute("bc_index_libro");
    }

}
