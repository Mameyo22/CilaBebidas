

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
					<th>BarCode</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php foreach($articulos as $articulo){ ?>
                    <tr>
                        <td><?= $articulo['articuloid']; ?></td>
                        <td><?= $articulo['articulodesc']; ?></td>
                        <td><?= $articulo['articuloprecio']; ?></td>
						<td><?= $articulo['articulobarcode']; ?></td>
                        <td>
                            <a href="<?= base_url(); ?>index.php/cila/viewarticulo/<?= $articulo['articuloid']; ?> "> <button type="button " class="btn btn-default" data-toggle="tooltip" title="Ver Detalle"><i class="fa fa-search"></i> </button></a>
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
        buttons: ['copy', 'excel', 'pdf', 'print'],
		"columnDefs": [
            {
                "targets": [ 3 ],
                "visible": false
            }
        ]       
        
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
 