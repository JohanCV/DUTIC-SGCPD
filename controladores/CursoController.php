<?php
require_once 'modelos/curso.php';
require_once 'modelos/usuario.php';
require_once 'modelos/usuariocurso.php';
require_once 'modelos/asistencia.php';
require_once 'modelos/seguimiento.php';
require_once 'modelos/seguimientonota.php';
require_once 'modelos/Informe.php';

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
    public function usuario(){
        Utils::isUser();
        $dentrocurso = true;
        $curso = new Curso();
        $CURSO = $curso->getAll();

        if ($dentrocurso) {
            $_SESSION['dentro'] = 'dentrocurso';
        }else {
            $_SESSION['dentro'] = 'noentrocurso';
        }
        require_once 'vistas/usuario/docente.php';

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
      if (isset($_SESSION['identity']) && $_SESSION['identity']->rol == 'user') {
        Utils::isUser();
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
        header("Location:".base_url.'cursocontroller/inscripcionusuario&id='.$idcurso);
      }else {
        Utils::isAdmin();
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
    }

    public function saveasistencia(){
      echo "entrosm ";
      if (isset($_POST)) {
          //var_dump($_GET['idoc']);
          $fecha = isset($_POST['fecha'])?$_POST['fecha'] : false;
          $usuario = isset($_POST['user'])?$_POST['user'] : false;
          $estado = isset($_POST['estado'])?$_POST['estado'] : false;
          $nota = isset($_POST['nota'])?$_POST['nota'] : false;
          var_dump($fecha);
          var_dump($usuario);
          var_dump($estado);
          echo "entro post ";
          if ($fecha &&  $usuario && $estado) {
                echo "entro if ";
                $asis =  new Asistencia();
                $asis->setIdfecha($fecha);
                $asis->setFk_iduc($usuario);
                $asis->setEstado($estado);
                $asis->setNota($nota);
                var_dump($asis->setNota($nota));
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
      header("Location:".base_url.'cursocontroller/asistentes&id='.$_GET['idcurso']);
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
        if (isset($_SESSION['identity']) && $_SESSION['identity']->rol == 'user') {
          Utils::isUser();
          if (isset($_GET['idusu'])) {
            $usuario = new Usuariocurso();
            $usuario->setIduc($_GET['idusu']);
            $cursomatri = $usuario->eliminar();
            header("Location:".base_url.'cursocontroller/inscripcionusuario&id='.$_GET['id']);
          }
          $_SESSION['buscarusercourse'] = 'noencontrado';
        }else {
          if (isset($_GET['idusu'])) {
            $usuario = new Usuariocurso();
            $usuario->setIduc($_GET['idusu']);
            $cursomatri = $usuario->eliminar();
            header("Location:".base_url.'cursocontroller/listacursos');
          }
          $_SESSION['buscarusercourse'] = 'noencontrado';
        }
      }
      require_once 'vistas/curso/inscripcion.php';

      return $cursomatri;
    }

    public function inscripcionusuario(){
      Utils::isUser();

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

        if (isset($_SESSION['identity']) && $_SESSION['identity']->rol == 'user') {
          Utils::isUser();
          if (isset($_GET['idusu'])) {
            $usuario = new Usuariocurso();
            $usuario->setIduc($_GET['idusu']);
            $cursomatri = $usuario->eliminar();
            header("Location:".base_url.'cursocontroller/usuario');
          }
          $_SESSION['buscarusercourse'] = 'noencontrado';
        }else {
          if (isset($_GET['idusu'])) {
            $usuario = new Usuariocurso();
            $usuario->setIduc($_GET['idusu']);
            $cursomatri = $usuario->eliminar();
            header("Location:".base_url.'cursocontroller/listacursos');
          }
          $_SESSION['buscarusercourse'] = 'noencontrado';
        }
      }
      require_once 'vistas/curso/inscripcionusuario.php';

      return $cursomatri;
    }


    public function matricular(){
      if (isset($_SESSION['identity']) && $_SESSION['identity']->rol == 'user') {
        Utils::isUser();
        require_once 'vistas/curso/matricula.php';
      }else {
        Utils::isAdmin();
        require_once 'vistas/curso/matricula.php';
      }

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
          //var_dump($_GET['id']);
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

    public function seguimientonota(){
      Utils::isAdmin();echo "entro sn ";

      if (isset($_POST)) {echo "entro post";
          $nota = isset($_POST['nota'])?$_POST['nota'] : false;
          if (isset($_GET['idsegcal'])) {echo "entro editar";
              $seguir = new Seguimientonota();
              $id = $_GET['idsegcal'];
              $seguir->setIdseg($id);
              $seguir->setNota($nota);
              $seguimiento = $seguir->editar();
          }
          if (isset($_GET['idcp'])&& isset($_GET['iduser']) && isset($_GET['idcurso']) && isset($_GET['iduc'])) {
            $cursoprueba = $_GET['idcp'];
            $usuario = $_GET['iduser'];
            $curso = $_GET['idcurso'];
            $iduc = $_GET['iduc'];echo "entro if";
            var_dump($iduc);
            $seguir = new Seguimientonota();
            $seguir->setIduc($iduc);
            $seguir->setCurso($curso);
            $seguir->setCursoprueba($cursoprueba);
            $seguir->setDocente($usuario);
            $seguir->setNota($nota);
            if (isset($_GET['idsegcal'])) {
                $id = $_GET['idsegcal'];
                $seguir->setIdseg($id);
                $seguimiento = $seguir->editar();
            }else {
                $seguimiento = $seguir->save();
            }
              //var_dump($seguimiento);
            if ($seguimiento) {
              $_SESSION['segnota'] = "completo";
            }else {
              $_SESSION['segnota'] = "fallido";
            }
          }else {
            $_SESSION['segnota'] = "fallido";
          }

      }else {
        $_SESSION['segnota'] = "fallido";
      }
      header("Location:".base_url.'cursocontroller/seguimiento&id='.$_GET['idcurso']);
    }
    public function seguimientonotaedicion(){
      Utils::isAdmin();

      if (isset($_POST)) {
          $nota = isset($_POST['nota'])?$_POST['nota'] : false;
          if (isset($_GET['idsegui'])) {
              $seguir = new Seguimientonota();
              $id = $_GET['idsegui'];
              $seguir->setIdseg($id);
              $seguir->setNota($nota);
              $seguimiento = $seguir->editar();
          }

              //var_dump($seguimiento);
            if ($seguimiento) {
              $_SESSION['segnotaedit'] = "completo";
            }else {
              $_SESSION['segnotaedit'] = "fallido";
            }
          }else {
            $_SESSION['segnotaedit'] = "fallido";
          }

      header("Location:".base_url.'cursocontroller/seguimientocalificaciones&id='.$_GET['idcurso']);
    }
    public function seguimientocalificaciones(){
      Utils::isAdmin();
      if (isset($_GET['id'])) {
        $curso = $_GET['id'];
        //var_dump($_GET['idcp']);
        $seguir = new Seguimientonota();
        $seguimientocalificado = $seguir->getOnecurso($_GET['id']);
      }

      require_once 'vistas/curso/seguimientocalificado.php';
      return $seguimientocalificado;
    }

    public function editarnota(){
        Utils::isAdmin();

        if (isset($_GET['idsegcal'])){
            $editnota = true;
            $id = $_GET['idsegcal'];
            $edit = new Seguimientonota();
            $edit->setIdseg($id);
            $editarnota = $edit->getOne();
            require_once 'vistas/curso/seguimientopersonaledicion.php';
        }else{
            header("Location:".base_url.'cursocontroller/listacursos');
        }

    }

    public function informe(){
      Utils::isAdmin();
      if (isset($_GET['id'])){
          $informe = true;
          $id = $_GET['id'];
          $info = new Informe();
          $informecertificacion = $info->getInforme($id);

      }else{
          header("Location:".base_url.'cursocontroller/listacursos');
      }
      require_once 'vistas/curso/informe.php';
      return $informecertificacion;
    }

    public function certificado(){
      Utils::isAdmin();
      require_once 'vistas/curso/certificado.php';
    }
    public function  buscar(){
        Utils::isAdmin();

        if (isset($_POST['busqueda'])){
            $buscarentradas = $_POST['busqueda'];
            $escuela = new Informe();

              $buscar = $escuela->getInformeSearch($buscarentradas);
              $informecertificacion = $escuela->getInforme($_GET['idcurso']);
              require_once 'vistas/usuario/busquedainforme.php';

        }else{
            header("Location:".base_url.'cursocontroller/listacursos');
        }
    }

    public function recuperacion(){
      Utils::isAdmin();
      require_once 'vistas/curso/recuperacion.php';
    }
}
