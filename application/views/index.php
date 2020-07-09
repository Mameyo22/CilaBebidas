

    <!-- **********************************************************************************************************************************************************
        Por defecto se muestra la lista de precios
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> <?= $title ?></h3>      
            <input type="search" id="searchtext" placeholder="Ingrese el texto a buscar ..." class="form-control">
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
                            <button type="button " class="btn btn-default" data-toggle="tooltip" title="Ver Detalle"><i class="fa fa-search"></i> </button>
                            <button type="button" class="btn btn-success" data-toggle="tooltip" title="Agregar a Carrito"><i class="fa fa-shopping-cart"></i></button>
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
    var arttable = $('#arttable').DataTable({
        dom: 'Brtip',
        buttons: ['copy', 'excel', 'pdf', 'print']        
        
    });
    $('.dataTables_filter input').hide();
    //Busqueda
    $('#searchtext').keyup(function(){
      arttable.search($(this).val()).draw() ;
    });
    //Llevar el foco al inicio
    $('#searchtext').focus();

});
</script>
 