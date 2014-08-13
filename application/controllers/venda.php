<?php 

/**
* Controler responsavel pela venda 
*/
class Venda extends MY_Controller
{
	
	function index(){
	}



	function nova()
	{
		$data_menu['username'] = $this->session->userdata('username');
		$this->load->view('menu_view', $data_menu);
		$this->load->view('nvenda_view');


	}


	function initvenda()
	{	
		$this->load->helper('form');
		$data_menu['username'] = $this->session->userdata('username');
		$this->load->view('menu_view', $data_menu);
		//$this->load->view('barraferramentavendas_view');
		//script ser executado ao abrir a pagina 		 
		if($this->input->get_post('data',TRUE)){
			$datapost = $this->input->get_post('data');
			}else{$datapost = date('Y-m-d H:i:s');}
		$s =  array('script' =>" ",'data' => $datapost); 
		$this->load->view('barradataevendedorvendas_view',$s);
		$this->load->model('cv_m');
		$lastSalles['ultimasVendas'] = $this->cv_m->listaUltimasVendas();
		$this->load->view('lastSallesView', $lastSalles);



	}


	function geravenda()
	{
		$this->load->helper('form');
		$this->load->model('cv_m');

		$dat=$this->input->post('datarv');
		$codvend=$this->input->post('codvend');
		$dt =implode("-",array_reverse(explode("/",$dat)));
		$ip = $_SERVER["REMOTE_ADDR"]; 

		if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $fip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{ $fip = "not defined";}

		$b = $_SERVER['HTTP_USER_AGENT']; 
		$al = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

		$timen = date("H:i:s");                         // 17:16:17
		$nv = array('store_id' =>"0" ,'invoice_prefix' => "loja-" , 'store_name'=>"piubol" , 'store_url' => "http://pbs.piubol.com.br" ,'customer_id'=> "2",'customer_group_id' =>"2", 'firstname' => "cliente",'lastname' => "balcao", 'email' => "balcao@piubol.com.br",'telephone'=> "32156181",'payment_firstname'=>"cliente", 'payment_lastname'=>"balcao",'payment_address_1'=>"rua",'payment_city'=>"juiz de fora",'payment_postcode'=>"36013260",'payment_country'=>"Brazil",'payment_country_id'=>"30",'payment_zone'=>"Minas Gerais",'payment_zone_id'=>"452",'payment_method'=>"pagamento na loja",'payment_code'=>"cash",'shipping_firstname'=>"cliente",'shipping_lastname'=>"balcao",'shipping_address_1'=>"rua",'shipping_city'=>"juiz de fora",'shipping_postcode'=>"36013260",'shipping_country'=>"Brazil",'shipping_country_id'=>"30",'shipping_zone'=>"Minas Gerais",'shipping_zone_id'=>"452",'shipping_method'=>"entrege diretamente ao cliente",'shipping_code'=>"mao.mao",'language_id' => "2" , 'currency_id' => "4" , 'currency_code' => "BRL" ,'currency_value'=>"1.0" ,'ip'=> $ip ,'forwarded_ip'=> $fip , 'user_agent'=> $b ,'accept_language' => $al  ,'date_added' =>$dt." ".$timen ,'date_modified' =>$dt." ".$timen , "affiliate_id" => $codvend );
		$rv= $this->cv_m->criarnovavenda($nv);
		echo $rv;
	
	}


