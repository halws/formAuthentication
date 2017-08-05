<?php 
session_start();
$_SESSION['message']='';
$mysqli = new mysqli('localhost','root','','accounts');
if ($_SERVER['REQUEST_METHOD']=='POST') {
	if($_POST['password']==$_POST['passComfirmation']){
		$username = $mysqli->real_escape_string($_POST['username']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$password = md5($_POST['password']);
		//query
		$sql = "INSERT INTO users (username,email,password)"
		. "VALUES ('$username','$email','$password')";
		// if query is successful, redirect to welcome.php
		if($mysqli->query($sql)==true){
				$_SESSION['message']= "Registration is successful, welcome $username on board!";
				header("location: welcome.html.php");
				die;
		}else{
				$_SESSION['message']= "Someshing goes wrong";	
		}
	}else{
				$_SESSION['message']= "Your passwords are not equal!";
				
	}
}


include 'form.html';
 ?>