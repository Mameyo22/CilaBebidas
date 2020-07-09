

    <!-- **********************************************************************************************************************************************************
        Por defecto se muestra la lista de precios
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> <?= $title ?></h3>      
      
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
                    <div class="btn-group">
                        <button type="button " class="btn btn-default btn-sm btn-theme"><i class="fa fa-search"></i> Ver   </button>
                        <button type="button" class="btn btn-default btn-sm btn-theme04"><i class="fa fa-shopping-cart"></i> Agregar</button>
                    </div>
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
 