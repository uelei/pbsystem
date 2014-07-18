<?php /**
* 
*/
class Fornecedor_m extends CI_Model
{

public function getallfornecedor(){

$f = $this->db->query('SELECT manufacturer_id,name FROM oc_manufacturer');



$forn =array(); 
 $forn[0] = "selecione";
foreach ($f->result_array() as $row)
{

	$forn[$row['manufacturer_id']]= $row['name'];

}

return $forn;


}	


} ?>