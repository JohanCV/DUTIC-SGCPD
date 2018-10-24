<?php if (!isset($_SESSION['identity'])):?>

<form action="<?=base_url?>usuariocontroller/login" method="POST" class="form-signin">
                <div class="text-center mb-4">
                <img class="mb-4" src="<?=base_url?>assets/img/logodutic.png" alt="logoDutic" width="100" height="100">
                <h3 class="h3 mb-3 font-weight-bold">INICIO DE SESION</h3>
                <p>Sistema de Gestión de Cursos para Capacitar a Docentes acerca del 
                    <a href="http://dutic.unsa.edu.pe/aulavirtual">Aula Virtual</a></p>
                </div>
        
                <div class="form-label-group">
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Ingrese su Correo Institucional" required="" autofocus="">
                <label for="inputEmail"></label>
                </div>
        
                <div class="form-label-group">
                <input type="password" name="dnipassword" id="inputPassword" class="form-control" placeholder="Ingrese su DNI" required="">
                <label for="inputPassword"></label>
                </div>  
                
                <button class="btn btn-lg btn-primary " type="submit">Iniciar Sesion</button>
</form>
<?php else: ?>
    <div class="alert alert-success" role="alert">
        <strong>Bienvenido <?= $_SESSION['identity']->nombre ?>
            <?= $_SESSION['identity']->apellidos ?>
        </strong>

    </div>
<?php endif; ?>