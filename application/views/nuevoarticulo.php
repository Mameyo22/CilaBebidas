    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
      <h1><?php 
        if (isset($error)){
          print_r($error);
        }
      ?></h1>
      <h3><i class="fa fa-angle-right"></i> <?= (isset($title)?$title:'') ?></h3>
      <div class="form-panel">
              <div class=" form">
                <?php echo validation_errors(); ?>
                <?= form_open('cila/nuevoarticulo',array('class' => "cmxform form-horizontal style-form",'enctype'=>"multipart/form-data" )); ?>
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Descripcion (requerido)</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="articulodesc" name="articulodesc" minlength="2" type="text" required="">
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">Precio (requerido)</label>
                    <div class="col-lg-4">
                      <input class="form-control " id="articuloprecio"" type="number" step="0.10" name="articuloprecio" required="">
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">Codigo de Barras (opcional)</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="articulobarcode" type="text" name="articulobarcode">
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">Imagen (opcional)</label>
                    <div class="col-lg-10">
                      <input type="file" name="articuloimg" id="articuloimg" class="btn btn-info">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-success" type="submit"><i class="fa fa-save"> </i> Guardar</button>
                      <a href="<?= base_url();?>index.php/cila/articulos" class="btn btn-danger" type="button"><i class="fa fa-times"> </i> Cancelar</a>
                    </div>
                  </div>
                <?= form_close(); ?>
              </div>
            </div>      
     </section>
    </section>
    <!--main content end-->
<script>
$(document).ready(function(){
    
});
</script>
 