<?php

namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /*$em= $this->getDoctrine()->getEntityManager();
        $data_repo= $em->getRepository("BcBundle:Listalibro");
        $listados = $data_repo->findAll();
        
        foreach($listados as $listado){
            echo $listado->getidUsuario()->getNombre()."<br>";
            echo $listado->getidLibro()->getTitulo()."<br>";
        }
        die();*/
        return $this->render('BcBundle:Default:index.html.twig');
    }
}
