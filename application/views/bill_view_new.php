<html>
<head>
	<title> Duplicata Detalhe</title>
</head>
<body>
<?php echo validation_errors(); ?>

<?php echo form_open('bills/update_bill'); 


		date_default_timezone_set("Brazil/East");
		$dataHora = date("Y-m-d");
?>

im :<input type="text"	value=" " name="im" >  
<br>
data Vencimento : <input type="text"	value="<?php echo implode("/",array_reverse(explode("-",$dataHora))); ?>" name="data_venc" >
<br>
tipo de operacao : <input type="text"	value="" name="tipo_ope" >  
<br>
tipo de documento : <input type="text"	value="" name="tipo_doc" > 
<br>
numero do documento : <input type="text"	value="" name="n_doc" >
<br>
valor original : <input type="text"	value="" name="valor_ori" >  
<br>
valor final : <input type="text"	value="" name="valor_efe" >
<br>
numero de opercao ou numero do cliente :<input type="text"	value="" name="n_ope_cli" > 
<br>
data final : <input type="text"	value="<?php echo implode("/",array_reverse(explode("-",$dataHora))); ?>" name="data_efe" >
<br>
parcela : <input type="text"	value="" name="parcela" >
<br>


<?php  echo form_dropdown('n_conta', $bancos, $iddup->n_conta);
 
/*<input type="text"	value="<?php echo $iddup->n_conta; ?>" name="n_conta" >*/

?>


numero conta: 


<br>
numero do decente : <input type="text"	value="" name="n_cedente" >
<br>
situacao : 
<?php echo form_dropdown('situacao', $status,"0"  ); ?>

<!-- <input type="text"	value="<?php echo $iddup->situacao; ?>" name="situacao" > -->

<div> <input type="submit" value="Submit" /> </div>
<?php echo form_close();
echo form_open('bills/paying');
 ?>
<br><br><br>



<div>im :<input type="text"	value="" name="im"  > 

<br>
valor final : <input type="text"	value="" name="valor_efe" >
<br>

numero conta: 
<?php  echo form_dropdown('n_conta', $bancos, "0");
 
/*<input type="text"	value="<?php echo $iddup->n_conta; ?>" name="n_conta" >*/

?>
<br>
data final : <input type="text"	value="<?php echo implode("/",array_reverse(explode("-",$dataHora))); ?>" name="data_efe" >
<br>

situacao : (hidden)
<?php echo form_dropdown('situacaof', $status,"0"  ); 

 

?>
<input type="text"	value="1" name="situacao" >



<div> <input type="submit" value="Submit" /> </div>
</div>



</body>
</html>