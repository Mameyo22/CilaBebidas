<!--main content start-->
	<section id="main-content">
    	<section class="wrapper">
			<h3>Detalle de la Compra</h3>
			<div class="col-md-6">
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
							<td><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></td>
						</tr>
						<?php } ?>
						
						</tbody>
					</table>
					
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-panel">
					<h4>Compra </h4>
					<h3>Total  $ <?= number_format($total,2) ?> </h3>
				</div>
			</div>
		</section>
	</section>
