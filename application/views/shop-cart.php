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
						<!-- se llena con jquery -->
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

    function refresh_icon_cart(){
    	//Actualizar el icono del carrito
      	var html="";
	  	//Obtener el detalle del carrito
		$.when($.get("<?= base_url();?>index.php/cila/ajax_cart")).then(function(data){
			var response = JSON.parse(data);
			$('#badge_cart').html(response.length);
			//rellenar la tabla detalle
			var i;
			var total = 0;
			
			for(i=0; i < response.length; i++){
						
			total += response[i].cantidad * response[i].articuloprecio;

						html += '<li>';
						html += '<a href="<?= base_url();?>index.php/cila/view_cart">';
						html += '<div class="task-info">';
						html += '<div class="desc">'+ response[i].cantidad +' -  '+ response[i].articulodesc +'</div>';
						html += '<div class="percent">  $ '+ response[i].cantidad * response[i].articuloprecio +' </div>'
						html += '</div>';
						html += '</a></li>';

			}
			$('#detalle').html(html);
			$('#totalH').html(parseFloat(total).toFixed(2));

		});
	}

	function calcular_vuelto(){
		total =  $('#total').val();
		pago = $('#pago').val();
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
	}

	function table_reload(){
		//Obtiene el carrito y actualiza la tabla
		var html = "";
		$.when($.get("<?= base_url();?>index.php/cila/ajax_cart")).then(function(data){
			var response = JSON.parse(data);
			console.log(response);
			total = 0.00;
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
			$('#total').val(parseFloat(total).toFixed(2));
			refresh_icon_cart();
			calcular_vuelto();
		});
	}

	table_reload();
	
	//Borrar Articulo 
	$('#body').on('click','.btn_dlt',function(){

        //obtener el id
        id = $(this).attr('data-id');
		console.log('Id a eliminar' + id);
		//eliminar el articulo
		$.when($.post("<?= base_url();?>index.php/cila/del_to_cart/"+id)).then(function(data){
                 console.log('eliminado');
				 table_reload();
		});
	});

	//Cambio de pago
	$('#pago').change(function(){
		calcular_vuelto();
	});

	//Finalizar Compra
	$('#fincompra').click(function(){
		//validar que no haya resto a pagar
		if (eval(total) > eval(pago)){
			alert('completar el Pago');
		}else{

			$.when($.post("<?= base_url();?>index.php/cila/clear_cart/"+userid)).then(function(data){
                 console.log(data);
				 table_reload();
			 });
			$('#pago').val(0.00);
			$('#vuelto').val(0.00);
		}

	});

	//Eliminar Compra
	$('#vaciar').click(function(){
		$.when($.post("<?= base_url();?>index.php/cila/clear_cart/"+userid)).then(function(data){
            console.log(data);
			table_reload();
		});
		$('#pago').val(0.00);
		$('#vuelto').val(0.00);
	});

	//agregar al carrito
	$('#searchtext').change(function(){
		var barcode = $(this).val();
		console.log(barcode);
		$(this).val('');
		//Llamar al ajax que agregue un item al carrito
		$.when($.post("<?= base_url();?>index.php/cila/add_to_cart_bc/"+userid+"/"+barcode+"/1")).then(function(data,status) {
			console.log('Agregado');
			table_reload();		
		});

	});
	
	//cambiar cantidad
	$('#body').on('click','.btn_sust',function(){
		id = $(this).attr('data-id');
		var cantidad = eval($(this).attr('data-cant'));
		if (cantidad > 1){
			cantidad--;
			console.log(id + ' -> ' +cantidad);
			$.when($.post("<?= base_url();?>index.php/cila/upd_to_cart/"+id+"/"+cantidad)).then(function(data){
				console.log(data);
				table_reload();
			});
		}
	});

	$('#body').on('click','.btn_add',function(){
		id = $(this).attr('data-id');
		var cantidad = eval($(this).attr('data-cant'));
		cantidad++;
		console.log(id + ' -> ' +cantidad);
		$.when($.post("<?= base_url();?>index.php/cila/upd_to_cart/"+id+"/"+cantidad)).then(function(data){
				console.log(data);
				table_reload();
			});
	});
	


});
</script>