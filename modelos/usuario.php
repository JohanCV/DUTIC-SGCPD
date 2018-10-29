<?php
class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $dnipassword;
    private $rol;
    private $ides;

    private $db;
    private $valor;

    public function __construct(){
      $this->db = Database::connect();
    }

    function getId(){
        return $this->id;
    }
    function getNombre(){
        return $this->nombre;
    }
    function getApellido(){
        return $this->apellidos;
    }
    function getEmail(){
        return $this->email;
    }
    function getDnipassword(){
        return password_hash($this->db->real_escape_string(
            $this->dnipassword),PASSWORD_DEFAULT);
    }
    function getRol(){
        return $this->rol;
    }
    function getEscuela(){
        return $this->ides;
    }
    function getValor(){
        return $this->valor;
    }

    function setId($id){
        $this->id = $id;
    }
    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string(strtoupper($nombre));
    }
    function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string(strtoupper($apellidos));
    }
    function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }
    function setDnipassword($dnipassword){
        $this->dnipassword = $dnipassword;
    }
    function setRol($rol){
        $this->rol = $rol;
    }
    function setEscuela($scuela){
        $this->ides = $this->db->real_escape_string(strtoupper($scuela));
    }
    function setValor($valor){
        $this->valor = $this->db->real_escape_string(strtoupper($valor));
    }
    function getOne(){
        $sql = "SELECT * FROM usuarios WHERE idusu = {$this->getId()}";
        $user = $this->db->query($sql);

        return $user->fetch_object();
    }
    function getAll(){
        $sql = "SELECT * FROM usuarios ORDER BY idusu DESC ";
        $users = $this->db->query($sql);

        return $users;
    }
    public function save(){
      $result = false;
      $sql = "INSERT INTO usuarios VALUES (NULL ,
              '{$this->getNombre()}',
              '{$this->getApellido()}',
              '{$this->getEmail()}',
              '{$this->getDnipassword()}',
              '{$this->getEscuela()}',
              'user')";
      $save = $this->db->query($sql);

      if ($save) {
          $result= true;
      }

      return $result;
    }
    public function login(){
        $result = false;
        $email = $this->email;
        $dnipassword = $this->dnipassword;

        //comprobar si exite el usaurio
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();
            $dni= $usuario->dnipassword;

            //verificar la contraseña
            $verify = password_verify($dnipassword, $dni);

            if($verify){
                $result = $usuario;
            }
        }
        return $result;
    }

    public function listadocentes($n_element, $n_elemet_page){
        $sql ="SELECT * FROM usuarios ORDER BY idusu DESC 
                LIMIT $n_element, $n_elemet_page";
        $docenteslista = $this->db->query($sql);
        return $docenteslista;
    }
    public function editar(){
        $sql = "UPDATE usuarios SET 
              nombre='{$this->getNombre()}',
              apellidos='{$this->getApellido()}',
              email='{$this->getEmail()}',
              dnipassword='{$this->getDnipassword()}',
              escuela='{$this->getEscuela()}'
              WHERE idusu={$this->id}";
        $edit = $this->db->query($sql);

        $result=false;
        if ($edit){
            $result = true;
        }

        return $result;
    }
    public function eliminar(){
        $sql = "DELETE FROM usuarios WHERE idusu = {$this->id} ";
        $delete = $this->db->query($sql);
        $result = false;

        if ($delete){
            $result = true;
        }
        return $result;
    }
    public function buscar(){
        $sql ="SELECT * FROM usuarios WHERE
               dnipassword  LIKE {$this->dnipassword}";
        $search = $this->db->query($sql);

        $result=false;
        if ($search){
            $result = true;
        }

        return $result;
    }
    /*Hola Victor  muy buenos videos, estoy haciendo algo similar a POO y MVC del carrito de compras y le quiero poner la paginacion a las tablas usando esta libreria zebra_pagination y sale como se muestra en la imagen:

*/
}