	function rv()
	{
		

		$this->load->helper('form');
		$rvp=$this->input->get_post('rv',TRUE);		
		$this->load->model('cv_m');


		$data_menu['username'] = $this->session->userdata('username');
		$this->load->view('menu_view', $data_menu);
		//$this->load->view('barraferramentavendas_view');
		$rv['numero']=$rvp;
		$rv['script']='
			$( "#codv" ).removeClass( "has-error");
		    $( "#datai" ).removeClass( "has-error");
		    $( "#codvend" ).attr("disabled", "disabled");
		    $( "#datarv" ).attr("disabled", "disabled");
		    $( "#rv1" ).attr("disabled", "disabled");
			$("#busca_string").focus();
		    ';
		$rvd= $this->cv_m->dadosrv($rvp);
		$rv['vendedor']=$rvd['affiliate_id'] ;
		$rv['data']=$rvd['date_added'];
		$rv['total']=number_format(floatval($rvd['total']), 2, ',', '.');
		$rv['ls']=$this->cv_m->listaprodutosrv($rvp);
		$this->load->view('barradataevendedorvendas_view',$rv);
		$this->load->view('buscaproduto_view',$rv);


	}



function findproduto()
{
	
	$s=$this->input->get_post('busca');

	$this->load->model('cv_m');
	$pr = $this->cv_m->findproduto($s);
	if($pr){	
	echo($pr);
}

}



function getdadostpag()
{
	$s=$this->input->get_post('tpg');
	$this->load->model('t_pag_m');
	$tp= $this->t_pag_m->getdadospag($s);
	if($tp){

		echo($tp);
	}


}





	function listadeprodutos()
	{
		# code...


		$rv=$this->input->get_post('rv', TRUE);

		$this->load->model('cv_m');

		$lsp['ls']=$this->cv_m->listaprodutosrv($rv);

		return $this->load->view('listaprodutos_view',$lsp);



	}


function delete()
{
	# code...
//function upvalores($rv,$totalto,$costto,$niten)

$iddelete= $this->input->get_post('iddoproduto',TRUE);
$this->load->model('cv_m');
$xi = $this->cv_m->getdadosproduto($iddelete);
///$xi = Array ( [order_product_id] => 113 [order_id] => 102 [product_id] => 2324 [name] => meia sapatilha adulto cor sort. DZ 
//[model] => 2324 [quantity] => 1.00 [price] => 12.0000 [total] => 12.0000 [tax] => 0.0000 [reward] => 0 [price_cost] => 1.6872 
//[total_cost] => 1.6872 )

$rv = $xi['order_id'];

$totalto = $xi['total'] * -1;
$costto = $xi['total_cost'] * -1;
$niten = $xi['quantity'] * -1;

// Array ( [order_id] => 102 [invoice_no] => 0 [invoice_prefix] => [store_id] => 0 [store_name] => [store_url] => [customer_id] => 0 
// 	[customer_group_id] => 0 [firstname] => [lastname] => [email] => [telephone] => [fax] => [payment_firstname] => 
// 	[payment_lastname] => [payment_company] => [payment_address_1] => [payment_address_2] => [payment_city] => 
// 	[payment_postcode] => [payment_country] => [payment_country_id] => 0 [payment_zone] => [payment_zone_id] => 0
// 	 [payment_address_format] => [payment_method] => [payment_code] => [shipping_firstname] => [shipping_lastname] =>
// 	  [shipping_company] => [shipping_address_1] => [shipping_address_2] => [shipping_city] => [shipping_postcode] => 
// 	  [shipping_country] => [shipping_country_id] => 0 [shipping_zone] => [shipping_zone_id] => 0 [shipping_address_format] =>
// 	   [shipping_method] => [shipping_code] => [comment] => [total] => 111.8500 [order_status_id] => 0 [affiliate_id] => 2 
// 	   [commission] => 0.0000 [marketing_id] => 0 [tracking] => [language_id] => 0 [currency_id] => 0 [currency_code] => 
// 	   [currency_value] => 1.00000000 [ip] => [forwarded_ip] => [user_agent] => [accept_language] => 
// 	   [date_added] => 2013-12-13 00:00:00 [date_modified] => 0000-00-00 00:00:00 )



$this->cv_m->upvalores($rv,$totalto,$costto,$niten);

$this->cv_m->delproduct($iddelete);







}


