<?php

/**
 * The Email class its independent ... 
 * just pass the "subject", "to" and the message file done ... 
 * and dont forget to have a jquery thing to implement this 
 * 
 * Customising this email page so that any part of the applicatiokn can call it with 
 * parameters and this will send the required email
 */
class Email extends CI_Controller {
	
	function __construct() {
		parent::__construct();		
	}
	
	function index(){
		$config = array(
			'mailtype' => "html",
			'protocol' => "smtp",
			'smtp_host' => "ssl://smtp.googlemail.com",
			'smtp_port' => 465,
			'smtp_user' => "amar.insane@gmail.com",
			'smtp_pass' => "DiscoFighter1" 
		);
		
		//parts being customised are 
		$subject = $this->input->post('subject');
		$to = $this->input->post('to');
		$msg_template = $this->input->post('email_template');		
		$msg_flag = $this->input->post('msg_flag');
		//end of customisation
		
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");
		
		$this->email->from('amar.insane@gmail.com','Crossbow');
		$this->email->to($to);
		$this->email->subject($subject);
		
		if($msg_flag == 1){
			$this->email->message($msg_template);
		}
		else{
			$msg = $this->load->view('emails/'.$msg_template,'',true);	
			$this->email->message($msg);
		}
		
		if($this->email->send())
		{
			echo "true";
		}
		else
		{
			show_error($this->email->print_debugger());
		}		
	}
}
