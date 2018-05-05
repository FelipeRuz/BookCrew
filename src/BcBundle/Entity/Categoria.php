<?php

namespace BcBundle\Entity;

/**
 * Categoria
 */
class Categoria
{
    /**
     * @var integer
     */
    private $idCategoria;

    /**
     * @var string
     */
    private $nombre;


    /**
     * Get idCategoria
     *
     * @return integer
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Categoria
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}

