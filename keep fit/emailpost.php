<?php 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require './src/Exception.php'; 
require './src/PHPMailer.php'; 
require './src/SMTP.php'; 

$text="您的验证码为：";
$random=mt_rand(100000,999999);
setcookie("yanzheng",$random,time()+3600);
$email=$_POST["email"];

if (empty($_POST["email"])){
    echo"<script>history.go(-1);</script>";  
    echo "<script>alert('输入邮箱不能为空')</script>"; 
}
else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
{
    echo"<script>history.go(-1);</script>";  
    echo "<script>alert('邮箱格式不合法')</script>";  
}
else{
$mail = new PHPMailer(true);                            
try { 
    //服务器配置 
    $mail->CharSet ="UTF-8";                     //设定邮件编码 
    $mail->SMTPDebug = 0;                        // 调试模式输出 
    $mail->isSMTP();                             // 使用SMTP 
    $mail->Host = 'smtp.qq.com';                // SMTP服务器 
    $mail->SMTPAuth = true;                      // 允许 SMTP 认证 
    $mail->Username = 'zza458384308';                // SMTP 用户名  即邮箱的用户名 
    $mail->Password = 'pljjiligyjrhcbbg';             // SMTP 密码  部分邮箱是授权码(例如163邮箱) 
    $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议 
    $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持 

    $mail->setFrom('zza458384308@qq.com', 'Mailer');  //发件人 
    $mail->addAddress($email, 'Joe');  // 收件人 
    $mail->addReplyTo('zza458384308@qq.com', 'info');
    $mail->Subject = '欢迎使用邮箱验证'; 
    $mail->Body    = $text.$random; 
    $mail->AltBody = '您的浏览器不支持该文件格式，请更换浏览器'; 
    $mail->send(); 
    echo  "";
} catch (Exception $e) { 
    echo '邮件发送失败: '; 
}}

?>