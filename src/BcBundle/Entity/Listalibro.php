<?php

namespace BcBundle\Entity;

/**
 * Listalibro
 */
class Listalibro {

    /**
     * @var integer
     */
    private $idLista;

    /**
     * @var \BcBundle\Entity\Usuario
     */
    private $idUsuario;

    /**
     * @var \BcBundle\Entity\Libro
     */
    private $idLibro;

    /**
     * Get idLista
     *
     * @return integer
     */
    public function getIdLista() {
        return $this->idLista;
    }

    /**
     * Set idUsuario
     *
     * @param \BcBundle\Entity\Usuario $idUsuario
     *
     * @return Listalibro
     */
    public function setIdUsuario(\BcBundle\Entity\Usuario $idUsuario = null) {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \BcBundle\Entity\Usuario
     */
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    /**
     * Set idLibro
     *
     * @param \BcBundle\Entity\Libro $idLibro
     *
     * @return Listalibro
     */
    public function setIdLibro(\BcBundle\Entity\Libro $idLibro = null) {
        $this->idLibro = $idLibro;

        return $this;
    }

    /**
     * Get idLibro
     *
     * @return \BcBundle\Entity\Libro
     */
    public function getIdLibro() {
        return $this->idLibro;
    }

    public function __toString() {
        return $this->idUsuario;
    }

}
