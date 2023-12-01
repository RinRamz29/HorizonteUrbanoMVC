<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{

    public static function crear(Router $router){
        $errors = Vendedor::getErrores();
        $vendedores = Vendedor::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $vendedores = new Vendedor($_POST);
    
            //Validamos
            $errors = $vendedores->validar();
     
            //Revisar que el arreglo de errores esté vacio
            if(empty($errors)){
    
                $vendedores->guardar(); 
            }
        }

        $router->render('vendedores/crear',[
            'errors'=>$errors,
            'vendedores'=>$vendedores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');

        $errors = Vendedor::getErrores();
        $vendedores = Vendedor::find($id);

        //Ejecutar el codigo despues de que el usuaior envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
        //Asignar los atributos
        $args = [];
        $args = $_POST['vendedor'];

        $vendedores->sincronizar($args);

        //Validacion
        $errors = $vendedores->validar();

        //Revisar que el arreglo de errores esté vacio
        if(empty($errors)){
            $vendedores->guardar();
        }
    }

        $router->render('vendedores/actualizar',[
            'errors'=>$errors,
            'vendedores'=>$vendedores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT); 
        
            if ($id) {
                $tipo = $_POST['tipo'];
        
                if (validarTipoContenido($tipo)) {
                    $vendedores = Vendedor::find($id);
                    $vendedores->eliminar();
                }
            }
        }
    }
}