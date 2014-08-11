<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link type="text/css" href="<?=base_url()?>css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet" />

<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/rv.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/moment.js"></script>


<script type="text/javascript">
$(function() {

	$("#n_par").prop('disabled',true);		
var valors = parseFloat($('#valor').val()).toFixed(2);
var totals = parseFloat($('#total').val().replace(",",".")).toFixed(2);
var n_itenss = parseFloat($('#n_itens').val()).toFixed(2);

$('#total').val(totals.replace(".",","));
$('#n_itens').val(n_itenss);
$("#sav").hide();

var soma = parseFloat($('#somapg').val()).toFixed(2);



// $("#somapg").val

if(totals == soma ){
$("#btfechar").prop('disabled', false);	
}else{
$("#btfechar").prop('disabled', true);
}

var resto =( totals - soma ).toFixed(2);

$('#valor').val(resto.toString().replace(".",","));



$("body").on( "click", ".deletepagamento", function() {
  //alert( $( this ).attr('id') );
    var id = $( this ).attr('id')  ; 
deletepg(id);
});


$("#btaddpg").on("click",function () {
 var valor = $("#valor").val();
      if (/\S/.test(valor)) {     
addpagamento();
}
});



$("#tipo_pag").on("change",function () {
var id = $("#tipo_pag").val();

if(id == 13 ){

$("#n_par").prop('disabled', false);	
}else { 

$("#n_par").prop('disabled', true);	


}

$("#valors").focus();

});




$("#mod").on("click",function(){

$("#total").prop('disabled', false);
$("#mod").hide();
$("#sav").show();
$("#total").focus();
$("#total").select();

} );

$("#total").on( "focusout", function(){

// $rv = $this->input->get_post('order_id',TRUE);
// $totalto = $this->input->get_post('total',TRUE);
var totals = parseFloat($('#total').val().replace(",",".")).toFixed(2);
var nvar = $("#n_rv").val();

$.post( "http://pbs.piubol.com.br/index.php/venda/upvrv", { order_id : nvar , total : totals })
.done(function(){

$("#total").prop('disabled', true);


refreshpg();


$("#mod").show();
$("#sav").hide();

$('#total').val(totals.replace(".",","));


});




} );


$("#btfechar").on("click",function () {
    $( "#myModal" ).modal();

var datarv = $("#datarv").val();  
  //var datar = datarv.split("/");
  // var data= datar[0].split("-"); //ano data[0] mes data[1] dia data[2] 
  //var datah = datar[2]+"-"+datar[1]+"-"+datar[0];
var nvar = $("#n_rv").val();

var totals = parseFloat($('#total').val().replace(",",".")).toFixed(2);


$.post( "http://pbs.piubol.com.br/index.php/venda/fechafim", { rv : nvar , status : "5" ,total : totals})
.done(function(){


// document.location.href="http://pbs.piubol.com.br/index.php/venda/initvenda/?data="+datarv+"";
// $().redirect('http://pbs.piubol.com.br/index.php/venda/initvenda/', {'data': datah});
window.location.assign("http://pbs.piubol.com.br/index.php/venda/initvenda/?data="+datarv);

});


});

});

</script>
<title>Fechando Rv  <?php echo $rv['order_id']; ?></title>
<!-- tela fechamento de rv  -->
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Fechamento</div>
		<div class="panel-body">
			
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<!-- coluna esquerda 6 -->

		<div class="panel panel-default">
			<div class="panel-body">
			   <div class="row">
			      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			      	<label for="valor">Valor :</label>
						<div class="input-group input-group-lg">
						  <span class="input-group-addon">R$</span>
						  <input type="text" class="form-control" name="valor"  id="valor" value="0,00" pattern="\d*" placeholder="0,00">
						</div>
			      </div>
			   </div>
			   <div class="row">
			   		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<label for="tipo_pag">tipo de pagamento :</label>
						<?php echo form_dropdown('tipo_pag', $pag, '11','class="form-control btn-lg" id="tipo_pag" '); ?>
			   		</div>
			   </div>
			   <div class="row">
			   	<br>
			   </div>
			
				<div class="row">
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<label for="npar">Parcelas :</label>
						<input type="text" name="n_par" id="n_par" class="form-control" value="1" required="required" pattern="\d*" title="" >
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						
					</div><br>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<button id="btaddpg" class="btn btn-default btn-lg" >Add</button>
					</div>
				</div>
				
			</div>
		</div>




	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<!-- coluna direita 6 -->
		<div class="row">
			
		
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
				
				<label for="n_rv">Numero do Rv:</label>
				<input type="text" name="n_rv" id="n_rv" class="form-control" value="<?php echo $rv['order_id']; ?>" required="required" pattern="" title="" disabled>
				
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<label for="n_itens">Numero de Itens :</label>
				<input type="text" name="n_itens" id="n_itens" class="form-control" value="<?php echo $rv['nitens']; ?>" required="required" pattern="" title="" disabled>
			</div>
			

		</div>
			
		<div class="row">
			<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 input-group input-group-lg">
				<label for="total">Total</label>
				<div class="input-group input-group-lg">
				  <span class="input-group-addon">R$</span>
				  <input type="text" class="form-control"  name="total" id="total" pattern="\d*" value="<?php echo $rv['total']; ?>" placeholder="0,00" disabled>
				</div>

			</div>
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><br>
				<a  class="btn btn-default btn-lg" id="mod" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
				<a  class="btn btn-default btn-lg" id="sav" href="#"><span class="glyphicon glyphicon glyphicon-floppy-disk"></span></a>
				
			</div>
		</div>
		<br>
		<div class="row">
			
			<!-- div abrir lista de pagamentos -->

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading center">
						Pagamentos

					</div>
					
					<div class="panel-body" id="divpg">

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


					</div>
				</div>
			</div>

		</div>
		
		<div class="row">
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<button class="btn btn-success btn-lg" id="btfechar">Fechar</button>
			</div>
		</div>

	</div>
</div>


<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

		</div>
	</div>
</div>


<!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:30%">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
            <h1>Processing...</h1><h1 id="#ipro">1/1</h1>
        </div>
        <div class="modal-body">
            <div class="progress progress-striped active" >
                <div class="progress-bar " style="width: 100%;"></div>
            </div>
</div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<input type="hidden" name="datarv" id="datarv" class="form-control" value="<?php echo $rv['date_added']; ?>">








	


