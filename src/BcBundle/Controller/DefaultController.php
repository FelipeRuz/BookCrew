<?php

namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /*$em = $this->getDoctrine()->getManager();
        $query = 'SELECT a.*, c.id_usuario FROM libro a JOIN listalibro b on a.id_libro=b.id_libro JOIN usuario c on b.id_usuario = c.id_usuario WHERE c.id_usuario = '.(1).'';
        $statement = $em->getConnection()->prepare($query);
        
        $statement->execute();
        $listados = $statement->fetchAll();*/
        
        return $this->render("BcBundle:Default:index.html.twig", array(
        ));

    }
    
    public function indexFindAction()
    {
        /*$em = $this->getDoctrine()->getManager();
        $query = 'SELECT a.*, c.id_usuario FROM libro a JOIN listalibro b on a.id_libro=b.id_libro JOIN usuario c on b.id_usuario = c.id_usuario WHERE c.id_usuario = '.(1).'';
        $statement = $em->getConnection()->prepare($query);
        
        $statement->execute();
        $listados = $statement->fetchAll();*/
        
        return $this->render("BcBundle:Default:indexFind.html.twig", array(
        ));

    }
}
