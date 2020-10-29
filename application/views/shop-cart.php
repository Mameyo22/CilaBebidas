<!--main content start-->
	<section id="main-content">
    	<section class="wrapper">
			<h3>Detalle de la Compra</h3>
			<div class="col-md-8">
				<div class="content-panel">
					<h4>Items</h4>
					<table id="carrito" class="display table table-striped table-advance table-hover" style="width:100%">
						<thead>
							<th>Cantidad</th>
							<th>Articulo</th>
							<th>Precio U</th>
							<th>Total</th>
							<th>Acciones</th>
						</thead>
						<tbody>
						<?php 
						$total=0;
						foreach($carrito as $item){ 
							$total += $item['cantidad'] * $item['articuloprecio'];
						?>
						<tr>
							<td><?= $item['cantidad'] ?></td>
							<td><?= $item['articulodesc'] ?></td>
							<td>$ <?= number_format($item['articuloprecio'],2) ?></td>
							<td>$ <?= number_format($item['cantidad'] * $item['articuloprecio'],2) ?></td>
							<td><button class="btn btn-danger btn_dlt" data-id="<?= $item['carritoitem'] ?>"><i class="fa fa-trash"></i> </button></td>
						</tr>
						<?php } ?>
						
						</tbody>
					</table>
					
				</div>
			</div>
			<div class="col-md-4">
				<div class="showback">
					<h4>Compra </h4>
					<div class="form-group ">
                    	<label for="total" class="control-label ">Total a Pagar</label>
                   		<input type="text" class="form-control" id="total" value="<?= $total ?> " readonly>
                    </div>
					<div class="form-group ">
                    	<label for="pago" class="control-label ">Su Pago</label>
                      	<input type="number" class="form-control danger" id="pago" min=0.00 value="0">
                    </div>
					<div class="form-group ">
                    	<label for="vuelto"  id="labelvuelto" class="control-label ">Resta Pagar</label>
                      	<input type="text" class="form-control red" id="vuelto"  value="<?= $total ?> " readonly>
                    </div>
					<button class="btn btn-success btn-lg" id="fincompra">
							Finalizar Compra
                	</button>
				</div>

			</div>
		</section>
	</section>
<script>
$(document).ready(function(){
	var id = 0;
	var total =  $('#total').val();
	var pago = 0;
	var vuelto = total;

	$('.btn_dlt').click(function(){
        //obtener el id
        id = $(this).attr('data-id');
		console.log('Id a eliminar' + id);
		//eliminar el articulo
		$.post("<?= base_url();?>index.php/cila/del_to_cart/"+id).done(function(data){
                 console.log(data);
			 });
		location.reload();
	});
	
	$('#pago').change(function(){
		pago = $(this).val();
		 vuelto = total - pago;
		console.log('total '+ total);
		if (total > pago){
			$('#labelvuelto').html('Resta Pagar');
			$('#vuelto').val(vuelto);
		}else{
			$('#labelvuelto').html('Vuelto');
			$('#vuelto').val(vuelto * -1);
		}
	});

	$('#fincompra').click(function(){
		//validar que no haya resto a pagar
		if (total > pago){
			alert('completar el Pago');
		}else{
			//TODO pasar el nro de user
			$.post("<?= base_url();?>index.php/cila/clear_cart/").done(function(data){
                 console.log(data);
			 });
			location.reload();
		}

	});
});
</script>