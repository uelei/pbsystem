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

$userlogged = array('id_user' => $eu->user_id,'username' => $eu->username, 'nivel' => '9', 'loggedin'=> TRUE	 );
$this->session->set_userdata($userlogged);

redirect('master', 'refresh');
}else {


	redirect('login', 'refresh');
}

}

} ?>