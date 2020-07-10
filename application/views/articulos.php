

    <!-- **********************************************************************************************************************************************************
        Por defecto se muestra la lista de precios
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> <?= $title ?></h3>      
        <a href="<?= base_url();?>index.php/cila/nuevoarticulo" ><button type="button" class="btn btn-default" data-toggle="tooltip" title="Nuevo"> Nuevo </button></a>
      <hr>
        <table id="arttable" class="display">
            <thead>
                <th>Código</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php foreach($articulos as $articulo){ ?>
                <tr>
                    <td><?= $articulo['articuloid']; ?></td>
                    <td><?= $articulo['articulodesc']; ?></td>
                    <td><?= $articulo['articuloprecio']; ?></td>
                    <td>
                        <button type="button " class="btn btn-info" data-toggle="tooltip" title="Ver Detalle"><i class="fa fa-search"></i> </button>
                        <button type="button" class="btn btn-success" data-toggle="tooltip" title="Editar"><i class="fa fa-edit"></i></button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
     </section>
    </section>
    <!--main content end-->
<script>
$(document).ready(function(){
    $('#arttable').DataTable();
});
</script>
 