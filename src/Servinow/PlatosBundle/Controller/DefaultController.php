<?php

namespace Servinow\PlatosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($restaurantID)
    {
        $platos = $this->getDoctrine()->getRepository("ServinowEntitiesBundle:Plato")
                            ->findPlatosByRestaurant($restaurantID);
        
        return $this->render('ServinowPlatosBundle:Default:index.html.twig',
                    array(
                        'restaurantID' => $restaurantID, 
                        'platos' => $platos
                    )
                );
    }
    
    public function decidirAction($restaurantID){
        
        $request = Request::createFromGlobals();
        
        if($request->request->has('platoID')){
            $platoID = $request->request->get('platoID');
        }
        
        if($request->request->has('action')){
            $tipo = $request->request->get('action');
        }
        
        if($request->request->has('nombre')){
            $productoNombre = $request->request->get('nombre');
        }
        
        if($request->request->has('descripcion')){
            $productoDescripcion = $request->request->get('descripcion');
        }
        
        if($request->request->has('precio')){
            $productoPrecio = str_replace(',', '.', $request->request->get('precio'));
        }
        
        if($request->request->has('disponible')){
            $productoDisponible = true;   
        } else {
            $productoDisponible=false;
        }
        
        if($request->request->has('categorias')){
            $categoriasId = $request->request->get('categorias');
        }
        
        
        if($tipo == "nuevo")
        {
            $url = $this->generateUrl('servinow_platos_homepage_nuevo', array(
                'restaurantID' => $restaurantID
            ));            
        }
        else if ($tipo == "editar")
        {
            $url = $this->generateUrl('servinow_platos_homepage_editar', array(
                'restaurantID' => $restaurantID,
                'productoID' => $platoID
            ));            
        }
        else if($tipo == "eliminar")
        {            
            $this->getDoctrine()->getRepository("ServinowEntitiesBundle:Plato")
                ->deletePlatoByID($platoID);
            $url = $this->generateUrl('servinow_platos_homepage', array('restaurantID' => $restaurantID));
            
        }
        else if($tipo == "aceptarEditar")
        {
            $url = $this->generateUrl('servinow_platos_homepage', array('restaurantID' => $restaurantID));
            $this->getDoctrine()->getRepository("ServinowEntitiesBundle:Producto")
                    ->updateProductoById($restaurantID, $platoID, $productoNombre,
                            $productoDescripcion, $productoPrecio, $productoDisponible);
            
            if (!isset($categoriasId)) {
                $categoriasId = array();
            }
            $this->getDoctrine()->getRepository("ServinowEntitiesBundle:Producto")
                    ->setCategoriasOfProducto($restaurantID, $platoID, $categoriasId);
            
        }
        else if($tipo == "descartarEditar")
        {
            $url = $this->generateUrl('servinow_platos_homepage', array('restaurantID' => $restaurantID));
        }
        else if($tipo == "aceptarNuevo")
        {
            $url = $this->generateUrl('servinow_platos_homepage', array('restaurantID' => $restaurantID));
            $platoID = $this->getDoctrine()->getRepository("ServinowEntitiesBundle:Plato")
                    ->insertPlato($restaurantID, $productoNombre, $productoDescripcion,
                            $productoPrecio, $productoDisponible);
            
            if (!isset($categoriasId)) {
                $categoriasId = array();
            }
            $this->getDoctrine()->getRepository("ServinowEntitiesBundle:Producto")
                    ->setCategoriasOfProducto($restaurantID, $platoID, $categoriasId);
        }
        else if($tipo == "descartarNuevo")
        {
            $url = $this->generateUrl('servinow_platos_homepage', array('restaurantID' => $restaurantID));
        }
        
        return new RedirectResponse($url);
    }
    
    public function editarAction($restaurantID, $productoID){
        
        $producto = $this->getDoctrine()->getRepository("ServinowEntitiesBundle:Producto")
                ->findProductoId($restaurantID, $productoID);
        
        $categorias = $this->getDoctrine()->getRepository("ServinowEntitiesBundle:Categoria")
                ->findCategoriasByRestaurante($restaurantID);
        
        return $this->render('ServinowPlatosBundle:Default:editar.html.twig',
                array('restaurantID' => $restaurantID,
                    'producto' => $producto,
                    'categorias' => $categorias));
    }
    
    public function nuevoAction($restaurantID){
        
        $categorias = $this->getDoctrine()->getRepository("ServinowEntitiesBundle:Categoria")
                ->findCategoriasByRestaurante($restaurantID);
        
        return $this->render('ServinowPlatosBundle:Default:nuevo.html.twig',
                array('restaurantID' => $restaurantID,
                    'categorias' => $categorias));
    }
}
