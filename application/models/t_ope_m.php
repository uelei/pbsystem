<?php /**
* 
*/
class T_pag_m extends CI_Model
{
	


public function getallpag(){

	$tpag = $this->db->query('SELECT id_t_pag,descricao_t_pag FROM tb_t_pag');
	$pag =array(); 
	$pag[0] = "selecione";
	foreach ($tpag->result_array() as $row)
		{
			$pag[$row['id_t_pag']]= $row['descricao_t_pag'];
		}
return $pag;
}




} ?>