<?php
require_once 'modelos/usuario.php';

class UsuarioController{
    public function index(){
        require_once 'vistas/usuario/login.php';

    }

    public function registro(){
        require_once 'vistas/usuario/registro.php';
    }

    public function save(){
        if(isset($_POST)){
            //verificando si los datos existen
            $nombre=isset($_POST['nombre']) ? $_POST['nombre']:false;
            $apellidos=isset($_POST['apellidos'])?$_POST['apellidos']:false;
            $email=isset($_POST['email'])?$_POST['email']:false;
            $dni=isset($_POST['dni'])?$_POST['dni']:false;    

            if($nombre && $apellidos && $email && $dni){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setDnipassword($dni);
                $save = $usuario->save();
               // var_dump($usuario);
                if($save){
                    $_SESSION['register'] = "completo"; 
                }else{
                    $_SESSION['register'] = "fallido"; 
                }
            }else{
                 $_SESSION['register'] = "fallido";  
            }   
        }else{
            $_SESSION['register'] = "fallido";            
        }         header("Location:".base_url.'usuariocontroller/registro');
    }
    
    public function login(){
        if(isset($_POST)){
            //consulta a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setDnipassword($_POST['dnipassword']);
            
            $identity = $usuario->login();

            //identificar al usuario
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                header("Location:".base_url.'cursocontroller/index');
                if ($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;

                }
            }else{
                $_SESSION['error_login']='Identificacion fallida!!';
            }
        }
       header("Location:".base_url);
    }

    public function logout(){
        if (isset($_SESSION['identity'])){

            unset($_SESSION['identity']);
            die();

        }

        if (isset($_SESSION['admin'])){

            unset($_SESSION['admin']);
            die();
        }
        session_destroy();
        header("Location:".base_url);
    }

}//fin class

?>