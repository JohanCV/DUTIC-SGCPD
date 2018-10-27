<?php
require_once 'modelos/usuario.php';

class UsuarioController{
    public function index(){
        require_once 'vistas/curso/listacursos.php';

    }

    public function registro(){
        Utils::isAdmin();
        require_once 'vistas/usuario/registro.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){
            //verificando si los datos existen
            $nombre=isset($_POST['nombre']) ? $_POST['nombre']:false;
            $apellidos=isset($_POST['apellidos'])?$_POST['apellidos']:false;
            $email=isset($_POST['email'])?$_POST['email']:false;
            $dni=isset($_POST['dni'])?$_POST['dni']:false;
            $escuela=isset($_POST['escuela'])?$_POST['escuela']:false;

            if($nombre && $apellidos && $email && $dni && $escuela){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setDnipassword($dni);
                $usuario->setEscuela($escuela);
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
        }
        header("Location:".base_url.'usuariocontroller/listadocentes');
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

                if ($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                    header("Location:".base_url.'cursocontroller/index');
                }
            }else{
                $_SESSION['error_login']='Identificacion fallida!!';
            }
        }
       header("Location:".base_url.'cursocontroller/index');
    }

    public function logout(){
        if (isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }

        if (isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        //session_destroy();
        header("Location:".base_url);
    }

    public function  buscar(){

    }

    public function listadocentes(){
        $docente = new Usuario();
        $docentes = $docente->listadocentes();


        require_once 'vistas/usuario/listadocentes.php';
    }
    public function editar(){

    }
    public function eliminar(){

    }

}//fin class

?>