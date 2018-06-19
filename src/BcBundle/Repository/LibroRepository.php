<?php

namespace BcBundle\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class LibroRepository extends \Doctrine\ORM\EntityRepository{

    public function getPaginateLibro($pagesize = 5, $currentPage = 1) {
        $em = $this->getEntityManager();
        
        $dql = 'SELECT l FROM BcBundle\Entity\Libro l ORDER BY e.id DESC';
        
        $query = 'SELECT l.*,a.id_autor,a.nombre AS autor_nom,a.apellido ,c.* '
                . 'FROM libro l JOIN autor a ON a.id_autor=l.autor '
                . 'JOIN categoria c ON c.id_categoria=l.categoria '
                . 'WHERE validacion = 1 ';
        
        $dql = $em ->createQuery($dql)
            ->setFirstResult($pagesize*($currentPage-1))
            ->setMaxResults($pagesize);
        
        $paginator = new Paginator($query,$fetchJoinCollection = true );
        return $paginator;
    }

}
