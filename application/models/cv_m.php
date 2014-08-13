<?php 
/**
* 
*/
class Cv_m extends CI_Model
{
	

public function checksaler($codvend)
{
	
//somente caracteres alfanumericos
	$vend = preg_replace("/[^a-zA-Z0-9]+/", "", $codvend);


	$sql ="SELECT * FROM oc_affiliate WHERE  code= '$vend' OR lastname LIKE '$vend';";
		$vend = $this->db->query($sql);
		if ($vend->num_rows() > 0){

			$row = $vend->row(); 

   			return $row->code;

			///return $detale_dup->row();
		}
		return FALSE;


}






public function findproduto($s)
{
if($s=="" OR $s==" "){ 
return '{ "name": " ", "price" : "0" ,"product_id" : " " }';
}	else{

	$sql = "SELECT * FROM oc_product
	INNER JOIN oc_product_description  ON oc_product.product_id = oc_product_description.product_id
	INNER JOIN ci_product_cost ON oc_product.product_id = ci_product_cost.product_id
	WHERE 
	oc_product.product_id = '".$s."' OR ean LIKE '".$s."'  OR sku = '".$s."'";
	$produto = $this->db->query($sql);
	if($produto->num_rows()>0){
		$result = $produto->row_array();
		return json_encode($result);
	}else{
		return '{ "name": " ", "price" : "0" ,"product_id" : " " }';
	}
	











}
	
	
}

public function upvalores($rv,$totalto,$costto,$niten)
{
	# code...

$sql = "SELECT * FROM oc_order
		INNER JOIN oc_order_total_cost ON oc_order.order_id = oc_order_total_cost.order_id
		WHERE 
		oc_order.order_id = '".$rv."';";

	$r = $this->db->query($sql);
	if($r->num_rows()>0){
		$result = $r->row_array();



$ptotal =  $result['total'] + $totalto ;
$data = array(
               'total' => $ptotal,

            );

$this->db->where('order_id',$rv);
$this->db->update('oc_order',$data); 



$pcost = $result['value_cost'] + $costto;
$pnitens = $result['nitens'] + $niten;


$datt = array('value_cost' => $pcost , 'nitens'=> $pnitens );

$this->db->where('order_id',$rv);
$this->db->update('oc_order_total_cost',$datt);

	}











}



















public function upvalor($rv,$totalto)
{
	# code...
$data = array(
               'total' => $totalto,

            );

$this->db->where('order_id',$rv);
$this->db->update('oc_order',$data); 


}

public function uprvstatus($rv,$status,$totals)
{
	


$data = array('order_status_id' => $status);
$this->db->where('order_id',$rv);
$this->db->update('oc_order',$data); 

$ta = str_replace('.', ',', $totals);
$t = "$".$ta;

$datat = array(
   'order_id' => $rv ,
   'code' => 'Total' ,
   'title'=>'Total','text'=> $t ,'value'=> $totals ,'sort_order'=> '9'
);

$this->db->insert('oc_order_total', $datat); 


}




public function insertnewproductcost($dados)
{


$this->db->insert('oc_order_product_cost', $dados); 






}

public function insertnewproduct($dados)
{

$dads =  array('order_id' => $dados['order_id'] ,
 'product_id'=> $dados['product_id'],
 'name'=> $dados['name'],
  'model'=>$dados['model'] 
  ,'quantity'=> $dados['quantity'],
  'price'=> $dados['price'] ,
   'total'=> $dados['total' ],
   'tax'=>'0', 'reward'=> '0');

$this->db->insert('oc_order_product', $dads);
$li = $this->db->insert_id();
//$dados =  array('order_id' => x , 'product_id'=> ,'name'=> , 'model'=> ,'quantity'=> ,'price'=> , 'total'=> ,'tax'=>'0', 'reward'=> '0');
$dad  = array('order_product_id' => $li , 'order_id' => $dados['order_id'],'product_id'=>$dados['product_id'] ,'price_cost' =>$dados['price_cost'] ,
	'total_cost' => $dados['total_cost'] );





$this->db->insert('oc_order_product_cost', $dad); 




/*$data = array(
   'title' => 'My title' ,
   'name' => 'My Name' ,
   'date' => 'My date'
);

$this->db->insert('mytable', $data); 

// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')*/	# code...
}



public function dadosrv($rv)
{



$sql ="SELECT * FROM oc_order
INNER JOIN oc_order_total_cost
ON oc_order.order_id = oc_order_total_cost.order_id
 WHERE  oc_order.order_id= '$rv';";
		$rvs = $this->db->query($sql);
		if ($rvs->num_rows() > 0){
			return $rvs->row_array(); 

		}
	# code...
}



public function listaprodutosrv($rv)
{
	# code...





$sql ="SELECT * FROM oc_order_product WHERE  order_id= '".$rv."' ;";
		$ls = $this->db->query($sql);
		if ($ls->num_rows() > 0){
			return $ls->result_array(); 

		}else {
return FALSE;

		}





}






public function getdadosproduto($id)
{
	# code...
	//order_product_id	

$sql ="SELECT * FROM oc_order_product
INNER JOIN oc_order_product_cost
ON oc_order_product.order_product_id = oc_order_product_cost.order_product_id

 WHERE  oc_order_product.order_product_id= '".$id."' ;";
		$ls = $this->db->query($sql);
		if ($ls->num_rows() > 0){
			return $ls->row_array(); 

		}else {
return FALSE;

		}





}




public function delproduct($i){


$sql ="DELETE FROM oc_order_product_cost WHERE  order_product_id= '$i';";
		$delproductcost = $this->db->query($sql);

$sql ="DELETE FROM oc_order_product WHERE  order_product_id= '$i';";
		$delproduct = $this->db->query($sql);




}




public function criarnovavenda($crianovavenda)
{




$insertnova = $this->db->insert('oc_order', $crianovavenda); 
$i = $this->db->insert_id();


$a = array('order_id' => $i);

$this->db->insert('oc_order_total_cost',$a);


return $i;


}





public function listapagamentorv($rv)
{
	$sql ="SELECT * FROM money_control 
INNER JOIN tb_t_pag ON  money_control.tipo_pag  = tb_t_pag.id_t_pag 
	WHERE  n_doc= '".$rv."' AND tipo_doc = '14'  ;";
		$ls = $this->db->query($sql);
		if ($ls->num_rows() > 0){
			return $ls->result_array(); 
		}else {
return FALSE;

		}
}


public function somapgrv($rv)
{
	$sql ="SELECT SUM( valor_ori ) AS soma FROM money_control
	WHERE  n_doc= '".$rv."' AND tipo_doc = '14'  ;";
		$ls = $this->db->query($sql);
		if ($ls->num_rows() > 0){
			$row = $ls->row_array(); 
			if($row['soma'] == ""  OR $row['soma'] == null){
				return "0";
			}else{
				return $row['soma'];
			}


		}else {
			return FALSE;
		}
}













public function somavendasm($value)
{
// 	$sql = "SELECT `affiliate_id`,SUM(total),usuario.username FROM `oc_order`  
// INNER JOIN usuario ON oc_order.affiliate_id = usuario.id_user
// WHERE MONTH(date_added) = ".$value." AND order_status_id ='5'
// GROUP BY `affiliate_id`";	

$sql = "SELECT oc_order.affiliate_id,af.firstname,SUM(total) AS ts 
FROM `oc_order`  
INNER JOIN oc_affiliate AS af ON oc_order.affiliate_id = af.affiliate_id
WHERE oc_order.date_added LIKE '%".$value."%' AND order_status_id ='5' GROUP BY oc_order.affiliate_id";
$vendas = $this->db->query($sql);
	if($vendas->num_rows()>0){
		$result = $vendas->result_array();
		return json_encode($result);
	}else { return '[{"affiliate_id":"0","username":"-","ts":"0"}]';}


}

public function somavendasmm($value)
{

	$at = 0.0;
	$sqlavg = "SELECT SUM(x.ts)/count(*) AS avgt  FROM ( SELECT date_added,SUM(total) AS ts
	FROM oc_order WHERE date_added LIKE  '".$value."%' GROUP BY MONTH( date_added ) ) x"; 
	$q = $this->db->query($sqlavg);
	if ($q->num_rows() > 0)
	{
	   foreach ($q->result() as $r)
	   {
	      $at =   number_format($r->avgt, 2, '.', '');

	   }
	}	

