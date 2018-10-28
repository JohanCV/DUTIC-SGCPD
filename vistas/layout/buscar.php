<?php if (isset($_SESSION['identity'])):?>

<form class="form-inline my-2 my-lg-0" id="buscar">
      <input class="form-control mr-sm-2"
             type="search"
             placeholder="Por DNI, NOMBRE, APELLIDOS"
             aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0"
              type="submit">BUSCAR
      </button>
</form>
<?php endif; ?>