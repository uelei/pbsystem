<?php /**
* 
*/
class D_desp_m extends CI_Model
{
	

public function getallddesp(){

	$ddesp = $this->db->query('SELECT i_d_desp,desc_d_desp FROM tb_d_desp');
	$d =array(); 
	$d[0] = "selecione";
	foreach ($ddesp->result_array() as $row)
		{
			$d[$row['i_d_desp']]= $row['desc_d_desp'];
		}
return $d;
}



} ?>