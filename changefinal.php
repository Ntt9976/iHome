<?php session_start(); ?>
<title>iHome</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("connect.php");
include "connect.php";
$username=$_SESSION['username'];
if ($username == null)
{
	
	sqlsrv_close($conn);
	header("Location:login.html" );
}
$sql1 = "SELECT realname,email,phone FROM Meminfo WHERE username='$username';";
$result1 = sqlsrv_query($conn,$sql1);
$info=sqlsrv_fetch_array($result1);
$realname=$info['realname'];
$email=$info['email'];
$phone=$info['phone'];
$sql = "UPDATE House SET phone='$phone' WHERE username='$username';
UPDATE Contact SET realname='$realname' WHERE username='$username';
UPDATE Contact SET email='$email' WHERE username='$username';
UPDATE Contact SET phone='$phone' WHERE username='$username';";
$result =sqlsrv_query($conn,$sql);
$info=sqlsrv_fetch_array($result);
echo "修改成功!!網頁重新導向";
header( "refresh:1; url=meminfo.php" );
?>
