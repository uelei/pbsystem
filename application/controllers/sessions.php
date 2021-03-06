<?php 
class Sessions extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('session');
		$this->load->library('form_validation');

    }

    function login()
    {
      #  $this->load->view('header');
        $this->load->view('login');
       # $this->load->view('footer');
    }

    function authenticate()
    {
        $this->load->model('user', '', true);

        $user = $this->input->post('user');

        if ($this->user->authenticate($user['email'], $user['password']))
        {
            $this->session->set_userdata('loggedin', true);
            $cookie = "loggedin";
            $this->input->set_cookie($cookie);

        }

        redirect('/');
    }

    function logout()
    {
        $this->load->helper('cookie');
        $this->session->unset_userdata('loggedin');
        delete_cookie("loggedin");

        redirect('/');
    }
}

 ?>