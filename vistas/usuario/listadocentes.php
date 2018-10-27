<h3>DOCENTES <a href="<?=base_url?>usuariocontroller/registro">
                <i class="fas fa-user-plus"></i>
             </a>
</h3>
<?php require_once 'vistas/layout/buscar.php'?>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">N°</th>
        <th scope="col">ESCUELA</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">APELLIDOS</th>
        <th scope="col">EMAIL</th>
        <th scope="col">ACCIONES</th>
    </tr>
    </thead>

    <tbody>
    <?php $contador = 1; ?>
        <?php while ($docente = $docentes->fetch_object() ): ?>
            <tr>
                <th scope="row"><?php echo $contador ?></th>
                <td><?= $docente->escuela; ?></td>
                <td><?= $docente->nombre; ?></td>
                <td><?= $docente->apellidos; ?></td>
                <td><?= $docente->email; ?></td>
                <td>
                    <a class="btn btn-xs btn-primary" href="<?=base_url?>usuariocontroller/editar">
                        <i class="fas fa-user-edit"></i> Editar</a>
                    <a class="btn btn-xs btn-danger" href="<?=base_url?>usuariocontroller/eliminar">
                        <i class="fas fa-user-times"></i> Eliminar</a>
                </td>
            </tr>
            <?php $contador++; ?>
        <?php endwhile; ?>
    </tbody>
</table>
