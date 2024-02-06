<?php
$timeslot=$_POST['time'];
$email=$_POST['email'];
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
if($p==1){
$sql = "UPDATE `doctor` SET `time1`='$time1', `time2`='$time2', `time3`='$time3' WHERE `email` = '$email'";
if(mysqli_query($q,$sql)){
    echo '<script>alert("Successfully Updated :)");window.location.href="../index.html";</script>';

}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($q);
}

}
else if($p==0){
    echo '<script>alert("This email is not found");window.location.href="doc_entry.html";</script>';
}
?>