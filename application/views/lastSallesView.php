<div class="row">
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">	
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Ultimas Vendas</h3>
	  </div>
	  <div class="panel-body">
			<table class="table table-hover">
			<thead>
				<tr>
					<th>Id</th>
					<th>Vendedor</th>
					<th>Total</th>
					<th>Data</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($ultimasVendas as $uv) {
					echo "<tr>";
					echo "<td>";
					echo '<a href="http://pbs.piubol.com.br/index.php/venda/rv?rv='.$uv->order_id.'">'.$uv->order_id.'</a>';
					echo "</td>";
					echo "<td>";
					echo $uv->affiliate_id;
					echo "</td>";
					echo "<td>";
					echo number_format($uv->total,2,",",".");
					echo "</td>";
					echo "<td>";
					$d = explode(" ",$uv->date_added);
					echo implode("/",array_reverse(explode("-",$d[0])));
					echo "</td>";
					echo "</tr>";
				} ?>
			</tbody>
		</table>
	  </div>
</div>
















	</div>
</div>