<?php

namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StockController extends Controller {

    public function indexStockAction($id) {
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT a.*,b.*,c.* FROM libreria a JOIN stock b on a.id_libreria=b.id_libreria JOIN libro c on  c.id_libro=b.id_libro WHERE c.id_libro = '.$id.'';
        $statement = $em->getConnection()->prepare($query);
        
        $statement->execute();
        $stocks = $statement->fetchAll();
        
        return $this->render("BcBundle:Stock:indexStock.html.twig", array(
            "stocks" => $stocks
        ));
    }
}
