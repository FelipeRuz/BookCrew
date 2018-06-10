<?php

namespace BcBundle\Entity;

/**
 * Libro
 */
class Libro {

    /**
     * @var integer
     */
    private $idLibro;

    /**
     * @var string
     */
    private $isbn;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var integer
     */
    private $formato;

    /**
     * @var \DateTime
     */
    private $fechPublic;

    /**
     * @var string
     */
    private $portada;

    /**
     * @var integer
     */
    private $validacion;

    /**
     * @var \BcBundle\Entity\Autor
     */
    private $autor;

    /**
     * @var \BcBundle\Entity\Categoria
     */
    private $categoria;

    /**
     * @var string
     */
    private $campBusq;

    /**
     * @var string
     */
    private $paramBusq;

    /**
     * Get idLibro
     *
     * @return integer
     */
    public function getIdLibro() {
        return $this->idLibro;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Libro
     */
    public function setIsbn($isbn) {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn() {
        return $this->isbn;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Libro
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set formato
     *
     * @param integer $formato
     *
     * @return Libro
     */
    public function setFormato($formato) {
        $this->formato = $formato;

        return $this;
    }

    /**
     * Get formato
     *
     * @return integer
     */
    public function getFormato() {
        return $this->formato;
    }

    /**
     * Set fechPublic
     *
     * @param \DateTime $fechPublic
     *
     * @return Libro
     */
    public function setFechPublic($fechPublic) {
        $this->fechPublic = $fechPublic;

        return $this;
    }

    /**
     * Get fechPublic
     *
     * @return \DateTime
     */
    public function getFechPublic() {
        return $this->fechPublic;
    }

    /**
     * Set portada
     *
     * @param string $portada
     *
     * @return Libro
     */
    public function setPortada($portada) {
        $this->portada = $portada;

        return $this;
    }

    /**
     * Get portada
     *
     * @return string
     */
    public function getPortada() {
        return $this->portada;
    }

    /**
     * Set validacion
     *
     * @param integer $validacion
     *
     * @return Libro
     */
    public function setValidacion($validacion) {
        $this->validacion = $validacion;

        return $this;
    }

    /**
     * Get validacion
     *
     * @return integer
     */
    public function getValidacion() {
        return $this->validacion;
    }

    /**
     * Set autor
     *
     * @param \BcBundle\Entity\Autor $autor
     *
     * @return Libro
     */
    public function setAutor(\BcBundle\Entity\Autor $autor = null) {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return \BcBundle\Entity\Autor
     */
    public function getAutor() {
        return $this->autor;
    }

    /**
     * Set categoria
     *
     * @param \BcBundle\Entity\Categoria $categoria
     *
     * @return Libro
     */
    public function setCategoria(\BcBundle\Entity\Categoria $categoria = null) {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \BcBundle\Entity\Categoria
     */
    public function getCategoria() {
        return $this->categoria;
    }

    /**
     * Convert to string
     *
     * @return \BcBundle\Entity\Libro-titulo
     */
    public function __toString() {
        return $this->titulo;
    }

    /**
     * Get campBusq
     *
     * @return libro
     */
    public function getCampBusq() {
        return $this->campBusq;
    }

    /**
     * Set campBusq
     * @param campBusq
     * 
     * @return libro
     */
    public function setCampBusq($campBusq) {
        $this->campBusq = $campBusq;
        return $this;
    }

    /**
     * Get paramBusq
     *
     * @return libro
     */
    public function getParamBusq() {
        return $this->campBusq;
    }

    /**
     * Set paramBusq
     * @param paramBusq
     * 
     * @return libro
     */
    public function setParamBusq($paramBusq) {
        $this->paramBusq = $paramBusq;
        return $this;
    }

}
