<?php if (isset($_SESSION['identity'])):?>
    <!--menu lateral -->
    <aside id="menulateral">


        <ul>
            <li><a href="<?=base_url?>usuariocontroller/index" name="clickdocente"><strong>Bienvenido <?= $_SESSION['identity']->nombre ?>
                        <?= $_SESSION['identity']->apellidos ?>
                    </strong></a></li>

            <li><a href="<?=base_url?>cursocontroller/index" name="clickcursos">
                    <i class="fas fa-plus-circle fa-1.5x"></i> CURSOS
                </a>
            </li>
            <li><a href="<?=base_url?>usuariocontroller/listadocentes" name="clickdocente"> DOCENTES</a></li>
            <li><a href="http://dutic.unsa.edu.pe/Reportes"> REPORTES</a></li>

        </ul>

    </aside>

<?php  ?>
<?php elseif(!isset($_SESSION['identity'])):?>
    <!--menu lateral -->
    <aside id="menulateral">

        <?php require_once 'vistas/usuario/login.php'?>

    </aside>

<?php endif; ?>



            

