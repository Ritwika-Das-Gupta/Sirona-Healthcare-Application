<?php
$docname = $_POST['doctorName'];
$fees = floatval($_POST['fees']);
$gender= $_POST['gender'];
$contact =$_POST['contact'];
$spec=$_POST['specialist'];
$exp =$_POST['experience'];
$email = $_POST['email'];
$timeslot=$_POST['time'];
$timeslot=explode(",",$timeslot);
if(sizeof($timeslot)==1)
{
    $time1= $timeslot[0];
    $time2="";
    $time3="";
}
else if(sizeof($timeslot)==2)
{
    $time1= $timeslot[0];
    $time2=$timeslot[1];
    $time3="";
}
else{
    $time1= $timeslot[0];
    $time2=$timeslot[1];
    $time3=$timeslot[2];
}


$q=mysqli_connect("localhost","root","","sirona");
if(!$q){
	echo "Not connected Please Check Your Internet Connection Or Contact The Administrator at-casatela93@gmail.com:)";
}
$qu = "SELECT * FROM `doctor`";
$re = mysqli_query($q,$qu);
$p=0;
while($row = mysqli_fetch_array($re)){
    if($row["email"] == $email)
    {
        $p=1;
        break;
    }
}
if($p==0){
$sql = "INSERT INTO `doctor`(`fees`,`name`, `gender`,`contact`,`email`,`spec`,`exp`,`time1`,`time2`,`time3`) VALUES ('$fees','$docname','$gender','$contact','$email','$spec','$exp','$time1','$time2','$time3');";
if(mysqli_query($q,$sql)){
    echo '<script>alert("Succcessfully Register :)");window.location.href="../index.html";</script>';

}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($q);
}

}
else if($p == 1) {
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
?>