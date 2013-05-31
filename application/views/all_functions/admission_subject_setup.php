<center style="margin: -10px 0px 30px 0px;"><h3>Admission Subject Setup</h3></center>

<div id="function_main_content">
	
	<button id="_14_subject_add" style="float:right;margin-right:20px;">&nbsp;Add&nbsp;</button>
	<div style="clear: both;"></div>
	<table id="_14_subject_table">
		<tr class="top_row">
			<td style="width:25%;">
				Subject Code				
			</td>
			<td style="width:50%;">
				Subject Name
			</td>
			<td>
				Others
			</td>
		</tr>
	</table>
	<button id="_14_subject_save" style="float:right;margin-right:20px;">&nbsp;Save&nbsp;</button>
</div>

<!-- 
	the right side test column starts here 
-->

<div id="function_help_content">
this is the test column and the break in the line is only due to the width of this thing.
</div>

<!--
	end of help content .. start with jquery 
-->

<script>

var update_disabled = 99;
	$(document).ready(function()
    {
       $('#_14_subject_save').hide();       
       $( ".datefield" ).datepicker({
      		changeMonth: true,
      		changeYear: true,
      		dateFormat:"d MM yy"
       });
           
       $('#_14_subject_add').click(function(){
       		//disable edit links
       		disable_other_links();
       		
       		//var this_id = $(this);
       		add_row_subject_code('_14_subject_table');
       		//alert('yes it is clicked');
       });
       
       $('#_14_subject_save').click(function(){
       		//enable the links
       		enable_other_links();
       		
       		//var this_id = $(this);
       		save_row_subject_code('_14_subject_table');
       		//alert('yes it is clicked');
       });   
       
       
       get_subjects(); 
       
   	 	$('#_14_edit_save_button').live("click",function(){
   	 		//enable the disabled add button
   	 		enable_add_button();
   	 		
       		var row_id = $(this).attr('class');  //because the class contains the row id 
       		update_row_subject(row_id);
       });
       
       
       /*starting the validation part */
      
      $('#_14_subject_table :input').live("blur",function() {
      			
				var return_val = validation0(this);
				error_notify(this, return_val);	
				
   		});
      
      
      
      /* end of the validation part */
       
    });	
    
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
    
    
    function get_subjects(){    	
    					
					// serialize the data in the form .. if any
					serializedData = '';

					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/admission_subject_setup/1",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						var hello = $('#_14_subject_table tbody').append(response);			
					  
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
				
	function add_row_subject_code(tableID){
			
			var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;  //gives the number of rows + 1 in the tableID
            var row = table.insertRow(rowCount);   //hence you use it to insert that number here
            var row_id = '_14_sub_id'+rowCount;
            
            row.id = row_id;
            
            var cell1 = row.insertCell(0);
			cell1.innerHTML = '<input class="_14_subcode_ip" id="_14_input_subcode'+rowCount+'" name="_14_input_subcode[]" type="text"/>';
			
			var cell2 = row.insertCell(1);
			cell2.innerHTML = '<input class="_14_subname_ip" id="_14_input_subname'+rowCount+'" name="_14_input_subname[]" type="text"/>';
		
			var cell3 = row.insertCell(2);
			cell3.innerHTML = '&nbsp;&nbsp;<a href="javascript:del_table_row('+row_id+')"> <span style="color:#ff0000;border-bottom:2px solid #ffffff;"><strong> X </strong></span></a>&nbsp;&nbsp;';
			
          	$('#_14_subject_save').show();    
			//returning false here so that the browser does not redirect to any href link
			return false;
	}
	
	function del_table_row(del_id){
			
			var input_counter = 0;
			$('#_14_subject_table tr td :input').each(function(){
				
				input_counter++;
			});
			
			//dividing by 2 because there are 2 inputs per row.. but we need roow with input count
			if(input_counter/2 == 1)  
			{
				$('#_14_subject_save').hide();    
			}
			//removing the save button also if only one input elemetn is remaining to be removed
			$(del_id).remove();
			
	}
	
	function save_row_subject_code(tableID){
	
		if(!(validate_textboxes() == 'true'))
		{
			//place to highlight the error some how
		}
		else
		{
			// serialize the data in the form .. if any
					serializedData = '';
					
					serializedData = $('#'+tableID+' :input').serialize(); 
					
					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/admission_subject_setup/2",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						if(response == 'true')
						{
							refresh_subject_table();
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
	
	function edit_db_row(row_id){
		//disable the ad button till this operaiton is complete
		if(update_disabled == 1)
		{
			return false;
		}
		
		disable_add_button();
		
		var temp_code = $('#'+row_id+' td:nth-child(1)').html();
		var temp_name = $('#'+row_id+' td:nth-child(2)').html();
		
		var temp_class = row_id+'|'+temp_code;
		$('#'+row_id+' td:nth-child(1)').html('<input class="_14_subcode_ip" name="_14_input_subcode[]" type="text" value="'+temp_code+'"/>');
		$('#'+row_id+' td:nth-child(2)').html('<input class="_14_subname_ip" name="_14_input_subname[]" type="text" value="'+temp_name+'"/>');
		$('#'+row_id+' td:nth-child(3)').html('&nbsp;<button class="'+temp_class+'" id="_14_edit_save_button">&nbsp;Update&nbsp;</button>');
		
	}
	
	function delete_db_row(row_id){
		var rowCount = $('#_14_subject_table tr').length;
		// it is includin the toprow .. hence we take 2
		if(rowCount > 2)
		{
		var temp_code = $('#'+row_id+' td:nth-child(1)').html();
		var temp_name = $('#'+row_id+' td:nth-child(2)').html();
		
		var r=confirm('Confirm Delete of '+temp_code+' - '+temp_name+' ?');
		if (r==true)
  		{
  			serializedData = '';
					
					serializedData += 'subject_code='+temp_code;
					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/admission_subject_setup/4",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						if(response == 'true')
						{
							refresh_subject_table();
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
  			else
  			{
  				// if cancel is clikc in the dialog box
  			}
  		}
		else
  		{
  			//for row count > 1 else
  			alert('Atleast one subject required !');
  		}
		
		// the following is an example of a modal you can use .. also there is a bookmark on little laptop for http://www.ericmmartin.com/projects/simplemodal-demos/  .. use it
		/*  
				$('<div id="the_modal"></div>').appendTo('body')
                    .html('<div><h7>Confirm Delete of '+temp_code+' - '+temp_name+' ?</h7></div>')
                    .dialog({
                        modal: true, title: 'Delete message', zIndex: 10000, autoOpen: true,
                        width: 'auto', resizable: false,
                        buttons: {
                            Yes: function () {
                                // $(obj).removeAttr('onclick');                                
                                // $(obj).parents('.Parent').remove();

                                $(this).dialog("close");
                            },
                            No: function () {
                                $(this).dialog("close");
                            }
                        },
                        close: function (event, ui) {
                            $(this).remove();
                        }
                    });
                    
                    alert('the html is '+$('#the_modal').html());   */
	}	
	
	function update_row_subject(temp_class){
		//fetch the row id and old subject code from this
		
		if(!(validate_textboxes() == 'true'))
		{
			//code here to highlighting the error
		}
		else
		{
		var substr = temp_class.split('|');
		var row_id = substr[0];
		var old_sub_code = substr[1];
		
		serializedData = '';
					
					serializedData = $('#'+row_id+' :input').serialize(); 
					serializedData += '&old_subject_code='+old_sub_code;
					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/site/admission_subject_setup/3",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						if(response == 'true')
						{
							refresh_subject_table();
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
	
	function refresh_subject_table(){
		/* Refresh the table */
						$('table tr:not(.top_row)').each(function(){
							var tmp_id = $(this).attr('id');
							$('#'+tmp_id).remove();
						});
						get_subjects(); 
						$('#_14_subject_save').hide();    
						/* end of refresh  */
						
						update_disabled = 0;
	
							$('._14_other_links').each(function(){
							$(this).css('color','#5394BD');	
						});
		
		
	}
	
	function validate_textboxes(){
		var err_counter = 0;
		
			$('input[name^="_14_input_"]').each(function(){
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
	
	function disable_add_button(){	
		alert('add button disabled');	
		$('#_14_subject_add').attr('disabled', 'disabled');			
	}
	
	function enable_add_button(){
		alert('add button enabled');
		$('#_14_subject_add').removeAttr('disabled');
	}
	
	function disable_other_links(){
		update_disabled = 1;
		$('._14_other_links').each(function(){
			$(this).css('color','#aaaaaa');	
		});
		
	}
	
	function enable_other_links(){
		update_disabled = 0;
	
		$('._14_other_links').each(function(){
			$(this).css('color','#5394BD');	
		});
	}
	
</script>

