<?php /**
* 
*/
class Users extends CI_Model
{
	
public function autentica($usuario,$senha){

$query = $this->db->query("SELECT salt FROM oc_user WHERE username = '".$usuario."';");
$ret = $query->row();
$s= $ret->salt;

$has = sha1($s.sha1($s.sha1($senha)));

$consulta = $this->db->query("SELECT * FROM oc_user  WHERE username='".$usuario."' and password='".$has."';");

if ($consulta->num_rows() > 0)
{
 $u = $consulta -> row();
	return $u;
}

return FALSE;

}
} ?>