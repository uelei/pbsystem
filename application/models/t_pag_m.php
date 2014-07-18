<?php /**
* 
*/
class T_pag_m extends CI_Model
{
	


public function getallpag(){

	$tope = $this->db->query('SELECT id_t_pag,descricao_t_pag FROM tb_t_pag');
	$ope =array(); 
	$ope[0] = "selecione";
	foreach ($tope->result_array() as $row)
		{
			$ope[$row['id_t_pag']]= $row['descricao_t_pag'];
		}
return $ope;
}


public function getallpagf(){

	$tope = $this->db->query('SELECT id_t_pag,descricao_t_pag FROM tb_t_pag');
	$ope =array(); 
	foreach ($tope->result_array() as $row)
		{
			$ope[$row['id_t_pag']]= $row['descricao_t_pag'];
		}
return $ope;
}





public function getdadospag($t_pag_m)
{
	$sql='SELECT * FROM tb_t_pag WHERE id_t_pag ="'.$t_pag_m.'";';
	$rpg = $this->db->query($sql);
	if ($rpg->num_rows() > 0){
		$result = $rpg->row_array();
		return json_encode($result);
	}else{
	// 	return '{ "name": " ", "price" : "0" ,"product_id" : " " }';
	// }
	// 	return $rpg->row_array(); 
	// }else{ 
		return FALSE;
	}


}



} ?>