<?php
$symptom=$_POST['symptom'];
$suggestionsString=$_POST['suggestions'];
$email=$_POST['email'];
$name="";
// Split the string into an array using underscores
$suggestionsArray = explode('_', $suggestionsString);

// Initialize arrays to store disease, medicine, and precaution
$diseaseArray = [];
$medicineArray = [];
$precautionArray = [];

// Iterate through suggestionsArray and extract disease, medicine, and precaution
foreach ($suggestionsArray as $suggestion) {
    // Split each suggestion into disease, medicine, and precaution
    list($disease, $medicineAndPrecaution) = explode('-', $suggestion, 2);
    list($medicine, $precaution) = explode('*', $medicineAndPrecaution, 2);

    // Add to respective arrays
    $diseaseArray[] = trim($disease);
    $medicineArray[] = trim($medicine);
    $precautionArray[] = trim($precaution);
}
$diseaseString = implode('*', $diseaseArray);
$medicineString = implode('*', $medicineArray);
$precautionString = implode('*', $precautionArray);

$q=mysqli_connect("localhost","root","","sirona");
if(!$q){
    echo "Not connected Please Check Your Internet Connection Or Contact The Administrator at-casatela93@gmail.com:)";
}
$us= "SELECT * FROM `user`";
$r=mysqli_query($q,$us);
while($row1=mysqli_fetch_array($r)){
    if($row1["email"]==$email)
    {
        $name=$row1["username"];
        break;
    }
    else{
        $name="New User";
    }
}
$qu = "SELECT * FROM `predict`";
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
    $sql = "INSERT INTO `predict`(`symptom`,`disease`,`medicine`,`precaution`,`email`) VALUES ('$symptom','$diseaseString','$medicineString','$precautionString','$email');";
    if(mysqli_query($q,$sql)){
        echo '<script>alert("Printing Prescription :)");</script>';
    
    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($q);
    }
    
    
}
else if($p==1){
    $sql = "UPDATE `predict` SET `symptom`='$symptom', `disease`='$diseaseString', `medicine`='$medicineString',`precaution`='$precautionString' WHERE `email` = '$email'";
    if(mysqli_query($q,$sql)){
        echo '<script>alert("Updated Presription :)");</script>';
    
    }
}
?>
<!-- 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Prescription:
    <h1>Your Name</h1>
    <p></p>
    <h1>Your Email</h1>
    <p</p>
    <h1>Your Symptoms are</h1>
    <p></p>
    <h2>Your Diseases </h2>
    <p></p>
    <h2>Your Medicine </h2>
    <p></p>
    <h2>Your Precaution </h2>
    <p></p>
    <button onclick="print()">Print</button>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Prescription Template</title>
  
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css'><link rel="stylesheet" href="./style.css">

</head>

<style>
    body {
  transition: all 0.3s ease;
  overflow-x:hidden;
}

.wrapper {
  height: 100vh;
  width: 100vw;
  display: flex;
  flex-direction: column;
  background: white;
  margin: 50px;
  /* margin-left: 25%; */

}
.prescription_form {
  width: 50%;
  height: 100vh;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
  margin-left: 25%;
  padding:1%;
  margin-bottom:-10%;


  background: white;
}
.prescription {
  width: 720px;
  height: 960px;
  margin: 0 auto;
  border: 1px solid lightgrey;
}
.prescription tr > td {
  padding: 15px;

}
.header {
  color: #333;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.logo {
  flex: 1;
}
.logo img {
  width: 120px;
  height: 120px;
  float: left;
}
.credentials {
  flex: 1;
}
.credentials h4 {
  line-height: 1em;
  letter-spacing: 1px;
  font-weight: 700;
  margin: 0px;
  padding: 0px;
}
.credentials p {
  margin: 0 0 5px 0;
  padding: 3px 0px;
}
.credentials small {
  margin: 0;
  padding: 0;
  letter-spacing: 1px;
  padding-right: 80px;
}
.d-header {
  width: 100%;
  text-align: center;
  background: rgb(41, 145, 163);
  padding: 5px;
  color: white;
  font-weight: 800;
}

.symptoms,
.tests,
.advice {
  display: flex;
  flex-direction: column;
  flex: 1;
  height:60%;
}

.symptoms ul,
.tests ul {
  list-style: square;
  margin: 0;
  padding-left: 10px;
  height: 100%;
}
.advice p {
  letter-spacing: 0;
  font-size: 14px;
}
.advice .adv_text {
  flex-grow: 1;
  width: 100%;
  height: 100%;
}

.desease_details {
  height: 80%;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}
