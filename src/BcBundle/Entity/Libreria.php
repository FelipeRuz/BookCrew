<?php

namespace BcBundle\Entity;

/**
 * Libreria
 */
class Libreria
{
    /**
     * @var integer
     */
    private $idLibreria;

    /**
     * @var string
     */
    private $nif;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $tlf;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $poblacion;

    /**
     * @var string
     */
    private $provincia;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $ubicacion;

    /**
     * @var string
     */
    private $web;


    /**
     * Get idLibreria
     *
     * @return integer
     */
    public function getIdLibreria()
    {
        return $this->idLibreria;
    }

    /**
     * Set nif
     *
     * @param string $nif
     *
     * @return Libreria
     */
    public function setNif($nif)
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Libreria
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

    /**
     * Set tlf
     *
     * @param string $tlf
     *
     * @return Libreria
     */
    public function setTlf($tlf)
    {
        $this->tlf = $tlf;

        return $this;
    }

    /**
     * Get tlf
     *
     * @return string
     */
    public function getTlf()
    {
        return $this->tlf;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Libreria
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     *
     * @return Libreria
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * Get poblacion
     *
     * @return string
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     *
     * @return Libreria
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Libreria
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return Libreria
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set web
     *
     * @param string $web
     *
     * @return Libreria
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }
}

