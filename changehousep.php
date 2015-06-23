<?php session_start(); ?>
<title>iHome</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("connect.php");
include "connect.php";
$username=$_SESSION['username'];
$id=$_POST['id'];
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
$sql = "SELECT id FROM House WHERE username = '$username'";
$result =sqlsrv_query($conn,$sql);
$info=sqlsrv_fetch_array($result);
$i=0;
$list_arr=array();
do{
$list_arr[$i]=$info['id'];
$i++;
}while($info=sqlsrv_fetch_array($result));//判斷是否還有資料沒有取完，如果取完，則停止while迴圈。
//do{
if((in_array($id,$list_arr)))
{
$sql = "UPDATE House SET srel='$srel' WHERE id='$id';
UPDATE House SET form='$form' WHERE id='$id';
UPDATE House SET city='$city' WHERE id='$id';
UPDATE House SET region='$region' WHERE id='$id';
UPDATE House SET address='$address' WHERE id='$id';
UPDATE House SET descb='$descb' WHERE id='$id';
UPDATE House SET price='$price' WHERE id='$id';
UPDATE House SET phone='$phone' WHERE id='$id';";
$result = sqlsrv_query($conn,$sql);
echo "更新成功!! 網頁重新導向";
sqlsrv_close($conn);
header( "refresh:1; url=changehouse.php" );
}else
	//}while($info2=sqlsrv_fetch_array($result2));
{
	echo "更新失敗!! 網頁重新導向";
	sqlsrv_close($conn);
header( "refresh:1; url=changehouse.php" );
}
?>
