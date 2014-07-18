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


					if (is_array($ls))
{
						foreach ($ls as $key) {
							echo "<tr>";
							echo "<td>";
							echo '<button id="';
							echo $key['order_product_id'];
							echo '" class="deleteproduto btn btn-danger glyphicon glyphicon-remove ">';
							//echo $key['order_product_id'];
							echo "</button>";
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
						}  }?>

				</tbody>
				</table>
