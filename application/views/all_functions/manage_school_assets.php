<center style="margin: -10px 0px 30px 0px;"><h3>Manage School Assets</h3></center>

<div id="function_main_content">	
	<div id="_46_dept_categories">		
		<div class="_46_subtitle">Departments</div>
		
		<div id="_46_categories">
						
		</div>
	</div>
	
	
	<div id="_46_assets_main">
		<div class="_46_subtitle">Assets in XXXXXXXX Department</div>
		
		<div id="_46_assets_content">
						
		</div>
	</div>
</div>

<div id="function_help_content">	
	<div id="_46_status_bar">The status here</div>
	<br/>
	Fill form to Add Assets
	<div id="_46_add_update_form">
		Asset Name: 
		<input type="text" id="_46_form_asset_name" name="_46_form_asset_name" /></br>
		
		<!-- implemtne auto complete -->
		Department: </br>
		<select id="_46_form_dept" name="_46_form_dept" type="text">
			<option value="0">Select Department</option>
		</select></br>						
		
		Brand Name: </br>
		<input type="text" id="_46_form_brand" name="_46_form_brand" /></br>
		
		Shop Name: </br>
		<input type="text" id="_46_form_shop" name="_46_form_shop" /></br>
		
		Shop Address Line 1: </br>
		<input type="text" id="_46_form_shop_address1" name="_46_form_shop_address1" /></br>
		
		Shop Address Line 2: </br>
		<input type="text" id="_46_form_shop_address2" name="_46_form_shop_address2" /></br>
		
		Shop State: </br>
		
			<select id="_46_form_shop_state" name="_46_form_shop_state" type="text">
			<option value="0">Select State</option>
			</select>
						
		</br>
		
		Shop City: </br>
		<select type="text" id="_46_form_shop_city" name="_46_form_shop_city" >
			<option value="0">Select City</option>
		</select>	
		
	
		
		Shop Pincode: </br>
		<input type="text" id="_46_form_shop_pincode" name="_46_form_shop_pincode" /></br>
		
		Shop Phone 1: </br>
		<input type="text" id="_46_form_shop_phone1" name="_46_form_shop_phone1" /></br>
		
		Shop Phone 2: </br>
		<input type="text" id="_46_form_shop_phone2" name="_46_form_shop_phone2" /></br>
		
		Shop Email: </br>
		<input type="text" id="_46_form_shop_email" name="_46_form_shop_email" /></br>
		
		Date of Purchase: </br>
		<input type="text" class="datefield" id="_46_form_date_of_purchase" name="_46_form_date_of_purchase" /></br>
		
		Bill Number: </br>
		<input type="text" id="_46_form_bill_number" name="_46_form_bill_number" /></br>
		
		Gaurantee End Date: </br>
		<input type="text" class="datefield" id="_46_form_gaurantee_end_date" name="_46_form_gaurantee_end_date" /></br>
		
		Warantee End Date: </br>
		<input type="text" class="datefield" id="_46_form_warrantee_end_date" name="_46_form_warrantee_end_date" /></br>
		
		Maintenance Interval (Days): </br>
		<input type="text" id="_46_form_maintenance_interval" name="_46_form_maintenance_interval" /></br>

		<button id="_46_form_submit" style="float:right;margin-right:10px;">&nbsp;Save&nbsp;</button>
		<button id="_46_form_update" style="float:right;margin-right:10px;">&nbsp;Update&nbsp;</button>
		<a id="_46_form_reset" style="float:left;margin:10px; 20px" href="javascript:void(0)">Reset</a>
		
		
		
		<div style="clear: both;"></div>
	</div>
	
</div>


<!-- the hidden form for the edit modal -->




<!-- END of the hidden form of the edit modal -->



<!-- 
	the right side test column starts here 
-->

<!-- WE WONT BE NEEDING IT HERE
<div id="function_help_content">
this is the test column and the break in the line is only due to the width of this thing.
</div>
-->
<!--
	end of help content .. start with jquery 
-->

