<?php 
session_start();
$_SESSION['message']='';
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "accounts";
try {
	$conn = new PDO ("mysql:host=$servername;dbname=$dbname",
		$username,$password);
	//set PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		if ($_POST['password']==$_POST['passComfirmation']) {
			//sequrity methods
			$username = $conn->quote($_POST['username']);
			$email = $conn->quote($_POST['email']);
			$password = md5($_POST['password']);

			//insert into row
			$stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES ( :username, :email, :password)      ");
			$stmt->bindParam(":username",$username);
			$stmt->bindParam(":email",$email);
			$stmt->bindParam(":password",$password);
if ($stmt->execute()) {
	$_SESSION['message'] = "Registration is successful, welcome $username on board";
	header("location: welcome.html.php");
	die;
}

					}
	}


} catch (PDOException $e) {
	echo "Error: " . $e->getMessage;
}




// $mysqli = new mysqli('localhost','root','','accounts');
// if ($_SERVER['REQUEST_METHOD']=='POST') {
// 	if($_POST['password']==$_POST['passComfirmation']){
// 		$username = $mysqli->real_escape_string($_POST['username']);
// 		$email = $mysqli->real_escape_string($_POST['email']);
// 		$password = md5($_POST['password']);
// 		//query
// 		$sql = "INSERT INTO users (username,email,password)"
// 		. "VALUES ('$username','$email','$password')";
// 		// if query is successful, redirect to welcome.php
// 		if($mysqli->query($sql)==true){
// 				$_SESSION['message']= "Registration is successful, welcome $username on board!";
// 				header("location: welcome.html.php");
// 				die;
// 		}else{
// 				$_SESSION['message']= "Someshing goes wrong";	
// 		}
// 	}else{
// 				$_SESSION['message']= "Your passwords are not equal!";
				
// 	}
// }


include 'form.html';
 ?>