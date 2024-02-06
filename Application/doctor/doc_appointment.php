<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment</title>
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

        #appointment-form {
            color: white;
            margin-top: 0px;
            padding: 40px;
            display: flex;
            flex-direction: column;
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
    <form id="appointment-form" method='POST' action="app_store.php">
        <h1>Doctor Appointment</h1>
        <div>
            <h2>Patient (Personal Info)</h2>
            <div class="form-row">

                <input type="text" placeholder="First Name" pattern="[a-zA-Z\s]+" id="name" name="fname" required>
                <input type="text" placeholder="Last Name" pattern="[a-zA-Z\s]+" id="name" name="lname" required>

            </div>

            <div class="form-row">
                <input type="number" placeholder="Age" id="age" name="age" min="0" required>
                <select id="gender" name="gender" required>
                    <option value="" disabled selected hidden>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>
            </div>

            <div class="form-row">
                <input type="number" step="0.01" placeholder="Height (cm)" pattern="/^\d+(\.\d{1,2})?$/" id="height" name="height" required>
                <input type="number" step="0.01" placeholder="Weight (kg)" pattern="/^\d+(\.\d{1,2})?$/" id="weight" name="weight" required>
                <select id="bloodgroup" name="bloodgroup" required>
                    <option value="" disabled selected hidden>Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option>
                    <option value="O+">O+</option>
                    <option value="AB+">AB+</option>
                    <option value="A-">A-</option>
                    <option value="B-">B-</option>
                    <option value="O-">O-</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>

            <div class="form-row">

                <input type="text" placeholder="Contact" pattern="^\d{10}$" id="contact" name="contact" required>
                <input type="email" placeholder="Email" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" id="email" name="email" required>
            </div>

            <div class="form-row">
                
                <textarea placeholder="Address" id="address" name="address" rows="4" required></textarea>

            </div>

            <div class="form-row">
            
                <input type="text" placeholder="City/Town" pattern="[a-zA-Z\s]+" id="city" name="city" required>

                <input type="text" placeholder="PinCode" pattern="^\d{6}$" id="pin-code" name="pin-code" required>
            </div>
        
        </div>

        <div>
            <h2>Patient (Medical Info)</h2>

            <div class="form-row">
                <textarea placeholder="Diagnosis of Medical Condition" id="diagnosis" name="diagnosis" rows="4" required></textarea>
            </div>

            <div class="form-row">
                <textarea placeholder="Medical History" id="medical-history" name="medical-history" rows="4" required></textarea>
            </div>
    
            <div class="form-row">
                <textarea placeholder="Current Medications" id="medications" name="medications" rows="4" required></textarea>
            </div>

            <div class="form-row">
            
                <select id="allergies" name="allergies" required>
                    <option value="" disabled selected hidden>Allergies</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
        
                <select id="mediclaim" name="mediclaim" required>
                    <option value="" disabled selected hidden>Mediclaim</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
    
        </div>

        <div>
            <h2>Appointment Info</h2>

            <div class="form-row">
                <select id="specialist" name="specialist" required>
                    <option value="" disabled selected hidden>Specialization</option> 
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Dermatologist">Dermatologist</option>
                    <option value="Endocrinologist">Endocrinologist</option>
                    <option value="Gastroenterologist">Gastroenterologist</option>
                    <option value="Neurologist">Neurologist</option>
                    <option value="Orthopedic">Orthopedic</option>
                    <option value="Ophthalmologist">Ophthalmologist</option>
                    <option value="Pulmonologist">Pulmonologist</option>
                    <option value="Allergist/Immunologist">Allergist/Immunologist</option>
                    <option value="Hematologist">Hematologist</option>
                    <option value="Gynecologic Oncologist">Gynecologic Oncologist</option>
                    <option value="Pediatrician">Pediatrician</option>
                    <option value="Urologist">Urologist</option>
                    <option value="Others">Others</option>
                </select>
                
                <!-- <select id="doctor-name" name="doctor-name" required>
                    <option value="" disabled selected hidden>Doctor Name</option> 
                    
                </select>

                <input type="number" min="0" placeholder="Doctor-Fees" id="fees" min="0" name="fees" required> -->
            
            </div>


            <div class="form-row">
