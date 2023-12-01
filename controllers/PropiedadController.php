<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class  PropiedadController{

    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;
        
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores'=>$vendedores
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $errors = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        //Ejecutar el codigo despues de que el usuaior envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $propiedad = new Propiedad($_POST);
    
            //Subida de archivos
            //Generar nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg"; 
    
            //Setea la imagen
            //Realiza un resize a la imagen
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
    
            //Validamos
            $errors = $propiedad->validar();
     
            //Revisar que el arreglo de errores esté vacio
            if(empty($errors)){
    
                $propiedad->guardar(); 
    
                //Crear una carpeta
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
    
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
        }
    
        $router->render('propiedades/crear',[
            'propiedad'=>$propiedad,
            'errors'=>$errors,
            'vendedores'=>$vendedores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $errors = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
            //Asignar los atributos
            $args = $_POST['propiedad'];
    
            $propiedad->sincronizar($args);
    
            //Validacion
            $errors = $propiedad->validar();
    
            //Subida de archivos
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
    
            //Revisar que el arreglo de errores esté vacio
            if(empty($errors)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
                //Almacenar la imagen
                    if ($_FILES['propiedad']['tmp_name']['imagen']){
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }
    
                    $propiedad->guardar();
                }
            }
        }

        $router->render('propiedades/actualizar',[
            'propiedad'=>$propiedad,
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
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}