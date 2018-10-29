<?php if (isset($_SESSION['identity'])):?>
    <!--menu lateral -->
    <aside id="menulateral">
        <ul>
            <li><a id="user" href="<?=base_url?>usuariocontroller/listadocentes" name="clickdocente">
                    <strong>Bienvenido <?= $_SESSION['identity']->nombre ?>
                        <?= $_SESSION['identity']->apellidos ?>
                    </strong></a></li>

            <li><a href="<?=base_url?>cursocontroller/index" name="clickcursos">
                    <i class="fas fa-chalkboard-teacher"></i> CURSOS</a></li>
            <li><a href="<?=base_url?>usuariocontroller/listadocentes" name="clickdocente">
                    <i class="fas fa-user-graduate"></i> DOCENTES</a></li>
            <li><a href="<?=base_url?>usuariocontroller/report">
                    <i class="fas fa-chart-line"></i> REPORTES</a></li>

        </ul>
    </aside>

<?php  ?>
<?php elseif(!isset($_SESSION['identity'])):?>
    <!--menu lateral -->
    <aside id="menulateral">

        <?php require_once 'vistas/usuario/login.php'?>

    </aside>

<?php endif; ?>



            

