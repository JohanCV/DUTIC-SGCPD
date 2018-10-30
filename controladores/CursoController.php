<?php
require_once 'modelos/curso.php';

class CursoController{
    public function index(){
        Utils::isAdmin();
       // Utils::isUser();
        //require_once 'vistas/curso/listacursos.php';
        $this->listacursos();
    }

    public function listacursos(){
        //Utils::isAdmin();
        $curso = new Curso();
        $cursos = $curso->getAll();

        $numero_elementos =$cursos->num_rows;
        $numero_elementos_pagina = 2;
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
        $empieza_aqui = (($page-1))*$numero_elementos_pagina;
        $CURSO = $curso->listaCursos($empieza_aqui,$numero_elementos_pagina);

        require_once 'vistas/curso/listacursos.php';
        $pagination->labels('Atras', 'Siguiente');
        $pagination->render();

        //uso del return para poder mostrar los cursos antes de iniciar sesion
        return $CURSO;
    }
}