<?php

namespace Mesa\ClientesBundle\Entity;

/**
 * Compania
 */
class Compania
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Compania
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contacto;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contacto = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contacto
     *
     * @param \Mesa\ClientesBundle\Entity\Contactos $contacto
     *
     * @return Compania
     */
    public function addContacto(\Mesa\ClientesBundle\Entity\Contactos $contacto)
    {
        $this->contacto[] = $contacto;

        return $this;
    }

    /**
     * Remove contacto
     *
     * @param \Mesa\ClientesBundle\Entity\Contactos $contacto
     */
    public function removeContacto(\Mesa\ClientesBundle\Entity\Contactos $contacto)
    {
        $this->contacto->removeElement($contacto);
    }

    /**
     * Get contacto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
