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

    $("button").click(function () {
      var text = $(this).text();
      $("#acao").val(text);
    });


      });
    
</script>
<style type="text/css">.top-b { margin-top:20px; }
.bot-b{ margin-bottom: 20px;}

</style>
</head>


<body>

<div class="container">
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 is-padded" >
<?php echo form_open('bills/bill'); 
    date_default_timezone_set("Brazil/East");
    $dataHora = date("Y-m-d");
?>


<div class="row top-b">
  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <label for="im" >im :</label>
    <input type="text"  value="<?php echo $iddup->im; ?>" name="im" size="3" class="form-control" readonly ></div>
  <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10"></div>
</div>



<div class="row top-b">
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
  <label for="data_venc" >Data Vencimento :</label>
  
  <input type="text" class="data form-control"  value="<?php echo implode("/",array_reverse(explode("-",$iddup->data_venc))); ?>" name="data_venc" >
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
  
<label>
Data Pagamento :</label> <input type="text" class="data form-control" value="<?php echo implode("/",array_reverse(explode("-",$iddup->data_efe)));  ?>" name="data_efe" >


</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" ></div>
</div>



<div class="row top-b">
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

<label for="tipo_pag">tipo de pagamento :</label>

<?php 
echo form_dropdown('tipo_pag', $pag, $iddup->tipo_pag,'class="form-control"');  ?>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

<label for="tipo_doc" >
tipo de documento : 
</label>
<?php echo form_dropdown('tipo_doc', $t_doc, $iddup->tipo_doc,'class="form-control"'); ?>
</div>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" >
  
<label>
n documento :</label>
 <input type="text" class="form-control" value="<?php echo $iddup->n_doc; ?>" name="n_doc" >
</div>
</div>



<div class="row top-b" >
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" ><label>valor original : </label>
<input type="text"  value="<?php echo $iddup->valor_ori; ?>" class="form-control" id="valor_ori" name="valor_ori" >  

</div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" ><label>
valor final : </label>
<input type="text"  value="<?php echo $iddup->valor_efe; ?>" class="form-control" id="valor_efe" name="valor_efe" ></div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" > </div>
</div>




<div class="row top-b">
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <label>
num oper/cliente :
</label>
<input type="text"  value="<?php echo $iddup->n_ope_cli; ?>"  class="form-control" name="n_ope_cli" > 

  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    
<label>
parcela :</label> <input type="text"  class="form-control" value="<?php echo $iddup->parcela; ?>" name="parcela" >
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
</div>



<div class="row top-b">
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
<label>
numero conta:</label> 
<?php 
if($iddup->situacao == "19"){

  echo form_dropdown('n_conta', $bancos, $iddup->n_conta,'class="form-control" disabled="disabled"'); }else{
  echo form_dropdown('n_conta', $bancos, '0','class="form-control"');
  }

?>
</div>
  <div class="col-md-8"></div>

</div>




<div class="row top-b">
  <div class="col-md-12">

<label>Cedente :</label> 
<?php echo form_dropdown('n_cedente',$fornecedor,$iddup->n_cedente ,'class="form-control"'); ?>
</div></div>




<div class="row top-b">
  <div class="col-md-6">


<label>
situacao : </label> 
<?php 
 if($iddup->situacao == "19"){echo form_dropdown('situacao', $status,$iddup->situacao ,'class="form-control" disabled="disabled"'); }else{
echo form_dropdown('situacao', $status,$iddup->situacao ,'class="form-control"');
}


 ?>
</div>


  <div class="col-md-6">
<label>d_desp:</label> 
<?php echo form_dropdown('d_desp',$d_desp, $iddup->id_d_desp,'class="form-control"'); ?>
 </div></div>

  <div class="row top-b bot-b">
    <div class="col-md-12">
    <button class="btn btn-default bta" <?php if($iddup->situacao == "19"){echo "disabled";} ?> >SALVAR</button>
    <button class="btn btn-default bta" <?php if($iddup->situacao == "19"){echo "disabled";} ?>  >SALVAR+DEBITAR</button>
    <button  class="btn btn-default bta"  >SALVARNOVO</button>
    <button  class="btn btn-default bta" id="svn1" >SALVARNOVO+1</button>
    <button class="btn btn-default bta" >DELETE</button>




     </div></div>
  <input type="hidden"  value="" id="acao" name="acao" />

</div>

  <?php echo form_close(); ?>
</div>
</body>
</html>