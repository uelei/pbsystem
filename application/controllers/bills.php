<?php /**
* 
*/
class Bills extends MY_Controller
{
	
	function index()
	{
	$this->load->helper('form');
		$data_menu['username'] = $this->session->userdata('username');
		$this->load->model('bills_m');
		$this->load->model('bancos_m');

		$bancos["bancos"] = $this->bancos_m->getallsaldos();

		date_default_timezone_set("Brazil/East");
		$dataHora = date("Y-m-d");
		$contas = $this->bills_m->lcontas($dataHora,$dataHora);
		$this->load->view('menu_view', $data_menu);

			$dat['datai']= $dataHora;
			$dat['dataf']= $dataHora;
			$dat['pg']= FALSE;

		if($contas){
			$dat['duplicatas'] = $contas;
			$dat['tem'] = TRUE;
			$status['status'] = " ";
			$this->load->view('bills_view',$dat);
			$this->load->view('bancos_view',$bancos);

		}else{
			$dat['tem'] = FALSE;
			$status['status'] ="nao tem duplicatas"; 
			$this->load->view('status_view',$status);
			$this->load->view('bills_view',$dat);
			$this->load->view('bancos_view',$bancos);

		}













	}


	function cartaoajuste()
	{
		$this->load->helper('form');
	    $data_menu['username'] = $this->session->userdata('username');
	
		date_default_timezone_set("Brazil/East");
		$dataHora = date("Y-m-d");

		if($this->input->post('datai')){
			$datai=implode("-",array_reverse(explode("/",$this->input->post('datai'))));
			$dataf=implode("-",array_reverse(explode("/",$this->input->post('dataf'))));
		}else{
			 $datai = $dataHora; 
			 $dataf = $dataHora;
		}
		
		$this->load->view('menu_view', $data_menu);
		$this->load->model('bills_m');
		$d['creditos'] = $this->bills_m->lcartaocredito($datai,$dataf);
		$d['datai']= $datai;
		$d['dataf']= $dataf;
		$this->load->view('cartoes_view',$d);


	}





function cartaodo()
{

	$this->load->model('bills_m');
	$this->load->model('bancos_m');

	$cards = $this->input->post(NULL, TRUE);

foreach ($cards as $key => $value){

$a = array('valor_efe' => $value,'situacao' => '19');
$this->bills_m->updateconta($a,$key);
$pbill = $this->bancos_m->paybill('3',$value);



}
 redirect('/bills', 'refresh');








}








function datafind(){
	$this->load->helper('form');
	$this->load->model('bills_m');
	$this->load->model('bancos_m');

	$data_menu['username'] = $this->session->userdata('username');
	$this->load->view('menu_view', $data_menu);

	date_default_timezone_set("Brazil/East");
	$dati=implode("-",array_reverse(explode("/",$this->input->post('datai'))));
	$datf=implode("-",array_reverse(explode("/",$this->input->post('dataf'))));
	$pgo=$this->input->post('pago');


		$bancos["bancos"] = $this->bancos_m->getallsaldos();
		$contas= $this->bills_m->lcontas($dati,$datf);


		if($contas){
			$dat['duplicatas'] = $contas;
			$dat['tem'] = TRUE;
			$dat['datai']= $dati;
			$dat['dataf']= $datf;
			$dat['pg']= FALSE;
			$status['status'] = " ";
			$this->load->view('bills_view',$dat);
			$this->load->view('bancos_view',$bancos);
			//$this->load->view('status_view',$status);

		}else{
			$dat['tem'] = FALSE;
			$dat['datai']= $dati;
			$dat['dataf']= $datf;
			$dat['pg']= FALSE;
			$status['status'] ="nao tem duplicatas"; 
			$this->load->view('status_view',$status);
			$this->load->view('bills_view',$dat);
			$this->load->view('bancos_view',$bancos);
		}


}

function newbill(){

	$this->load->helper('form');

	$data_menu['username'] = $this->session->userdata('username');

	$this->load->model('fornecedor_m');
	$combo['fornecedor'] = $this->fornecedor_m->getallfornecedor();
	
	$this->load->model('bancos_m');
	$combo['bancos']  = $this->bancos_m->getallbancos();
	
	$this->load->model('t_doc_m');
	$combo['t_doc']=$this->t_doc_m->getalldoc();

 	$this->load->model('t_pag_m');
 	$combo['pag'] = $this->t_pag_m->getallpag();

 	$this->load->model('status_m');
	$combo['status'] = $this->status_m->getallstatus();

	$this->load->model('d_desp_m');
	$combo['d_desp']= $this->d_desp_m->getallddesp();

	$this->load->view('menu_view', $data_menu);
	$this->load->view('bills_view_new',$combo);

}











function bill(){

$this->load->helper('form');

$acao= $this->input->get_post('acao',TRUE);
if($acao!=""){
	$dup = $this->input->get_post('dup',TRUE);




	$data_menu['username'] = $this->session->userdata('username');

	$this->load->model('bills_m');

	$this->load->model('fornecedor_m');
	$dados['fornecedor'] = $this->fornecedor_m->getallfornecedor();
	
	$this->load->model('bancos_m');
	$dados['bancos']  = $this->bancos_m->getallbancos();
	
	$this->load->model('t_doc_m');
	$dados['t_doc']=$this->t_doc_m->getalldoc();

 	$this->load->model('t_pag_m');
 	$dados['pag'] = $this->t_pag_m->getallpag();

	$this->load->model('status_m');
	$dados['status'] = $this->status_m->getallstatus();

	$this->load->model('d_desp_m');
	$dados['d_desp']= $this->d_desp_m->getallddesp();

	$this->load->view('menu_view', $data_menu);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if($acao == "EDITAR"){

		$dados['iddup']= $this->bills_m->detale_dup($dup);
		$this->load->view('bills_view_det',$dados);

	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if($acao == "DELETE"){

		$pg= $this->input->post('situacao');
		$i = $this->input->post('im');
		$valor=$this->input->post('valor_efe') * -1;
		$banco= $this->input->post('n_conta');

		$this->load->model('bills_m');
		$d=$this->bills_m->delbill($i);


		if($pg =="19"){

			$this->load->model('bancos_m');

			$pbill = $this->bancos_m->paybill($banco,$valor);

		}

		redirect('/bills', 'refresh');

	}

///////////////////////////////////////////////////////////////////////////////////////////////////////

	if($acao == "SALVARNOVO"){


	$dupe['im']="NULL";
	$dupe['data_venc']=implode("-",array_reverse(explode("/",$this->input->post('data_venc'))));
	$dupe['tipo_pag']=$this->input->post('tipo_pag');
	$dupe['tipo_doc']=$this->input->post('tipo_doc');
	$dupe['n_doc']=$this->input->post('n_doc');

	$this->load->model('t_doc_m');
    $var =  $this->t_doc_m->creordebdoc($dupe['tipo_doc']);

	$dupe['n_ope_cli']=$this->input->post('n_ope_cli');
	$dupe['data_efe']=implode("-",array_reverse(explode("/",$this->input->post('data_efe'))));
	$dupe['parcela']=$this->input->post('parcela');
	$dupe['n_conta']=$this->input->post('n_conta');
	$dupe['n_cedente']=$this->input->post('n_cedente');
	$dupe['id_d_desp']=$this->input->post('d_desp');
	$dupe['situacao']=$this->input->post('situacao');
	$valorOri = $this->input->post('valor_ori');
	$valorOri = str_replace(",",".",$valorOri);
	$valorEfe = $this->input->post('valor_efe');
 	$valorEfe = str_replace(",",".",$valorEfe);

	if($dupe['situacao']=="19"){
		
		$dupe['valor_ori']=$valorOri * $var; 
		$dupe['valor_efe']=$valorEfe * $var;
		$pbill = $this->bancos_m->paybill($dupe['n_conta'],$dupe['valor_efe']);

	}else{

		$dupe['valor_ori']=$valorOri; 
		$dupe['valor_efe']=$valorEfe;

	}

	$addduplicata = $this->bills_m->addconta($dupe);

	$lid= $this->db->insert_id();

redirect('/bills', 'refresh');

	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($acao=="SALVAR"){

		$im=$this->input->post('im');
		$dupe['data_venc']=implode("-",array_reverse(explode("/",$this->input->post('data_venc'))));
		$dupe['tipo_pag']=$this->input->post('tipo_pag');
		$dupe['tipo_doc']=$this->input->post('tipo_doc');
		$dupe['n_doc']=$this->input->post('n_doc');
		$dupe['n_ope_cli']=$this->input->post('n_ope_cli');
		$dupe['data_efe']=implode("-",array_reverse(explode("/",$this->input->post('data_efe'))));
		$dupe['parcela']=$this->input->post('parcela');
		$dupe['n_conta']=$this->input->post('n_conta');
		$dupe['n_cedente']=$this->input->post('n_cedente');
		$dupe['id_d_desp']=$this->input->post('d_desp');
		$dupe['situacao']=$this->input->post('situacao');
		$dupe['valor_ori']=$this->input->post('valor_ori'); 
		$dupe['valor_efe']=$this->input->post('valor_efe');
		
		$addduplicata = $this->bills_m->updateconta($dupe,$im);

		$lid= $this->db->insert_id();

		//echo($lid);
		// redirect('/bills', 'refresh');


	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($acao == "SALVAR+DEBITAR"){




		$im=$this->input->post('im');
		$dupe['data_venc']=implode("-",array_reverse(explode("/",$this->input->post('data_venc'))));
		$dupe['tipo_pag']=$this->input->post('tipo_pag');
		$dupe['tipo_doc']=$this->input->post('tipo_doc');
		$dupe['n_doc']=$this->input->post('n_doc');

		$this->load->model('t_doc_m');
    	$var =  $this->t_doc_m->creordebdoc($dupe['tipo_doc']);


		$dupe['n_ope_cli']=$this->input->post('n_ope_cli');
		$dupe['data_efe']=implode("-",array_reverse(explode("/",$this->input->post('data_efe'))));
		$dupe['parcela']=$this->input->post('parcela');
		$dupe['n_conta']=$this->input->post('n_conta');
		$dupe['n_cedente']=$this->input->post('n_cedente');
		$dupe['id_d_desp']=$this->input->post('d_desp');
		$dupe['situacao']=$this->input->post('situacao');
		$valorOri = $this->input->post('valor_ori');
		$valorOri = str_replace(",",".",$valorOri);
		$valorEfe = $this->input->post('valor_efe');
	 	$valorEfe = str_replace(",",".",$valorEfe);

		if($dupe['situacao']=="19"){
		
			$dupe['valor_ori']=$valorOri * $var; 
			$dupe['valor_efe']=$valorEfe * $var;
			$pbill = $this->bancos_m->paybill($dupe['n_conta'],$dupe['valor_efe']);

		}else{

			$dupe['valor_ori']=$valorOri; 
			$dupe['valor_efe']=$valorEfe;

		}

		$addduplicata = $this->bills_m->updateconta($dupe,$im);

	$lid= $this->db->insert_id();

redirect('/bills', 'refresh');



	}




////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if($acao == "SALVARNOVO+1"){


	$dupe['im']="NULL";
	$dupe['data_venc']=implode("-",array_reverse(explode("/",$this->input->post('data_venc'))));
	$dupe['tipo_pag']=$this->input->post('tipo_pag');
	$dupe['tipo_doc']=$this->input->post('tipo_doc');
	$dupe['n_doc']=$this->input->post('n_doc');

	$this->load->model('t_doc_m');
    $var =  $this->t_doc_m->creordebdoc($dupe['tipo_doc']);

	$dupe['n_ope_cli']=$this->input->post('n_ope_cli');
	$dupe['data_efe']=implode("-",array_reverse(explode("/",$this->input->post('data_efe'))));
	$dupe['parcela']=$this->input->post('parcela');
	$dupe['n_conta']=$this->input->post('n_conta');
	$dupe['n_cedente']=$this->input->post('n_cedente');
	$dupe['id_d_desp']=$this->input->post('d_desp');
	$dupe['situacao']=$this->input->post('situacao');
	$valorOri = $this->input->post('valor_ori');
	$valorOri = str_replace(",",".",$valorOri);
	$valorEfe = $this->input->post('valor_efe');
 	$valorEfe = str_replace(",",".",$valorEfe);
	if($dupe['situacao']=="19"){
		
		$dupe['valor_ori']=$valorOri * $var; 
		$dupe['valor_efe']=$valorEfe * $var;
		$pbill = $this->bancos_m->paybill($dupe['n_conta'],$dupe['valor_efe']);

	}else{

		$dupe['valor_ori']=$valorOri; 
		$dupe['valor_efe']=$valorEfe;

	}

	$addduplicata = $this->bills_m->addconta($dupe);

	$lid= $this->db->insert_id();

	$dados['iddup']= $this->bills_m->detale_dup($lid);
	$this->load->view('bills_view_det',$dados);


	}


///////////////////////////////////////////////////////////////////////////////////////////////////

}else{

	redirect('/bills', 'refresh');

}







}









 function add_new(){



	$this->load->model('bills_m');
	$this->load->model('bancos_m');


$this->load->model('status_m');

	$this->load->model('fornecedor_m');


	$forn= $this->fornecedor_m->getallfornecedor();




$this->load->helper('form'); //id_user
	$data_menu['username'] = $this->session->userdata('username');
	$this->load->view('menu_view', $data_menu);

	date_default_timezone_set("Brazil/East");


	$dupe['im']="NULL";
	$dupe['data_venc']=implode("-",array_reverse(explode("/",$this->input->post('data_venc'))));
	$dupe['tipo_pag']=$this->input->post('tipo_pag');
	$dupe['tipo_doc']=$this->input->post('tipo_doc');
	$dupe['n_doc']=$this->input->post('n_doc');
	
	$this->load->model('t_doc_m');
    $var =  $this->t_doc_m->creordebdoc($dupe['tipo_doc']);

	$dupe['valor_ori']=$this->input->post('valor_ori') * $var; 
	$dupe['valor_efe']=$this->input->post('valor_efe') * $var;


	$dupe['n_ope_cli']=$this->input->post('n_ope_cli');
	$dupe['data_efe']=implode("-",array_reverse(explode("/",$this->input->post('data_efe'))));
	$dupe['parcela']=$this->input->post('parcela');
	$dupe['n_conta']=$this->input->post('n_conta');
	$dupe['n_cedente']=$this->input->post('n_cedente');
	$dupe['id_d_desp']=$this->input->post('d_desp');
	$dupe['situacao']=$this->input->post('situacao');


$addduplicata = $this->bills_m->addconta($dupe);

$lid= $this->db->insert_id();


$addmore = $this->input->post('addmore');


// faz update no mysql ....
	// carrega o detalhe denovo !!! 

	$this->load->model('bills_m');

//updateconta($updateconta,$id_conta) 

$addduplicata = $this->bills_m->addconta($dupe);

$lid= $this->db->insert_id();

if($addduplicata){ 
 

			$status['status'] = "addicionado com sussesso ";

			$this->load->view('status_view',$status);


			if($dupe['situacao']=="19"){



$v = $dupe['valor_efe'];
$pbill = $this->bancos_m->paybill($dupe['n_conta'],$v);



			}

if($addmore= "add"){

//adicionar mais 












	$duplicata_id =  $this->input->get('dup', TRUE);
	$dp_detale = $this->bills_m->detale_dup($lid);
	$bancos = $this->bancos_m->getallbancos();
	$status = $this->status_m->getallstatus();
	$forn= $this->fornecedor_m->getallfornecedor();


		$iddup['iddup'] = $dp_detale;
		//print_r($bancos);
		$iddup['bancos'] = $bancos;
		$iddup['status'] = $status;
		$iddup['fornecedor'] = $forn;
		$this->load->view('bills_view_new_2',$iddup);
		$data_menu['username'] = $this->session->userdata('username');
		$this->load->view('menu_view', $data_menu);



}




 }else { 




			$status['status'] = "erro ao addicionar conta  ";

			$this->load->view('status_view',$status);


 }

}





function paying(){




$this->load->helper('form');
	$data_menu['username'] = $this->session->userdata('username');
	$this->load->view('menu_view', $data_menu);

	date_default_timezone_set("Brazil/East");
	$wim=$this->input->post('im');
	
	$dupe['valor_efe']=$this->input->post('valor_efe');

	$dupe['data_efe']=implode("-",array_reverse(explode("/",$this->input->post('data_efe'))));

	$dupe['n_conta']=$this->input->post('n_conta');

   $dupe['situacao']=$this->input->post('situacaof');
   $situaori = $this->input->post('situacao');




if($situaori == '19'){ echo "eroro conta ja paga !!!! ";}else{


$this->load->model('bills_m');
$this->load->model('bancos_m');

$pbill = $this->bancos_m->paybill($dupe['n_conta'],$dupe['valor_efe']);

$upduplicata = $this->bills_m->updateconta($dupe,$wim);
if($upduplicata){ echo "ok"; }else{echo "not ok"; }



}



}

function deletepg()
{
	
		// $pg= $this->input->post('situacao');
		$i = $this->input->get_post('im');

$this->load->model('bills_m');
$dup = $this->bills_m->detale_dup($i);

print_r($dup);

$valor = $dup->valor_efe * -1;
$banco = $dup->n_conta;
$pg = $dup->situacao;

// public function detale_dup($duplicata_id)
// {


// $sql ="SELECT * FROM money_control WHERE  im= '$duplicata_id';";
// 		$detale_dup = $this->db->query($sql);
// 		if ($detale_dup->num_rows() > 0){
// 			return $detale_dup->row();
// 		}
// 		return FALSE;
// }





		// $valor=$this->input->post('valor_efe') * -1;
		// $banco= $this->input->post('n_conta');

		$this->load->model('bills_m');
		$d=$this->bills_m->delbill($i);


		if($pg =="19"){

			$this->load->model('bancos_m');

			$pbill = $this->bancos_m->paybill($banco,$valor);

		}



return "Exclu&iacute;do com sussesso !!! ";




}




function update_bill (){
	$this->load->helper('form'); //id_user
	$data_menu['username'] = $this->session->userdata('username');
	$this->load->view('menu_view', $data_menu);

	date_default_timezone_set("Brazil/East");
	$wim=$this->input->post('im');
	$dupe['data_venc']=implode("-",array_reverse(explode("/",$this->input->post('data_venc'))));
	$dupe['tipo_pag']=$this->input->post('tipo_pag');
	$dupe['tipo_doc']=$this->input->post('tipo_doc');
	$dupe['n_doc']=$this->input->post('n_doc');
	$dupe['valor_ori']=$this->input->post('valor_ori');
	$dupe['valor_efe']=$this->input->post('valor_efe');
	$dupe['n_ope_cli']=$this->input->post('n_ope_cli');
	$dupe['data_efe']=implode("-",array_reverse(explode("/",$this->input->post('data_efe'))));
	$dupe['parcela']=$this->input->post('parcela');
	$dupe['n_conta']=$this->input->post('n_conta');
	$dupe['n_cedente']=$this->input->post('n_cedente');
	$dupe['situacao']=$this->input->post('situacao');

// faz update no mysql ....
	// carrega o detalhe denovo !!! 

	$this->load->model('bills_m');

//updateconta($updateconta,$id_conta) 

$upduplicata = $this->bills_m->updateconta($dupe,$wim);


if($upduplicata){ 
 }






	$this->load->helper('form');
		$data_menu['username'] = $this->session->userdata('username');
		$this->load->model('bills_m');
		date_default_timezone_set("Brazil/East");
		$dataHora = date("Y-m-d");
		$contas = $this->bills_m->lcontas($dataHora,$dataHora);
		$this->load->view('menu_view', $data_menu);

		if($contas){
			$dat['duplicatas'] = $contas;
			$dat['tem'] = TRUE;
			$dat['datai']= $dataHora;
			$dat['dataf']= $dataHora;
			$dat['pg']= FALSE;
			$status['status'] = "UPdated ";
			$this->load->view('bills_view',$dat);
			$this->load->view('status_view',$status);





$this->load->library('email');

$this->email->from('ueleiww@gmail.com', 'uelei');
$this->email->to('uelei.8c1ae0e@m.evernote.com'); 

$this->email->subject('Email Test');
$this->email->message('Testing the email class.');	

$this->email->send();

echo $this->email->print_debugger();
















		}else{
			$dat['tem'] = FALSE;
			$dat['datai']= $dataHora;
			$dat['dataf']= $dataHora;
			$dat['pg']= FALSE;
			$status['status'] ="nao tem duplicatas"; 
			$this->load->view('status_view',$status);
			$this->load->view('bills_view',$dat);
		}





// $data = array(
//                'title' => $title,
//                'name' => $name,
//                'date' => $date
//             );

// $this->db->where('id', $id);
// $this->db->update('mytable', $data); 

}


} ?>