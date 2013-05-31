<?php

/*
 * The main controller where the whole magic starts
 */
 
/**
 * The main class
 */
class Home extends CI_Controller {
	
	function __construct() {
	//the constructor
		parent::__construct();	
	}
	
	function index(){
		//the default one, where it doesnt need a methodname mention
		
		$data['greeting'] = "Good Morning"; //data, just in case you want to pass something to the view
		$this->load->view('home_page', $data);		
	}
	
	function validate_credentials()
	{		
		$this->load->model('home_model');
		$query = $this->home_model->login_validate();

	
	
		if($query) // if the user's credentials validated...
		{
			$data = array(
				'username' => $this->input->post('login_username'),
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			echo 'true';
		}
		else // incorrect username or password
		{
			echo "Invalid Credentials, please try again...";
		}
	 
	}
	
	function access_issue_data()
	{
		$this->load->model('home_model');
		$query = $this->home_model->access_issue_data();
		//$query = 'Rahul,amar';
		if($query == 'Rahul,amar')
		{
			echo 'amar.insane@gmail.com,amar';
		}
		else
		{
			echo "Error";
		}
	}	
}
 
