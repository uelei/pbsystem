<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link type="text/css" href="<?=base_url()?>css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet" />

<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap.js"></script>

<script type="text/javascript" >
					 	


			$(document).ready(function(){
				 	$(".data").datepicker({
						dateFormat: 'dd/mm/yy',
						dayNames: ['Domingo','Segunda','TerÃ§a','Quarta','Quinta','Sexta','SÃ¡bado','Domingo'],
						dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
						dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','SÃ¡b','Dom'],
						monthNames: ['Janeiro','Fevereiro','MarÃ§o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
						monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
						nextText: 'PrÃ³ximo',
						prevText: 'Anterior'
					});

				 	// $("#datai").change(function(){
				 	// 	var data  = $("#datai").val();
				 	// 	$("#dataf").val(data);
				 	// });





			});
		


</script>


<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Creditos a Compensar !</h3>
	  </div>
	  <div class="panel-body">

<div class="row">
	<?php echo form_open('bills/cartaoajuste'); ?>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<label for="datai">Data inicial:</label>
			<input type="text" name="datai" id="datai" class="form-control data" value="<?php echo implode("/",array_reverse(explode("-",$datai))); ?>" required="required"  title="">
	</div>
		  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

	<label for="dataf">Data Final: </label>
	<input type="text" name="dataf" id="dataf" class="form-control data" value="<?php echo implode("/",array_reverse(explode("-",$dataf))); ?>" required="required" title="">
			  </div>

<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><br>
	<button type="submit" class="btn btn-default">Seleciona</button>
</div>

<?php echo form_close(); ?>
</div>
	  </div>   <!-- fim div panel body -->

  <table class="table">
<thead>
 	<th>cod</th>
	<th>rv numero</th>
	<th>valor</th>
</thead>
<!-- number_format($val2,2,",","."); -->
<?php 

echo form_open('bills/cartaodo');
$t = 0.00;

// print_r($creditos);
if(is_array($creditos)){
foreach ($creditos as $cd) {

echo "<tr>";
echo "<td>".$cd->im."</td>
<td> Rv : ".$cd->n_doc."</td>
<td>".number_format($cd->valor_efe,2,",",".")."</td>";
$t= $t + number_format($cd->valor_efe,2,".",".");

echo '<input type="hidden" name="'.$cd->im.'" id="'.$cd->im.'" class="form-control" value="'.number_format($cd->valor_efe,2,".",".").'">';

echo "</tr>";

}

}


 ?>



 </table>
	  <div class="panel-footer">
		 Total dos Rvs : <?php echo number_format($t,2,",",".");  ?>  

<input type="submit" class="btn btn-default" label="Gravar" ><?php echo form_close(); ?>

		</div>


</div>