<!-- 
                <input type="text" placeholder="Appointment Date" id="appointment-date" name="appointment-date" onfocus="(this.type='date')">
        
                <input type="text" placeholder="Appointment Time" id="appointment-time" name="appointment-time" onfocus="(this.type='time')"> -->
            </div>

        </div>
        <div id="doctor-name"> </div>
        <button type="submit">Submit</button>
        <button type="button"><a href="../user_doctor.html" class="no-decoration">Back</a></button>
    </form>
</div>

<!-- <script>
    function validateForm() {
        
        var fname = document.getElementById('fname').value;
        var lname = document.getElementById('lname').value;
        var age = document.getElementById('age').value;
        var gender = document.getElementById('gender').value;
        var contact = document.getElementById('contact').value;
        var email = document.getElementById('email').value;
        var address = document.getElementById('address').value;
        var pinCode = document.getElementById('pin-code').value;
        var city = document.getElementById('city').value;
        var appointmentDate = document.getElementById('appointment-date').value;
        var appointmentTime = document.getElementById('appointment-time').value;
        var diagnosis = document.getElementById('diagnosis').value;
        var medicalHistory = document.getElementById('medical-history').value;
        var medications = document.getElementById('medications').value;
        var allergies = document.getElementById('allergies').value;
        var mediclaim = document.getElementById('mediclaim').value;
        var doctorName = document.getElementById('doctor-name').value;
        var specialist = document.getElementById('specialist').value;
        var height = parseFloat(document.getElementById('height').value).toFixed(2);
        var weight = parseFloat(document.getElementById('weight').value).toFixed(2);
        var bloodgroup = document.getElementById('bloodgroup').value;
  

        //var nameRegex = /^[a-zA-Z\s]+$/;
        //var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        //var contactRegex = /^\d{10}$/;
        //var pinCodeRegex = /^\d{6}$/;
        //var ageRegex = /^\d+$/;
        //var heightRegex = /^\d+(\.\d{1,2})?$/;  // Regex for positive float numbers (including up to 2 decimals)
        //var weightRegex = /^\d+(\.\d{1,2})?$/;  // Regex for positive float numbers (including up to 2 decimals)
        //var bloodgroupRegex = /^(A\+|B\+|O\+|AB\+|A-|B-|O-|AB-)$/;  // Regex for the specified blood groups
        //var appointmentDateRegex = /^\d{4}-\d{2}-\d{2}$/;

        // var isValid = true;

        // if (fname === "")|(lname === "") {
        //     alert('Please enter a valid name');
        //     return false;
        // }

        // if (age === "") {
        //     alert('Please enter a valid age');
        //     return false;
        // }

        // if (gender === "") {
        //     alert('Please select a gender');
        //     return false;
        // }

        // if (city === ""){
        //     alert('Please enter city/town');
        //     return false;
        // }

        // if (diagnosis === "") {
        //     alert('Please describe diagonisis of medical condition');
        //     return false;
        // }

        // if (medicalHistory === "") {
        //     alert('Please describe medical history');
        //     return false;
        // }

        // if (medications === "") {
        //     alert('Please describe current medications');
        //     return false;
        // }

        // if (!emailRegex.test(email)) {
        //     alert('Please enter a valid email address');
        //     return false;
        // }

        // if (!contactRegex.test(contact)) {
        //     alert('Please enter a valid contact number');
        //     return false;
        // }

        // if (!pinCodeRegex.test(pinCode)) {
        //     alert('Please enter a valid pin code');
        //     return false;;
        // }

        // if (!heightRegex.test(height)) {
        //     alert('Please enter a valid height (up to 2 decimal places)');
        //     return false;
        // }

        // if (!weightRegex.test(weight)) {
        //     alert('Please enter a valid weight (up to 2 decimal places)');
        //     return false;
        // }

        // if (!bloodgroupRegex.test(bloodgroup)) {
        //     alert('Please select a valid blood group');
        //     return false;
        // }

        // if ((allergies === "")|(mediclaim === "")) {
        //     alert('Please select an option');
        //     return false;
        // }

        // if (gender === "") {
        //     alert('Please select a gender');
        //     return false;
        // }

        // if (doctorName === "") {
        //     alert('Please select a doctor name');
        //     return false;
        // }

        // if (!appointmentDateRegex.test(appointmentDate)) {
        //     alert('Please enter a valid appointment date in YYYY-MM-DD format');
        //     return false;
        // }

        // Add more validations as needed for other fields

        return true;
    }

        
    
</script> -->

</body>
</html>
