<?php

/**
 * The home model for all db stuff required from home
 */
class Home_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function login_validate(){
	
		$this->db->where('reg_num', $this->input->post('login_username'));
		$this->db->where('password', $this->input->post('login_password'));
		$query = $this->db->get('s1_login_details');
		
		if($query->num_rows == 1)
		{
			/*
			 * Assign relavent data into the session... those are as follows
			 * 1. c_id - basic for alltypes of operations
			 * 2. c_category - for page check
			 * 3. manager_id - id of the manager .. for any submissions and approval.. if not head
			 * 3. is_head - to check if he/she has write permissions for the particular things they are working on.
			 */
					
			$query2 = 'SELECT c_id from s1_candidates WHERE reg_num="'.$this->input->post('login_username').'"';
			$q = $this->db->query($query2);
			
			foreach ($q->result() as $row) {
				$c_id = $row->c_id;
			}
			// got c_id, now get categories and get if manager or not.
			
			
			
			$query = 'SELECT c_catagory, manager from s1_candidate_catagory WHERE c_id='.$c_id;
			$q = $this->db->query($query);
			
			if($q->num_rows() > 0)
			{
			   foreach ($q->result() as $row) {
				   $catagory_temp = $row->c_catagory;
				   $manager_temp = $row->manager;
				   
				   $is_head = ($catagory_temp == 2)?(($manager_temp == 0)?1:0):(($manager_temp == 1)?1:0);
				   
				   $catagory_list['catagory'][] = $catagory_temp;
				   $catagory_list['my_manager'][] = $manager_temp;
				   $catagory_list['is_head'][] = $is_head;
				   
			   }
			}
			
			$this->session->set_userdata('c_id', $c_id);
			$this->session->set_userdata('catagories', $catagory_list);
			return true;
		}
	}
	
	function access_issue_data(){
		// need to fetch the email id of the user and passit back
		
		$query = 'SELECT ld.password, cd.first_name FROM s1_candidates cd, s1_login_details ld WHERE cd.reg_num="'.$this->input->post('reg_num').'" and ld.c_id = cd.c_id';
		$q = $this->db->query($query);  
		
		if($q->num_rows() > 0){
			
			foreach ($q->result() as $row) {
				$ret_string = $row->first_name;
				$ret_string .= ','.$row->password;
			}
			
		}
		return $ret_string; 
		
	}
}
