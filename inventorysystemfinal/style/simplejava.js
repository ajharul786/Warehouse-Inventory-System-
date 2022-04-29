// JavaScript Document

function checkform()
{
var username,pass,pass1,uname,lastname,email,adress,mobno;
	uname=document.getElementById('uname').value;
	username=document.getElementById('username').value;
	pass=document.getElementById('pass').value;
	pass1=document.getElementById('pass1').value;
	lastname=document.getElementById('lastname').value;
	email=document.getElementById('email').value;
	mobno=document.getElementById('mobno').value;
	adress=document.getElementById('adress').value;
	if(username==null || pass==null || pass1==null || uname==null || lastname==null || email==null || mobno==null || adress==null ){
		alert('Please Fill Full Form');
		return false;
	}	
 
 
 
 }
//end function

//end function

function checksub(){
	var email;
	emial=document.getElementById('subemail').value;
	if(email==""){
		alert('Please Enter Email Address');
		return false;
	}
	}
	//end function
	
	function checkp(){
	var pp;
	pp=document.getElementById('vp').value;
	if(pp==null || pp==0){
		alert('Please Enter Unit Umount');
		return false;
	}
	}
	//end function


ction

function checkaddproducts(){
var proname, proprice, prodec, propic;
proname=document.getElementById('proname').value;
proprice=document.getElementById('proprice').value;
prodec=document.getElementById('prodec').value;
propic=document.getElementById('propic').value;
	if(proname=="" || proprice=="" || prodec=="" || propic==""){
		alert('Please Fill Full Form');
		return false;
	}
}
//end function

