<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>iHome</title>
	</head>
	<body>
		<?php
		session_start();
		include "connect.php";
		$username=$_POST['username'];
		$password=$_POST['password'];
		$realname=$_POST['realname'];
		$birthday=$_POST['birthday'];
		$job=$_POST['job'];
		$region=$_POST['region'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$sql1 = "SELECT * FROM Account ;";
		$result1 = sqlsrv_query($conn,$sql1);
		$info=sqlsrv_fetch_array($result1);
		$i=0;
		$list_arr=array();
		do{
		$list_arr[$i]=$info['username'];
		$i++;
		}while($info=sqlsrv_fetch_array($result1));
		if (ereg ("[a-zA-Z0-9\._\+]+@([a-zA-Z0-9\.-]\.)*[a-zA-Z0-9\.-]+", $email)&&(!in_array($username,$list_arr))&&$username!=null&&$password!=null) {
		$sql = "
		insert into Account (username,password) values ('$username','$password');
		insert into Meminfo (username,realname,birthday,job,region,email,phone) values ('$username','$realname','$birthday','$job','$region','$email','$phone');
		";
						$result =sqlsrv_query($conn,$sql);
						echo "註冊成功!!網頁重新導向";
						$_SESSION['username'] = $username;
						sqlsrv_close($conn);
						header( "refresh:1; url=main.php" );
		}
		else {
		echo "註冊失敗!!格式錯誤或帳號已有人註冊";
		header( "refresh:2; url=signup.html" );
		}
		?>
	</body>
</html>
