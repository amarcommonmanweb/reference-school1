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
	<script type="text/javascript" src="http://localhost/CodeIgniter_school1/jquery_scripts/admin_jquery.js"></script>
	<script type="text/javascript" src="http://localhost/CodeIgniter_school1/jquery_scripts/home_jquery.js"></script>
	<script type="text/javascript" src="http://localhost/CodeIgniter_school1/jquery_scripts/all_functions_jquery.js"></script>
	<script type="text/javascript" src="http://localhost/CodeIgniter_school1/javascripts/field_validations.js"></script>	
	<!-- end: custom css and scripts -->
	
</head>
<body>
	<div id="wrapper">
		<div id="logo_head">
				<img src="http://localhost/CodeIgniter_school1/images/school1_logo.jpg" width="100px" height="130px"/>
				<div id="school_name"><center><h1>Army Public School, Bangalore</h1><br />ADMIN PANEL</center></div>
				<a id="feedback_click" href="javascript:void(0)">Feedback</a>
	
		</div>

		<div id="body_container">
			
			<div id="admin_boxes">
				<center>To contact the technical team, <a href="#"> Click Here </a></center>
				<br /><br />
				<div id="testingtesting"></div>
				
				<?php print_r($this->session->all_userdata()) ?>	
				
				<br /><br />
				
				
				
			</div>
			
			
			<div style="clear: both;"></div>
			
			more
			
			</div>



	<!-- all the modal forms here -->
	
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
		
		<div id="footer_content">
			<div style="float: right;padding-right: 20px;"><strong>Powered By - <a href="http://www.google.com">Crossbow</a></strong></div>		
			<div style="clear: both;"></div>	
		</div>

	</div>
</body>
</html>	