	$a = array();
	$sql = "SELECT  MONTHNAME(date_added ) AS m , SUM( total ) AS ts
	FROM oc_order WHERE date_added LIKE  '".$value."%' 
	GROUP BY MONTH( date_added ) 
	ORDER BY MONTH( date_added ) ASC";
	$vendas = $this->db->query($sql);
		if($vendas->num_rows()>0){
	$i = 0;
	foreach ($vendas->result_array() as $row)
	{ 

	 $a[$i]['m'] = $row['m'];
	 $a[$i]['ts']= $row['ts'];
	 $a[$i]['avg']= $at;
	$i++;

	}

	return json_encode($a);
	}else { return '[{"affiliate_id":"0","username":"-","ts":"0"}]';}


}




public function somavendasd($value)
{

	$at = 0.0;
	$sqlavg = "SELECT SUM(x.ts)/count(*) AS avgt  FROM ( SELECT DAY(date_added), SUM(total) AS ts
	FROM oc_order WHERE date_added LIKE  '".$value."%' GROUP BY DAY( date_added )) x"; 
	$q = $this->db->query($sqlavg);
	if ($q->num_rows() > 0)
	{
	   foreach ($q->result() as $r)
	   {
	      $at =   number_format($r->avgt, 2, '.', '');

	   }
	}



	$a = array();
	$sql = "SELECT  DAY( date_added ) AS day , SUM( total ) AS ts
	FROM oc_order WHERE date_added LIKE  '".$value."%' 
	GROUP BY DAY( date_added ) 
	ORDER BY DAY( date_added ) ASC ";
	$vendas = $this->db->query($sql);
		if($vendas->num_rows()>0){
	$i = 0;
	foreach ($vendas->result_array() as $row)
	{ 

	 $a[$i]['day'] = $row['day'];
	 $a[$i]['ts']= $row['ts'];
	 $a[$i]['avg']= $at;
	$i++;

	}

	return json_encode($a);
	}else { return '[{"affiliate_id":"0","username":"-","ts":"0"}]';}

}




