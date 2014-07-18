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

<script type="text/javascript">




$(function() {
  // Handler for .ready() called.

//botao + nova venda desativado 21
$( "#nrv" ).addClass( "disabled" );
//.css( "border", "2px solid red" )

$('#datarv').dblclick(function() {
            $("#datarv").removeclass('disabled');
        });







$( "#rv1" ).on( "click", function() {
var datarv = $("#datarv").val();
var vend = $("#codvend").val();


$.post( "http://pbs.piubol.com.br/index.php/venda/rv1", { datarv: datarv, codvend: vend })
  .done(function( data ) {
 $( "#aqui" ).append( data );});






});





  
});






</script>



<div class="panel" >


<?php echo form_open('venda/geravenda','id="getnew"'); 
    date_default_timezone_set("Brazil/East");
    $dataHora = date("Y-m-d");
?>

<div class="form">
	<div class="row">
<div class="col-md-2" id="datai">
<label class="control-label" for="datarv" >Data:</label>
<input id="datarv" class="data form-control" value="<?php echo date("d/m/Y"); ?>"></input>
</div>

<div class="col-md-1" id="codv">
<label for="codvend" class="control-label">Vendedor: </label>
<input id="codvend" class="form-control" ></input>
</div>


<div class="col-md-2" ><br>
<button class="btn btn-lg btn-default" id="rv1" type="button" >Criar</button>

</div>


<div class="col-md-7"> 

</div>
</div>

<?php echo form_close(); ?>
</div>



</form>



</div>





