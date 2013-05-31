
var global_feed_email = 'xx';
var global_feed_msg = 'xx';
var global_access_reg = 'xx';
var global_admin_call_email = 'xx';
var global_admin_call_msg = 'xx';
	  	//MODAL STARTS
	  	
	  	var modal = (function(){
				var 
				method = {},
				$overlay,
				$modal,
				$content,
				$close;

				// Center the modal in the viewport
				method.center = function () {
					var top, left;

					top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
					left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;

					$modal.css({
						top:top + $(window).scrollTop(), 
						left:left + $(window).scrollLeft()
					});
				};

				// Open the modal
				method.open = function (settings) {
					$content.empty().append(settings.content);

					$modal.css({
						width: settings.width || 'auto', 
						height: settings.height || 'auto'
					});

					method.center();
					$(window).bind('resize.modal', method.center);
					$modal.show();
					$overlay.show();
				};

				// Close the modal
				method.close = function () {
					$modal.hide();
					$overlay.hide();
					$content.empty();
					$(window).unbind('resize.modal');
				};

				// Generate the HTML and add it to the document
				$overlay = $('<div id="overlay"></div>');
				$modal = $('<div id="modal"></div>');
				$content = $('<div id="content"></div>');
				$close = $('<a id="close" href="#">close</a>');
				
				
				
				
				$modal.hide();
				$overlay.hide();
				$modal.append($content, $close);

				$(document).ready(function(){
					$('body').append($overlay, $modal);						
				});

				$close.click(function(e){
					e.preventDefault();
					method.close();
				});

				return method;
			}());
   
			//MODAL ENDS




