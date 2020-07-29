

    <!-- **********************************************************************************************************************************************************
        Por defecto se muestra la lista de precios
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> <?= $title ?></h3>      
        <a href="<?= base_url();?>index.php/cila/nuevoarticulo" ><button type="button" class="btn btn-primary" data-toggle="tooltip" title="Nuevo"> Nuevo </button></a>
      <hr>
        <table id="arttable" class="display">
            <thead>
                <th>Descripcion</th>
                <th>Precio</th>
                <th></th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php foreach($articulos as $articulo){ ?>
                <tr>
                    <td><?= $articulo['articulodesc']; ?></td>
                    <td style="text-align: right;"><?= $articulo['articuloprecio']; ?></td>
                    <td>
                    <?php if ($articulo['articuloimg'] == ''){ ?>
                        <img class="img-product" src="<?=base_url().'/img/noimage.png'?>" alt="Sin Imagen">
                      <?php }else{ ?>
                        <img class="img-product" src="<?=base_url().'/img/products/'.$articulo['articuloimg']; ?>" alt="Sin Imagen">  </td>
                      <?php } ?>
                    <td>
                        <a href="<?= base_url(); ?>index.php/cila/editarticulo/<?= $articulo['articuloid']; ?> ">
                            <button type="button" class="btn btn-success" title="Editar"><i class="fa fa-edit"></i></button>
                        </a>
                        <button type="button" class="btn btn-danger btn_dlt" title="Eliminar" data-id="<?= $articulo['articuloid'];?>"  data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
     </section>
    </section>
    <!--main content end-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Eliminar Artículo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    Esta seguro de eliminar este artículo?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="eliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>        

<script>
$(document).ready(function(){
    var id = 0;
    $('#arttable').DataTable();

     $('.btn_dlt').click(function(){
        //obtener el id
        id = $(this).attr('data-id');
    });
    //Eliminar articulo
    $("#eliminar").click(function(){
        $.post("<?= base_url();?>index.php/cila/deletearticulo/",{articuloid:id}).done(function(data){
                console.log(data);
            });
        //Ocultar modal
        $("#myModal").modal('hide');
        //Refrescar tabla
        location.reload();
    });
});
</script>
 