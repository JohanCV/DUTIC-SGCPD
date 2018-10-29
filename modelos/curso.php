<?php
class Curso{
    private $id;
    private $nombre;
    private $nombrecorto;
    private $hora;
    private $dia;
    private $profesor;
    private $contenido;

    private $db;

    /**
     * Curso constructor.
     */
    public function __construct(){
        $this->db = Database::connect();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getNombrecorto()
    {
        return $this->nombrecorto;
    }

    /**
     * @param mixed $nombrecorto
     */
    public function setNombrecorto($nombrecorto)
    {
        $this->nombrecorto = $nombrecorto;
    }

    /**
     * @return mixed
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @param mixed $hora
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    /**
     * @return mixed
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * @param mixed $dia
     */
    public function setDia($dia)
    {
        $this->dia = $dia;
    }

    /**
     * @return mixed
     */
    public function getProfesor()
    {
        return $this->profesor;
    }

    /**
     * @param mixed $profesor
     */
    public function setProfesor($profe)
    {
        $this->dia = $profe;
    }
    /**
     * @return mixed
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * @param mixed $contenido
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }

    public function getAll(){
        $sql = "SELECT * FROM curso ORDER BY idcurso DESC ";
        $cursos = $this->db->query($sql);

        return $cursos;
    }

    public function listaCursos($n_element, $n_elemet_page){
        $sql ="SELECT * FROM curso ORDER BY idcurso DESC 
                LIMIT $n_element, $n_elemet_page";
        $cursolista = $this->db->query($sql);
        return $cursolista;
    }

}//fin de clase
