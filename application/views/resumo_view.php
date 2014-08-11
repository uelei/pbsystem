<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link type="text/css" href="<?=base_url()?>css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet" />

<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/graficos.js"></script>


<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">google.load('visualization', '1.0', {'packages':['corechart']});</script>


	<title>Relat&oacute;rio</title>
</head>
<body>
	



 
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<input type="text" name="mes" id="inputMes" class="form-control" value="" required="required" pattern="" title="">
				</div>
        


				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					  
					  	
				</div>
</div>


			</div>
	
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div id="funcgrafico"></div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div id="funcgraficoc"></div>
    </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div id="daychart"></div>
  </div>
</div>


<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div id="mchart"></div>
  </div>
</div>

</div>
		</div>
	</div>
</div>







  </body>
<!-- ///////////////////////////////////////Scripts ///////////////////////////////////////////// -->
     <script type="text/javascript">
$("#inputMes").datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo','Segunda','Ter&ccedil;a','Quarta','Quinta','Sexta','S&aacute;bado','Domingo'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b','Dom'],
            monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Pr&oacute;ximo',
            prevText: 'Anterior'
          });



var datad = new Date();
var dia = ("0" + datad.getDate()).slice(-2)
// var mes = datad.getMonth();
var ano = datad.getFullYear();
// var mesa = mes + 1;
var mesa = ("0" + (datad.getMonth() + 1)).slice(-2)
$("#inputMes").val(dia + "/"+mesa+"/"+ano);


// var chart;
// var chars;
// var chartt;

gera();
gera2();
barra();
barra2();

$("#inputMes").on("change",function(){
  $("#funcgrafico").empty();
  $("#daychart").empty();
   gera();
   gera2();
  barra();
  barra2();
});





</script>
</html>