<?php

class Fecha{
    private $idfecha;
    private $dia;
    private $mes;
    private $anio;
    private $diasemana;

    private $db;

    function __construct(){
        $this->db = Database::connect();
    }

    /**
     * @return mixed
     */
    public function getIdfecha()
    {
        return $this->$idfecha;
    }

    /**
     * @param mixed $ides
     */
    public function setIdfecha($idfe)
    {
        $this->idfecha = $idfe;
    }

    /**
     * @return mixed
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * @param mixed $nombre
     */
    public function setDia($d)
    {
        $this->dia = $d;
    }

    public function getMes()
    {
        return $this->mes;
    }

    /**
     * @param mixed $nombre
     */
    public function setMes($m)
    {
        $this->mes = $m;
    }

    public function getAno()
    {
        return $this->anio;
    }

    /**
     * @param mixed $nombre
     */
    public function setAno($a)
    {
        $this->anio = $a;
    }

    public function getAll(){
        $sql = "SELECT concat(diasemana,' - ',dia,'/',mes,'/',anio) as fecha, idfecha FROM fecha ORDER BY idfecha DESC";
        $fecha = $this->db->query($sql);

        return $fecha;
    }

}
