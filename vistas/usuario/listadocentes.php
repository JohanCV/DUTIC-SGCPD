<h3>DOCENTES</h3>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">N°</th>
        <th scope="col">ESCUELA</th>
        <th scope="col">NOMNRE</th>
        <th scope="col">APELLIDOS</th>
        <th scope="col">EMAIL</th>
    </tr>
    </thead>

    <tbody>
        <?php while ($docente = $docentes->fetch_object() ): ?>
            <tr>
                <th scope="row">1</th>
                <td><?= $docente->nombre; ?></td>
                <td><?= $docente->apellidos; ?></td>
                <td><?= $docente->email; ?></td>
                <td><?= $docente->nombre; ?></td>
            </tr>

        <?php endwhile; ?>
    </tbody>
</table>

