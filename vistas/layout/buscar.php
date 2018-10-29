<?php if (isset($_SESSION['identity'])):?>

<form action="<?=base_url?>usuariocontroller/buscar" method="post" class="form-inline my-2 my-lg-0" id="buscar">
      <input class="form-control mr-sm-2"
             type="search"
             placeholder="Por DNI o APELLIDOS"
             aria-label="Search"
             name="busqueda">
      <button class="btn btn-outline-success my-2 my-sm-0"
              type="submit">BUSCAR
      </button>
</form>
<?php endif; ?>