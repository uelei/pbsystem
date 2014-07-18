<?php /**
* 
*/
class Bancos_m extends CI_Model
{



public function paybill($banco,$valor){

$q=$this->db->query('SELECT saldo_conta FROM tb_contas WHERE id_conta='.$banco);
$v=$q->row_array();
$saldo = $v['saldo_conta'] + $valor;
$qq= $this->db->query('UPDATE tb_contas SET saldo_conta='.$saldo.' WHERE id_conta='.$banco);
return TRUE;


}

public function getallsaldos(){

$q = $this->db->query('SELECT * FROM tb_contas');



return $q->result_array();

}



public function getallbancos(){


$bancos = $this->db->query('SELECT id_conta,descricao_conta FROM tb_contas');


//return $bancos->result();

$ar =array(); 
 $ar[0] = "selecione";
foreach ($bancos->result_array() as $row)
{

	$ar[$row['id_conta']]= $row['descricao_conta'];

}

return $ar;
// foreach ($query->result_array() as $row)
// {
//     echo $row['title'];
//     echo $row['name'];
//     echo $row['email'];
// }




}





} ?>