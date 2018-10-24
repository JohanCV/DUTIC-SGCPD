<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" 
          href="assets/css/style.css">

    <!--link rel="stylesheet" 
          href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" 
          integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" 
          crossorigin="anonymous">
    <link rel="stylesheet" 
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
          crossorigin="anonymous"-->

    <title>DUTIC</title>
</head>
<body>
<div id="containergeneral">
    <!--cabecera -->
    <header id="header" class="navbar navbar-light bg-secondary mb-4">
            <div id="texto">
                <h1>DUTIC - SISTEMA DE GESTIÓN DE CURSOS PARA CAPACITAR DOCENTES</h1>
            </div>
            <div id="logout">
                <a href="../index.php">
                <i class="fas fa-sign-out-alt fa-4x"></i>
                </a>            
            </div>
    </header>

    <!--menu lateral -->
    <aside id="menulateral">
        <ul>
            <li><a href="">Inscripcion</a></li>
            <li><a href="">Asistencia</a> </li>
            <li><a href="">Seguimiento</a> </li>
            <li><a href="">Recuperacion</a> </li>
            <li><a href="">Informe</a> </li>
            <li><a href="">
                <i class="fas fa-plus-circle fa-1.5x"></i> 
                Agregar</a> </li>                
        </ul>

    </aside>
    <!--contenido -->
    <section id="contenido">


     </section>  

</div>
<!--pie de pagina -->
<footer id="footer">
        <p class="mt-5 mb-3 text-muted text-center" >Desarrollado por JCV &copy; <?= date('Y')?> </p>
</footer>
</body>
</html>