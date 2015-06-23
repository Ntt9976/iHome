<?php session_start(); ?>
<title>iHome</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("connect.php");
$delhouse = $_POST['delhouse'];
$username = $_SESSION['username'];
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
if((in_array($delhouse,$list_arr)))
{
$sql = "DELETE  FROM House WHERE id='$delhouse';";
$result = sqlsrv_query($conn,$sql);
echo "刪除成功!! 網頁重新導向";
sqlsrv_close($conn);
header( "refresh:1; url=delhouse.php" );
}else
	//}while($info2=sqlsrv_fetch_array($result2));
{
	echo "刪除失敗!! 網頁重新導向";
	sqlsrv_close($conn);
header( "refresh:1; url=delhouse.php" );
}
?>
