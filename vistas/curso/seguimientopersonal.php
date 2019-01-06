<h3>SEGUIMIENTO DOCENTE</h3>

<?php // require_once 'vistas/layout/buscar.php'?>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">N°</th>
        <th scope="col">archivos</th>
        <th scope="col">tareas</th>
        <th scope="col">cuestionarios</th>
        <th scope="col">foros</th>
        <th scope="col">encuesta</th>
        <th scope="col">nota</th>
    </tr>
    </thead>

    <tbody>
    <?php $contador = 1; ?>
        <?php while ($seguipersonal = $seguimiento->fetch_object() ): ?>
            <tr>
                <th scope="row"><?php echo $contador ?></th>
                <td><?= $seguipersonal->Archivos?></td>
                <td><?= $seguipersonal->Tareas ?></td>
                <td><?= $seguipersonal->Cuestionarios ?></td>
                <td><?= $seguipersonal->forum ?></td>
                <td><?= $seguipersonal->encuesta ?></td>
            </td>

            </tr>
            <?php $contador++; ?>
        <?php endwhile; ?>

    </tbody>
</table>
