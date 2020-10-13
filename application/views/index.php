

    <!-- **********************************************************************************************************************************************************
        Por defecto se muestra la lista de precios
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <section id="cart-shop">
                <h1>Compra Actual</h1>
        </section>
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
                        <td><a href="<?= base_url(); ?>index.php/cila/viewarticulo/<?= $articulo['articuloid']; ?> "><?= $articulo['articulodesc']; ?> </a></td>
                        <td><?= $articulo['articuloprecio']; ?></td>
						<td><?= $articulo['articulobarcode']; ?></td>
                        <td>
                            
                            <input type="number" name="cant" id="cant_<?= $articulo['articuloid'] ?>" value="1" min="1" class="inputcantidad">
                            <button type="button" class="btn btn-success btn_cart" data-toggle="tooltip" title="Agregar a Carrito" id="add" data-id="<?= $articulo['articuloid'] ?>"><i class="fa fa-shopping-cart"></i></button>
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
	var articuloid= 0;
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


	//TODO No pedir aca la cantidad, sino mostrar un modal donde se pida la cantidad y la confirmacion

	//Carrito de Compras
	$('.btn_cart').click(function(){
        //obtener el id
		articuloid = $(this).attr('data-id');
		//Obtener la cantidad
		var cantidad = $('#cant_'+articuloid).val()
		console.log(articuloid+ ' ' + cantidad);

		//llamar a la carga del carrito
    });

});
</script>
 