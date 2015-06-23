<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("connect.php");
$username = $_POST['username'];
$password = $_POST['password'];
//搜尋資料庫資料
$sql = "SELECT * FROM Account WHERE username = '$username'";
$result = sqlsrv_query($conn,$sql);
$info = sqlsrv_fetch_array($result);
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($username != null && $password != null && $info[0] == $username && $info[1] == $password)
{
//將帳號寫入session，方便驗證使用者身份
$_SESSION['username'] = $username;
echo "登入成功!!網頁重新導向";
    sqlsrv_close($conn);
    header( "refresh:1; url=main.php" );
// echo '<meta http-equiv=REFRESH CONTENT=1;url=member.php>';
}
else
{
echo "登入失敗!!網頁重新導向";
sqlsrv_close($conn);
    header( "refresh:1; url=login.html" );
// echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
?>
