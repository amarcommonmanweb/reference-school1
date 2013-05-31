<?php

/*
 * The controller after logging in 
 */
class Site extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function members_area(){
		/*
		 * Check here ifthe member is an admin or not, if yes, direct to main console .. 
		 * or the ordinary pages of operation
		 */
		 
		$tmp = $this->session->userdata('catagories');
		$is_admin = 1;
		foreach ($tmp['catagory'] as $key => $value) {
			// if he has admin rights over the system
			
			$is_admin = ($value == 2)?1:0;
			if($is_admin == 1){break;}
			
		}
		if($is_admin == 1)
		{// go to the admin console
			$data['greeting'] = 'Good Morning';  //some data to passon to the view .. like session variables
			$this->load->view('admin_area', $data);	
		}
		else
		{ // go to normal pages
			$data['greeting'] = 'Good Morning';
			$this->load->view('logged_in_area', $data);
		}
		
	}
	
	function get_admin_boxes(){
		
		$this->load->model('site_model');
		$query = $this->site_model->get_admin_boxes();
		 
		echo $query;
	}
	
	
	function load_func($func_num){
		
		/*
		 * loading the views for all the functions possible
		 * 
		*/		
		switch ($func_num) {
			
			case 1:
				$data['page_load'] = 'add_department';
				$this->load->view('func_includes/main_template', $data); break;
			case 2:
				$data['page_load'] = 'add_class';
				$this->load->view('func_includes/main_template', $data); break;
			case 3:
				$data['page_load'] = 'add_section';
				$this->load->view('func_includes/main_template', $data); break;	
			case 4:
				$data['page_load'] = 'add_designation';
				$this->load->view('func_includes/main_template', $data); break;
			case 5:
				$data['page_load'] = 'edit_school_details';
				$this->load->view('func_includes/main_template', $data); break;
			case 6:
				$data['page_load'] = 'add_staff';
				$this->load->view('func_includes/main_template', $data); break;	
			case 7:
				$data['page_load'] = 'add_teacher';
				$this->load->view('func_includes/main_template', $data); break;
			case 8:
				$data['page_load'] = 'add_students';
				$this->load->view('func_includes/main_template', $data); break;
			case 9:
				$data['page_load'] = 'archive_personal_data';
				$this->load->view('func_includes/main_template', $data); break;	
			case 10:
				$data['page_load'] = 'edit_personal_details';
				$this->load->view('func_includes/main_template', $data); break;
			case 11:
				$data['page_load'] = 'manage_permissions';
				$this->load->view('func_includes/main_template', $data); break;
			case 12:
				$data['page_load'] = 'policies_and_rules_setup';
				$this->load->view('func_includes/main_template', $data); break;
			case 13:
				$data['page_load'] = 'admission_initiate';
				$this->load->view('func_includes/main_template', $data); break;
			case 14:
				$data['page_load'] = 'admission_subject_setup';
				$this->load->view('func_includes/main_template', $data); break;	
			case 15:
				$data['page_load'] = 'admission_dashboard';
				$this->load->view('func_includes/main_template', $data); break;
			case 16:
				$data['page_load'] = 'admission_test_setup';
				$this->load->view('func_includes/main_template', $data); break;
			case 17:
				$data['page_load'] = 'exam_schedules';
				$this->load->view('func_includes/main_template', $data); break;	
			case 18:
				$data['page_load'] = 'exam_wise_marks';
				$this->load->view('func_includes/main_template', $data); break;
			case 19:
				$data['page_load'] = 'reports_and_trends';
				$this->load->view('func_includes/main_template', $data); break;
			case 20:
				$data['page_load'] = 'timetable_setup';
				$this->load->view('func_includes/main_template', $data); break;	
			case 21:
				$data['page_load'] = 'holiday_calender_setup';
				$this->load->view('func_includes/main_template', $data); break;
			case 22:
				$data['page_load'] = 'question_paper_logs';
				$this->load->view('func_includes/main_template', $data); break;
			case 23:
				$data['page_load'] = 'local_study_material';
				$this->load->view('func_includes/main_template', $data); break;
			case 24:
				$data['page_load'] = 'scholorship_setup';
				$this->load->view('func_includes/main_template', $data); break;
			case 25:
				$data['page_load'] = 'report_cards';
				$this->load->view('func_includes/main_template', $data); break;	
			case 26:
				$data['page_load'] = 'cocurricular_activities_and_events';
				$this->load->view('func_includes/main_template', $data); break;
			case 27:
				$data['page_load'] = 'fees_charges_setup';
				$this->load->view('func_includes/main_template', $data); break;
			case 28:
				$data['page_load'] = 'reciept_design';
				$this->load->view('func_includes/main_template', $data); break;	
			case 29:
				$data['page_load'] = 'check_fee_status';
				$this->load->view('func_includes/main_template', $data); break;
			case 30:
				$data['page_load'] = 'payroll_setting';
				$this->load->view('func_includes/main_template', $data); break;
			case 31:
				$data['page_load'] = 'payroll_status';
				$this->load->view('func_includes/main_template', $data); break;	
			case 32:
				$data['page_load'] = 'expenditure';
				$this->load->view('func_includes/main_template', $data); break;
			case 33:
				$data['page_load'] = 'bank_account_details';
				$this->load->view('func_includes/main_template', $data); break;
			case 34:
				$data['page_load'] = 'cash_book';
				$this->load->view('func_includes/main_template', $data); break;
			case 35:
				$data['page_load'] = 'finance_policies';
				$this->load->view('func_includes/main_template', $data); break;
			case 36:
				$data['page_load'] = 'add_book';
				$this->load->view('func_includes/main_template', $data); break;	
			case 37:
				$data['page_load'] = 'books_audit';
				$this->load->view('func_includes/main_template', $data); break;
			case 38:
				$data['page_load'] = 'issue_book';
				$this->load->view('func_includes/main_template', $data); break;
			case 39:
				$data['page_load'] = 'reserve_book';
				$this->load->view('func_includes/main_template', $data); break;	
			case 40:
				$data['page_load'] = 'return_book';
				$this->load->view('func_includes/main_template', $data); break;
			case 41:
				$data['page_load'] = 'our_health_centres';
				$this->load->view('func_includes/main_template', $data); break;
			case 42:
				$data['page_load'] = 'our_doctors';
				$this->load->view('func_includes/main_template', $data); break;	
			case 43:
				$data['page_load'] = 'student_health_records';
				$this->load->view('func_includes/main_template', $data); break;
			case 44:
				$data['page_load'] = 'student_visits';
				$this->load->view('func_includes/main_template', $data); break;
			case 45:
				$data['page_load'] = 'in_house_medicenes';
				$this->load->view('func_includes/main_template', $data); break;
			case 46:
				$data['page_load'] = 'manage_school_assets';
				$this->load->view('func_includes/main_template', $data); break;
			case 47:
				$data['page_load'] = 'raise_order_for_new_asset';
				$this->load->view('func_includes/main_template', $data); break;	
			case 48:
				$data['page_load'] = 'asset_maintenance_schedule';
				$this->load->view('func_includes/main_template', $data); break;
			case 49:
				$data['page_load'] = 'asset_booking';
				$this->load->view('func_includes/main_template', $data); break;
			case 50:
				$data['page_load'] = 'daily_menu';
				$this->load->view('func_includes/main_template', $data); break;	
			case 51:
				$data['page_load'] = 'caterers_profile';
				$this->load->view('func_includes/main_template', $data); break;
			case 52:
				$data['page_load'] = 'requests_and_feedback';
				$this->load->view('func_includes/main_template', $data); break;
			case 53:
				$data['page_load'] = 'vehicles_and_specifications';
				$this->load->view('func_includes/main_template', $data); break;	
			case 54:
				$data['page_load'] = 'maintenance_schedule';
				$this->load->view('func_includes/main_template', $data); break;
			case 55:
				$data['page_load'] = 'transport_charges_setup';
				$this->load->view('func_includes/main_template', $data); break;
			case 56:
				$data['page_load'] = 'trnsport_booking';
				$this->load->view('func_includes/main_template', $data); break;
			case 57:
				$data['page_load'] = 'regisered_players';
				$this->load->view('func_includes/main_template', $data); break;
			case 58:
				$data['page_load'] = 'raise_equipment_request';
				$this->load->view('func_includes/main_template', $data); break;	
			case 59:
				$data['page_load'] = 'previous_participation_details';
				$this->load->view('func_includes/main_template', $data); break;
			case 60:
				$data['page_load'] = 'training_schedule_and_setup';
				$this->load->view('func_includes/main_template', $data); break;
			case 61:
				$data['page_load'] = 'employee_attendance';
				$this->load->view('func_includes/main_template', $data); break;	
			case 62:
				$data['page_load'] = 'employee_leave_plan';
				$this->load->view('func_includes/main_template', $data); break;
			case 63:
				$data['page_load'] = 'student_atendance_logs';
				$this->load->view('func_includes/main_template', $data); break;
			case 64:
				$data['page_load'] = 'teacher_attendance_logs';
				$this->load->view('func_includes/main_template', $data); break;	
			case 65:
				$data['page_load'] = 'approve_leaves';
				$this->load->view('func_includes/main_template', $data); break;
			case 66:
				$data['page_load'] = 'teachers_leave_report';
				$this->load->view('func_includes/main_template', $data); break;
			case 67:
				$data['page_load'] = 'students_leave_report';
				$this->load->view('func_includes/main_template', $data); break;				
			case 68:
				$data['page_load'] = 'admission_questionbank_setup';
				$this->load->view('func_includes/main_template', $data); break;
			default:
				echo 'Default: Some error in the selection<button style="float: right;margin: 3px 10px 0px 0px;" id="admin_call_send"> &nbsp;&nbsp;Contact Admin&nbsp;&nbsp; </button>';
				break;
		}
	}


   /*
    * NOTE: each function code specifies the operation of that particular module..
    * hence each code redirecs the control to the place where that function can be performed
    * 
    * NOTE: name of the function is the same as the module name .. the same will be maintained inthe model also
    * 

	/*
	//START : admission functions
	*/

	function admission_subject_setup($func_code){
		
		switch ($func_code) {
			case '1':
					//FUNCTION DESC: to fetch the subject and subject code list initially  - get_subjects()  
					$this->load->model('site_model');
					$result = $this->site_model->admission_subject_setup(1);
					echo $result;
					
				break;
					
			case '2':
					//FUNCTION DESC: to save the details added to the subjects list  - save_row_subject_code()  
					$this->load->model('site_model');
					$result = $this->site_model->admission_subject_setup(2);
					echo $result;
					
				break;
				
			case '3':
					//FUNCTION DESC: to Updatethe subject to db  - update_row_subject()  
					$this->load->model('site_model');
					$result = $this->site_model->admission_subject_setup(3);
					echo $result;	
				break;
				
			case '4':
					//FUNCTION DESC: to Update the subject to db  - update_row_subject()  
					$this->load->model('site_model');
					$result = $this->site_model->admission_subject_setup(4);
					echo $result;	
				break;
					
			default:
					
				break;
		}
		
	}
		
	/*
	//END : admission functions
	*/
	
	//-------------------------------------------------------------------------
	
	/*
	//START : Inventory functions
	*/
	
	function manage_school_assets($func_code){
		
		switch ($func_code) {
			case 1:
					//FUNCTION DESC: fetch all the department categories: load_dept_categories()
					$this->load->model('site_model');
					$result = $this->site_model->manage_school_assets(1);
					echo $result;
					
				break;
			 case 2:
				 ChromePhp::log('reaching the 2 part of controller');
				    //FUNCTION DESC: fetch the assets for the department selected: load_dept_assets()
				    $this->load->model('site_model');
					$result = $this->site_model->manage_school_assets(2);
					echo $result;
				break;	
			case 3:
				
				    //FUNCTION DESC: save form data to db: ()
				    $this->load->model('site_model');
					$result = $this->site_model->manage_school_assets(3);
					echo $result;
				break;
			case 4:
				    //FUNCTION DESC: autocomplete dept()
				  
				    $this->load->model('site_model');
					$result = $this->site_model->manage_school_assets(4);
					echo $result;
				break;
			case 5:
				//FUNCTION DEC: load all the states on startup
				 $this->load->model('site_model');
					$result = $this->site_model->manage_school_assets(5);
					echo $result;
			break;	
			case 6:
				//FUNCTION DEC: load all the states on startup
				 $this->load->model('site_model');
					$result = $this->site_model->manage_school_assets(6);
					echo $result;
			break;		
			
			case 7:
				
				//FUNCTION DEC: load all the depts on startup
				 $this->load->model('site_model');
					$result = $this->site_model->manage_school_assets(7);
					echo $result;
			break;	
			default:
				
				break;
		}
	}
	
	/*
	//END : Inventory functions
	*/
	
	/*
	 * Stariting the auto complete functions
	 * 
	 */
	
		function autocomplete_46($string){
			switch ($string) {
				case 1:
					//for dept
					
					$this->load->model('site_model');
					$result = $this->site_model->autocomplete_46(1);
					echo $result;
				break;
				
				case 2:
					//for shop name
					$this->load->model('site_model');
					$result = $this->site_model->autocomplete_46(2);
					echo $result;	
				break;	
				
				default:
					//all the auto feilds filling tasks
											
				break;
			}
			
			
		}
		
		function autofill_46($string){
			
					$this->load->model('site_model');
					$result = $this->site_model->autofill_46(urldecode($string));
					
					echo $result;
		}
	 
	 /* 
	 * 
	 * END OF ALL AUTO COMPLETE FUNCTIONS
	 */ 
	
	
	
	
	
	
	
	
	
	
	
	// let this function be here for now
	function func_load($func_num){
		
		$this->load->model('site_model');
		switch ($func_num) {
			/*
			 * This is the place where the final function to the functions end up
			 * and the model returns values..
			 * that is displayed as a success or error
			 * 
			 * 
			 */
			case 1:
				$query = $this->site_model->f_add_department();
				break;
			case 2:
				$query = $this->site_model->f_add_class();
				break;
			case 3:
				$query = $this->site_model->f_add_section();
				break;	
			case 4:
				$query = $this->site_model->f_add_designation();
				break;
			case 5:
				$query = $this->site_model->f_edit_school_details();
				break;
			case 6:
				$query = $this->site_model->f_add_staff();
				break;	
			case 7:
				$query = $this->site_model->f_add_teacher();
				break;
			case 8:
				$query = $this->site_model->f_add_students();
				break;
			case 9:
				$query = $this->site_model->f_archive_personal_data();
				break;	
			case 10:
				$query = $this->site_model->f_edit_personal_details();
				break;
			case 11:
				$query = $this->site_model->f_manage_permissions();
				break;
			case 12:
				$query = $this->site_model->f_policies_and_rules_setup();
				break;
			case 13:
				$query = $this->site_model->f_admission_initiate();
				break;
			case 14:
				$query = $this->site_model->f_admission_subject_setup();
				break;	
			case 15:
				$query = $this->site_model->f_admission_dashboard();
				break;
			case 16:
				$query = $this->site_model->f_admission_test_setup();
				break;
			case 17:
				$query = $this->site_model->f_exam_schedules();
				break;	
			case 18:
				$query = $this->site_model->f_exam_wise_marks();
				break;
			case 19:
				$query = $this->site_model->f_reports_and_trends();
				break;
			case 20:
				$query = $this->site_model->f_timetable_setup();
				break;	
			case 21:
				$query = $this->site_model->f_holiday_calender_setup();
				break;
			case 22:
				$query = $this->site_model->f_question_paper_logs();
				break;
			case 23:
				$query = $this->site_model->f_local_study_material();
				break;
			case 24:
				$query = $this->site_model->f_scholorship_setup();
				break;
			case 25:
				$query = $this->site_model->f_report_cards();
				break;	
			case 26:
				$query = $this->site_model->f_cocurricular_activities_and_events();
				break;
			case 27:
				$query = $this->site_model->f_fees_charges_setup();
				break;
			case 28:
				$query = $this->site_model->f_reciept_design();
				break;	
			case 29:
				$query = $this->site_model->f_check_fee_status();
				break;
			case 30:
				$query = $this->site_model->f_payroll_setting();
				break;
			case 31:
				$query = $this->site_model->f_payroll_status();
				break;	
			case 32:
				$query = $this->site_model->f_expenditure();
				break;
			case 33:
				$query = $this->site_model->f_bank_account_details();
				break;
			case 34:
				$query = $this->site_model->f_cash_book();
				break;
			case 35:
				$query = $this->site_model->f_finance_policies();
				break;
			case 36:
				$query = $this->site_model->f_add_book();
				break;	
			case 37:
				$query = $this->site_model->f_books_audit();
				break;
			case 38:
				$query = $this->site_model->f_issue_book();
				break;
			case 39:
				$query = $this->site_model->f_reserve_book();
				break;	
			case 40:
				$query = $this->site_model->f_return_book();
				break;
			case 41:
				$query = $this->site_model->f_our_health_centres();
				break;
			case 42:
				$query = $this->site_model->f_our_doctors();
				break;	
			case 43:
				$query = $this->site_model->f_student_health_records();
				break;
			case 44:
				$query = $this->site_model->f_student_visits();
				break;
			case 45:
				$query = $this->site_model->f_in_house_medicenes();
				break;
			case 46:
				$query = $this->site_model->f_manage_school_assets();
				break;
			case 47:
				$query = $this->site_model->f_raise_order_for_new_asset();
				break;	
			case 48:
				$query = $this->site_model->f_asset_maintenance_schedule();
				break;
			case 49:
				$query = $this->site_model->f_asset_booking();
				break;
			case 50:
				$query = $this->site_model->f_daily_menu();
				break;	
			case 51:
				$query = $this->site_model->f_caterers_profile();
				break;
			case 52:
				$query = $this->site_model->f_requests_and_feedback();
				break;
			case 53:
				$query = $this->site_model->f_vehicles_and_specifications();
				break;	
			case 54:
				$query = $this->site_model->f_maintenance_schedule();
				break;
			case 55:
				$query = $this->site_model->f_transport_charges_setup();
				break;
			case 56:
				$query = $this->site_model->f_trnsport_booking();
				break;
			case 57:
				$query = $this->site_model->f_regisered_players();
				break;
			case 58:
				$query = $this->site_model->f_raise_equipment_request();
				break;	
			case 59:
				$query = $this->site_model->f_previous_participation_details();
				break;
			case 60:
				$query = $this->site_model->f_training_schedule_and_setup();
				break;
			case 61:
				$query = $this->site_model->f_employee_attendance();
				break;	
			case 62:
				$query = $this->site_model->f_employee_leave_plan();
				break;
			case 63:
				$query = $this->site_model->f_student_atendance_logs();
				break;
			case 64:
				$query = $this->site_model->f_teacher_attendance_logs();
				break;	
			case 65:
				$query = $this->site_model->f_approve_leaves();
				break;
			case 66:
				$query = $this->site_model->f_teachers_leave_report();
				break;
			case 67:
				$query = $this->site_model->f_students_leave_report();
				break;
			case 68:
				$query = $this->site_model->f_admission_questionbank_setup();
				break;	
			default:
				$query = 'Default: Some error in the selection<button style="float: right;margin: 3px 10px 0px 0px;" id="admin_call_send"> &nbsp;&nbsp;Contact Admin&nbsp;&nbsp; </button>';
				break;
		}
		
		 if($query)
		 {
		 	echo $query;
		 }
		 else {
			 echo "blank yet";
		 }
		
		//echo $func_num;
	}
	
	function get_cand_reg_list(){
		
		$this->load->model('site_model');
		$query = $this->site_model->get_cand_reg_list();
		 
		echo $query;	
		
	}
	
	function get_cand_reg_list2(){
		
		$this->load->model('site_model');
		$query = $this->site_model->get_cand_reg_list();
		 
		$pieces = explode('|', $query);		
		 
		echo json_encode(array_values(array_unique($pieces)));
		//echo $query;		
	}

}
