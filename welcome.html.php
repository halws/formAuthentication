<?php 
session_start();
$message = $_SESSION['message'];
$mysqli = new mysqli('localhost','root','','accounts');
$sql = 'SELECT username,email,password FROM users';
$result = $mysqli->query($sql);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>
	<h1> <?php print_r($message); ?> </h1> 	
	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>id</th>
		</tr>
	<?php 
	while ($row = $result->fetch_assoc()) {
echo"<tr>
					<td>" . $row['username'] ."</td>
					<td>" . $row['email'] ."</td>
					<td>" . $row['password'] ."</td>
				</tr>"		
		;
	}


	 ?>
	</table>
 </body>
 </html>