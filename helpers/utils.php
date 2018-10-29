<?php 
class Utils{
    public static function deleteSesion($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        
        return $name;
    }

    public static function isAdmin(){
        if (!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }
    }

    public static function isUser(){
        if (!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function showEscuelas(){
        require_once 'modelos/escuela.php';
        $escuelas = new Escuela();
        $escuelas->getAll();

        return $escuelas;
    }
}