<script>
	
	//variables to cache the auto complete fields
	var autoc_array_dept;
	var autoc_shop_name;
	
	//autofill variables
	var shop_autofill_result;
	
	var auto_fill_city; // to detect city auto fills its progress
	var auto_fill_city_val;
  	
  	//STATUS VARIABLES
  	var FORM_STATUS = 'free';   // status can be free, addprogress, updateprogress
  	var dirty_form = 0;   // avariable to track if the form was soiled ,, or is fresh
  	//END OF STATUS VARIABLES
  	
  	var saving_form_db = 0;
  	
  	
	//the mapping from the database to the id of the elements.. for autofill
	var shop_autofill_map = new Array();
	shop_autofill_map['source_address_line1'] = '_46_form_shop_address1';
	shop_autofill_map['source_address_line2'] = '_46_form_shop_address2';
	shop_autofill_map['source_city'] = '_46_form_shop_city';
	shop_autofill_map['source_state'] = '_46_form_shop_state';
	shop_autofill_map['source_pincode'] = '_46_form_shop_pincode';
	shop_autofill_map['source_phone1'] = '_46_form_shop_phone1';
	shop_autofill_map['source_phone2'] = '_46_form_shop_phone2';
	shop_autofill_map['source_email'] = '_46_form_shop_email';
	
	
	
	$(document).ready(function()
    {
    	
    	alert('dirty for is '+dirty_form+' from status is '+FORM_STATUS);
    	populate_auto(1);  //for dept
    	populate_auto(2);
    	 load_dept_categories();
    	 load_states('_46_form_shop_state');
    	 load_departments('_46_form_dept');
    	 
    	 $('#_46_form_update').hide(); // initially hiding the update form
    	 
    	 $('#_46_add_update_form').live("change",function(){
    	 	dirty_form = 1;
    	 	if(FORM_STATUS == 'free'){
    	 		FORM_STATUS = 'addprogress';
    	 	}
    	 	
    	 	alert('dirty for is '+dirty_form+' from status is '+FORM_STATUS);
    	 	
    	 });
    	 
    	 $('#_46_form_shop_state').live("change", function(){
    	 	
    	 	load_cities($(this).find(":selected").text(), '_46_form_shop_city');
    	 	
    	 });
    	 
    	 $('#_46_form_reset').click(function(){
    	 	reset_asset_form();
    	 });
    	 
    	 
    	$('.datefield').live('click', function () {
       	 	
            $(this).datepicker('destroy').datepicker({
            changeMonth: true,
			changeYear: true,
			yearRange: "-30:+0",
			dateFormat: 'dd/mm/yy'}).focus();
    	 });
    	 
      $('#_46_form_shop').live("blur", function(){
      	   // this fuction is to auto complete all the address fields .. based on theshop name..
      	   // if it existed
      	 
      	 // ifcondition here so that we avoid this blur ,, when the form is being saved.. it is not necessary while saving
      	 if(saving_form_db != 1){
      	    for(var i = 0; i < autoc_shop_name.length; i++) {
        		if(autoc_shop_name[i]["label"] === $(this).val()){
        			// found an available shop .. hence populatethe address and contact fields
        			
        			populate_contactfields($(this).val());
        		}
    		}
    	}
    	if(saving_form_db == 1){
    		saving_form_db = 0;
    	}
    	
      });
      
      $('#_46_categories ul li a').live("click",function(){
   	 	  	 		
       		var dept_id = $(this).attr('id');         		
       		load_dept_assets(dept_id);
       		
       });
       
       // form validations start here
       
       //username types
        $('#_46_form_asset_name, #_46_form_dept, #_46_form_brand, #_46_form_shop, #_46_form_shop_address1, #_46_form_shop_address2,').live("blur",function() {
      			
				var return_val = validation1(this);
				error_notify(this, return_val);	
				
   		});
       
       //just numbers
       $('#_46_form_bill_number, #_46_form_maintenance_interval').live("blur",function(){
       			
       			var return_val = validation5(this);
				error_notify(this, return_val);	
       });
       
       //drop downs
       $('#_46_form_shop_state, #_46_form_shop_city').live("blur",function(){
       			var return_val = validation2(this);
				error_notify(this, return_val);	
       });
       
       //date fields
        $('#_46_form_date_of_purchase, #_46_form_gaurantee_end_date, #_46_form_warrantee_end_date').live("change",function(){
       			var return_val = validation2(this);
				error_notify(this, return_val);	
       });
       $('#_46_form_date_of_purchase, #_46_form_gaurantee_end_date, #_46_form_warrantee_end_date').live("blur",function(){
       			var return_val = validation2(this);
				error_notify(this, return_val);	
       });
       
       //phone
        $('#_46_form_shop_phone1, #_46_form_shop_phone2').live("blur",function(){
       			var return_val = validation3(this);
				error_notify(this, return_val);	
       });
       
       //pincode
        $('#_46_form_shop_pincode').live("blur",function(){
       			var return_val = validation4(this);
				error_notify(this, return_val);	
       });
       
       //email
       $('#_46_form_shop_email').live("blur",function(){     
       			var return_val = validation6(this);
				error_notify(this, return_val);	
       });
       //form validation ends
       
       $('#_46_form_submit').live("click",function(){
       	
       		save_form_data_46();
       	
       });
       	
    });	
    
    
    function update_asset(row_id){
    	//bring up a colorbox modal here with a form andupdate those values tothe db
    	
    	//extracting the asset id from the row id for using with db
    	var asset_id = row_id.replace('_46_ast_id','');
    	
    	
    	
    	
    	 
    }
    
    function delete_asset(row_id){
    	alert('delete row '+row_id);
    	
    }
    
    function load_cities(state_name, city_select_id){
    	
    	
    	serializedData = '';
		serializedData = 'state_name='+state_name;
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/manage_school_assets/6",
						type: "post",
						dataType: 'json',
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						
							$('#'+city_select_id).empty(); //clear anything that may exist
						 	var mySelect = $('#'+city_select_id)
    						$.each(response, function(key,val){
        						$('<option/>',{
            						value : key
        						})
        						.text(val)
        						.appendTo(mySelect);
    						});
						
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						
						
						
						// double check for 'saving_form_db'  .. not actually required here ..
						if((auto_fill_city == 1)&&(saving_form_db != 1)){
							
							 
								
								$('#_46_form_shop_city').val(auto_fill_city_val);
								
								/*  trying the value thing  
								$('#_46_form_shop_city option').filter(function() {
    							//may want to use $.trim in here
    								
    								return $(this).text() == text1; 
								}).attr('selected', true);
								
								*/
								
								
								//running this blurr here so that on auto fill the errors are removed ... if any
								$('select[name^="_46_form_"]').each(function(){
									$(this).removeClass('cb_val_error');
									$(this).addClass('cb_val_success');
								});
								$('input[name^="_46_form_"]').each(function(){
									$(this).removeClass('cb_val_error');
									$(this).addClass('cb_val_success');
								});
							
								// run a blur on other fields .. because we trust db has correct fields
							//	$('#_46_form_asset_name, #_46_form_dept, #_46_form_brand, #_46_form_date_of_purchase, #_46_form_bill_number, #_46_form_gaurantee_end_date, #_46_form_warrantee_end_date, #_46_form_maintenance_interval ').each(function(){
							//		$(this).blur();
							//	});
			
								
						}
						
						auto_fill_city = 0;
						auto_fill_city_val = 0;
							if(saving_form_db == 1){
    							saving_form_db = 0;
    						}
						}
					});
				// prevent default posting of form
				event.preventDefault();
    	
    }
    
    /* Altrenate way to use the options populations to drop down is
     * 
     * function getResults(str) {
  		$.ajax({
        url:'suggest.html',
        type:'POST',
        data: 'q=' + str,
        dataType: 'json',
        success: function( json ) {
           $.each(json, function(i, optionHtml){
              $('#myselect').append(optionHtml);
           });
        }
    	});
	};
     * 
     * where the json is in the format, on the server side
     * 
     * [
    "<option value='...</option>",
    "<option value='...</option>",
    "<option value='...</option>",
    ...
]
     * 
     */
    
    
    function load_states(select_id){
    	serializedData = '';
					
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/manage_school_assets/5",
						type: "post",
						dataType: 'json',
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						
							$('#'+select_id).empty(); //clear anything that may exist
						 	var mySelect = $('#'+select_id)
    						$.each(response, function(key,val){
        						$('<option/>',{
            						value : key
        						})
        						.text(val)
        						.appendTo(mySelect);
    						});
						
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
							
						}
					});
				// prevent default posting of form
				event.preventDefault();
    	
    }
    
    function load_departments(select_id){
    	
    	serializedData = '';
					
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/manage_school_assets/7",
						type: "post",
						dataType: 'json',
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						
							$('#'+select_id).empty(); //clear anything that may exist
						 	var mySelect = $('#'+select_id)
    						$.each(response, function(key,val){
        						$('<option/>',{
            						value : key
        						})
        						.text(val)
        						.appendTo(mySelect);
    						});
						
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
							
						}
					});
				// prevent default posting of form
				event.preventDefault();
    	
    }
    
    function populate_contactfields(shop_name){
    	// must populate the contact fileds .. as we found an available shop in the shop name field
    
    	
    	    		serializedData = '';
					
					
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/autofill_46/shop|"+shop_name,
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						shop_autofill_result = $.parseJSON(response);
						
						//loop through all the data and fill in 
						for(var index in shop_autofill_result) {
							$('#'+shop_autofill_map[index]).val(shop_autofill_result[index]);
							//using the map to fillint he contact details
							
							// still need to work on the state and city fields...
  							if(index == 'source_state')
  							{
  								
  								var text1 = shop_autofill_result[index];
								$('#'+shop_autofill_map[index]+' option').filter(function() {
    							//may want to use $.trim in here
    								return $(this).text() == text1; 
								}).attr('selected', true);
								
								
								
								//loading city for auto fill.. correct city will be selected on complete of the load
								auto_fill_city = 1;
								auto_fill_city_val = shop_autofill_result['source_city'];
								
								load_cities($('#_46_form_shop_state').find(":selected").text(), '_46_form_shop_city');
								
  								
  							}
  							if(index == 'source_city')
  							{
  							
  								// taken care in the trigger in the state condition .. andthe oncomplete of the states ..
  								// by setting the auto_fill_city status to 1
  								
  							}
						}
						
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
							
						}
					});
				// prevent default posting of form
				event.preventDefault();
    	
    }
    
    
    function populate_auto(val){
    		serializedData = '';
					
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/autocomplete_46/"+val,
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						if(val ==1)
						{
							
							autoc_array_dept = $.parseJSON(response);
						
						}
						else if(val ==2)
						{
							autoc_shop_name = $.parseJSON(response);
							
						}    
						
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
							if(val ==1)
						{
							
							$("#_46_form_dept").autocomplete({ source:autoc_array_dept });
						
						}
						else if(val ==2)
						{
							$("#_46_form_shop").autocomplete({ source:autoc_shop_name });
							
						}    
							
						}
					});
				// prevent default posting of form
				event.preventDefault();
    }
    
    
    function save_form_data_46(){
    	if(!(validate_textboxes() == 'true'))
		{
			alert('error in text boxes, Please correct them!!');
			//code here to highlighting the error
		}
		else
		{
				// serialize the data in the form .. if any
				saving_form_db = 1;
				
					serializedData = '';
					
					serializedData = $('#_46_add_update_form :input, select').serialize(); 
					
					
					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/manage_school_assets/3",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						if(response == 'true')
						{
							//data inserted successfully ... what to do
							$('#_46_status_bar').html('Data Inserted Successfully');
							
							
							populate_auto(2); // used to get the array of any new shop
							//would be better if i could use some condition .. wether to do this or not..
							// we would be saving on one ajax call on every save
							
							reset_asset_form();
						}
						else
						{
							alert(response);
						}
						    
						
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
							
						}
					});
				// prevent default posting of form
				event.preventDefault();
		}	
    }
    
    function validate_textboxes(){
		var err_counter = 0;
		
			$('input[name^="_46_form_"]').each(function(){
				$(this).blur();
			});
			
			$('select[name^="_46_form_"]').each(function(){
				$(this).blur();
			});
			 
		$('.cb_val_error').each(function(){		
				
			err_counter++;			
		});
		
		if(err_counter > 0 )
		{			
			
			return 0;			
		}
		else
		{
			
			return 'true';
		}			 
	}
	
    function error_notify(elem, return_val)
   	{
   				
				if(return_val == 1)
				{
					$(elem).removeClass('cb_val_error');
					$(elem).addClass('cb_val_success');
					//var this_id = $(elem).attr('id');
		
					//var error_div = '#'+this_id+'_err';
					//$(error_div).fadeOut(500);		
				}
				if(return_val == 0)
				{
					$(elem).addClass('cb_val_error');
					$(elem).removeClass('cb_val_success');
					//var this_id = $(elem).attr('id');
				
					//var error_div = '#'+this_id+'_err';
					//$(error_div).fadeIn(500);			
				}	   
   	}
   	
   	function reset_asset_form(){
   		
   		$('select[name^="_46_form_"]').each(function(){
				$(this).removeClass('cb_val_error');
				$(this).addClass('cb_val_success');
				$(this).val(0);
		});
		$('input[name^="_46_form_"]').each(function(){
				$(this).removeClass('cb_val_error');
				$(this).addClass('cb_val_success');
				$(this).val('');
		});
		dirty_form = 0;
		FORM_STATUS = 'free';
		window.scrollTo(0,0);
		
   	}
   			
    function load_dept_assets(dept_id){
    	
    	// serialize the data in the form .. if any
					serializedData = 'dept_id='+dept_id;
					
					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/manage_school_assets/2",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						$('#_46_assets_content').html(response);			
					  	$(".inline").colorbox({inline:true, width:"35%"});
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						
						}
					});

				// prevent default posting of form
				event.preventDefault();
		
    }
    
    function load_dept_categories(){
    	
    	// serialize the data in the form .. if any
					serializedData = '';

					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/manage_school_assets/1",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						$('#_46_categories').html(response);			
					  
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						
						}
					});

				// prevent default posting of form
				event.preventDefault();
		
    }
    
</script>