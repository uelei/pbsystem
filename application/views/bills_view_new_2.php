<?php print_r($iddup); ?>






<!-- <html>
<head>
	<title> Duplicata Detalhe</title>
</head>
<body>


<?php echo form_open('bills/add_new'); 


		date_default_timezone_set("Brazil/East");
		$dataHora = date("Y-m-d");


?>

im :<input type="text"	value=" " name="im" >  
<br>
data Vencimento : <input type="text"	value="<?php echo implode("/",array_reverse(explode("-",$iddup->data_venc))); ?>" name="data_venc" >
<br>
tipo de operacao : <input type="text"	value="<?php echo $iddup->tipo_ope; ?>" name="tipo_ope" >  
<br>
tipo de documento : <input type="text"	value="<?php echo $iddup->tipo_doc; ?>" name="tipo_doc" > 
<br>
numero do documento : <input type="text"	value="<?php echo $iddup->n_doc; ?>" name="n_doc" >
<br>
valor original : <input type="text"	value="<?php echo $iddup->valor_ori; ?>" name="valor_ori" >  
<br>
valor final : <input type="text"	value="<?php echo $iddup->valor_efe; ?>" name="valor_efe" >
<br>
numero de operacao ou numero do cliente :



<input type="text"	value="<?php echo $iddup->n_ope_cli; ?>" name="n_ope_cli" > 




<br>
data final : <input type="text"	value="<?php echo implode("/",array_reverse(explode("-",$iddup->data_efe))); ?>" name="data_efe" >
<br>
parcela : <input type="text"	value="<?php echo $iddup->parcela ?>" name="parcela" >
<br>


<?php  // form_dropdown('n_conta', $bancos, $iddup->n_conta);
 
/*<input type="text"	value="<?php echo $iddup->n_conta; ?>" name="n_conta" >*/

?>


numero conta: 
<?php echo form_dropdown('n_conta', $bancos, $iddup->n_conta); ?>

<br>
numero do decente : 
<?php echo form_dropdown('n_cedente', $fornecedor,$iddup->n_cedente); ?>
<br>
situacao : 


<input type="text"	value="<?php echo $iddup->situacao; ?>" name="situacao" >

<br>
Adicionar outra :
<?php echo form_checkbox('addmore',"add", TRUE); ?>

<br>
<div> <input type="submit" value="Submit" /> </div>
<br>
<?php echo form_close(); ?>
<br><br><br>





</body>
</html> -->