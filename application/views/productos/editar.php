<nav class="purple darken-2">
	<div class="nav-wrapper">
	  <div class="col s12">
	    <a href="<?= base_url() ?>panel" class="breadcrumb">Inicio</a>
	    <a href="<?= base_url() ?>productos" class="breadcrumb">Productos</a>
	    <a href="#!" class="breadcrumb">Editar</a>
	  </div>
	</div>
</nav>
<section class="container">
	<div class="row">
		<h4 class="purple-text text-darken-2">Editando <strong><?= $product->product_name ?></strong></h4>
	</div>
	<div class="row">
		<div class="col s12 m4">
			 <img class="responsive-img" src="<?= base_url() ?>imagen/original/<?= $product->product_image ?>"> 
		</div>
		<div class="col s12 m8">
			<form action="../update/<?= $product->product_id ?>" class="col s12" method="post">
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
				<div class="input-field col s12">
					<input id="description" name="description" type="text" class="validate" value="<?= $product->product_name ?>">
	          		<label for="description">Nombre</label>
				</div>
				<div class="input-field col s12">
					<input id="description" name="description" type="text" class="validate" value="<?= $product->product_description ?>">
	          		<label for="description">Descripcion</label>
				</div>
				<div class="input-field col s12">
					<input class="btn-large col s12 purple darken-2" type="submit" value="Actualizar">
				</div>
			</form>
		</div>
	</div>
</section>