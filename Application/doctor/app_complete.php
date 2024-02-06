<?php
    // Extract data from the form
    $fname = $_POST['fname'] ;
    $lname = $_POST['lname'] ;
    $age = $_POST['age'] ;
    $gender = $_POST['gender'] ;
    $height = $_POST['height'] ;
    $weight = $_POST['weight'] ;
    $bloodgroup = $_POST['bloodgroup'] ;
    $contact = $_POST['contact'] ;
    $email = $_POST['email'] ;
    $address = $_POST['address'] ;
    $city = $_POST['city'] ;
    $pinCode = $_POST['pin-code'] ;
    
    $diagnosis = $_POST['diagnosis'] ;
    $medicalHistory = $_POST['medical-history'] ;
    $medications = $_POST['medications'] ;
    $allergies = $_POST['allergies'] ;
    $mediclaim = $_POST['mediclaim'] ;
    $spec = $_POST['specialist'] ;

    // Additional date field
    $date = $_POST['date'] ;

    // Extract selected row data
    $selId = $_POST['selectedId'] ;
    $selName = $_POST['selectedName'] ;
    $selFees = $_POST['selectedFees'] ;
    $selTime1 = $_POST['selectedTime1'] ;
    $selTime2 = $_POST['selectedTime2'] ;
    $selTime3 = $_POST['selectedTime3'] ;

    $q=mysqli_connect("localhost","root","","sirona");
    if(!$q){
        echo "Not connected Please Check Your Internet Connection Or Contact The Administrator at-casatela93@gmail.com:)";
    }
    $qu = "SELECT * FROM `appt`";
    $re = mysqli_query($q,$qu);
    $p=0;
    while($row = mysqli_fetch_array($re)){
        if($row["email"] == $email ){
            $p=1;
            break;
        }
    }
    
    if($p==0){
        // echo'<script>alert("Hi");</script>';
        $sql = "INSERT INTO `appt` (`f_name`, `l_name`, `age`, `gender`, `height`, `weight`, `b_group`, `contact`, `email`, `address`, `city`, `pin`, `diagnosis`, `med_history`, `medications`, `allergies`, `mediclaim`, `specialist`, `date`,`doc_id`, `doc_name`, `fees`, `time1`, `time2`,`time3`)
        VALUES ('$fname', '$lname', '$age', '$gender', '$height', '$weight', '$bloodgroup', '$contact', '$email', '$address', '$city', '$pinCode', '$diagnosis', '$medicalHistory', '$medications', '$allergies', '$mediclaim', '$spec', '$date','$selId', '$selName', '$selFees', '$selTime1', '$selTime2', '$selTime3')";
        if(mysqli_query($q,$sql)){  
            echo '<script>alert("Your appointment has been booked Thankyou :)");window.location.href="../index.html";</script>';
        
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($q);
        }
        
        
    }
    else if($p==1){
        $sql = "UPDATE `appt` SET
        `f_name` = '$fname',
        `l_name` = '$lname',
        `age` = '$age',
        `gender` = '$gender',
        `height` = '$height',
        `weight` = '$weight',
        `b_group` = '$bloodgroup',
        `contact` = '$contact',
        `email` = '$email',
        `address` = '$address',
        `city` = '$city',
        `pin` = '$pinCode',
        `diagnosis` = '$diagnosis',
        `med_history` = '$medicalHistory',
        `medications` = '$medications',
        `allergies` = '$allergies',
        `mediclaim` = '$mediclaim',
        `specialist` = '$spec',
        `date` = '$date',
        `doc_id` = '$selId',
        `doc_name` = '$selName',
        `fees` = '$selFees',
        `time1` = '$selTime1',
        `time2` = '$selTime2',
        `time3` = '$selTime3'
    WHERE `email` = '$email'";
        if(mysqli_query($q,$sql)){
            echo '<script>alert("Your appointment has been booked and booking has been updated Thankyou:)");window.location.href="../index.html";</script>';
        
        }
    }
?>