public function listaUltimasVendas()
{
	$sql ='SELECT order_id,affiliate_id,total,date_added FROM `oc_order` WHERE `order_status_id`=5 ORDER BY `oc_order`.`order_id` DESC LIMIT 5;';
	$ultimasVendas = $this->db->query($sql);
	if ($ultimasVendas->num_rows()>0){
		$result= $ultimasVendas->result();
		return $result;

	}
	else
		{return "error on Loading last salles !!!";}




}



/*SELECT DATE_FORMAT(date, "%m-%Y") AS Month, SUM(numofsale)
FROM <table_name>
WHERE <where-cond>
GROUP BY DATE_FORMAT(date, "%m-%Y") */


/*SELECT  MONTHNAME(date_added),SUM(total) FROM `oc_order`  

WHERE YEAR(date_added) = "2013" AND order_status_id ='5'


GROUP BY YEAR(date_added),MONTH(date_added)*/






function socksreportsun($dai,$daf,$meias)
{



	$re  = array();
	# magic 
	foreach ($meias as $socks) {
		# code...
	
	if(strcmp($dai,$daf)==0){

	$sql ="SELECT SUM(quantity) AS sq , SUM(total) AS st 
		FROM `oc_order_product` 
		WHERE order_id IN (
			SELECT order_id FROM `oc_order` WHERE date_added LIKE '$dai%'
			) AND product_id = '$socks';";
	}else { 
	$sql ="SELECT SUM(quantity) AS sq , SUM(total) AS st 
		FROM `oc_order_product` 
		WHERE order_id IN (
			SELECT order_id FROM `oc_order` WHERE date_added >= '$dai' AND date_added <= '$daf'
			) AND product_id = '$socks';";
}



		$somasock = $this->db->query($sql);
		if ($somasock->num_rows() > 0){
		  $re[$socks] = $somasock->row();
			
		}else{  $re[$socks] = " ";}



}


return $re;




}




}








/*
check tb order !!! 
DELETE FROM oc_order_product WHERE (SELECT count(1) FROM oc_order WHERE order_id = oc_order_product.order_id) < 1


*/

 ?>