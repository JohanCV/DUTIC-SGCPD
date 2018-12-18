<?php
class Curso{
    private $id;
    private $nombre;
    private $nombrecorto;
    private $horainicio;
    private $horafinal;
    private $contenido;
    private $idprofesor;

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getNombrecorto(){
        return $this->nombrecorto;
    }
    public function setNombrecorto($nombrecorto){
        $this->nombrecorto = $nombrecorto;
    }
    public function getHorainicio(){
        return $this->horainicio;
    }
    public function setHorainicio($hora){
        $this->horainicio = $hora;
    }
    public function getHorafinal(){
        return $this->horafinal;
    }
    public function setHorafinal($hf){
        $this->horafinal = $hf;
    }
    public function getContenido(){
        return $this->contenido;
    }
    public function setContenido($contenido){
        $this->contenido = $contenido;
    }
    public function getIdprofesor(){
        return $this->idprofesor;
    }
    public function setIdprofesor($profe){
        $this->idprofesor = $profe;
    }

    function getOne(){
        $sql = "SELECT * FROM curso WHERE idcurso = {$this->getId()}";
        $course = $this->db->query($sql);

        return $course->fetch_object();
    }

    public function getAll(){
        $sql = "SELECT * FROM curso";
        $cursos = $this->db->query($sql);

        return $cursos;
    }

    public function listaCursos($n_element, $n_elemet_page){
        $sql ="SELECT * FROM curso ORDER BY idcurso DESC
                LIMIT $n_element, $n_elemet_page";
        $cursolista = $this->db->query($sql);
        return $cursolista;
    }

    public function save(){
      $result = false;
      $sql = "INSERT INTO curso VALUES (NULL ,
              '{$this->getNombre()}',
              '{$this->getNombrecorto()}',
              '{$this->getHorainicio()}',
              '{$this->getHorafinal()}',
              '{$this->getContenido()}',
              '{$this->getIdprofesor()}')";
      $save = $this->db->query($sql);
      echo $this->db->error;
      die();
      if ($save) {
          $result= true;
      }

      return $result;
    }

    public function editar(){
        $sql = "UPDATE curso SET
              nombre='{$this->getNombre()}',
              nombrecorto='{$this->getNombrecorto()}',
              horainicio='{$this->getHorainicio()}',
              horafinal='{$this->getHorafinal()}',
              contenido='{$this->getContenido()}',
              idprofesor='{$this->getIdprofesor()}'
              WHERE idcurso={$this->id}";
        $edit = $this->db->query($sql);

        $result=false;
        if ($edit){
            $result = true;
        }

        return $result;
    }
    public function eliminar(){
        $sql = "DELETE FROM curso WHERE idcurso = {$this->id} ";
        $delete = $this->db->query($sql);
        $result = false;

        if ($delete){
            $result = true;
        }
        return $result;
    }

}//fin de clase
