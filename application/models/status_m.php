<?php 

/**
* 
*/
class Status_m extends CI_Model
{
	
public function getallstatus()
{
	# code...
$status = $this->db->query('SELECT order_status_id,name FROM oc_order_status');


//return $bancos->result();

$ar =array(); 
 $ar[0] = "selecione";
foreach ($status->result_array() as $row)
{

	$ar[$row['order_status_id']]= $row['name'];

}

return $ar;


}


}




 ?>