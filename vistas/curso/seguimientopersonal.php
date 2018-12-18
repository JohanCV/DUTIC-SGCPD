<h3>SEGUIMIENTO DOCENTE</h3>

<?php require_once 'vistas/layout/buscar.php'?>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">N°</th>
        <th scope="col">NOMBRES</th>
        <th scope="col">CURSO PRUEBA</th>
        <th scope="col">TOTAL</th>
    </tr>
    </thead>

    <tbody>
    <?php $contador = 1; ?>
        <?php while ($seguimiento = $cursomatri->fetch_object() ): ?>
            <tr>
                <th scope="row"><?php echo $contador ?></th>
                <td><?= $seguimiento->idusu ?></td>
                <td><?= $seguimiento->idcursoprueba ?></td>
                <td><a href="<?=base_url?>cursocontroller/seguimietnopersonal&idcp=<?= $seguimiento->idcursoprueba ?>"
                   class="btn btn-xs btn-danger">
                    <i class="fas fa-user-times"></i> VER</a>
            </td>

            </tr>
            <?php $contador++; ?>
        <?php endwhile; ?>

    </tbody>
</table>
