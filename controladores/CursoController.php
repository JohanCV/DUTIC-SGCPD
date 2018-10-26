<?php 
class CursoController{
    public function index(){
        Utils::isAdmin();
       // Utils::isUser();
        require_once 'vistas/curso/listacursos.php';
    }
}

?>