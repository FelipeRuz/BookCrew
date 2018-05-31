<?php

namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        /* $em = $this->getDoctrine()->getEntityManager();
          $usuario_repo = $em->getRepository("BcBundle:Usuario");
          $usuario = $usuario_repo->find($id); */
        $em = $this->getDoctrine()->getManager();
        $query = 'DELETE FROM listalibro WHERE id_usuario = ' . $idusuario . ' AND id_libro = '.$idlibro;
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        
        return $this->redirectToRoute("bc_index_listadolibros");
    }

    public function addListadolibroAction(Request $request, $idlibro, $idusuario) {
        $listalibro = new Listalibro();
        $form = $this->createForm(LibroType::class, $listalibro);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getEntityManager();

        $listalibro->setIdUsuario($idusuario);
        $listalibro->setIdLibro($idlibro);

        $em->persist($libro);
        $flush = $em->flush();

        //$this->session->getFlashBag()->add("status",$status);

        return $this->render("BcBundle:Listalibro:indexListadolibro.html.twig", array(
                    "form" => $form->createView()
        ));
    }

}
