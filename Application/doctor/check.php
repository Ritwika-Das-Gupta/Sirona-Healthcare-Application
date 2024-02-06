<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>

</body>
</html>


<?php
$email = $_POST['email'];
$q=mysqli_connect("localhost","root","","sirona");
if(!$q){
	echo "Not connected Please Check Your Internet Connection Or Contact The Administrator at-casatela93@gmail.com:)";
}
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

if($k==0){
    $p=0;
}
else
{
while($row = mysqli_fetch_array($re1)){

        if($row["email"] == $email)
        {
            echo("true");
            $p=1;
           break;
        }
    }
if($p!=1){
    while($row1 = mysqli_fetch_array($re))
    {
    if($row1["email"]==$email)
    {
        $p=2;
        break;
    }
}
}
}


if($p==0){
    echo '<script>alert("Register as a doctor :)");window.location.href="doc.html";</script>';

}
else if($p == 2) {
    echo "
        <script>
            var email = '" . $email . "';
            if (confirm('You are already registered. Do you wish to update your time slot?') == true) {
                window.location.href = 'update_doc.html?email=' + email;
            } else {
                window.location.href = '../user_doctor.html';
            }
        </script>";
}
else if($p==1){
    echo '<script>alert("You are registered as a user :)");window.location.href="../login/login.html";</script>';
}
?>