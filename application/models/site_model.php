<?php

/*
 * The site modal is the one where all the activities of the site with db are recorded
 */
 
 /**
  * The main class
  */
 class Site_model extends CI_Model {
     
     function __construct() {
         parent::__construct();
     }
	 
	 function get_admin_boxes(){
	 	//the place to search the database .. and get all the boxes setup..
	 	//then it is the job of the css to aplly the style..
	 	//comme onn .. stop putting comments and start.... :|
	 	
	 	$query = 'SELECT dept_box_id, dept_box_name from s1_boxes_lkup';
		$q = $this->db->query($query);  
	 	
		$string = '';
		
		if($q->num_rows() > 0){
			
			foreach ($q->result() as $row) {
				
				$string .= '<div class="single_box" id="box_'.$row->dept_box_id.'">'; //opened box div
				$string .= '<ul style="list-style: none;padding: 0; margin: 0;">';
					//$string .= ','.$row->dept_box_id;
					//$string .= ','.$row->dept_box_name.'|||';
				$string .= '<li><center><h3>'.$row->dept_box_name.'</h3></center></li><hr />';
				$query = 'SELECT function_id, function_name from s1_boxes_functions where dept_box_id = '.$row->dept_box_id;
				$q1 = $this->db->query($query);
				
				if($q1->num_rows() > 0){
					
					foreach ($q1->result() as $row1) {
						$string .= '<a href="javascript:void(0)" id="func_'.$row1->function_id.'"><li>'. $row1->function_name.'</li></a>';
						
							//$string .= '-'.$row1->function_id.'-';
							//$string .= '-'.$row1->function_name.'-';
					}
				}
				else{
					$string .= '<li>No Functions available</li>';
				}	
				
				$string .= '</ul>';
				$string .= '</div>';
			}
		}
		
		return $string;
	 	
	 }
	  
	 function admission_subject_setup($func_code, $string = 'M'){
	 	switch ($func_code) {
		case 1:
				 //FUNCTION DESC: to fetch the subject and subject code list initially  - get_subjects()  
				 // create the list from db and send it to UI through controller
				 
			$query = 'select subject_id, subject_name from s1_admission_test_subject_lkup';
			$q = $this->db->query($query);  
			$ret_string = '';
			$color_count = 0;
			if($q->num_rows() > 0){
				foreach ($q->result() as $row) {
					$color_count++;
					if(($color_count % 2) == 0){	
						$ret_string .= '<tr class="even_row" id="_14_sub_id'.$color_count.'">';
					}
					else
					{
						$ret_string .= '<tr class="odd_row" id="_14_sub_id'.$color_count.'">';
					}
					
					$ret_string .= '<td>'.$row->subject_id.'</td>';
					$ret_string .= '<td>'.$row->subject_name.'</td>';
					$ret_string .= '<td> &nbsp;&nbsp;<a class="_14_other_links" href="javascript:edit_db_row(\'_14_sub_id'.$color_count.'\')">Edit</a>&nbsp;&nbsp;&nbsp;<a class="_14_other_links" href="javascript:delete_db_row(\'_14_sub_id'.$color_count.'\')">Delete</a></td>';
					$ret_string .= '</tr>';
					
				}					
			
			}
			else {
				$ret_string .= '<tr class="even_row" ><td colspan="3">No Subjects in Records</td></tr>';
			}
			return $ret_string;
				 
		break;
		
		case 2:
			//FUNCTION DESC: to save the details added to the subjects list  - save_row_subject_code()  
			$subject_codes = $this->input->post('_14_input_subcode');
			$subject_names = $this->input->post('_14_input_subname');
					
			$query = 'INSERT INTO s1_admission_test_subject_lkup values ';
			$comma_count = 0;	
			foreach ($subject_codes as $key => $value) {
				
				if(($subject_codes[$key] != '') && ($subject_names[$key] != ''))
				{	
					if($comma_count != 0){$query .= ',';}
					$comma_count++;
					$query .= '("'.$subject_codes[$key].'","'.$subject_names[$key].'")';		
				}
			}
			
			$q = $this->db->query($query);
			if(!$q)
			{
				return 'error in inserting subject codes';
			}
			return 'true';
			
		break;
			
			
		case 3:
			//FUNCTION DESC: to Updatethe subject to db  - update_row_subject()  
			$subject_code = $this->input->post('_14_input_subcode');
			$subject_name = $this->input->post('_14_input_subname');
			$old_subject_code = $this->input->post('old_subject_code');
			
			$query = 'UPDATE s1_admission_test_subject_lkup SET ';	
			foreach ($subject_code as $key => $value) {
				
				$query .= 'subject_id = "'.$subject_code[$key].'", subject_name = "'.$subject_name[$key].'" ';
				$query .= 'WHERE subject_id = "'.$old_subject_code.'"';
					
			}
	
			$q = $this->db->query($query);
			if(!$q)
			{
				return 'error in updating subject data';
			}
			return 'true';
			
		break;	
		
		case 4:
			$subject_code = $this->input->post('subject_code');
			
			$query = 'DELETE FROM s1_admission_test_subject_lkup WHERE subject_id = "'.$subject_code.'"';
			
			$q = $this->db->query($query);
			if(!$q)
			{
				return 'error in deleting subject data';
			}
			return 'true';
			
			
			
		break;
				
			default:
				 
				 break;
		 }
	 } 
	  
	  
	 function manage_school_assets($func_code){
	 	switch ($func_code) {
			 case 1:
				 
				$query = 'select dept_id, dept_name from s1_temp_dept_lkup';
				$q = $this->db->query($query);  
				$ret_string = '';
			
				if($q->num_rows() > 0){
					$ret_string .= '<ul>';
				
					foreach ($q->result() as $row) {
					
						$ret_string .= '<li><a href ="javascript:void(0)" id="'.$row->dept_id.'">'.$row->dept_name.'</a></li>';
				
					}				
					$ret_string .= '</ul>';	
				
				}
				else {
					$ret_string .= 'No Departments in Records';
				}
				return $ret_string;
				 break;
			 
			 case 2:
				 //FUNCTION DESC: fetch the assets for the department selected: load_dept_assets()
				 $dept_id = $this->input->post('dept_id');
				 $query = 'SELECT am.asset_id,am.asset_name,tdl.dept_name,am.source_brand_name,am.source_shop_name,am.source_address_line1,';
				 $query .= 'am.source_address_line2,cts.city_name,am.source_state,am.source_pincode,am.source_phone1,';
				 $query .= 'am.source_phone2,am.source_email,am.date_of_purchase,am.bill_number,am.gaurantee_end_date,';
				 $query .= 'am.warranty_end_date,am.maintenance_interval_days ';
				 $query .= 'FROM s1_assets_main am, s1_temp_dept_lkup tdl, s1_cities cts ';
				 $query .= 'WHERE am.asset_dept_id ='.$dept_id.' AND am.asset_dept_id = tdl.dept_id AND am.source_city = cts.city_id';
				
			
				$q = $this->db->query($query);  
				$ret_string = '';
			
				if($q->num_rows() > 0){
					$ret_string .= '<table id="_46_subject_table">';
					$ret_string .= '<tr class="top_row">';
					$ret_string .= '<td style="width:15%;">Asset Id</td>';
					$ret_string .= '<td style="width:42%;">Name</td>';
					$ret_string .= '<td style="width:23%;">Department</td>';
					$ret_string .= '<td style="width:20%;">Actions</td>';
					$ret_string .= '</tr>';
				
					$color_count = 0;
					foreach ($q->result() as $row) {
						$color_count++;
						if(($color_count % 2) == 0){	
							$ret_string .= '<tr class="even_row" id="_46_ast_id'.$row->asset_id.'">';
						}
						else
						{
							$ret_string .= '<tr class="odd_row" id="_46_ast_id'.$row->asset_id.'">';
						}
					
						$ret_string .= '<td>'.$row->asset_id.'</td>';
						$ret_string .= '<td>'.$row->asset_name.'</br><a class="inline" href="#_46_address_'.$row->asset_id.'">'.$row->source_brand_name.' - '.$row->source_shop_name.'</a></td>';
						$ret_string .= '<td>'.$row->dept_name.'</td>';
						$ret_string .= '<td> &nbsp;<a href="javascript:update_asset(\'_46_ast_id'.$row->asset_id.'\')">Edit</a>&nbsp;<a href="javascript:delete_asset(\'_46_ast_id'.$row->asset_id.'\')">Delete</a></td>';
						$ret_string .= '</tr>';
					
					
						//  code 123  $ret_string .= '<div class="_46_assets_content">';
						
						  
						 /*
						$ret_string .= '<div class="_46_id">'.$row->asset_id.'</div>';
						$ret_string .= '<div class="_46_name">'.$row->asset_name.'</div>';
						$ret_string .= '<div class="_46_dept">'.$row->dept_name.'</div>';
						$ret_string .= '<div class="_46_source_name"><a class="inline" href="#_46_address_'.$row->asset_id.'">'.$row->source_brand_name.' - '.$row->source_shop_name.'</a></div>';
						
						
						$ret_string .= '<a href="javascript:void(0)" id="'.$row->asset_id.'">';
						$ret_string .= 'Delete';
						$ret_string .= '</a>';
						
						$ret_string .= '<a href="javascript:void(0)" id="'.$row->asset_id.'">';
						$ret_string .= 'Update';
						$ret_string .= '</a>';
						

						  
						 //now forthe fields that are initially hidden
						*/
						$ret_string .= '<tr>';
						$ret_string .= '<td colspan="4">';
						$ret_string .= '<div class="_46_hidden_asset_details" id="'.$row->asset_id.'">';
						$ret_string .= '<div style="display:none">';
						$ret_string .= '<div id="_46_address_'.$row->asset_id.'">';
						$ret_string .= '<table class="_46_asset_address">';
						$ret_string .= '<tr><th>Address:</th><tr>';
						$ret_string .= '<tr><td>'.$row->source_brand_name.' - '.$row->source_shop_name.'</td><tr>';
						$ret_string .= '<tr><td>'.$row->source_address_line1.'</td></tr>';
						$ret_string .= '<tr><td>'.$row->source_address_line2.'</td></tr>';
						$ret_string .= '<tr><td>'.$row->city_name.'</td></tr>';
						$ret_string .= '<tr><td>'.$row->source_state.'</td></tr>';
						$ret_string .= '<tr><td>'.$row->source_pincode.'</td></tr>';
						$ret_string .= '<tr><td>'.'Ph: '.$row->source_phone1.', '.$row->source_phone1.'</td></tr>';
						$ret_string .= '<tr><td>'.'Email: '.$row->source_email.'</td></tr>';
						$ret_string .= '</table>';
						$ret_string .= '</div>';
						$ret_string .= '</div>';
						$ret_string .= '</td>';
						$ret_string .= '</tr>'; 
						 
						/*
							later add the address to the addresses under category 3 and change the query accordingly
						*/
						
						/*
						$ret_string .= '<table class="_46_asset_extras">';
						$ret_string .= '<tr><td>Date Of Purchase</td><td>'.$row->date_of_purchase.'</td></tr>';
						$ret_string .= '<tr><td>Bill Number</td><td>'.$row->bill_number.'</td></tr>';
						$ret_string .= '<tr><td>Gaurantee End Date</td><td>'.$row->gaurantee_end_date.'</td></tr>';
						$ret_string .= '<tr><td>Warranty End Date</td><td>'.$row->warranty_end_date.'</td></tr>';
						//maintenamce date calculation
						$maintenamce_interval = $row->maintenance_interval_days;
						
						//end of maintenance date calculation
						$ret_string .= '<tr><td>Next Maintenance date</td><td></td></tr>';
						$ret_string .= '</table>';
						
						 end of hidden table */
						
						
						$ret_string .= '</div>';
						// code 123 $ret_string .= '</div>';
					}
					$ret_string .= '</table>'; 
					
				}
				else {
					$ret_string .= 'No assets in records for this department';
				}
				return $ret_string;
				 
				 
				 	
				 break; 
			 
			case 3:
				//Saving the details into the database
				
				$post_vals_dbmap['asset_name'] = $this->input->post('_46_form_asset_name');
				// need to make this as dept id and map it to the dept table .. DOne .. still might need further changes
				$post_vals_dbmap['asset_dept_id'] = $this->input->post('_46_form_dept');
				$post_vals_dbmap['source_brand_name'] = $this->input->post('_46_form_brand');
				$post_vals_dbmap['source_shop_name'] = $this->input->post('_46_form_shop');
				$post_vals_dbmap['source_address_line1'] = $this->input->post('_46_form_shop_address1');
				$post_vals_dbmap['source_address_line2'] = $this->input->post('_46_form_shop_address2');
				$post_vals_dbmap['source_state'] = $this->input->post('_46_form_shop_state'); 
				$post_vals_dbmap['source_city'] = $this->input->post('_46_form_shop_city');
				$post_vals_dbmap['source_pincode'] = $this->input->post('_46_form_shop_pincode');
				$post_vals_dbmap['source_phone1'] = $this->input->post('_46_form_shop_phone1');
				$post_vals_dbmap['source_phone2'] = $this->input->post('_46_form_shop_phone2');
				$post_vals_dbmap['source_email'] = $this->input->post('_46_form_shop_email');
				$post_vals_dbmap['date_of_purchase'] = $this->input->post('_46_form_date_of_purchase');
				$post_vals_dbmap['bill_number'] = $this->input->post('_46_form_bill_number');
				$post_vals_dbmap['gaurantee_end_date'] = $this->input->post('_46_form_gaurantee_end_date');
				$post_vals_dbmap['warranty_end_date'] = $this->input->post('_46_form_warrantee_end_date');
				$post_vals_dbmap['maintenance_interval_days'] = $this->input->post('_46_form_maintenance_interval');	
				
				$query = 'INSERT INTO s1_assets_main (';
				$comma_count = 0;
				foreach ($post_vals_dbmap as $key => $value)
				{
					if($comma_count != 0){$query .= ',';}
					$comma_count++;
					$query .= $key;
				}
				$query .= ') values (';
				$query .= '"'.$post_vals_dbmap['asset_name'].'"';
				$query .= ','.$post_vals_dbmap['asset_dept_id'].'';
				$query .= ',"'.$post_vals_dbmap['source_brand_name'].'"';
				$query .= ',"'.$post_vals_dbmap['source_shop_name'].'"';
				$query .= ',"'.$post_vals_dbmap['source_address_line1'].'"';
				$query .= ',"'.$post_vals_dbmap['source_address_line2'].'"';
				$query .= ',"'.$post_vals_dbmap['source_state'].'"';
				$query .= ','.$post_vals_dbmap['source_city'].'';  
				$query .= ','.$post_vals_dbmap['source_pincode'].'';
				$query .= ','.$post_vals_dbmap['source_phone1'].'';
				$query .= ','.$post_vals_dbmap['source_phone2'].'';
				$query .= ',"'.$post_vals_dbmap['source_email'].'"';
				$query .= ',"'.$post_vals_dbmap['date_of_purchase'].'"';
				$query .= ','.$post_vals_dbmap['bill_number'].'';
				$query .= ',"'.$post_vals_dbmap['gaurantee_end_date'].'"';
				$query .= ',"'.$post_vals_dbmap['warranty_end_date'].'"';
				$query .= ','.$post_vals_dbmap['maintenance_interval_days'].'';
				$query .= ')';
			
				
				$q = $this->db->query($query);
				if(!$q)
				{
					return 'error in inserting asset form details';
				}
				return 'true';
					
			break;
				
			case 4:
				//$string = $this->input->get('string');
				$req = 'SELECT dept_name FROM s1_temp_dept_lkup WHERE dept_name LIKE "%'.$string.'%" '; 

				$query = mysql_query($req);

				while($row = mysql_fetch_array($query))
				{
					$results[] = array('label' => $row['dept_name']);
				}
				return json_encode($results);
				break;
				
			case 5:
				//FUNCTION DESC : load all the states
				$req = 'SELECT DISTINCT state_name FROM s1_cities';
				$query = mysql_query($req);
				$results[] = 'Select State';
				while($row = mysql_fetch_array($query))
				{
					$results[$row['state_name']] = $row['state_name'];
				}
				return json_encode($results);
			break;		
			case 6:
				//FUNCTION DESC : load all the states
				$req = 'SELECT city_id, city_name FROM s1_cities WHERE state_name = "'.$this->input->post('state_name').'"';
				$query = mysql_query($req);
				$results[] = 'Select City';
				while($row = mysql_fetch_array($query))
				{
					$results[$row['city_id']] = $row['city_name'];
				}
				return json_encode($results);
			break;	
			case 7:
				//FUNCTION DESC : load all the states
				$req = 'SELECT DISTINCT dept_id, dept_name FROM s1_temp_dept_lkup';
				$query = mysql_query($req);
				$results[] = 'Select Department';
				while($row = mysql_fetch_array($query))
				{
					$results[$row['dept_id']] = $row['dept_name'];
				}
				return json_encode($results);
			break;			
			 default:
				 
				 break;
		 }	 
	  
	 } 
	  
	 function autocomplete_46($string){
	 	
		switch ($string) {
			case 1:
				
				// the department box
				$req = 'SELECT dept_name FROM s1_temp_dept_lkup'; 

				$query = mysql_query($req);

				while($row = mysql_fetch_array($query))
				{
					$results[] = array('label' => $row['dept_name']);
				}
				
				
				return json_encode($results);
			break;
			
			case 2:
				// the shop name box
				$req = 'SELECT DISTINCT source_shop_name FROM s1_assets_main'; 

				$query = mysql_query($req);

				while($row = mysql_fetch_array($query))
				{
					$results[] = array('label' => $row['source_shop_name']);
				}
				
				return json_encode($results);
				
			break;	
			default:
				
				break;
		}
		
	 }

	function autofill_46($string){
		//string is in the form <sourcefield>|<data> .. use it and do auto fill
		$parts = explode('|', $string);
		if($parts[0] === 'shop'){
			ChromePhp::log('in the shop with data '.$parts[1]);
			
			$query = 'select source_address_line1, source_address_line2, source_city, source_state, source_pincode, source_phone1, source_phone2, source_email ';
			$query .= 'FROM s1_assets_main '; 
			$query .= 'WHERE source_shop_name = "'.$parts[1].'"';
				
				
				$query = mysql_query($query);

				while($row = mysql_fetch_array($query))
				{
					
					$results['source_address_line1'] = $row['source_address_line1'];
					$results['source_address_line2'] =  $row['source_address_line2'];
					$results['source_state'] = $row['source_state'];
					$results['source_city'] = $row['source_city'];					
					$results['source_pincode'] = $row['source_pincode'];
					$results['source_phone1'] = $row['source_phone1'];
					$results['source_phone2'] = $row['source_phone2'];
					$results['source_email'] = $row['source_email'];
				}
				
				return json_encode($results);
			
			
		}		
	}
	 
	 function module_name($func_code){
	 	switch ($func_code) {
			 case 1:
				 return "this is the string from mode l";
				 break;
			 
			 default:
				 
				 break;
		 }	 
	  
	 }  
	  
	  
		  function f_add_department(){    }
          
			
          function f_add_class(){    }
          
			
          function f_add_section(){    }
          	
			
          function f_add_designation(){    }
          
			
          function f_edit_school_details(){    }
          
			
          function f_add_staff(){    }
          	
			
          function f_add_teacher(){    }
          
			
          function f_add_students(){    }
          
			
          function f_archive_personal_data(){    }
          	
			
          function f_edit_personal_details(){    }
          
			
          function f_manage_permissions(){    }
          
			
          function f_policies_and_rules_setup(){    }
          
			
          function f_admission_test_setup(){    }
          
			
          function f_admission_initiate(){    }
          	
			
          function f_admission_dashboard(){    }
          
			
          function f_admission_subject_setup(){    }
          
			
          function f_exam_schedules(){    }
          	
			
          function f_exam_wise_marks(){    }
          
			
          function f_reports_and_trends(){    }
          
			
          function f_timetable_setup(){    }
          	
			
          function f_holiday_calender_setup(){    }
          
			
          function f_question_paper_logs(){    }
          
			
          function f_local_study_material(){    }
          
			
          function f_scholorship_setup(){    }
          
			
          function f_report_cards(){    }
          	
			
          function f_cocurricular_activities_and_events(){    }
          
			
          function f_fees_charges_setup(){    }
          
			
          function f_reciept_design(){    }
          	
			
          function f_check_fee_status(){    }
          
			
          function f_payroll_setting(){    }
          
			
          function f_payroll_status(){    }
          	
			
          function f_expenditure(){    }
          
			
          function f_bank_account_details(){    }
          
			
          function f_cash_book(){    }
          
			
          function f_finance_policies(){    }
          
			
          function f_add_book(){    }
          	
			
          function f_books_audit(){    }
          
			
          function f_issue_book(){    }
          
			
          function f_reserve_book(){    }
          	
			
          function f_return_book(){    }
          
			
          function f_our_health_centres(){    }
          
			
          function f_our_doctors(){    }
          	
			
          function f_student_health_records(){    }
          
			
          function f_student_visits(){    }
          
			
          function f_in_house_medicenes(){    }
          
			
          function f_manage_school_assets(){    }
          
			
          function f_raise_order_for_new_asset(){    }
          	
			
          function f_asset_maintenance_schedule(){    }
          
			
          function f_asset_booking(){    }
          
			
          function f_daily_menu(){    }
          	
			
          function f_caterers_profile(){    }
          
			
          function f_requests_and_feedback(){    }
          
			
          function f_vehicles_and_specifications(){    }
          	
			
          function f_maintenance_schedule(){    }
          
			
          function f_transport_charges_setup(){    }
          
			
          function f_trnsport_booking(){    }
          
			
          function f_regisered_players(){    }
          
			
          function f_raise_equipment_request(){    }
          	
			
          function f_previous_participation_details(){    }
          
			
          function f_training_schedule_and_setup(){    }
          
			
          function f_employee_attendance(){    }
          	
			
          function f_employee_leave_plan(){    }
          
			
          function f_student_atendance_logs(){    }
          
			
          function f_teacher_attendance_logs(){    }
          	
			
          function f_approve_leaves(){    }
          
			
          function f_teachers_leave_report(){    }
          
			
          function f_students_leave_report(){    }
		  
		  
		  function f_admission_questionbank_setup(){    }


		function get_cand_reg_list(){
			/*
			 * Create a list of candidates and their reg nums in a feild separated string
			 * will be used for autocompletion
			 */
			 
			$query = 'SELECT first_name, middle_name, last_name, reg_num from s1_candidates';
			$q = $this->db->query($query);
			
			$ret_string = '';
			$first_flag = 1;
			foreach ($q->result() as $row) {
			if($first_flag == 0)
			{
				$ret_string .= '|';				
			}	
				$ret_string .= $row->first_name;
				if($row->middle_name)
				{
					$ret_string .= ' '.$row->middle_name;
				}
				$ret_string .= ' '.$row->last_name;
				$ret_string .= ', '.$row->reg_num;
				$first_flag = 0;
			}
		
		return $ret_string;
			 
		}
		
		
 }
 
