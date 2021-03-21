<!--main content start-->
	<section id="main-content">
    	<section class="wrapper">
			<h3>Venta</h3>
			<div class="col-md-8">
				<div class="">
					<input type="search" class="form-control" name="searchtext" id="searchtext" placeholder="utilice el lector de barras">
				</div>
				<br>
			</div>
			<div class="col-md-8">
				<div class="showback ">
					<h4>Items</h4>
					<table id="carrito" class="display table table-striped table-advance table-hover" style="width:100%">
						<thead>
							<th>Cantidad</th>
							<th>Articulo</th>
							<th>Precio U</th>
							<th>Total</th>
							<th>Acciones</th>
						</thead>
						<tbody id="body">
						<!-- se llena con ajax -->
						</tbody>
					</table>
					
				</div>
			</div>
			<div class="col-md-4">
				<div class="showback">
					<h4>Pago </h4>
					<div class="form-group ">
                    	<label for="total" class="control-label ">Total a Pagar</label>
                   		<input type="text" class="form-control" id="total" value="0.00" readonly>
                    </div>
					<div class="form-group ">
                    	<label for="pago" class="control-label ">Su Pago</label>
                      	<input type="number" class="form-control danger" id="pago" min=0.00 value="0">
                    </div>
					<div class="form-group ">
                    	<label for="vuelto"  id="labelvuelto" class="control-label ">Resta Pagar</label>
                      	<input type="text" class="form-control red" id="vuelto"  value="0.00" readonly disabled="true">
						<input type="hidden" naem="userid" id="userid" value="<?=  $userid = $_SESSION['logged_in']['userid']; ?>">
                    </div>
					<button class="btn btn-success btn-lg" id="fincompra" disabled>Finalizar Compra</button>
					<button class="btn btn-danger btn-lg" id="vaciar" >Eliminar</button>
				</div>

			</div>
		</section>
	</section>
<script>
$(document).ready(function(){
	var id = 0;
	var total =  0;
	var pago = 0;
	var vuelto = total;
	var userid = $('#userid').val();
	var cantidad = 0;
	 //Llevar el foco al inicio
	$('#searchtext').focus();

	function table_reload(){
		//Obtiene el carrito y actualiza la tabla
		$.get("<?= base_url();?>index.php/cila/ajax_cart",function(data){
			var response = JSON.parse(data);
			total = 0.00;
			var html = "";
			var i;
			for(i=0; i < response.length; i++){
				//Cantidad, Articulo, Precio U, Total, Acciones
				html += '<tr><td>'+ response[i].cantidad  + '</td><td>' + response[i].articulodesc  + '</td><td>$ '+ response[i].articuloprecio +'</td>';
				html += '<td>$ '+ eval(response[i].cantidad*response[i].articuloprecio)  +'</td>';
				html += '<td><button class="btn btn-default btn_sust" data-id="'+ response[i].carritoitem + '" data-cant="' + response[i].cantidad +'" title="Disminuir Cantidad"><i class="fa fa-minus"></i></button>';
				html += '<button class="btn btn-default btn_add" data-id="'+ response[i].carritoitem + '" data-cant="'+ response[i].cantidad+'" title="Aumentar Cantidad"><i class="fa fa-plus"></i></button>';
				html += '&nbsp;| &nbsp;';
				html += '<button class="btn btn-danger btn_dlt" data-id="'+ response[i].carritoitem + '" title="Eliminar"><i class="fa fa-trash"></i> </button>';
				html += '</td></tr>';
				
				//Total
				total += eval(response[i].cantidad*response[i].articuloprecio);
			}
			$('#body').html(html);
			$('#total').val(total);
		});
	}

	table_reload();

	//Borrar Articulo 
	$('.btn_dlt').click(function(){
        //obtener el id
        id = $(this).attr('data-id');
		console.log('Id a eliminar' + id);
		//eliminar el articulo
		$.post("<?= base_url();?>index.php/cila/del_to_cart/"+id).done(function(data){
                 console.log(data);
			 });
		location.reload(true);
	});

	//Cambio de pago
	$('#pago').change(function(){
		total =  $('#total').val();
		pago = $(this).val();
		vuelto = total - pago;
		console.log('total '+ total + ' vuelto: ' + vuelto);
		if (eval(total) > eval(pago)){
			$('#labelvuelto').html('Resta Pagar');
			$('#vuelto').val(vuelto);
			$('#fincompra').attr('disabled',true);
		}else{
			$('#labelvuelto').html('Vuelto');
			$('#vuelto').val(vuelto * -1);
			$('#fincompra').attr('disabled',false);
		}
	});

	//Finalizar Compra
	$('#fincompra').click(function(){
		//validar que no haya resto a pagar
		if (eval(total) > eval(pago)){
			alert('completar el Pago');
		}else{

			$.post("<?= base_url();?>index.php/cila/clear_cart/"+userid).done(function(data){
                 console.log(data);
			 });
			table_reload();
		}

	});

	//Eliminar Compra
	$('#vaciar').click(function(){
			$.post("<?= base_url();?>index.php/cila/clear_cart/"+userid).done(function(data){
                 console.log(data);
			 });
			table_reload();
	});

	//agregar añ carrito
	$('#searchtext').change(function(){
		var barcode = $(this).val();
		console.log(barcode);
	
		//Llamar al ajax que agregue un item al carrito
		$.post("<?= base_url();?>index.php/cila/add_to_cart_bc/"+userid+"/"+barcode+"/1",function(data,status) {
			console.log(response.descripcion);
		});
		table_reload();		
	});
	
	//cambiar cantidad
	$('.btn_sust').click(function(){
		id = $(this).attr('data-id');
		var cantidad = eval($(this).attr('data-cant'));
		if (cantidad > 1){
			cantidad--;
			console.log(id + ' -> ' +cantidad);
			$.post("<?= base_url();?>index.php/cila/upd_to_cart/"+id+"/"+cantidad).done(function(data){
				console.log(data);
			});
		}
		table_reload();
	});

	$('.btn_add').click(function(){
		id = $(this).attr('data-id');
		var cantidad = eval($(this).attr('data-cant'));
		cantidad++;
		console.log(id + ' -> ' +cantidad);
		$.post("<?= base_url();?>index.php/cila/upd_to_cart/"+id+"/"+cantidad).done(function(data){
				console.log(data);
			});
		table_reload();
	});
	


});
</script>