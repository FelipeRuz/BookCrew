<?php

namespace BcBundle\Entity;

/**
 * Stock
 */
class Stock
{
    /**
     * @var integer
     */
    private $idVenta;

    /**
     * @var integer
     */
    private $disponible;

    /**
     * @var \BcBundle\Entity\Libro
     */
    private $idLibro;

    /**
     * @var \BcBundle\Entity\Libreria
     */
    private $idLibreria;


    /**
     * Get idVenta
     *
     * @return integer
     */
    public function getIdVenta()
    {
        return $this->idVenta;
    }

    /**
     * Set disponible
     *
     * @param integer $disponible
     *
     * @return Stock
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return integer
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set idLibro
     *
     * @param \BcBundle\Entity\Libro $idLibro
     *
     * @return Stock
     */
    public function setIdLibro(\BcBundle\Entity\Libro $idLibro = null)
    {
        $this->idLibro = $idLibro;

        return $this;
    }

    /**
     * Get idLibro
     *
     * @return \BcBundle\Entity\Libro
     */
    public function getIdLibro()
    {
        return $this->idLibro;
    }

    /**
     * Set idLibreria
     *
     * @param \BcBundle\Entity\Libreria $idLibreria
     *
     * @return Stock
     */
    public function setIdLibreria(\BcBundle\Entity\Libreria $idLibreria = null)
    {
        $this->idLibreria = $idLibreria;

        return $this;
    }

    /**
     * Get idLibreria
     *
     * @return \BcBundle\Entity\Libreria
     */
    public function getIdLibreria()
    {
        return $this->idLibreria;
    }
}

