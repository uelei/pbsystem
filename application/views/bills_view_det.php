<html>
<head>
	<title> Duplicata Detalhe</title>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>


  <link type="text/css" href="<?=base_url()?>css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet" />



<script type="text/javascript" src="<?=base_url();?>js/jquery-1.9.1.js"> </script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.10.3.custom.js"></script>
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











</head>


<body>



<?php echo validation_errors(); ?>

<?php echo form_open('bills/bill'); 



?>




<br><br>

im :<input type="text"	value="<?php echo $iddup->im; ?>" name="imm"  disabled >  
<input type="hidden" name="im" value="<?php echo $iddup->im; ?>">
<br>

data Vencimento : <input type="text" class="data" value="<?php echo implode("/",array_reverse(explode("-",$iddup->data_venc))); ?>" name="data_venc" >
<br>
tipo de pagamento :<?php echo form_dropdown('tipo_pag', $pag, $iddup->tipo_pag); ?> 
<br>
tipo de documento : 
<?php echo form_dropdown('tipo_doc', $t_doc, $iddup->tipo_doc); ?>

<br>
numero do documento : <input type="text"	value="<?php echo $iddup->n_doc; ?>" name="n_doc" >
<br>
valor original : <input type="text"	value="<?php echo $iddup->valor_ori; ?>" name="valor_ori" >  
<br>
valor final : <input type="text"	value="<?php echo $iddup->valor_efe; ?>" name="valor_efe" >
<br>
numero de opercao ou numero do cliente :<input type="text"	value="<?php echo $iddup->n_ope_cli; ?>" name="n_ope_cli" > 
<br>
data final : <input type="text" class="data"	value="<?php echo implode("/",array_reverse(explode("-",$iddup->data_efe)));  ?>" name="data_efe" >
<br>
parcela : <input type="text"	value="<?php echo $iddup->parcela; ?>" name="parcela" >
<br>
numero conta: <?php  

if($iddup->situacao == "19"){
  echo form_dropdown('n_conta_d', $bancos, $iddup->n_conta,'id="#nconta" disabled="disabled" ' );
echo '<input type="hidden" value="'.$iddup->n_conta.'" name="n_conta" >';
}else{echo form_dropdown('n_conta', $bancos, $iddup->n_conta,'id="#nconta"' );}


?>
<br><script>

$('#nconta').click(function() {
  alert('Handler for .change() called.');

});



 $("#nconta").change(function(){
var nn=$(this).val();
alert('Handler for .change() called.');

  if(nn =0){
    allert()
$("#bt_pay").attr("disabled", "disabled");
}else{
$('#bt_pay').removeAttr("disabled");
}
  });</script>

numero do decente : 
<?php echo form_dropdown('n_cedente', $fornecedor,$iddup->n_cedente ); ?>
<br>

Tipo de Despesa 
<?php echo form_dropdown('d_desp', $d_desp, $iddup->id_d_desp); ?>


<br>
situacao : 


<?php

 if($iddup->situacao == "19"){
  echo form_dropdown('situacao_d', $status,$iddup->situacao, 'disabled="disabled"' );
  echo '<input type="hidden" value="'.$iddup->situacao.'" name="situacao" >';
    }else{

echo form_dropdown('situacao', $status,$iddup->situacao);

 }

  ?>

<br><br>
 <div>
  
    <button>SALVAR</button>
    <button>SALVAR+DEBITAR</button>
    <button>SALVARNOVO</button>
    <button>SALVARNOVO+1</button>
    <button <?php if($iddup->situacao == "19"){echo "disabled";} ?> id="bt_pay"  >PAGAR</button>
    <button>DELETE</button>
  </div>
  <input type="hidden"  value="" id="acao" name="acao" />
  <script>
    $("button").click(function () {
      var text = $(this).text();
      $("#acao").val(text);
    });





</script>

<?php echo form_close(); ?>
<br><br>



</body>
</html>