<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
$servername = "victorybringer.xyz";
$username = "root";
$password = "123456";
$dbname = "mydb";
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

$email=$password="";
$email = $_POST["email"];
$password = $_POST["password"];
$code = $_POST["code"];

if (empty($_POST["email"])){
    echo"<script>history.go(-1);</script>";  
    echo "<script>alert('输入邮箱不能为空')</script>"; 
}
else {
    $sql="SELECT*FROM myde WHERE email='$email'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        echo"<script>alert('该邮箱已被注册')</script>";
         echo"<script>history.go(-1);</script>";  
    }
    else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
    {
        echo"<script>history.go(-1);</script>";  
        echo "<script>alert('邮箱格式不合法')</script>";  
    }
    else if(empty($_POST["password"])){ 
        echo"<script>history.go(-1);</script>";  
        echo "<script>alert('密码输入不能为空')</script>";
       
    }
    else if(empty($_POST["code"])){ 
        echo"<script>history.go(-1);</script>";  
        echo "<script>alert('验证码输入不能为空')</script>";
       
    }
    else if($code=$_COOKIE["yanzheng"]){
        $email1 = $_POST["email"];
        $password1 = $_POST["password"];
        $sql = "INSERT INTO myde (code,email)
        VALUES ('$password1','$email1')"; 
        if ($conn->query($sql) === TRUE) {
            echo "注册成功! 5秒后将自动跳转到登陆界面。";
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }
    else{
        echo"<script>history.go(-1);</script>";  
        echo "<script>alert('验证码不正确')</script>";
    }
    }
}
$conn->close();
 
?>