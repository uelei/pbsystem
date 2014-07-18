<?php 
/**
* 
*/
class Data extends CI_Controller
{


	function index(){


 $sid = $this->session->userdata();
 if(!$sid){



redirect('login', 'refresh');}

$this->load->helper('form');
$msg =$this->input->get_post('msg',TRUE);

$this->load->view('data_view');

$this->load->view('status_view',$msg);




}





}



 ?>