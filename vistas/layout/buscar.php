<?php if (isset($_SESSION['identity']) && $_SESSION['identity']->rol == 'admin'):?>
<label for=""></label>
<form action="<?=base_url?>usuariocontroller/buscar" method="POST"
      class="form-inline my-2 my-lg-0" id="buscar">
      <input class="form-control mr-sm-2"
             type="search"
             placeholder="Por APELLIDOS"
             aria-label="Search"
             name="busqueda">
      <input class="btn btn-outline-success my-2 my-sm-0"
              type="submit" value="BUSCAR"/>
</form>
<?php else: ?>
  <?php if (isset($_SESSION['identity']) && $_SESSION['identity']->rol == 'user'):?>
  <label for=""></label>
  <form action="<?=base_url?>usuariocontroller/buscarusuario" method="POST"
        class="form-inline my-2 my-lg-0" id="buscar">
        <input class="form-control mr-sm-2"
               type="search"
               placeholder="Por DNI o APELLIDOS"
               aria-label="Search"
               name="busqueda">
        <input class="btn btn-outline-success my-2 my-sm-0"
                type="submit" value="BUSCAR"/>
  </form>
  <?php endif; ?>
<?php endif; ?>
