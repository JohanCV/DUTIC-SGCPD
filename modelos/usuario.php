<?php
class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $dnipassword;
    private $rol;
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

    function setId($id){
        $this->id = $id;
    }
    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
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

    public function save(){
      $sql = "INSERT INTO usuarios VALUES (NULL ,
              '{$this->getNombre()}',
              '{$this->getApellido()}',
              '{$this->getEmail()}',
              '{$this->getDnipassword()}',
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
        $docenteslista = $this->db->query("SELECT * FROM usuarios");
        return $docenteslista;
    }
    public function editar(){

    }
    public function eliminar(){

    }

}
?>
