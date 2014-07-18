<html>
<head>
	<title></title>
</head>
<body>
<div class="content">

		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<div class="form-group">
					<label for="busca_string" class="control-label" > Buscar :</label>
					<input id="busca_string" class="form-control" value="" pattern="\d*" ></input>
				</div>
			</div>
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<label for="descp" class="control-label" > Descricao :</label>
				<input id="descp" class="form-control" value="" ></input>
			</div>	
		</div>
	
		<div class="rows">
		
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
				<input type="hidden" id="cod" ></input>
				<input type="hidden" id="mais"></input>
			</div>
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				<div class="row">
				<br>
					<label for="qtd" class="control-label" >Qtd :</label>
					<input id="qtd" class="form-control" value="1" pattern="\d*"></input>
				</div>
				<div class="row">
					<label for="preco" class="control-label" >Preco :</label>
					<div class="input-group">
					<span class="input-group-addon">$</span>
					<input id="preco" class="form-control" pattern="\d*" ></input></div>
				</div>

				<div class="row">

					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"> 
						<br><button id="btadd" class="btn btn-default">Ok</button>
					 </div>
					 <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
				</div>
			</div>
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" id="produtos" style="overflow:auto;height:49%;">

<br>

<table class="table table-hover">
					<thead>
						<th>i</th>
						<th>Codigo</th>
						<th>Descri&ccedil;&atilde;o</th>
						<th>Qtd</th>
						<th>Pre&ccedil;o</th>
						<th>Sub Total</th>
					</thead>
					<tbody>
					<?php 
							if (isset($ls)) {

								# code...
							if($ls){

						foreach ($ls as $key) {
							echo "<tr>";
							echo "<td>";


echo '<button id="';
echo $key['order_product_id'];
echo '" class="deleteproduto btn btn-danger glyphicon glyphicon-remove">';
//echo $key['order_product_id'];
echo "</button>";


							// echo '<a href="';
							// echo $key['order_product_id'];
							// echo '" class="deleteproduto">';
							// echo $key['order_product_id'];
							// echo "</a>";





							echo "</td>";						
							echo "<td>";
							echo $key['product_id'];
							echo "</td>";
							echo "<td>";
							echo $key['name'];
							echo "</td>";
							echo "<td>";
							echo $key['quantity'];
							echo "</td>";
							echo "<td>";
							echo number_format(floatval($key['price']), 2, ',', '.');
							echo "</td>";
							echo "<td>";
							echo number_format(floatval($key['total']), 2, ',', '.');
							echo "</td>";
							echo "</tr>";
						}}
						}?>

				</tbody>
				</table>





			</div>
		

	</div>
	
	
	
	
	
	</div>
	
</div>
</body>
</html>

