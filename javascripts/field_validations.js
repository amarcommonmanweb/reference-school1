/**
 * @author Amar
 */

var error_fields = new Array();

//for usernames -- alphanumeric, dot, underscore 
function validation0(elem)
{
	
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isusername(elem))
	{
		return 1;
	}
	else
	{
		return 0;
	}
} 

 //check for not blank, alpha numeric, dot, comma and space
function validation1(elem)
{
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isalphanumeric(elem))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function validation2(elem)
{
	//for all drop downs and date pickers
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isselected(elem))
	{
		return 1;
	}
	else
	{
		return 0;
	}
} 

function validation3(elem)
{
	//for phone numbers
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isnumeric(elem) && (val.length >= 10))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function validation4(elem)
{
	//for pin code
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isnumeric(elem) && (val.length >= 6))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function validation5(elem)
{
	//for marks
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isnumeric(elem))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function validation6(elem)
{
	//for email
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isemail(elem))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function validation7(elem)
{
	//for date
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isdate(elem))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function validation8(elem)
{
	//for radio buttons (2)
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isradiochosen(elem))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function validation9(elem)
{
	//for only numbers
	var val = elem.value;
	var elem_name = elem.name;
	
	if(isexists(elem) && isnumeric(elem))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

/*
*
*  The definition of all the validations follows
*
*/

//All functions doing the testing

function isexists(elem){
	if(elem.value.length == 0){		
		return false;
	}
	return true;
	
}

function isenabled(elem){
	if(elem.diabled == true){
		return false;
	}	
	return true;
}

function isselected(elem){

	if((elem.value == '') || (elem.value == '0') || (elem.value == 0)) {
		return false;
	}else{
		return true;
	}	
}


function isAlphabet(elem, errmsg){
	var alphaExp = /^[a-zA-Z\s]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		error_log += '&nbsp;&nbsp;&nbsp;'+errmsg+'<br>';
		elem.focus();
		return false;
	}	
}

function isnumeric(elem){
	var numericExpression = /^[0-9]+$/;
	if(elem.value.match(numericExpression)){
		return true;
	}else{
		return false;
	}		
}

function isusername(elem){
	
	//allowing dot comma and space also
	var alphaExp = /^[0-9a-zA-Z\.\_]+$/;
	if(elem.value.match(alphaExp) || elem.value == ''){
		return true;
	}else{
		return false;
	}	
}

function isalphanumeric(elem){
	//allowing dot comma and space also
	var alphaExp = /^[0-9a-zA-Z\s\.\,]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		return false;
	}	
}

function isemail(elem){
	
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.value.match(emailExp)){
		
		return true;
	}else{
		
		return false;
	}	
}

function isdate(elem){
	var dateExp = /^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/;
	if(elem.value.match(dateExp)){
		return true;
	}else{
		return false;
	}	
}

function isradiochosen(elem1, elem2){
	
	if(elem1.checked){
		return true;
	}
	else if(elem2.checked){
		return true;
	}
	
	return false;	
} 
 