$(document).ready(function() {
		 
	
	//$("#signin_response").hide();
	
	
	//the button or link click events start here .. 
	  	
		$('#feedback_click').click(function(e){
					modal.open({content: $("#feedback_form").html()});
					e.preventDefault();
		});
		
		$('#feed_email').live('change',function(){
			global_feed_email = $(this).val();
		});
				
		$('#feed_msg').live('change',function(){
			global_feed_msg = $(this).val();
		});
		
		
		$('#access_admin_contact').live('click',function(e){
			modal.close();
			modal.open({content: $("#admin_call_form").html()});
					e.preventDefault();
		});
		$('#admin_call_email').live('change',function(){
			global_admin_call_email = $(this).val();
		});
				
		$('#admin_call_msg').live('change',function(){
			global_admin_call_msg = $(this).val();
		});
		
		$("#admin_call_send").live("click", function(){
			/*to send a mail .. we need to supply 3 things
			 * 1. to
			 * 2. subject 
			 * 3. message or message template
			 * 4. a flag to say message or template to use... 1= message ,, else .. page.php
			 */ 
	
			 /* the values from the modal can only be got
			  * if the modal is closed .. as we have a buton inside it..
			  * we need to tweak something to get the values .. which isdone above
			  */
			 
			 var to_addr = global_admin_call_email;
			 var message = global_admin_call_msg;
			
			 
			 serializedData = 'to=amar.insane@gmail.com'; // assign it to a global variable and use... replace it
			 serializedData += '&subject=Crossbow Feedback - '+to_addr;
			 serializedData += '&email_template='+message;
			 serializedData += '&msg_flag=1';
			 
			 alert('serialised data'+serializedData);
			 $("#content").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sending Message....&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/><br/>');
			 $.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/email",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						
						if(response == 'true')
						{
							modal.close();
							alert("Issue submitted successfully.");
							modal.open({content: "Thankyou for you Feedback"});
							window.setTimeout(modal.close(),3000);				
						}
						else
						{
							//display error in the block
							alert("There was an error in sending Message, please try again!!")
						}
						
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
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
		});
			 
		
		$('#access_account').click(function(e){
				modal.open({content: $("#account_access_help").html()});
				e.preventDefault();
		});
		$('#acc_reg_num').live('change',function(){
			global_access_reg = $(this).val();
		});
		
		
		$("#send_access_mail").live("click",function(){
			var access_reg = global_access_reg;
			
			serializedData = 'reg_num='+access_reg;
		
			$("#content").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sending Mail....&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/><br/>');
			 $.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/home/access_issue_data",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						
						if(response == 'Error')
						{
							alert("There was an error in fetching registration data, please try again.");	
						}
						else
						{	
							
							var strs = response.split(',');
							// reg_num,  email,  password 
							send_user_main(access_reg, strs[1], strs[0]);
																		
						}
						
						
						//console.log("Hooray, it worked!");
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
							
							alert("An error Occured.");
							//alert("inerror"+jqXHR+"vvv"+textStatus+"vvv"+errorThrown);
							modal.close();
						// log the error to the console
						//$("#login_response").html("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
							
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
	
		});
		
		
		$("#send_feedback").live("click", function(){
			/*to send a mail .. we need to supply 3 things
			 * 1. to
			 * 2. subject 
			 * 3. message or message template
			 * 4. a flag to say message or template to use... 1= message ,, else .. page.php
			 */ 
	
			 /* the values from the modal can only be got
			  * if the modal is closed .. as we have a buton inside it..
			  * we need to tweak something to get the values .. which isdone above
			  */
			 
			 var to_addr = global_feed_email;
			 var message = global_feed_msg;
			
			 
			 serializedData = 'to=amar.insane@gmail.com'; // assign it to a global variable and use... replace it
			 serializedData += '&subject=Crossbow Feedback - '+to_addr;
			 serializedData += '&email_template='+message;
			 serializedData += '&msg_flag=1';
			 
			alert('serialised data'+serializedData);
			 $("#content").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sending Message....&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/><br/>');
			 $.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/email",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						
						if(response == 'true')
						{
							modal.close();
							alert("Feedback was submitted successfully.");
							modal.open({content: "Thankyou for you Feedback"});
							window.setTimeout(modal.close(),3000);				
						}
						else
						{
							//display error in the block
							alert("There was an error in sending Feedback, please try again!!")
						}
						
						//console.log("Hooray, it worked!");
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
							
							alert("An error occured while sending feedback.");
							//alert("inerror"+jqXHR+"vvv"+textStatus+"vvv"+errorThrown);
							
						// log the error to the console
						//$("#login_response").html("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
							//alert("in complete");
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
		});
	
	
						   
	    $("#login_button").click(function() {
   		
		$("#login_response").fadeOut(300);
		serializedData = $('#left_content :text').serialize();
		
		serializedData = serializedData+'&action=signin';	
		
						//ajax post
						$.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/home/validate_credentials",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						/*
						 * Have a condition in the members area page that will redirect it to the customer 
						 * based on he is the admin or not. check the session variable for that.
						 */
																							
						if(response == 'true')
						{
							window.location.href = "http://localhost/CodeIgniter_school1/index.php/site/members_area";						
						}
						else
						{
							//display error in the block
							$("#login_response").fadeIn(300);
							$("#login_response").html(response);
						}
						
						//console.log("Hooray, it worked!");
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
							alert("login failure .. some error");
							alert("inLOGINerror"+jqXHR+"vvv"+textStatus+"vvv"+errorThrown);
						// log the error to the console
						$("#login_response").html("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
					
   });
	
});


	function send_user_main(reg_num, password, email_id){
			/*to send a mail .. we need to supply 3 things
			 * 1. to
			 * 2. subject 
			 * 3. message or message template
			 * 4. a flag to say message or template to use... 1= message ,, else .. page.php
			 */ 
	
			 /* the values from the modal can only be got
			  * if the modal is closed .. as we have a buton inside it..
			  * we need to tweak something to get the values .. which isdone above
			  */
			 
			 serializedData = 'to='+email_id;
			 serializedData += '&subject=Crossbow Login Details';
			 var message = '<center>Your Password is'+password+' </center>'; 
			 serializedData += '&email_template='+message;
			 serializedData += '&msg_flag=1';
			 
			
			
			 $("#content").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sending Message....&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/><br/>');
			 $.ajax({
						url: "http://localhost/CodeIgniter_school1/index.php/email",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						
						if(response == 'true')
						{
							modal.close();
							alert("Sent successfully, please check your email id "+email_id);
							modal.open({content: "Thankyou"});
							window.setTimeout(modal.close(),3000);				
						}
						else
						{
							modal.close();
							//display error in the block
							alert("There was an error in sending Message, please try again!!")
						}
						
						//console.log("Hooray, it worked!");
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
							
							alert("An error occured while sending message.");
							//alert("inerror"+jqXHR+"vvv"+textStatus+"vvv"+errorThrown);
							modal.close();
						// log the error to the console
						//$("#login_response").html("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
							//alert("in complete");
							
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
	
	}
