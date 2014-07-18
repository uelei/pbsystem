<?php /**
* 
*/
class Login extends CI_Controller
{

function index(){

$this->load->helper('form');
$this->load->view('login_view');

}


function verifica (){

$this->load->model('users');
$user = $this->input->post();
$u=$user['username'];
$p=$user['password'];
$eu = $this->users->autentica($u,$p);
if($eu){

$userlogged = array('id_user' => $eu->id_user,'username' => $eu->username, 'nivel' => $eu->nivel, 'loggedin'=> TRUE	 );
$this->session->set_userdata($userlogged);

redirect('master', 'refresh');
}else {


	redirect('login', 'refresh');
}

}

} ?>