<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link type="text/css" href="<?=base_url()?>css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet" />

<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap.js"></script>



<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Relat&oacute;rio de Meias !</h3>
	  </div>
	  <div class="panel-body">

<div class="row">
	<?php echo form_open('venda/sockreport'); ?>
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
<div class="row">
	

<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	
</div>
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	

  <table class="table">
<thead>
 	<th>cod</th>
	<th>quantidade</th>
	<th>Total</th>
</thead>

<?php

$tt=0;

if(is_array($meias)){
	foreach ($meias as $cd) {
		$i=0;
		$n ="";
		//loop array
		foreach ($tsock[$cd] as $k => $v) {
			$s[$i]= $v; 
			$i++;
			// echo($v);
		}

		if(is_numeric($s[1])){ $n = number_format($s[1],2,",",".") ;}else{$n="";}

		echo "<tr>";
		echo "<td>".$cd."</td>";
		echo "<td>".$s[0]."</td>";
		echo "<td>".$n."</td>";
		echo "</tr>";
		$tt = $tt + $s[1];


	}


}


?>

</table>
</div>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	
</div>
</div>

<div class="row">  	
   <div class="panel-footer">
	 Total das Vendas de Meias : <?php echo number_format($tt,2,",",".");  ?>  
	</div>
</div>












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
});
</script>