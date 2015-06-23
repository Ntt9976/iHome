<?php
session_start();
		include("connect.php");
		$superuser = $_SESSION['superuser'];
		if ($superuser == null)
		{
			
			sqlsrv_close($conn);
			header("Location:login.html" );
		}
$realname=$_POST['realname'];
$msg=$_POST['replyMsg'];
$remail=$_POST['email'];
$sql1 = "select username from Contact where email='$remail';";
$result1 =sqlsrv_query($conn,$sql1);
$info=sqlsrv_fetch_array($result1);
	$useracc=$info[0];
$id=$_POST['id'];
include("/phpMailer/class.phpmailer.php");
mb_internal_encoding('UTF-8');
header("Content-Type:text/html; charset=utf-8");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true; // turn on SMTP authentication
//這幾行是必須的
$mail->Username = "ihomemsg@gmail.com";
$mail->Password = "ihomeservice";
//這邊是你的gmail帳號和密碼
$mail->FromName = "iHome";
// 寄件者名稱(你自己要顯示的名稱)
$webmaster_email = "ihomemsg@gmail.com";
//回覆信件至此信箱
$email=$remail;
// 收件者信箱
$name=$realname;
// 收件者的名稱or暱稱
$mail->From = $webmaster_email;
$mail->AddAddress($email,$name);
$mail->AddReplyTo($webmaster_email,"Squall.f");
//這不用改
$mail->WordWrap = 50;
//每50行斷一次行
//$mail->AddAttachment("/XXX.rar");
// 附加檔案可以用這種語法(記得把上一行的//去掉)
$mail->IsHTML(true); // send as HTML
$mail->Subject = "Re:  " .$useracc. "  to iHome comments";
// 信件標題
$mail->Body = $msg;
//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
//$mail->AltBody = "測試內容";
//信件內容(純文字版)
if(!$mail->Send()){
echo "寄信發生錯誤：" . $mail->ErrorInfo;
sqlsrv_close($conn);
header( "refresh:1; url=supersend.php" );
//如果有錯誤會印出原因
}
else{
echo "寄信成功";
$sql = "UPDATE Contact SET reply='V' WHERE id=$id;";
$result =sqlsrv_query($conn,$sql);
sqlsrv_close($conn);
header( "refresh:1; url=supercontact.php" );
}
?>
