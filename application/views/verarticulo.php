    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> <?= (isset($title)?$title:'') ?></h3>
      <div class="form-panel">
              <div class=" form cmxform form-horizontal style-form">
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Descripcion</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="articulodesc" name="articulodesc" minlength="2" type="text" readonly="" value="<?= $articulo['articulodesc'] ?>" >
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">Precio</label>
                    <div class="col-lg-4">
                      <input class="form-control " id="articuloprecio"" type="number" step="0.10" name="articuloprecio" readonly="" value="<?= $articulo['articuloprecio'] ?>" >
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">Imagen</label>
                    <div class="col-lg-10">
                      <?php if ($articulo['articuloimg'] == ''){ ?>
                        <img class="fileupload-new thumbnail" style="width: 200px;height: 150px;" src="<?=base_url().'/img/noimage.png'?>" alt="Sin Imagen">
                      <?php }else{ ?>
                        <img class="fileupload-new thumbnail" src="<?=base_url().'/img/products/'.$articulo['articuloimg']; ?>" alt="Sin Imagen">
                      <?php } ?>
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <a href="<?= base_url();?>index.php/cila" class="btn btn-danger" type="button"><i class="fa fa-times"> </i> Cerrar</a>
                    </div>
                  </div>
              </div>
            </div>      
     </section>
    </section>
    <!--main content end-->
<script>
$(document).ready(function(){
    
});
</script>
 