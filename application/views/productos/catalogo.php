<nav class="purple darken-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url()?>panel" class="breadcrumb">Inicio</a>
        <a href="#!" class="breadcrumb">Catálogo</a>
      </div>
    </div>
</nav>
<section class="container"> 
    <div class="row">
        <?php if($products != false){foreach ($products->result() as $product) { ?>              
        <div class="col s12 m6 l3">
            <div class="card">
              <div class="card-image">
                <img src="data:image/jpeg;base64,<?= $product->product_image ?>"> 
                <span class="card-title purple-text"><?= $product->product_name ?></span>
              </div>
              <div class="card-content">
                <p><?= $product->product_description ?></p>
              </div>
            </div>
        </div>
        <?php }}else{  ?>
          
        <?php } ?>
    </div>
</section>
<div class="fixed-action-btn">
    <a href="productos/nuevo" class="btn-floating btn-large waves-effect waves-light purple lighten-1"><i class="material-icons">add</i></a>
</div>