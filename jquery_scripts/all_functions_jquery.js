/*
 * This is the master jquery script with all the scripts for all the function 
 * 
 * please maintain the distinction between the different function's jquery
 * by using comments in between for separation
 * 
 * The onload function will be loading everything of all the functions available...
 * Hence the if conditions are used to get the id value and load only certain things on load ..
 * relavent to that particular page
 * 
 * Later we can implement a smart switch statement .. by using or not using break statements
 * and replace this if statements 
 */

//Variables START
var candidates_reg_num = [];


//Variables END


//start ready function
$(document).ready(function() {

	//this is one way to know the page we are navigating to .. then we load only the appropriate data
	var pathname = window.location.pathname;

	var part_id = pathname.split('/');
	var parts_num = part_id.length;
	var func_id = part_id[parts_num - 1]; 
	//now use this func_id to differentiate the functions
	
	if(func_id == 1){
		
		get_candidates_reg_list(); //gets the candidates list with reg_num .. and populates the global variable candidates_reg_num
		
	}
	else if (func_id == 2) {
		alert("thisis the second one");
	} else{
		alert("the else condition");
	};
	
	
	$("input#hello_txt").autocomplete({
    	source: 'http://localhost/CodeIgniter_school1/index.php/site/get_cand_reg_list'
	});
	
});
//end ready function

function get_candidates_reg_list(){
	var return_string = '';
	var serializedData = '';
	
	$.ajax({
		url: "http://localhost/CodeIgniter_school1/index.php/site/get_cand_reg_list",
		type: "post",
		data: serializedData,
		// callback handler that will be called on success
		success: function(response, textStatus, jqXHR){
		//log a message to the console
		
		alert("response list is"+response);
		var response_split = response.split('|');
		candidates_reg_num = response_split;
		
		var i = candidates_reg_num.length - 1;
		alert("length is"+i);
		var string_ppl = '';
		while(i >= 0){
			
			string_ppl += candidates_reg_num[i];
			//alert("the values are"+candidates_reg_num[i]);
			i--;
		}
		$('#test_dept').html(string_ppl);
		return_string = response;
						
		//console.log("Hooray, it worked!");
		},
		// callback handler that will be called on error
		error: function(jqXHR, textStatus, errorThrown){
							
		alert("An error occured while sending message.");
		//alert("inerror"+jqXHR+"vvv"+textStatus+"vvv"+errorThrown);
							
		// log the error to the console
		//$("#login_response").html("The following error occured: "+textStatus, errorThrown);
		},
		// callback handler that will be called on completion
		// which means, either on success or error
		complete: function(){
		//alert("in complete");
		alert("in complete");
		
		}
	});
					
	// prevent default posting of form
	event.preventDefault();
		
}
 