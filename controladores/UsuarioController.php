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

                //Editar usuario
                if (isset($_GET['id'])){
                    $id = $_GET['id'];
                    $usuario->setId($id);
                    $save = $usuario->editar();

                }else{
                    $save = $usuario->save();
                }

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
                var_dump($identity);
                if ($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                    header("Location:".base_url.'cursocontroller/index');
                }
            }else{
                $_SESSION['error_login']='fallido';
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
    public function listadocentes(){
        Utils::isAdmin();
        $docente = new Usuario();
        $docentes = $docente->getAll();

        $numero_elementos =$docentes->num_rows;
        $numero_elementos_pagina = 50;
           var_dump($numero_elementos);
        //numero total de elmentos a paginar
        $pagination = new Zebra_Pagination();
        $pagination->navigation_position(isset($_GET['navigation_position'])
                            && in_array($_GET['navigation_position'],
                            array('left', 'right')) ?
                            $_GET['navigation_position'] : 'outside');


        $pagination->records($numero_elementos);
        //numero de elementos por pagina
        $pagination->records_per_page($numero_elementos_pagina);

        $page = $pagination->get_page();
        var_dump($page);
        $empieza_aqui = (($page-1))*$numero_elementos_pagina;
        $PRO = $docente->listadocentes($empieza_aqui,$numero_elementos_pagina);

        include 'vistas/usuario/listadocentes.php';
        $pagination->labels('Atras', 'Siguiente');
        $pagination->render();
    }
    public function editar(){
        Utils::isAdmin();

        if (isset($_GET['id'])){
            $edit = true;
            $id = $_GET['id'];
            $user = new Usuario();
            $user->setId($id);
            $usuario = $user->getOne();
            require_once 'vistas/usuario/registro.php';
        }else{
            header("Location:".base_url.'usuariocontroller/listadocentes');
        }

    }
    public function eliminar(){
        Utils::isAdmin();

        if (isset($_GET['id'])){
            $user = new Usuario();
            $user->setId($_GET['id']);
            $delete = $user->eliminar();

            if ($delete){
                $_SESSION['delete']= 'completo';
            }else{
                $_SESSION['delete']= 'fallido';
            }
        }else{
            $_SESSION['delete']= 'fallido';
        }

        header("Location:".base_url.'usuariocontroller/listadocentes');
    }
    public function  buscar(){
        Utils::isAdmin();
        $this->listadocentes();

        if (isset($_POST['busqueda'])){
            $buscarentradas = $_POST['busqueda'];
            $docentes = new Usuario();
            //require_once 'vistas/usuario/listadocentes.php';

            if (is_numeric($buscarentradas)){
                $docentes->setDnipassword($buscarentradas);
                $docentes->buscar();
                var_dump($docentes);
            }else{
                $docentes->setApellidos($buscarentradas);
                $docentes->buscar();
            }
        }else{
            header("Location:".base_url.'usuariocontroller/listadocentes');
        }
    }

    public function report(){
        Utils::isAdmin();
        require_once 'vistas/reportes/reportes.php';
    }


}//fin class

?>