.med_name {
  font-size: 16px;
  font-weight: bold;
  padding: 0;
}
.taking_time {
  display: flex;
  flex-direction: row;
  justify-content: flex-end;
  text-align: right;
}
.schedual {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}
.sc_time {
  margin: 0;
  padding: 0;
  float: left;
}
.sc_time span {
  font-weight: bold;
  margin-right: 1rem;
}
.sc {
  border: none;
  outline: none;
  font-size: 15px;
}

select {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  appearance: none;
  outline: 0;
  box-shadow: none;
  border: 0 !important;
  background: #fff;
  background-image: none;
}
select::-ms-expand {
  display: none;
}
.select {
  font-size: 15px;
  color: #335;
  position: relative;
  float: left;
  overflow: hidden;
}
select {
  font-weight: bold;
  padding: 0 0.5em;
  color: #333;
  cursor: pointer;
  outline: none;
}
.med_name {
  border: 0;
  outline: 0;
}
.period {
  font-size: 14px;
}
input[type="date"] {
  padding: 0;
  margin: 0;
  font-weight: bold;
  border: none;
}
.medicine {
  display: flex;
  flex-flow: column;
  height: 100%;
}
.med_name_action,
.med_when_action,
.med_period_action {
  display: none;
}
.med_meal_action .btn {
  margin: 2px;
}
.med_period {
  border: none;
  outline: none;
}
#add_med {
  margin: 20px 5px;
  flex-grow: 1;
}
#add_med {
  animation: shake 1.5s linear infinite;
}

@keyframes shake {
  10%, 90% {
    transform: translate3d(-1px, 0, 0);
  }
  
  20%, 80% {
    transform: translate3d(2px, 0, 0);
  }

  30%, 50%, 70% {
    transform: translate3d(-4px, 0, 0);
  }

  40%, 60% {
    transform: translate3d(4px, 0, 0);
  }
  95% {
    opacity: 0;
  }
}

#add_symptoms {
  margin: 20px 5px;
  flex-grow: 1;
  opacity: 1;
}
.symp_action,
.test_action,
.adv_action {
  display: none;
}
.med_footer {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
hr {
  margin: 10px 0px;
}
.med:hover hr {
  border-top: 3px #111 solid;
}
.med_period_action {
  float: right;
}
span.date {
  color: #333399;
  float: right;
  clear: both;
}
.del_action {
  width: 100%;
  text-align: right;
}
.delete {
  width: 50px;
  opacity: 0;
  display: none;
}
.med:hover .delete {
  display: inline;
  opacity: 1;
}
.folded {
  visibility: hidden;
}
.button_group {
    position: fixed;
    right: 120px;
    bottom: 100px;
}
#snacking, #snacked {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snacking.show, #snacked.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

.print-button {
    background-color: rgb(41, 145, 163);
    color: white;
    box-shadow: 2px 2px 5px #888888;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
}


@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
@media print {
            
            .print-button{
              display: none;}
          
        }
</style>
<body>
<!-- partial:index.partial.html -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
    integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js"
    integrity="sha256-srhz/t0GOrmVGZryG24MVDyFDYZpvUH2+dnJ8FbpGi0=" crossorigin="anonymous"></script>
<div class="wrapper">
    <div class="prescription_form">
            <tbody>


                <tr height="15%">
                    <td colspan="2">
                        <div class="header">
                            <div class="logo">
                                <img
                                    src="../img/logo.png" />
                            </div>
                            <div class="credentials">
                                <h4>Patient Name</h4>
                                <p><?php echo $name; ?></p>
                                <small><?php echo $email; ?></small>
                                <br />
                                <small>Age: 22</small>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="40%">
                        <div class="desease_details">
                            <div class="symptoms">
                                <h4 class="d-header">Symptoms</h4>
                                <p><?php echo $symptom;?></p>
                            </div>

                            <div class="symptoms">
                                <h4 class="d-header">Precautions</h4>
                                <p><?php echo $precautionString;?></p>
                            </div>

                            
                            <div class="symptoms">
                                <h4 class="d-header">Medicines</h4>
                                <p><?php echo $medicineString;?></p>
                            </div>
                            
                            
                                
                            <div class="advice">
                                <h4 class="d-header">Disease Match</h4>
                                <p class="adv_text" style="outline: 0;" data-toggle="tooltip"
                                    data-placement="bottom" title="Click to edit." contenteditable="true">
                                    <?php echo $diseaseString;?>
                                </p>

                            </div>

                    </td>
                    
                </tr>
            </tbody>
        </table>
        <button onclick="print()" class="print-button">Print e-Prescription</button>


            
        
   
  
</div>

</body>
</html>


