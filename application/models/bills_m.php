<?php /**
* 
*/
class Bills_m extends CI_Model
{
	
	public function lcontas($data,$intervalo)
	{
		$sql ="SELECT *,oc_manufacturer.name AS forn_name FROM money_control 
		INNER JOIN oc_manufacturer  ON money_control.n_cedente = oc_manufacturer.manufacturer_id 
		INNER JOIN tb_t_pag ON money_control.tipo_pag=tb_t_pag.id_t_pag 
		INNER JOIN tb_d_desp ON money_control.id_d_desp=tb_d_desp.i_d_desp 
		INNER JOIN oc_order_status ON money_control.situacao = oc_order_status.order_status_id 
		INNER JOIN tb_t_doc ON money_control.tipo_doc = tb_t_doc.id_t_doc  
		WHERE money_control.data_venc >= '$data' and money_control.data_venc <= '$intervalo' OR money_control.data_efe >= '$data' and money_control.data_efe <= '$intervalo' 
		ORDER BY money_control.data_venc ASC; ";
		$listacontas = $this->db->query($sql);
		if ($listacontas->num_rows() > 0){
			return $listacontas->result();
			
		}
		return FALSE;
	}


	public function lcartaocredito($data,$intervalo)
	{
		$sql ="SELECT *,oc_manufacturer.name AS forn_name FROM money_control 
		INNER JOIN oc_manufacturer  ON money_control.n_cedente = oc_manufacturer.manufacturer_id 
		INNER JOIN tb_t_pag ON money_control.tipo_pag=tb_t_pag.id_t_pag 
		INNER JOIN tb_d_desp ON money_control.id_d_desp=tb_d_desp.i_d_desp 
		INNER JOIN oc_order_status ON money_control.situacao = oc_order_status.order_status_id 
		INNER JOIN tb_t_doc ON money_control.tipo_doc = tb_t_doc.id_t_doc  
		WHERE money_control.data_venc >= '$data' and money_control.data_venc <= '$intervalo' and tipo_doc ='14' and situacao !='19'   OR money_control.data_efe >= '$data' and money_control.data_efe <= '$intervalo'  and tipo_doc ='14' and situacao !='19' 
		ORDER BY money_control.data_venc ASC; ";
		$listacontas = $this->db->query($sql);
		if ($listacontas->num_rows() > 0){
			return $listacontas->result();
			
		}
		return FALSE;
	}





public function detale_dup($duplicata_id)
{


$sql ="SELECT * FROM money_control WHERE  im= '$duplicata_id';";
		$detale_dup = $this->db->query($sql);
		if ($detale_dup->num_rows() > 0){
			return $detale_dup->row();
		}
		return FALSE;
}

public function updateconta($updateconta,$id_conta){
// $data = array(
//                'title' => $title,
//                'name' => $name,
//                'date' => $date
//             );
//echo $id_conta.'<br><br>';
// $this->db->where('id', $id);
// $this->db->update('mytable', $data); 
//print_r($updateconta);

$upd = $this->db->where('im', $id_conta);
$upd = $this->db->update('money_control', $updateconta); 

if ($this->db->affected_rows() > 0)
{
  return TRUE;
}
else
{

  return FALSE;
}
// $data = array('name' => $name, 'email' => $email, 'url' => $url);

// $where = "author_id = 1 AND status = 'active'"; 

// $str = $this->db->update_string('table_name', $data, $where);

	
}







public function delbill($i){


$sql ="DELETE FROM money_control WHERE  im= '$i';";
		$delbill = $this->db->query($sql);
if ($this->db->affected_rows() > 0)
{
  return TRUE;
}
else
{

  return FALSE;
}


}












public function addconta($addconta){
// $data = array(
//                'title' => $title,
//                'name' => $name,
//                'date' => $date
//             );
//echo $id_conta.'<br><br>';
// $this->db->where('id', $id);
// $this->db->update('mytable', $data); 
//print_r($updateconta);
//$upd = $this->db->where('im', $id_conta);
$upd = $this->db->insert('money_control', $addconta); 


if ($this->db->affected_rows() > 0)
{
  return TRUE;
}
else
{


  return FALSE;
}
// $data = array('name' => $name, 'email' => $email, 'url' => $url);

// $where = "author_id = 1 AND status = 'active'"; 

// $str = $this->db->update_string('table_name', $data, $where);

	
}













}
?>