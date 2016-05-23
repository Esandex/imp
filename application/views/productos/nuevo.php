<nav class="purple darken-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>" class="breadcrumb">Inicio</a>
        <a href="<?= base_url() ?>productos" class="breadcrumb">Productos</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<section class="container">
	<div class="row">
		<h4 class="purple-text text-darken-2">Nuevo Producto</h4>
	</div>
	<form action="insertar" method="post" enctype="multipart/form-data" >
		<div class="row">
			<div class="input-field col s12 m6">
	          <input id="name" name="name" type="text" class="validate" required>
	          <label for="name">Nombre</label>
	        </div>
	        <div class="input-field col s12 m6">
	          <input id="description" name="description" type="text" class="validate" required>
	          <label for="description">Descripción</label>
	        </div>
		</div>
		<div class="row">
	        <div class="file-field input-field">
		      <div class="btn">
		        <span>Foto</span>
		        <input name="image" type="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>
		</div>
        <div class="row">
	        <div class="input-field col s12">
	          <input type="submit" class="btn-large purple col s12" value="Crear Nuevo">
	        </div>
        </div>
	</form>
</section>