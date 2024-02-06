<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hi
</body>
</html>
<?php
session_start();
$q=mysqli_connect("localhost","root","","sirona");
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$email = $_POST['email'];
$a = "SELECT * FROM `user` WHERE `email` = '$email';";
$r = mysqli_query($q,$a);
$p=0;
while($row = mysqli_fetch_array($r)){
	if($row["email"] == $email){
		$p=1;
		break;
	}
}
if($p==0)
{
    echo '<script>alert("Your email did not match :)");window.history.go(-1);</script>';
}
else if ($p==1){
if($pass1 == $pass2){
    $p1 = md5($pass1);
    $a1 = "UPDATE `user` SET `password` = '$p1' WHERE `email` = '$email';";
    $r1 = mysqli_query($q,$a1);
    if($r1){
        echo '<script>alert("Your password is updated :)");window.location.href="login.html";</script>';
}
}
else{
    echo '<script>alert("Your Password Not Matched Pls Try Again :)"); window.history.go(-1);</script>';
}
}


?>