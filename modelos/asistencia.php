<?php
class Asistencia{
    private $idfecha;
    private $idcurso;
    private $idusu;
    private $estado;

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function getIdfecha(){
        return $this->idfecha;
    }
    public function setIdfecha($id){
        $this->idusu = $id;
    }
    public function getIdcurso(){
        return $this->idcurso;
    }
    public function setIdcurso($idcurso){
        $this->idcurso = $idcurso;
    }
    public function getIdusu(){
        return $this->idusu;
    }
    public function setIdusu($idusu){
        $this->idusu= $idusu;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function setEstado($esta){
        $this->estado = $esta;
    }

    public function getAll(){
        $sql = "SELECT * FROM asistencia ORDER BY idcurso DESC ";
        $cursosasistencia = $this->db->query($sql);

        return $cursosasistencia;
    }

    public function getOne($idcurso){
        $sql = "SELECT fecha.diasemana as idfecha,  curso.nombre as idcurso,
                       usuarios.nombre as idusu, estado
                FROM asistencia
                INNER JOIN fecha ON asistencia.idfecha = fecha.idfecha
                INNER JOIN curso on curso.idcurso = asistencia.idcurso
                INNER JOIN usuarios on usuarios.idusu = asistencia.idusu
                WHERE curso.idcurso = '$idcurso'";


        $matriculados = $this->db->query($sql);

        return $matriculados;
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

}//fin de clase
