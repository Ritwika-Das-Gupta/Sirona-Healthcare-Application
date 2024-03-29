
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Innovations - The creativity of your new world</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel = "icon" href =  "../images/home2.png" type = "image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
html,body{
    background: #6665ee;
    font-family: 'Poppins', sans-serif;
}
::selection{
    color: #fff;
    background: #6665ee;
}
.container{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.container .form{
    background: #fff;
    padding: 30px 35px;
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.container .form form .form-control{
    height: 40px;
    font-size: 15px;
}
.container .form form .forget-pass{
    margin: -15px 0 15px 0;
}
.container .form form .forget-pass a{
   font-size: 15px;
}
.container .form form .button{
    background: #6665ee;
    color: #fff;
    font-size: 17px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.container .form form .button:hover{
    background: #5757d1;
}
.container .form form .link{
    padding: 5px 0;
}
.container .form form .link a{
    color: #6665ee;
}
.container .login-form form p{
    font-size: 14px;
}
.container .row .alert{
    font-size: 14px;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forget.php" method="POST" >
                    <img src="../img/logo.png" style="margin-bottom:20px;height: 60px; width: 60px;display: block;margin-left: auto;margin-right: auto;">
                    <h2 class="text-center" style="font-size:20px;">Set your new password</p>
                    
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter your email" required>
                        <input class="form-control" type="password" name="pass1" placeholder="Enter your new password" required>
                        <input style="margin-top:20px;" class="form-control" type="password" name="pass2" placeholder="Enter your new password again" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" >
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>