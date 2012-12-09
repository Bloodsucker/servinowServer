<?php

namespace Servinow\EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servinow\EntitiesBundle\Entity\Producto
 *
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Servinow\EntitiesBundle\Entity\ProductoRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"producto" = "Producto", "plato" = "Plato", "menu" = "Menu"})
 */
class Producto
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string $imagen
     *
     * @ORM\Column(name="imagen", type="string", length=2083)
     */
    private $imagen;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var float $precio
     *
     * @ORM\Column(name="precio", type="float")
     */
    private $precio;

    /**
     * @var boolean $cantDisponible
     *
     * @ORM\Column(name="disponible", type="boolean")
     */
    private $disponible;

    /**
     * @ORM\OneToMany(targetEntity="LineaPedido", mappedBy="producto")
     */
    private $lineasPedido;
    
    /**
     * @ORM\ManyToOne(targetEntity="Restaurante", inversedBy="productos")
     * @ORM\JoinColumn(name="restaurante_id", referencedColumnName="id")
     */
    private $restaurante;
    
    /**
     * @ORM\ManyToMany(targetEntity="Categoria", mappedBy="productos")
     */
    private $categorias;

    
    public function __construct() {
        $this->categorias = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Producto
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
     * Set imagen
     *
     * @param string $imagen
     * @return Producto
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Producto
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set cantDisponible
     *
     * @param integer $cantDisponible
     * @return Producto
     */
    public function setCantDisponible(\int $cantDisponible)
    {
        $this->cantDisponible = $cantDisponible;
    
        return $this;
    }

    /**
     * Get cantDisponible
     *
     * @return integer 
     */
    public function getCantDisponible()
    {
        return $this->cantDisponible;
    }

    /**
     * Add lineasPedido
     *
     * @param Servinow\EntitiesBundle\Entity\LineaPedido $lineasPedido
     * @return Producto
     */
    public function addLineasPedido(\Servinow\EntitiesBundle\Entity\LineaPedido $lineasPedido)
    {
        $this->lineasPedido[] = $lineasPedido;
    
        return $this;
    }

    /**
     * Remove lineasPedido
     *
     * @param Servinow\EntitiesBundle\Entity\LineaPedido $lineasPedido
     */
    public function removeLineasPedido(\Servinow\EntitiesBundle\Entity\LineaPedido $lineasPedido)
    {
        $this->lineasPedido->removeElement($lineasPedido);
    }

    /**
     * Get lineasPedido
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLineasPedido()
    {
        return $this->lineasPedido;
    }

    /**
     * Set restaurante
     *
     * @param Servinow\EntitiesBundle\Entity\Restaurante $restaurante
     * @return Producto
     */
    public function setRestaurante(\Servinow\EntitiesBundle\Entity\Restaurante $restaurante = null)
    {
        $this->restaurante = $restaurante;
    
        return $this;
    }

    /**
     * Get restaurante
     *
     * @return Servinow\EntitiesBundle\Entity\Restaurante 
     */
    public function getRestaurante()
    {
        return $this->restaurante;
    }

    /**
     * Add categorias
     *
     * @param Servinow\EntitiesBundle\Entity\Categoria $categorias
     * @return Producto
     */
    public function addCategoria(\Servinow\EntitiesBundle\Entity\Categoria $categorias)
    {
        $this->categorias[] = $categorias;
    
        return $this;
    }

    /**
     * Remove categorias
     *
     * @param Servinow\EntitiesBundle\Entity\Categoria $categorias
     */
    public function removeCategoria(\Servinow\EntitiesBundle\Entity\Categoria $categorias)
    {
        $this->categorias->removeElement($categorias);
    }

    /**
     * Get categorias
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     * @return Producto
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    
        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean 
     */
    public function getDisponible()
    {
        return $this->disponible;
    }
}