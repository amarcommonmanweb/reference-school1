<center style="margin: -10px 0px 30px 0px;"><h3>Admission Initiation</h3></center>

<div id="function_main_content">
	<center>
		<table>
			<tr>
				<td>
					<label for="13_start_date">Start Date</label><br />
					<input id="13_start_date" class="datefield" name="13_start_date" type="text" style="width:250px;" maxlength="10"/><br/>
					<small>12:00 pm</small>
				</td>
				<td>
					&nbsp;&nbsp;&nbsp;&nbsp;To&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td>
					<label for="13_end_date">End Date</label><br />
					<input id="13_end_date" class="datefield" name="13_end_date" type="text" style="width:250px;" maxlength="10"/><br/>
					<small>12:00 pm</small>
				</td>
			</tr>
		</table>
		</center>
		<br /><br />
		<center>
			
			For Classes
			
			<div id="highlight_box1">
				drgdr helloo .
			</div>
			<br/>
			<div id="13_response_message" style="float:left;margin-left:150px;">
				Hello .. this is some text
			</div>
			<button id="13_admission_initiate" style="float:right;margin-right:80px;">&nbsp;&nbsp;Initiate Admission&nbsp;&nbsp;</button>		
		
		</center>
	
</div>

<!-- 
	end of main function ... start with the help things 
-->

<div id="function_help_content">
yes .. some text 
<br />
some more text
</div>

<!--
	end of help content .. start with jquery 
-->

<script>
	$(document).ready(function()
    {
              
       $( ".datefield" ).datepicker({
      		changeMonth: true,
      		changeYear: true,
      		dateFormat:"d MM yy"
       });
           
        $('#13_response_message').html('hey .. this is the new text');   
    });	
</script>