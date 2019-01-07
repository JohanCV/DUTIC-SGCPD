<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="<?=base_url?>assets/css/style.css">

    <link rel="stylesheet"
          href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
          integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
          crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">

    <title>DUTIC</title>
</head>
<body>
<div id="containergeneral">
    <!--cabecera -->
    <header id="header" class="navbar navbar-light bg-secondary">
            <div id="texto">
                <h1>SISTEMA DE GESTIÓN DE CURSOS PARA CAPACITAR DOCENTES</h1>
            </div>
        <?php if (isset($_SESSION['identity'])):?>
            <div id="logout">
                <a href="<?=base_url?>usuariocontroller/logout">
                <i class="fas fa-sign-out-alt fa-3x"></i>
                </a>
            </div>
        <?php endif; ?>
    </header>
    
