<?php /**
* 
*/
class MY_Controller extends CI_Controller
{
	
  function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('cookie');
        //delete_cookie("name");
//$this->input->cookie('some_data', TRUE);

        if (!$this->session->userdata('loggedin') && !$this->input->cookie("loggedin",TRUE))
        {
            redirect('login');
        }
    }
} ?>