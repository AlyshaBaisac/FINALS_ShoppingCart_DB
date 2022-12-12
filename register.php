<?php
		require('function.php');

		$err = array('email' =>'', 'password' =>'');

		$firstname = $email = '';

		if (isset($_POST['CrtAccount'])) {
			$con = openConnection();

			$firstname = sanitizeInput($con, $_POST['Fname']);
			$email = sanitizeInput($con, $_POST['txtEmail']);


			if (empty($email)){
				$err['email'] = "Email is required"; 
			} else {
				//$err['email'] = "Email is typed";

				//$email = $_POST['txtEmail'];
			$email_query = "SELECT * FROM tbl_customer WHERE emailAddress = '$email'";
			$email_query_run = mysqli_query($con, $email_query);

			if(mysqli_num_rows($email_query_run) > 0){
			$err['email'] = 'email is existing';
			}
			}
			if ($_POST['CrtPassword'] != $_POST['RptPassword']) 
			$err['password'] = "Password not match/required";
	
		$password = md5($_POST['CrtPassword']);
	
			if(!array_filter($err)){
					$strSql = "INSERT INTO tbl_customer(firstName, emailAddress, password) 
					VALUES ('$firstname', '$email', '$password') 
	
					";
	
					if (mysqli_query($con, $strSql)) {
						echo "success";
						header("location: login.php");
					}
					else
						echo "errorL: ";
	
				}
	
			}
	  ?>
<!DOCTYPE html>
<html>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/register.css">
	<title>Login Form</title>
</head>
<body>
<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" name="Fname" placeholder="First Name" class="form-control form-control-lg" value="<?php echo $firstname; ?>" required/>
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="email" id="form3Example3cg" name="txtEmail" class="form-control form-control-lg" placeholder="Email Address" value="<?php echo $email; ?>" required/>
                  <label class="form-label" for="form3Example3cg"><?php echo $err['email'];?>Your Email</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cg" name="CrtPassword" class="form-control form-control-lg" placeholder="Password" required />
                  <label class="form-label" for="form3Example4cg">Password</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cdg" name="RptPassword" class="form-control form-control-lg" placeholder="Password" required/>
                  <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                </div>

                <div class="d-flex justify-content-center">
				<label class="text-danger"><?php echo $err['password'];?></label>
					<button type="submit" name="CrtAccount" class="btn btn-primary btn-user btn-block text-white">
						Register Account</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>	