
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Resumo Bancos<span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
  <?php foreach ($bancos as $key) {
    echo'<li><a href="#">';
    echo $key['descricao_conta'].' : '.$key['saldo_conta'];
    echo '</a></li>';
  } ?>	
  </ul>
</div>
<script src="<?=base_url()?>/../js/bootstrap.js"></script>
