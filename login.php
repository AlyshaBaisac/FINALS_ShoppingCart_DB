<?php
     session_start();
     require("function.php");
     $con = openConnection();
     
     if (isset($_POST['loginbtn'])){

        $password = $_POST['password'];
        $email  =  $_POST['email'];
     
        $email = stripslashes();
        $password = stripcslashes();

        $email = mysqli_real_escape_string($con , $email);
        $password = mysqli_real_escape_string($con , $email);

        $strSql = "SELECT * FROM tbl_customer
                    WHERE email_Address = ' email'
                    AND password = ' $password'
                    ";

                if ($Logins = mysqli_query($con, $strSql)) {
                    if (mysqli_num_rows($Logins)>0) {
                        echo 'Welcome to the system';
                        foreach ($Logins as $key => $value) {
                            $_SESSION['customerID'] = $value['customerID'];
                            $_SESSION['customerName'] = $value['firstName'];
                            header('location: index.php');
                        }
                    }else
                        echo 'invalid Username/password';
                }
                else
                    echo "could not execute your request";
        }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Animated Dynamic Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
</head>
<!-- Coded With Love By Mutiullah Samim-->
<body>
    <dvi class="container h-100">
    <div class="d-flex justify-content-center">
        <div class="card mt-5 col-md-4 animated bounceInDown myForm">
            <div class="card-header">
                <h4>Welcome Dear Customer!</h4>
            </div>
            <div class="card-body">
                <form>
                    <div id="dynamic_container">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text br-15"><i class="fa fa-user-tag"></i></i></span>
                            </div>
                            <input type="text" placeholder="Username" class="form-control"/>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text br-15"><i class="fa fa-lock"></i></i></span>
                            </div>
                            <input type="text" placeholder="Password" class="form-control"/>
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text br-15"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="email" placeholder="Email Address" class="form-control"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a class="btn btn-secondary btn-sm" id="add_more"><i class="fas fa-plus-circle"></i> Create Account</a>
                <button type="submit" name="loginbtn" class="btn btn-success btn-sm float-right submit_btn"><i class="fas fa-arrow-alt-circle-right"></i> Login</button>
            </div>
        </div>
    </div>
    </dvi>
</body>
</html>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
</body>
</html>