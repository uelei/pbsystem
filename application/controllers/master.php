<?php /**
* 
*/
class Master extends MY_Controller
{
	
	function index()
	{

		$data_menu['username'] = $this->session->userdata('username');
    	$this->load->view('menu_view',$data_menu);
		$this->load->view('master_view');




	}

	function logout(){
		$this->session->unset_userdata('loggedin');
		redirect('/');
	}



} ?>