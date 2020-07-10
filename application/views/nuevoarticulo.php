    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> <?= $title ?></h3>
      <div class="form-panel">
              <div class=" form">
                <form class="cmxform form-horizontal style-form" id="commentForm" method="get" action="">
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Descripcion (requerido)</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="articulodesc" name="articulodesc" minlength="2" type="text" required="">
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">Precio (requerido)</label>
                    <div class="col-lg-4">
                      <input class="form-control " id="articuloprecio"" type="number" name="articuloprecio" required="">
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">Codigo de Barras (opcional)</label>
                    <div class="col-lg-10">
                      <input class="form-control " id="articulosbarcode" type="text" name="articulosbarcode">
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">Imagen (opcional)</label>
                    <div class="col-lg-10">
                      <button  class="btn btn-info"><i class="fa fa-upload"> </i> Subir</button>
                      <img src="" alt="imagen" >
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-success" type="submit"><i class="fa fa-save"> </i> Guardar</button>
                      <button class="btn btn-danger" type="button"><i class="fa fa-times"> </i> Cancelar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>      
     </section>
    </section>
    <!--main content end-->
<script>
$(document).ready(function(){
    
});
</script>
 