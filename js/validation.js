arw="<span class='ui-icon ui-icon-triangle-1-e' style='float:left;'></span>&nbsp; ";
function valid()
{
//alert("");
	var msg='';
	$('#sucMsg').hide();
	//First Name
   	if(document.register.f_name.value=="")
	{
		msg+=arw+"First Name"+"<br>";
	}
	else if(document.register.f_name.value!="")
	{
		var reg1= /^[A-Za-z\s]+[A-Za-z\s\.]+$/;
		if((document.register.f_name.value.indexOf(".")==0) || (document.register.f_name.value.indexOf(" ")==0))
		{
			msg+=arw+"First character of name should be alphabet character in First Name"+"<br>";
		}
		else if(document.register.f_name.value!="" && document.register.f_name.value.length<3)
		{
			msg+=arw+"Enter at least 3 characters in First Name."+"<br>";
		}
	}
	//Last Name
   	if(document.register.l_name.value=="")
	{
		msg+=arw+"Last Name"+"<br>";
	}
	else if(document.register.l_name.value!="")
	{
		var reg1= /^[A-Za-z]+[A-Za-z\s\.]+$/;
		if((document.register.l_name.value.indexOf(".")==0) || (document.register.l_name.value.indexOf(" ")==0))
		{
			msg+=arw+"First character of name should be alphabet character in Last Name"+"<br>";
		}
		else if(document.register.l_name.value!="" && document.register.l_name.value.length<1)
		{
			msg+=arw+"Enter at least 1 character in Last Name."+"<br>";
		}
	}
	
	//Sex
	if((document.register.gender[0].checked==false)&&(document.register.gender[1].checked==false)) 
	{
		msg+=arw+"Gender"+"<br>";
	}
	
	//PHONE NUMBER
	if(document.register.r_contact.value=="")
   	{ 
		msg+=arw+"Mobile No"+"<br>";
	}
	if(document.register.r_contact.value!="" && document.register.r_contact.value.length<5)
		{	
			msg+=arw+"Enter at least 5 numbers in Mobile No."+"<br>";
		}
	//Country
	if(document.register.country_id_l.value=="")
   	{ 
		msg+=arw+"Country"+"<br>";
	}
	//State
	if(document.register.state_id_l.value=="")
   	{ 
		msg+=arw+"State"+"<br>";
	}
//City
	if(document.register.city_id_l.value=="")
   	{ 
		msg+=arw+"City"+"<br>";
	}

//Location
	if(document.register.location_name.value=="")
   	{ 
		msg+=arw+"Location"+"<br>";
	}
else if(document.register.location_name.value!="" && document.register.location_name.value.length<3)
		{
			msg+=arw+"Enter at least 3 characters in Location."+"<br>";
		}
	//Email
	if(document.register.r_email.value=="")
	{
		msg+=arw+"Mail Id"+"<br>";
	}

	if(document.register.r_email.value!="")
	{
		
		var reg=/^[A-Za-z0-9]+([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var address =document.register.r_email.value;
		if(reg.test(address)==false) 
		{
		  msg+=arw+'Enter valid Email'+"<br>";
		}
	}
	
	//Password
	if(document.register.pwd.value=="")
		{
			msg+=arw+"Password"+"<br>";
		}
		if(document.register.pwd.value!="" && document.register.pwd.value.length<5)
		{	
			msg+=arw+"Enter minimum 5 character in Password"+"<br>";
		}
		if(document.register.cpwd.value=="")
		{
			msg+=arw+"Confirm Password"+"<br>";
		}
		
		if(document.register.cpwd.value!="" && document.register.cpwd.value.length<5) 
		{
			msg+=arw+"Enter minimum 5 characters in Confirm Password"+"<br>";
		}
		if(document.register.pwd.value!=document.register.cpwd.value)
		{
			msg+=arw+"Password Mismatch"+"<br>";
		}
		
	//Captcha
	if(document.register.STI_imgString.value=="")
   	{ 
		msg+=arw+"Captcha"+"<br>";
	}
	if(document.register.STI_imgString.value!="" && document.register.STI_imgString.value.length<3 )
   	{ 
		msg+=arw+"Enter the Captcha correctly"+"<br>";
	}

	
	//Terms of use
	if((document.register.amenities.checked==false)) 
	{
		msg+=arw+"Terms of use"+"<br>";
	}
	//DIALOG
	if(msg!='')
	{ 
		
		document.getElementById('dialog').innerHTML=msg;
        $('#dialog').dialog('open');
		return false;
	}	
}

//For Forgot Password
function frgpassword()
{
	var msg='';
	$('#sucMsg').hide();
	if(document.frgpass.email.value=="")
	{
		msg+=arw+" Enter Your Email Id"+"<br>";
	}
	if(document.frgpass.email.value!="")
	{
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var address = document.frgpass.email.value;
		if(reg.test(address) == false) 
		{
			msg+=arw+" Invalid Email Id"+"<br>";
		}
	}
	if(msg!=''){
		document.getElementById('dialog').innerHTML=msg;
		$('#dialog').dialog('open');
		return false;
	}
}

//For Change Password
function chngpassword()
{
	var msg='';
	$('#sucMsg').hide();
	if(document.chngpass.oldPassword.value=="")
	{
		msg+=arw+" Old Password"+"<br>";
	}
	if(document.chngpass.oldPassword.value!="" && document.chngpass.oldPassword.value.length<5)
	{
		msg+=arw+"Enter minimum 5 character for Old Password"+"<br>";
	}

	if((document.chngpass.oldPassword.value!="") && (document.chngpass.oldPassword.value!=document.chngpass.dbPassword.value))
	{
		msg+=arw+" Enter the existing password"+"<br>";
	}

	if(document.chngpass.newPassword.value=="")
	{
		msg+=arw+" New Password"+"<br>";
	}
	if(document.chngpass.newPassword.value!="" && document.chngpass.newPassword.value.length<5)
	{
		msg+=arw+"Enter minimum 5 character for New Password"+"<br>";
	}

	if(document.chngpass.newConfrmPassword.value=="")
	{
		msg+=arw+" Confirm New Password"+"<br>";
	}
	if(document.chngpass.newConfrmPassword.value!="" && document.chngpass.newConfrmPassword.value.length<5)
	{
		msg+=arw+"Enter minimum 5 character for Confirm New Password"+"<br>";
	}
	
	if(document.chngpass.newPassword.value!=document.chngpass.newConfrmPassword.value)
	{
		msg+=arw+"Password mismatch"+"<br>";
	}	
	if(msg!=''){
		document.getElementById('dialog').innerHTML=msg;
		$('#dialog').dialog('open');
		return false;
	}
}

//ALLOW ONLY ALPHABETIC CHARACTERS AND .(DOT) FOR NAME
function characteronly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
	if(unicode!=9 && unicode!=13 &&  unicode!=8 &&  unicode!=46 &&  unicode!=127 && unicode!=32)
	{
		if ((unicode<65||unicode>90) && (unicode<97||unicode>122) && unicode!=17)
		{
			msg="Please enter only the alphabetic characters and .(dot).";
			//alert(msg)
			document.getElementById('dialog').innerHTML=msg;
			$('#dialog').dialog('open');
			return false;
		}
	}
}

//ALLOW NUMBERS,SMALL CHARACTERS,.(DOT), @ &_(UNDERSCORE) FOR EMAIL ID.
function email(e){
	var unicode=e.charCode? e.charCode : e.keyCode
	if(unicode!=9 && unicode!=13 &&  unicode!=46 &&  unicode!=64 &&  unicode!=95){
	//if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
		if ((unicode<48||unicode>57) && (unicode<97||unicode>122) && (unicode!=8) || unicode==94 || unicode==46){ //if not a number
		msg="Please enter the numbers, small alphabetic characters,.(dot),@ and _(underscore).";
		document.getElementById('dialog').innerHTML=msg;
			$('#dialog').dialog('open');
			return false
		}
	}
}

//ALLOW NUMBERS,+ AND -(HYPEN) FOR PHONE
function contactnumbonly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
	if(unicode!=8 && unicode!=9 && unicode!=13 &&  unicode!=39  && unicode!=43 && unicode!=45 && unicode!=46)
	{
		if (unicode<48||unicode>57 || unicode==94 || unicode==32 ) 
		{alert(unicode);
			msg="Please enter numbers only.";
			document.getElementById('dialog').innerHTML=msg;
			$('#dialog').dialog('open');
			return false
		}
	}
}
//For avoid press character
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
