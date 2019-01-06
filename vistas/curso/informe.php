<h3>INFORME DOCENTE</h3>

<?php require_once 'vistas/layout/buscar.php'?>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">N°</th>
        <th scope="col">ESCUELA</th>
        <th scope="col">NOMBRES</th>
        <th scope="col">APELLIDOS</th>
        <th scope="col">SEGUIMIENTO</th>
        <th scope="col">ASISTENCIA</th>
        <th scope="col">TOTAL</th>
        <th scope="col">CONSTANCIA</th>
    </tr>
    </thead>

    <tbody>
    <?php $contador = 1; ?>
        <?php //while ($docente = $PRO->fetch_object() ): ?>
            <tr>
                <th scope="row"><?php echo $contador ?></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <a href="<?=base_url?>cursocontroller/certificado"
                   class="btn btn-xs btn-danger">
                    <i class="fas fa-user-times"></i> VER</a>
                
            </tr>
            <?php $contador++; //var_dump($docente);?>
        <?php //endwhile; ?>

    </tbody>
</table>
