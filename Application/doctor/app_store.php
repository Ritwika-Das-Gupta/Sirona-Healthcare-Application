<?php
// Database connection details
$fname = $_POST['fname']  ;
    $lname = $_POST['lname']  ;
    $age = $_POST['age']  ;
    $gender = $_POST['gender']  ;
    $height = $_POST['height']  ;
    $weight = $_POST['weight']  ;
    $bloodgroup = $_POST['bloodgroup']  ;
    $contact = $_POST['contact']  ;
    $email = $_POST['email']  ;
    $address = $_POST['address']  ;
    $city = $_POST['city']  ;
    $pinCode = $_POST['pin-code']  ;
    
    $diagnosis = $_POST['diagnosis']  ;
    $medicalHistory = $_POST['medical-history']  ;
    $medications = $_POST['medications']  ;
    $allergies = $_POST['allergies']  ;
    $mediclaim = $_POST['mediclaim']  ;
$spec = $_POST['specialist'];
$id= array();
$name = array();
$fees = array();
$time1 = array();
$time2 = array();
$time3 = array();
// Create connection
$q=mysqli_connect("localhost","root","","sirona");

$qu = "SELECT * from `doctor`";
$re = mysqli_query($q,$qu);
$p=0;
$k1=0;
$empdoc= "SELECT COUNT(*) FROM `doctor`";
$doc_count= mysqli_query($q,$empdoc);
$k1 = mysqli_fetch_array($doc_count);
if($k1[0]==0)
{
    echo '<script>alert("No Dotors Available :)");window.history.go(-1);</script>';
}
else{
    $found=0;
while($row = mysqli_fetch_array($re)){
    if($row["spec"] == $spec)
    {
        // Append data to separate arrays
        $id[] = $row["doc_id"];
        $name[] = $row["name"];
        $fees[] = $row["fees"];
        $time1[] = $row["time1"];
        $time2[] = $row["time2"];
        $time3[] = $row["time3"];
        $found=1;
    }

}
if ($found==0){
    echo '<script>alert("No Dotors Available :)");window.history.go(-1);</script>';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Form Table</title>

    <style>
        body {
            background: linear-gradient(rgba(20, 51, 97, 0.85), rgba(20, 51, 97, 0.85)), url(img/doc-appointment.jpg) center center no-repeat;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            font-size: 15 px;
            font-weight: bold;
            margin: 0;
            padding: 0;
        }

         /* Add this to your existing CSS styles */
         @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .container {
            max-width: 650px;
            margin: 50px auto;
            background-color:rgba(6, 163, 218, .7);
            padding: 30px;
            color: rgb(34, 34, 70);
            animation: slideInLeft 1s ease-in-out;
        }

        #doctorForm {
            color: white;
            margin-top: 0px;
            padding: 40px;
            display: flex;
            flex-direction: column;
        }


        table {
            border: 2px double white; /* Set the border to white and make it double */
            width: 100%;
            margin-bottom: 20px; /* Adjust margin as needed */
        }

        table th, table td {
            padding: 10px; /* Adjust padding as needed */
            text-align: center;
        }

        .form-row {
            display: flex;
            justify-content:first baseline;
            width: auto;
            vertical-align: middle;
        }

        .form-row label,
        .form-row input,
        .form-row select {
            width: 50%; /* Adjust the width as needed */
        }


        label {
            display: block;
            margin-right: 0px;
            margin-left: 10px;
        }

        input,textarea,select{
            background-color: #e1f7ff;
            color:#6B6A75;
            border-color: white;
            border-style: double;
            box-shadow: ;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-right: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            background-color:  #e1f7ff;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #e1f7ff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color:  #e1f7ff;
        }

        button {
            padding: 10px;
            margin-top: 30px;
            background-color: #193c71;
            color: white;
            font-weight: bold;
            font-size: larger;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgba(6, 163, 218, .7);
            color: black;
        }

        .no-decoration {
            text-decoration: none;
            color: inherit; /* Optionally, this will make the link inherit the color from its parent */
        }

        .error {
            color: #ff0000;
            margin-bottom: 16px;
        }
        
        h1 {
            text-align: center;
        }

        h2 {
            text-align: center;
            font-style: normal;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 8px;
        }

    </style>

</head>

<body>

<div class="container">
    <form id="doctorForm" action="app_complete.php" method="post">
    <h1><?php echo $spec;?></h1>
        <table border="1">
            <tr>
                <th>Doctor ID</th>
                <th>Name</th>
                <th>Fees</th>
                <th>Time 1</th>
                <th>Time 2</th>
                <th>Time 3</th>
                <th>Select</th>
            </tr>

            <?php
            // Assume you have the data arrays ($doctorIdArray, $nameArray, $feesArray, $time1Array, $time2Array, $time3Array) available

            // Iterate through the arrays to generate table rows
            for ($i = 0; $i < count($id); $i++) {
                echo "<tr>
                        <td>{$id[$i]}</td>
                        <td>{$name[$i]}</td>
                        <td>{$fees[$i]}</td>
                        <td>{$time1[$i]}</td>
                        <td>{$time2[$i]}</td>
                        <td>{$time3[$i]}</td>
                        <td><input type='radio' name='selected_row' value='{$i}' onchange='updateFields($i)' required></td>
                    </tr>";
            }
            ?>
        </table>

        <br>
        <input type="hidden" name="fname" value="<?= $fname ?>">
        <input type="hidden" name="lname" value="<?= $lname ?>">
        <input type="hidden" name="age" value="<?= $age ?>">
        <input type="hidden" name="gender" value="<?= $gender ?>">
        <input type="hidden" name="height" value="<?= $height ?>">
        <input type="hidden" name="weight" value="<?= $weight ?>">
        <input type="hidden" name="bloodgroup" value="<?= $bloodgroup ?>">
        <input type="hidden" name="contact" value="<?= $contact ?>">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="address" value="<?= $address ?>">
        <input type="hidden" name="city" value="<?= $city ?>">
        <input type="hidden" name="pin-code" value="<?= $pinCode ?>">
        
        <input type="hidden" name="diagnosis" value="<?= $diagnosis ?>">
        <input type="hidden" name="medical-history" value="<?= $medicalHistory ?>">
        <input type="hidden" name="medications" value="<?= $medications ?>">
        <input type="hidden" name="allergies" value="<?= $allergies ?>">
        <input type="hidden" name="mediclaim" value="<?= $mediclaim ?>">
        <input type="hidden" name="specialist" value="<?= $spec ?>">

        <!-- Hidden input fields to store the selected row data -->
        <input type="hidden" id="selectedId" name="selectedId">
        <input type="hidden" id="selectedName" name="selectedName">
        <input type="hidden" id="selectedFees" name="selectedFees">
        <input type="hidden" id="selectedTime1" name="selectedTime1">
        <input type="hidden" id="selectedTime2" name="selectedTime2">
        <input type="hidden" id="selectedTime3" name="selectedTime3">
        <input type="date" id="date" name="date" required onchange="validateDate()">
        <input type="submit" value="Submit">
    </form>

</div>




<script>
    function updateFields(index) {
        console.log('Selected Index:', index);
        // Update the hidden input fields with the values from the selected row
        document.getElementById('selectedId').value = <?php echo json_encode($id); ?>[index];
        document.getElementById('selectedName').value = <?php echo json_encode($name); ?>[index];
        document.getElementById('selectedFees').value = <?php echo json_encode($fees); ?>[index];
        document.getElementById('selectedTime1').value = <?php echo json_encode($time1); ?>[index];
        document.getElementById('selectedTime2').value = <?php echo json_encode($time2); ?>[index];
        document.getElementById('selectedTime3').value = <?php echo json_encode($time3); ?>[index];
    }
    function validateDate() {
        // Get the current date in the format "YYYY-MM-DD"
        var currentDate = new Date().toISOString().split('T')[0];

        // Get the selected date from the input field
        var selectedDate = document.getElementById('date').value;

        // Compare the selected date with the current date
        if (selectedDate < currentDate) {
            alert('Please select a valid date.');
            // You can reset the date field or take other actions as needed
            document.getElementById('date').value = currentDate;
        }
    }
</script>

</body>
</html>