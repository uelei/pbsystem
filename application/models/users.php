<?php /**
* 
*/
class Users extends CI_Model
{
	
public function autentica($usuario,$senha){

$consulta = $this->db->query("SELECT * FROM usuario WHERE username='$usuario' and password=md5('".$senha."');");
if ($consulta->num_rows() > 0)
{
 $u = $consulta -> row();


// $user_detale = array('username' => $u->username,'nivel'=> $u->nivel );



	return $u;
//	return $consulta
//    foreach ($consulta->result() as $campos)
//    {
// $usuario_login  = array('id_user' => $campos->id_user, );
//    }

}

return FALSE;

}
} ?>