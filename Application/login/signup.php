<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hi</h1>
</body>
</html>
<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$pas = md5($password);
$q=mysqli_connect("localhost","root","","sirona");
if(!$q){
	echo "Not connected Please Check Your Internet Connection Or Contact The Administrator at-casatela93@gmail.com:)";
}
$p=0;



$k=0;
$k1=0;
$empdoc= "SELECT COUNT(*) FROM `doctor`";
$doc_count= mysqli_query($q,$empdoc);
$k1 = mysqli_fetch_array($doc_count);
$empus= "SELECT COUNT(*) FROM `user`";
$us_count= mysqli_query($q,$empus);
$k = mysqli_fetch_array($us_count);
$qu = "SELECT * FROM `doctor`";
$us= "SELECT * FROM `user`";
$re = mysqli_query($q,$qu);
$re1 = mysqli_query($q,$us);
if(!$re1){
    echo "error";
}
$p=0;
while($row1 = mysqli_fetch_array($re))
    {
    if($row1["email"]==$email)
    {
        $p=3;
        break;
    }
}
if($p!=3){

while($row = mysqli_fetch_array($re1)){
	if($row["email"] == $email && $row["password"]==$pas){
		$p=1;
		break;
	}
    elseif($row["email"] == $email || $row["password"]==$pas){
        $p=2;
        break;
    }
}
}

if($p==0){
$sql = "INSERT INTO `user`(`username`, `email`,`password`) VALUES ('$username','$email','$pas');";
if(mysqli_query($q,$sql)){
    echo '<script>alert("Succcessfully Register :)");window.location.href="../index.html";</script>';

}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($q);
}
// else{
// 	echo '<script>alert("Please Enter The Matching Password");window.history.go(-1);</script>';
// }
}
else if($p==1){
      echo "<script>alert('You Are Already Registered :)');window.location.href='login.html';</script>";
}
elseif($p==2){
    echo "<script>alert('Your email or password is already regestered before please try different mail or password :)');window.history.go(-1);</script>";
}
else{
    echo "<script>alert('You Are Already Registered as doctor:)');window.location.href='../user_doctor.html';</script>";
}
?>