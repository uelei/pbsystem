<?php /**
* 
*/
class T_doc_m extends CI_Model
{
	

public function getalldoc(){

	$tdoc = $this->db->query('SELECT id_t_doc,descricao_t_doc FROM tb_t_doc');
	$doc =array(); 
	$doc[0] = "selecione";
	foreach ($tdoc->result_array() as $row)
		{
			$doc[$row['id_t_doc']]= $row['descricao_t_doc'];
		}
return $doc;
}


public function creordebdoc($iddoc){

$tdoc = $this->db->query('SELECT var FROM tb_t_doc WHERE id_t_doc="'.$iddoc.'"; ');

	foreach ($tdoc->result_array() as $row)
		{
			$doc = $row['var'];
		}
return $doc;




}



} ?>