	function buscaproduto()
	{

	$this->load->view('buscaproduto_view');






	# code ...
}







function insertnew()
{

//sleep(1);


$this->load->helper('form');



$cod=$this->input->get_post('cod', TRUE);
$mais=$this->input->get_post('mais', TRUE);
$rv=$this->input->get_post('rv', TRUE);

$qtd=$this->input->get_post('qtd', TRUE);
$qtd= str_replace(",",".",$qtd);
//$qtd= str_replace("-","",$qtd);
//$dat = $this->input->get_post('dat',TRUE);

$preco=$this->input->get_post('preco', TRUE);
$preco= str_replace(",",".",$preco);

$ttoal= $qtd * $preco;

//$data = $dat." ".date("H:i:s");

$this->load->model('cv_m');

		//$lsp['ls']=$this->cv_m->listaprodutosrv($rv);

		//$this->load->view('listaprodutos_view',$lsp);
 $dados = explode("////",$mais);

$name = $dados[0];
$model = $dados[1];
$pcusto= $dados[2];

$tcusto = $qtd * $pcusto;

//echo $tcusto;


$dads =  array('order_id' => $rv,
 'product_id'=> $cod,
 'name'=> $name, 
 'model'=> $model,
 'quantity'=> $qtd ,
 'price'=> $preco,
  'total'=> $ttoal ,
  'tax'=>'0',
   'reward'=> '0',
   'price_cost'=>$pcusto,
   'total_cost'=>$tcusto
   );


$this->cv_m->insertnewproduct($dads);
$this->cv_m->upvalores($rv,$ttoal,$tcusto,$qtd);






//echo $mais;
//echo $pcusto; 
/* var cod = $("#cod").val();
 var mais = $("#mais").val();
 var rv = $("#rv").val();
 var qtd = $("#qtd").val();
 var preco = $("#preco").val();
*/




	# code...
}





function gettotal()
{
	# code...

		$rv=$this->input->get_post('rv', TRUE);

		$this->load->model('cv_m');

		$rvd = $this->cv_m->dadosrv($rv);


		$total = $rvd['total'];		
		echo $total;

}












function rv1()
{
	$this->load->model("cv_m");

	$dat=$this->input->get_post('datarv',TRUE);
	$codvend=$this->input->get_post('codvend',TRUE);

	$data = explode("/",$dat); // fatia a string $dat em pedados, usando / como referência
	if( isset($data[0]) ){$d = $data[0];}else {$d=0; } 
	if( isset($data[1]) ){$m = $data[1];}else {$m=0; } 
	if( isset($data[2]) ){$y = $data[2];}else {$y=0; } 
	$ii =0;

	$ckd = checkdate($m,$d,$y);
    $ckv = $this->cv_m->checksaler($codvend);
	if($ckd){$ii= $ii +1 ; }
	if($ckv){$ii = $ii +3; }

	switch ($ii) {
		case '1':
			//data ok but vendedor not ok 
			echo '<script type="text/javascript">';
			echo ' $( "#codv" ).addClass( "has-error" ); $( "#codvend" ).focus();';
			echo '$( "#datai" ).removeClass( "has-error");';
			# code...
			echo '</script>';
			break;
		case '3':
			//vendedor ok mas data not ok 
			
			echo '<script type="text/javascript">';			
			echo ' $( "#codv" ).removeClass( "has-error");';
			echo '$("#codvend").val('.$$ckv.');';
			echo '$( "#datai" ).addClass( "has-error" ); $( "#datarv").focus();';
			# code...
			echo '</script>';
			break;
		case '4':
			//evething ok 
			//$ve=$this->cv_m->checksaler($codvend);$ve=$this->cv_m->checksaler($codvend); 

			echo '<script type="text/javascript"> 
		    $( "#codv" ).removeClass( "has-error");
		    $( "#datai" ).removeClass( "has-error");
		    $( "#codvend" ).attr("disabled", "disabled");
		    $( "#datarv" ).attr("disabled", "disabled");
		    $( "#rv1" ).attr("disabled", "disabled");
			var datarv = $("#datarv").val();
			var vend = '.$ckv.' ; 
			$.post( "http://pbs.piubol.com.br/index.php/venda/geravenda", { datarv: datarv, codvend: vend })
				.done(function( data ) {
					url = "http://pbs.piubol.com.br/index.php/venda/rv?rv="+data;
					window.location.replace(url);
				;});
			</script>';
			# code...  $( "#getnew" ).submit();
			break;
	
		default:
			//tudo not ok 
			echo '<script type="text/javascript">';
			echo ' $( "#codv" ).addClass( "has-error" );';
			echo '$( "#datai" ).addClass( "has-error" ); $( "#datarv").focus();';
			# code...
			echo '</script>';
			break;
	}
}



function fechar()

{

	$this->load->helper('form');
	$data_menu['username'] = $this->session->userdata('username');
	$this->load->view('menu_view', $data_menu);
	
	$rv=$this->input->get_post('rv',TRUE );

	$this->load->model('t_pag_m');
 	$combo['pag'] = $this->t_pag_m->getallpagf();

	$this->load->model('cv_m');
	$combo['rv'] = $this->cv_m->dadosrv($rv);

	$combo['ls']=$this->cv_m->listapagamentorv($rv);
	$combo['somapg']=$this->cv_m->somapgrv($rv);
	
	$this->load->view('fecharrv_view',$combo);




}


function fechafim()
{
	# code...
	$rv= $this->input->get_post('rv',TRUE);
	$status = $this->input->get_post('status',TRUE);
	$totals = $this->input->get_post('total',TRUE);
	$this->load->model('cv_m');

	$this->cv_m->uprvstatus($rv,$status,$totals);

	return TRUE;







}




function listapagamentosrv()
{

		$rv=$this->input->get_post('rv', TRUE);
		$this->load->model('cv_m');

		$lsp['ls']=$this->cv_m->listapagamentorv($rv);
		$lsp['somapg']=$this->cv_m->somapgrv($rv);

		return $this->load->view('listapagamentos_view',$lsp);



	



	# code...
}



function upvrv()
{
	//upvalores($rv,$totalto,$costto,$niten)

// $iddelete= $this->input->get_post('iddoproduto',TRUE);
$this->load->model('cv_m');
// $xi = $this->cv_m->getdadosproduto($iddelete);
///$xi = Array ( [order_product_id] => 113 [order_id] => 102 [product_id] => 2324 [name] => meia sapatilha adulto cor sort. DZ 
//[model] => 2324 [quantity] => 1.00 [price] => 12.0000 [total] => 12.0000 [tax] => 0.0000 [reward] => 0 [price_cost] => 1.6872 
//[total_cost] => 1.6872 )

$rv = $this->input->get_post('order_id',TRUE);
$totalto = $this->input->get_post('total',TRUE);
// $costto = $this->input->get_post('total_cost',TRUE);
// $niten = $this->input->get_post('quantity',TRUE);

// Array ( [order_id] => 102 [invoice_no] => 0 [invoice_prefix] => [store_id] => 0 [store_name] => [store_url] => [customer_id] => 0 
// 	[customer_group_id] => 0 [firstname] => [lastname] => [email] => [telephone] => [fax] => [payment_firstname] => 
// 	[payment_lastname] => [payment_company] => [payment_address_1] => [payment_address_2] => [payment_city] => 
// 	[payment_postcode] => [payment_country] => [payment_country_id] => 0 [payment_zone] => [payment_zone_id] => 0
// 	 [payment_address_format] => [payment_method] => [payment_code] => [shipping_firstname] => [shipping_lastname] =>
// 	  [shipping_company] => [shipping_address_1] => [shipping_address_2] => [shipping_city] => [shipping_postcode] => 
// 	  [shipping_country] => [shipping_country_id] => 0 [shipping_zone] => [shipping_zone_id] => 0 [shipping_address_format] =>
// 	   [shipping_method] => [shipping_code] => [comment] => [total] => 111.8500 [order_status_id] => 0 [affiliate_id] => 2 
// 	   [commission] => 0.0000 [marketing_id] => 0 [tracking] => [language_id] => 0 [currency_id] => 0 [currency_code] => 
// 	   [currency_value] => 1.00000000 [ip] => [forwarded_ip] => [user_agent] => [accept_language] => 
// 	   [date_added] => 2013-12-13 00:00:00 [date_modified] => 0000-00-00 00:00:00 )



$this->cv_m->upvalor($rv,$totalto);

// $this->cv_m->delproduct($iddelete);



}


function addpag()
{
		$this->load->model('bills_m');
		$this->load->model('bancos_m');
$dupe['im']="NULL";
	$dupe['data_venc']=$this->input->post('data_venc');
	$dupe['tipo_pag']=$this->input->post('tipo_pag');
$dupe['tipo_doc']="14";
	$dupe['n_doc']=$this->input->post('n_doc');

// 	$this->load->model('t_doc_m');
//     $var =  $this->t_doc_m->creordebdoc($dupe['tipo_doc']);

	$dupe['n_ope_cli']="1";
	$dupe['data_efe']=$this->input->post('data_efe');
	$dupe['parcela']=$this->input->post('parcela');
	$dupe['n_conta']= $this->input->post('n_conta');
	$dupe['n_cedente']='1';
	$dupe['id_d_desp']="1";
	$dupe['situacao']=$this->input->post('situacao');
	if($dupe['situacao']=="19"){
		
		$dupe['valor_ori']=$this->input->post('valor_ori'); 
		$dupe['valor_efe']=$this->input->post('valor_efe');
		$pbill = $this->bancos_m->paybill($dupe['n_conta'],$dupe['valor_efe']);

	}else{

		$dupe['valor_ori']=$this->input->post('valor_ori'); 
		$dupe['valor_efe']=$this->input->post('valor_efe');

	}

	$addduplicata = $this->bills_m->addconta($dupe);

	$lid= $this->db->insert_id();


// http://pbs.piubol.com.br/index.php/venda/fechar/?rv=111

//http://pbs.piubol.com.br/index.php/venda/rv?rv=105
// $s = "//http://pbs.piubol.com.br/index.php/venda/?rv=".$dupe['n_doc'];



// 	redirect($s ,'refresh');
}


function resumo()
{
	$data_menu['username'] = $this->session->userdata('username');
	$this->load->view('menu_view', $data_menu);




	$this->load->view('resumo_view');

/*
SELECT `affiliate_id`,SUM(total),usuario.username FROM `oc_order`  
INNER JOIN usuario ON oc_order.affiliate_id = usuario.id_user
WHERE MONTH(date_added) = 12


GROUP BY `affiliate_id`
*/
}
function dadosdograficovendas()
{
	$this->load->model('cv_m');
	$m = $this->input->get_post('inputmes');
	$data = implode("-",array_reverse(explode("/",$m)));
	$r = $this->cv_m->somavendasm($data);
echo $r;
}




function dadosdograficovendasmm()
{
	$this->load->model('cv_m');
	$m = $this->input->get_post('inputmes');
		$dd = explode("/",$m);
	$data = $dd[2]."-".$dd[1];
	$r = $this->cv_m->somavendasm($data);
echo $r;
}






function dadosdograficovendasd()
{
	$this->load->model('cv_m');

	$m = $this->input->get_post('inputmes');
	$dd = explode("/",$m);
	$data = $dd[2]."-".$dd[1];


	$r = $this->cv_m->somavendasd($data);

echo $r;


}



function dadosdograficovendasm()
{
	$this->load->model('cv_m');

	$m = $this->input->get_post('inputmes');
	$dd = explode("/",$m);
	$data = $dd[2];


	$r = $this->cv_m->somavendasmm($data);

echo $r;


}


	function sockreport()
	{
		$this->load->helper('form');

		$meias = array("1332","4138","2059","1078","1081","2324","2325","2326","2060","1087","2328");
		
		$data_menu['username'] = $this->session->userdata('username');
		$this->load->view('menu_view', $data_menu);

		//$this->load->view('nvenda_view');
	
		date_default_timezone_set("Brazil/East");
		$dataHora = date("Y-m-d");

		if($this->input->post('datai')){
			$datai=implode("-",array_reverse(explode("/",$this->input->post('datai'))));
			$dataf=implode("-",array_reverse(explode("/",$this->input->post('dataf'))));
		}else{
			 $datai = $dataHora; 
			 $dataf = $dataHora;
		}
		
		$this->load->model('cv_m');

		 $tsocks['tsock'] = $this->cv_m->socksreportsun($datai,$dataf,$meias);
		 $tsocks['meias']= $meias;
		$tsocks['datai']= $datai;
		$tsocks['dataf']= $dataf;

		$this->load->view('sockReportView',$tsocks);


	}








}


 ?>