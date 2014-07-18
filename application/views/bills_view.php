<html>
<head>
	<title>bills</title>

<link type="text/css" href="<?=base_url()?>css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet" />

<script type="text/javascript" src="<?=base_url();?>/../js/jquery-1.9.1.js"> </script>
<script src="<?=base_url()?>/../js/jquery-ui-1.10.3.js"></script>


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

				 	$("#datai").change(function(){
				 		var data  = $("#datai").val();
				 		$("#dataf").val(data);
				 	});





			});
		


</script>

</head>
<body>




<div class="panel">
  <!-- Brand and toggle get grouped for better mobile display -->

	<?php echo validation_errors(); ?>
	<?php echo form_open('bills/datafind'); ?>
	<div class="form-group">
		<div class="col-lg-2">
			<label for="datai" >data inicial :</label>
			<input type="text" class="data form-control" id="datai" name="datai" value="<?php echo implode("/",array_reverse(explode("-",$datai))); ?>" >
		</div>
		<div class="col-lg-2">
			<label for="dataf" >data final :</label>
			<input type="text" class="data form-control" id="dataf" name="dataf" value="<?php echo implode("/",array_reverse(explode("-",$dataf))); ?>" >
		</div>
		<div class="hidden">
			<label>situacao :</label>
			<input type="checkbox" name="pago" <?php if($pg){ }  ?> >   
		</div>
		<div class="col-lg-2"><br>
		<button type="submit" id="sb" class="btn btn-default btn-primary" > Seleciona</button>
		</div>
		<div class="navbar-right">
			<a href="<?php echo site_url(); ?>/bills/newbill" class="btn btn-lg btn-default" ><span class="glyphicon glyphicon-plus"></span> Novo</a>
		</div><br><br><br>
</div>
</div>
</div></div>




<div class="container"> 
<div class="panel panel-default" >
	<div class="panel-heading">Duplicatas </div>


<table class="table table-hover" >
	<thead>
<tr>
<th WIDTH="40" >id Duplicata</th>
<th>F Pg</th>
<th>tipo doc</th>
<th>data</th>
<th>cedente</th>
<th>valor</th>
<th>Parcela</th>
<th>status </th>
</tr>
	</thead>

<tbody>








<?php 
$ct=0.00;
$dt=0.00;
$dpa=0.00;
$dpp=0.00;

if($tem){
	foreach ($duplicatas as $dp) {


		if($dp->tipo_doc=='14'){
		//credito de vendas => somar 
			if($dp->tipo_pag=='11'){

				$dt= $dt + $dp->valor_efe;
			}else{

				$ct= $ct + $dp->valor_efe;
			}



		}else {
		//contas e outros tipos 
			if($dp->situacao=='19'){
			//contas pagas
				$dpp= $dpp +($dp->valor_efe*-1);

				echo '<tr class="success" >';

echo '<td><a href="'.site_url().'/bills/bill/?acao=EDITAR&dup='.$dp->im.'">'.$dp->im.'</a></td>';
echo "<td>".$dp->descricao_t_pag."</td>";
echo "<td>".$dp->descricao_t_doc."</td>";
echo "<td>".implode("/",array_reverse(explode("-",$dp->data_venc)))."</td>";
echo "<td>";
if($dp->manufacturer_id==1){echo $dp->desc_d_desp;}else{echo $dp->forn_name;}
echo "</td>";echo "<td>";
if (stripos($dp->valor_ori,'-')===false ){
echo $dp->valor_ori ;}else{ echo '<span style="color:red">'.$dp->valor_efe.'</span>'; }
echo "</td>";
echo "<td>".$dp->parcela."</td>";
echo "<td>".$dp->name."</td>";


echo "</tr>";








			}else{
			//contas a pagar
				$dpa =$dpa + $dp->valor_ori;

			echo "<tr>";
echo '<td><a href="'.site_url().'/bills/bill/?acao=EDITAR&dup='.$dp->im.'">'.$dp->im.'</a></td>';
echo "<td>".$dp->descricao_t_pag."</td>";
echo "<td>".$dp->descricao_t_doc."</td>";
echo "<td>".implode("/",array_reverse(explode("-",$dp->data_venc)))."</td>";
echo "<td>";
if($dp->manufacturer_id==1){echo $dp->desc_d_desp;}else{echo $dp->forn_name;}
echo "</td>";echo "<td>";
if (stripos($dp->valor_ori,'-')===false ){
echo $dp->valor_ori ;}else{ echo '<span style="color:red">'.$dp->valor_ori.'</span>'; }
echo "</td>";
echo "<td>".$dp->parcela."</td>";
echo "<td>".$dp->name."</td>";


echo "</tr>";




			}




			}


















	}


 }


echo '<tr  class="success" >
<td>-</td>
	<td>-</td>
	<td>-</td>
	<td> Data</td>
	<td>Duplicatas pagas </td>
	<td>'.number_format($dpp,2,",",".").'</td>
	<td>x/x</td>
	<td>-</td></tr>';
echo '<tr  class="danger" >
<td>-</td>
	<td>-</td>
	<td>-</td>
	<td> Data</td>
	<td>Duplicatas em aberto </td>
	<td>'.number_format($dpa,2,",",".").'</td>
	<td>x/x</td>
	<td>-</td></tr>';

echo '<tr  class="success" >
<td>-</td>
	<td>-</td>
	<td>-</td>
	<td> Data</td>
	<td>Cretidos de Vendas  Dinheiro </td>
	<td>'.number_format($dt,2,",",".").'</td>
	<td>x/x</td>
	<td>-</td></tr>';
echo '<tr  class="warning" >
<td>-</td>
	<td>-</td>
	<td>-</td>
	<td> Data</td>
	<td>Cretidos de Vendas Cart&atilde;o</td>
	<td>'.number_format($ct,2,",",".").'</td>
	<td>x/x</td>
	<td>-</td></tr>';









?>



  


</tbody>

</table>

</div>




</div>
</div>

</body>
</html>