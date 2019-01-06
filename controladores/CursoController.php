<?php
require_once 'modelos/curso.php';
require_once 'modelos/usuario.php';
require_once 'modelos/usuariocurso.php';
require_once 'modelos/asistencia.php';
require_once 'modelos/seguimiento.php';

class CursoController{
    public function index(){
        Utils::isAdmin();
       // Utils::isUser();
        //require_once 'vistas/curso/listacursos.php';
        $this->listacursos();
    }

    public function crear(){
      Utils::isAdmin();

      require_once 'vistas/curso/crear.php';
    }

    public function save(){
      Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre'])?$_POST['nombre'] : false;
            $nombrecorto = isset($_POST['nombrecorto'])?$_POST['nombrecorto'] : false;
            $horainicio = isset($_POST['horainicio'])?$_POST['horainicio'] : false;
            $horafinal= isset($_POST['horafin'])?$_POST['horafin'] : false;
            $contenido = isset($_POST['contenido'])?$_POST['contenido'] : false;
            $rofesor = isset($_POST['profesor'])?$_POST['profesor'] : false;

            if ($nombre &&  $nombrecorto && $horainicio
                && $horafinal && $contenido && $rofesor) {

                  $curso =  new Curso();
                  $curso->setNombre($nombre);
                  $curso->setNombrecorto($nombrecorto);
                  $curso->setHorainicio($horainicio);
                  $curso->setHorafinal($horafinal);
                  $curso->setContenido($contenido);
                  $curso->setIdprofesor($rofesor);

                  if (isset($_GET['id'])) {
                      $id = $_GET['id'];
                      $curso->setId($id);
                      $save = $curso->editar();
                  }else {
                      $save = $curso->save();
                  }

                  if ($save) {
                    $_SESSION['curso'] = "completo";
                  }else {
                    $_SESSION['curso'] = "fallido";
                  }
            }else {
              $_SESSION['curso'] = "fallido";
            }

        }else {
          $_SESSION['curso'] = "fallido";
        }
        header('Location:'.base_url.'cursocontroller/listacursos');
    }

    public function listacursos(){
        Utils::isAdmin();
        Utils::isUser();
        $dentrocurso = true;
        $curso = new Curso();
        $CURSO = $curso->getAll();

        if ($dentrocurso) {
            $_SESSION['dentro'] = 'dentrocurso';
        }else {
            $_SESSION['dentro'] = 'noentrocurso';
        }
        require_once 'vistas/curso/listacursos.php';

        //uso del return para poder mostrar los cursos antes de iniciar sesion
        return $CURSO;
    }

    public function editar(){
        Utils::isAdmin();

        if (isset($_GET['id'])){
            $edit = true;
            $id = $_GET['id'];
            $curso = new Curso();
            $curso->setId($id);
            $edicion = $curso->getOne();
            require_once 'vistas/curso/crear.php';

            if ($edicion){
                $_SESSION['edicion']= 'completo';
            }else{
                $_SESSION['edicion']= 'fallido';
            }
        }else{
            $_SESSION['edicion']= 'fallido';
            header("Location:".base_url.'cursocontroller/listacursos');
        }

    }
    public function eliminar(){
        Utils::isAdmin();

        if (isset($_GET['id'])){
            $curso = new Curso();
            $curso->setId($_GET['id']);
            $delete = $curso->eliminar();

            if ($delete){
                $_SESSION['delete']= 'completo';
            }else{
                $_SESSION['delete']= 'fallido';
            }
        }else{
            $_SESSION['delete']= 'fallido';
        }

        header("Location:".base_url.'cursocontroller/listacursos');
    }

    public function savematricula(){

      if (isset($_POST)) {
          //var_dump($_GET['idoc']);
          $idusu = isset($_POST['usuario'])?$_POST['usuario'] : false;
          $idcurso = isset($_POST['curso'])?$_POST['curso'] : false;
          $estado = isset($_POST['estado'])?$_POST['estado'] : false;
          $idcp= isset($_POST['cursoprueba'])?$_POST['cursoprueba'] : false;

          if ($idusu &&  $idcurso && $estado
              && $idcp) {

                $curso =  new Usuariocurso();
                $curso->setIdusu($idusu);
                $curso->setIdcurso($idcurso);
                $curso->setEstadoasistencia($estado);
                $curso->setIdcursoprueba($idcp);

                /*if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $curso->setId($id);
                    $save = $curso->editar();
                }else {*/
                    $save = $curso->save();
                //}
                var_dump($save);
                if ($save) {
                  $_SESSION['matricula'] = "completo";
                }else {
                  $_SESSION['matricula'] = "fallido";
                }
          }else {
            $_SESSION['matricula'] = "fallido";
          }

      }else {
        $_SESSION['matricula'] = "fallido";
      }
      header("Location:".base_url.'cursocontroller/inscripcion&id='.$idcurso);
    }

    public function saveasistencia(){
      echo "entrosm";
      if (isset($_POST)) {
          //var_dump($_GET['idoc']);
          $fecha = isset($_POST['fecha'])?$_POST['fecha'] : false;
          $usuario = isset($_POST['user'])?$_POST['user'] : false;
          $estado = isset($_POST['estado'])?$_POST['estado'] : false;
          var_dump($fecha);
          var_dump($usuario);
          var_dump($estado);
          echo "entro post";
          if ($fecha &&  $usuario && $estado) {
                echo "entro if";
                $asis =  new Asistencia();
                $asis->setIdfecha($fecha);
                $asis->setFk_iduc($usuario);
                $asis->setEstado($estado);

                /*if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $curso->setId($id);
                    $save = $curso->editar();
                }else {*/
                    $save = $asis->save();
                //}
                var_dump($save);
                if ($save) {
                  $_SESSION['asistencia'] = "completo";
                }else {
                  $_SESSION['asistencia'] = "fallido";
                }
          }else {
            $_SESSION['asistencia'] = "fallido";
          }

      }else {
        $_SESSION['asistencia'] = "fallido";
      }
    //  header("Location:".base_url.'cursocontroller/asistencia');
    }

    public function inscripcion(){
      Utils::isAdmin();

      if (isset($_GET['id'])) {
          $buscarusuariocurso = true;
          $cursomatricula = new Usuariocurso();
          $cursomatri = $cursomatricula->getOne($_GET['id']);

          if ($buscarusuariocurso) {
              $_SESSION['buscarusercourse'] = 'encontrado';
          }else {
              $_SESSION['buscarusercourse'] = 'noencontrado';
          }
      }else {

          if (isset($_GET['idusu'])) {
            $usuario = new Usuariocurso();
            $usuario->setIduc($_GET['idusu']);
            $cursomatri = $usuario->eliminar();
            header("Location:".base_url.'cursocontroller/listacursos');
          }
          $_SESSION['buscarusercourse'] = 'noencontrado';
      }
      require_once 'vistas/curso/inscripcion.php';

      return $cursomatri;
    }


    public function matricular(){
      Utils::isAdmin();


      require_once 'vistas/curso/matricula.php';
    }



    public function asistencia(){
      Utils::isAdmin();

      if (isset($_GET['idasis'])) {

          $buscarusuariocurso = true;
          $asistencia = new Asistencia();
          $cursoasistencia = $asistencia->getOne($_GET['idasis']);

          if ($buscarusuariocurso) {
              $_SESSION['buscarusercourse'] = 'encontrado';
          }else {
              $_SESSION['buscarusercourse'] = 'noencontrado';
          }
      }else {
          $_SESSION['buscarusercourse'] = 'noencontrado';
      }

      require_once 'vistas/curso/asistencia.php';

      return $cursoasistencia;

    }
    public function asistentes(){
      Utils::isAdmin();
      if (isset($_GET['id'])) {
          $buscarusuariocurso = true;
          $cursomatricula = new Usuariocurso();
          $cursomatri = $cursomatricula->getOne($_GET['id']);

          if ($buscarusuariocurso) {
              $_SESSION['buscarusercourse'] = 'encontrado';
          }else {
              $_SESSION['buscarusercourse'] = 'noencontrado';
          }
      }else {

          if (isset($_GET['idusu'])) {
            $usuario = new Usuariocurso();
            $usuario->setIduc($_GET['idusu']);
            $cursomatri = $usuario->eliminar();
            header("Location:".base_url.'cursocontroller/listacursos');
          }
          $_SESSION['buscarusercourse'] = 'noencontrado';
      }
      require_once 'vistas/curso/asistentes.php';

      return $cursomatri;
    }

    public function marcarasistencia(){
      Utils::isAdmin();
      require_once 'vistas/curso/marcarasistencia.php';
    }

    public function seguimiento(){
      Utils::isAdmin();
      if (isset($_GET['id'])) {
          var_dump($_GET['id']);
          $buscarusuariocurso = true;
          $cursomatricula = new Usuariocurso();
          $cursomatri = $cursomatricula->getOne($_GET['id']);

          if ($buscarusuariocurso) {
              $_SESSION['buscarusercourse'] = 'encontrado';
          }else {
              $_SESSION['buscarusercourse'] = 'noencontrado';
          }
      }else {
          $_SESSION['buscarusercourse'] = 'noencontrado';
      }

      require_once 'vistas/curso/seguimiento.php';

      return $cursomatri;
    }

    public function seguimietnopersonal(){
      Utils::isAdmin();
      if (isset($_GET['idcp'])) {
        $cursoprueba = $_GET['idcp'];
        var_dump($_GET['idcp']);
        $seguir = new Seguimiento();
        $seguimiento = $seguir->seguimiento($_GET['idcp']);
      }

      require_once 'vistas/curso/seguimientopersonal.php';
      return $seguimiento;
    }

    public function informe(){
      Utils::isAdmin();
      require_once 'vistas/curso/informe.php';
    }

    public function certificado(){
      Utils::isAdmin();
      require_once 'vistas/curso/certificado.php';
    }

    public function recuperacion(){
      Utils::isAdmin();
      require_once 'vistas/curso/recuperacion.php';
    }
}
