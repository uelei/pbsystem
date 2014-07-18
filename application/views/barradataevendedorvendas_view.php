
<script src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
<link type="text/css" href="<?=base_url()?>css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet" />

<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/rv.js"></script>



<script type="text/javascript" >
  
      $(document).ready(function(){

$("#codvend").focus();

          $(".data").datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo','Segunda','Ter&ccedil;a','Quarta','Quinta','Sexta','S&aacute;bado','Domingo'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b','Dom'],
            monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Pr&oacute;ximo',
            prevText: 'Anterior'
          });

        //funcoes executar ao abrir a pagina !!! variavel script 

        <?php if(isset($script) ){echo $script;} ?>


      });
</script>

<script type="text/javascript">

$(function() {
  
$( "#nrv" ).addClass( "disabled" );

$( "#rv1" ).on( "click", function() {
  checkdados();
});


$('#bt').on('click',function(){
  refreshprodutos();
});




$("#busca_string").on('keydown', function(e) { 
  var keyCode = e.keyCode || e.which;
  var cod = $("#cod").val();

//alert( keyCode );


  if (keyCode == 189) {

$('#qtd').val("-1");
var s = $("#busca_string").val();
var res = s.replace("-","");
$("#busca_string").val(res);



  }

  if (keyCode == 8) {
    $('#descp').val(" ");
    $('#preco').val("0,00");
    $('#cod').val(" ");
    $('#mais').val("////////");
  }

  if(keyCode==114){
    e.preventDefault();
$("#btf").focus();

  }
  if (keyCode == 9) { 
      e.preventDefault(); 
      $('#qtd').focus();
    } 
  if (keyCode==13){
      var cod = $("#cod").val();
      if (/\S/.test(cod)) {
      // string is not empty and not just whitespace
          inserindonovoprodutonavenda();
           $('#busca_string').focus();
      }
    }
  });

$("#busca_string").on( "keypress", function(event) { 
  key = event.keyCode || event.which;
  // var cod = $("#cod").val();

  var s = $("#busca_string").val();
var res = s.replace("-","");
$("#busca_string").val(res);

  stoptimer();
  starttimer();

  });











$("#preco").on("focusin",function() {

// $("#qtd").select();
// $("#qtd").empty();
$("#preco").val("");
});

$("#qtd").on("focusin",function() {

// $("#qtd").select();
// $("#qtd").empty();
$("#qtd").val("");
});
// focusin



$("#qtd").on("keydown",function(event) {
  key = event.keyCode || event.which;

  // alert (key);
if (key==13){
      var cod = $("#cod").val();
      if (/\S/.test(cod)) {
      // string is not empty and not just whitespace

          inserindonovoprodutonavenda();
       $('#busca_string').focus();
      }
}
});


$("#btadd").on("click",function () {
  // body...
      var cod = $("#cod").val();
      if (/\S/.test(cod)) {
      // string is not empty and not just whitespace

          inserindonovoprodutonavenda();
           $('#busca_string').focus();
}

});



$("body").on( "click", ".deleteproduto", function() {
  //alert( $( this ).attr('id') );
    var id = $( this ).attr('id')  ; 
    deleteproduto(id);
});


// $(".deleteproduto").on("click",function () {
//     var id = this.id; 
//     deleteproduto(id);
// });



$("#preco").on("keydown",function (event) {
  // body...
  key = event.keyCode || event.which;
if (key==13){
      var cod = $("#cod").val();
      if (/\S/.test(cod)) {
      // string is not empty and not just whitespace
          inserindonovoprodutonavenda();
           $('#busca_string').focus();
      }
}
});





$("#idven").on("keydown",function (event) {
  // body...
  key = event.keyCode || event.which;
  if (key==13){
    $('#rv1').focus();}
});




$("#codvend").on("keydown",function (event) {
  // body...
  key = event.keyCode || event.which;
  if (key==13){
    $('#rv1').focus();}
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

    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
      <a  class="btn btn-default btn-lg" id="nrv" href="<?php echo site_url();?>/venda/initvenda"><span class="glyphicon glyphicon-plus-sign"></span> Nova Venda</a>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" id="datai">
      <label class="control-label" for="datarv" >Data:</label>
      <input id="datarv" class="data form-control" value="<?php 
      if(isset($data)){
      $dt =explode(" ",$data);
      $dtd =implode("/",array_reverse(explode("-",$dt[0])));
      echo $dtd;
      }else{
      echo date("d/m/Y"); }
      ?>"></input>
    </div>
    
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" id="codv">
      <label for="codvend" class="control-label">Vendedor: </label>
      <input id="codvend" class="form-control" id="#idven" value="<?php if(isset($vendedor)){echo $vendedor;} ?>" ></input>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >
      <button class="btn btn-lg btn-default" id="rv1" type="button" >Criar</button>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" >

    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" >
      <label for="rv" class="control-label" >rv :</label>
      <input id="rv" class="form-control" disabled="disabled" value="<?php if(isset($numero)) {echo $numero;} ?>" >
      </input>
    </div>

    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
      <div> 
        <label for="total" control-label> Total : </label>
        <input id="total" class="form-control input-lg" style="color:red;" value="<?php if(isset($total)){echo $total;} ?>"  >
      </div>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"> 
      <?php if(isset($numero)) { echo '<a href="'.base_url().'index.php/venda/fechar/?rv='.$numero.'" id="btf" class="btn btn-lg btn-default" > Fechar </a>';} ?>
    </div>
  </div>
<?php echo form_close(); ?>
</div>

</form>



</div>
<div  class="hidden" id="aqui">

aqui
</div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:30%">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
            <h1>Processing...</h1>
        </div>
        <div class="modal-body">
            <div class="progress progress-striped active" >
                <div class="progress-bar " style="width: 100%;"></div>
            </div>
</div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->



