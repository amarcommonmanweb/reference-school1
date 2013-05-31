<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>School1 - Home</title>
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
	<meta name="author" content="Amarnath Bagineni" />
	<meta name="description" content="Site Description Here" />
	<meta name="keywords" content="keywords, here" />
	<meta name="robots" content="index, follow, noarchive" />
	<meta name="googlebot" content="noarchive" />

	<!-- start : jquery stuff -->
	<script type="text/javascript" src="http://localhost/CodeIgniter_school1/jquery/js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript" src="http://localhost/CodeIgniter_school1/jquery/js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="http://localhost/CodeIgniter_school1/jquery/js/jquery-1.8.0.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/CodeIgniter_school1/jquery/css/ui-lightness/jquery-ui-1.8.22.custom.css" />
	<!-- end : jquery stuff -->
	
	<!-- start: custom css nad scripts -->
	<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/CodeIgniter_school1/css/school1_style1.css" />
	<script type="text/javascript" src="http://localhost/CodeIgniter_school1/jquery_scripts/home_jquery.js"></script>
	<script type="text/javascript" src="http://localhost/CodeIgniter_school1/javascripts/field_validations.js"></script>	
	
	   	
	<!-- end: custom css and scripts -->
	
</head>
<body>
	<div id="wrapper">
		<div id="logo_head">
				<img src="http://localhost/CodeIgniter_school1/images/school1_logo.jpg" width="100px" height="130px"/>
				<div id="school_name"><center><h1>Army Public School, Bangalore</h1><br />STAFF PANEL</center></div>
				<a id="feedback_click" href="javascript:void(0)">Feedback</a>
	
		</div>
		
		<div id="body_container">
			<div id="left_content">
				<center>
				<br /><br />
				Hi, Welcome to the staff panel, please enter your username and password to proceed
				<br /><br /><br />
				<table id="login_table">
					<tr>
						<td><strong>Username</strong> <br /><input name="login_username" type="text"/> </td>
					</tr>
					<tr>
						<td><strong>Password</strong> <br /><input name="login_password" type="text"/> </td>
					</tr>
					<tr>
						<td><div id="login_response"></div><button id="login_button" style="float:right;">Go</button></td>
					</tr>
					<tr>
						<td><a id="access_account" href="javascript:void(0)">Can't access your account?</a></td>
					</tr>
				</table>
				</center>
			</div>
			<div id="right_content">
				 &nbsp;<strong>Recent</strong> 
				<hr />
				<!-- Only four news items .. else .. the vertical line will create a prolem -->
				<div class="recent_div">
					<h2>Heading</h2>
					hi this is the recent newssdfsdfsf sdf sdf sdf sdf sdf sd fsdfsdfsdfsdf 
					<div style="clear: both;"></div>
					<a href="#">more...</a>
					<div style="clear: both;"></div>
					<hr/>
				</div>
				<div class="recent_div">
					<h2>Heading</h2>
					hi this is the recent newssdfsdfsf sdf sdf sdf sdf sdf sd fsdfsdfsdfsdf 
					<div style="clear: both;"></div>
					<a href="#">more...</a>
					<div style="clear: both;"></div>
					<hr/>
				</div>
				<div class="recent_div">
					<h2>Heading</h2>
					hi this is the recent newssdfsdfsf sdf sdf sdf sdf sdf sd fsdfsdfsdfsdf 
					<div style="clear: both;"></div>
					<a href="#">more...</a>
					<div style="clear: both;"></div>
					<hr/>
				</div>
				<div class="recent_div">
					<h2>Heading</h2>
					hi this is the recent newssdfsdfsf sdf sdf sdf sdf sdf sd fsdfsdfsdfsdf 
					<div style="clear: both;"></div>
					<a href="#">more...</a>
					<div style="clear: both;"></div>
					<hr/>
				</div>
				
			</div>
			<div style="clear: both;"></div>
		</div>
		
	   <!-- lets just make all our MODALs here -->
	   
	   
	   <div id="feedback_form" class="modal_window" width="500px">
		<h3>Send us a Feedback</h3>

		
			<label style="font-size: 12px;" for="feed_email">Your E-mail</label><br />
			<input type="text" id="feed_email" class="text_box" name="feed_email" style="width: 300px;padding:6px;font-size: 13px;">
			<br>
			
			<label style="font-size: 12px;" for="feed_msg">Your Feedback</label><br />
			<textarea id="feed_msg" class="text_box" name="feed_msg" style="font-family: arial, verdana, tahoma;font-size: 13px;width: 500px;height: 100px;padding:6px;"></textarea>
			<br />
			<button style="float: right;margin: 3px 10px 0px 0px;" id="send_feedback"> &nbsp;&nbsp;Send&nbsp;&nbsp; </button>
			<br />
		</div>
	 
	 
	 
	 	<div id="account_access_help" class="modal_window" width="300px">
	 		
	 		<h3>Can't Access Account</h3>
	 		<label style="font-size: 12px;" for="acc_reg_num">Enter your registration number</label><br />
			<input type="text" id="acc_reg_num" class="text_box" name="acc_reg_num" style="width: 200px;padding:6px;font-size: 13px;">
			<button style="float: right;margin: 3px 30px 0px 0px;" id="send_access_mail"> &nbsp;&nbsp;Submit&nbsp;&nbsp; </button>
			<br>
	 		<p style="font-size: 12px;">A mail will be sent to your registered e-mail id, with your login credentials.</p> 
	 		
	 		<br /><br />
	 		<p style="font-size: 12px;">For any further assistance, <a id="access_admin_contact" href="javascript:void(0)"><strong>Click here</strong></a> to contact admin.</p>
	 	</div>
	 	
	 	
	 	
		<div id="admin_call_form" class="modal_window" width="500px">
		<h3>Contact Admin</h3>

		
			<label style="font-size: 12px;" for="admin_call_email">Your E-mail</label><br />
			<input type="text" id="admin_call_email" class="text_box" name="admin_call_email" style="width: 300px;padding:6px;font-size: 13px;">
			<br>
			
			<label style="font-size: 12px;" for="admin_call_msg">Your Message</label><br />
			<textarea id="admin_call_msg" class="text_box" name="admin_call_msg" style="font-family: arial, verdana, tahoma;font-size: 13px;width: 500px;height: 100px;padding:6px;"></textarea>
			<br />
			<button style="float: right;margin: 3px 10px 0px 0px;" id="admin_call_send"> &nbsp;&nbsp;Send&nbsp;&nbsp; </button>
			<br />
		</div>
	 	
	   
	   
	   <!-- END of MODAL windows -->
		
		
		<div id="footer_content">
			<div style="float: right;padding-right: 20px;"><strong>Powered By - <a href="http://www.google.com">Crossbow</a></strong></div>		
			<div style="clear: both;"></div>	
		</div>
		
	</div>
	
</body>
</html>	