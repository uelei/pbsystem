
<link href="<?php echo site_url(); ?>/../css/bootstrap.css" rel="stylesheet">
<style type="text/css">
	
	@media (min-width: 768px) {
  .row { margin-right: 0; margin-left: 0; }
}
</style>

<nav class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<a href="<?php echo site_url(); ?>/venda/nova" class="btn btn-lg btn-default" ><span class="glyphicon glyphicon-shopping-cart"></span></a>
		<a href="<?php echo site_url(); ?>/bills" class="btn btn-lg btn-default" ><span class="glyphicon glyphicon-usd"></span> </a>
		<a href="<?php echo site_url(); ?>/bills/cartaoajuste" class="btn btn-lg btn-default" ><span class="glyphicon glyphicon-credit-card"></span> </a>
		<a href="<?php echo site_url(); ?>/venda/resumo" class="btn btn-lg btn-default" ><span class="glyphicon glyphicon-stats"></span> </a>
		<a href="<?php echo site_url(); ?>/master/logout" class="btn btn-danger" ><span class="glyphicon glyphicon-log-out"></span> Sair</a>
		
	</div>
</nav>

<div class="hidden" >
	<? echo $username; ?>
</div>