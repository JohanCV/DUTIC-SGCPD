<?php
class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $dnipassword;
    private $rol;
    private $escuela;
    private $db;

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
        return $this->escuela;
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
        $this->escuela = $this->db->real_escape_string(strtoupper($scuela));
    }
    function getOne(){
        $sql = "SELECT * FROM usuarios WHERE idusu = {$this->getId()}";
        $user = $this->db->query($sql);

        return $user->fetch_object();
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

    public function listadocentes(){
        $docenteslista = $this->db->query("SELECT * FROM usuarios ORDER BY idusu DESC ");
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

}
?>
