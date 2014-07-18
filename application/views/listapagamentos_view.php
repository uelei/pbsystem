<br>
<table class="table table-hover">
					<thead>
						<th>i</th>
						<th>tipo</th>
						<th>valor</th>
					</thead>
					<tbody>
					<?php 


					if (is_array($ls))
{
						foreach ($ls as $key) {
							echo "<tr>";
							echo "<td>";
echo '<button id="';
echo $key['im'];
echo '" class="deletepagamento btn btn-danger glyphicon glyphicon-remove ">';
//echo $key['order_product_id'];
echo "</button>";

							echo "</td>";						
							echo "<td>";
							echo $key['descricao_t_pag'];
							echo "</td>";
							// echo "<td>";
							// echo $key['valor_ori'];
							// echo "</td>";
							// echo "<td>";
							// echo $key['quantity'];
							// echo "</td>";
							echo "<td>";
							echo number_format(floatval($key['valor_ori']), 2, ',', '.');
							echo "</td>";
							// echo "<td>";
							// echo number_format(floatval($key['total']), 2, ',', '.');
							// echo "</td>";
							echo "</tr>";
						}  }?>

				</tbody>
				</table>
<input type="hidden" name="somapg" id="somapg" class="form-control" value="<?php echo $somapg; ?>">