<!DOCTYPE html>
<?php session_start();?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>iHome</title>
	</head>
	<body>
		<?php
		include ("connect.php");
		$username=$_SESSION['username'];
		$srel=$_POST['srel'];
		$form=$_POST['form'];
		$city=$_POST['city'];
		$region=$_POST['region'];
		$address=$_POST['address'];
		$descb=$_POST['descb'];
		$price=$_POST['price'];
		$phone=$_POST['phone'];
		if ($username == null)
		{
		
		sqlsrv_close($conn);
		header("Location:login.html" );
		}
		$sql = "insert into House (username,srel,form,city,region,address,descb,price,phone) values ('$username','$srel','$form','$city','$region','$address','$descb','$price','$phone');";
						$result =sqlsrv_query($conn,$sql);
						echo "新增成功!!網頁重新導向";
						sqlsrv_close($conn);
						header( "refresh:1; url=main.php" );
		?>
	</body>
</html>
