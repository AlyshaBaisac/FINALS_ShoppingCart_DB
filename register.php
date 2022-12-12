<?php 
	require('function.php');

	$err = array('First_name' =>'', 'Last_name' =>'', 'email' =>'', 'Address'=>'', 'password' =>'');

	$firstname = $lastname = $sex = $email = $Address = '';

	if (isset($_POST['Register_acc'])) {
		$con = openConnection();

		$firstname = sanitizeInput($con, $_POST['First_name']);
		$lastname = sanitizeInput($con, $_POST['Last_name']);
		$sex = sanitizeInput($con, $_POST['radSex']);
		$email = sanitizeInput($con, $_POST['txtEmail']);
		$Address = sanitizeInput($con, $_POST['Address']);

		if (empty($firstname))
			$err['First_name'] = "First Name is required";

		if (empty($lastname))
			$err['Last_name'] = "Last Name is required"; 

		if (empty($email)){
			$err['email'] = "Email is required"; 
		} else {

		  $email_query = "SELECT * FROM tbl_customer WHERE emailAddress = '$email'";
	      $email_query_run = mysqli_query($con, $email_query);

	      if(mysqli_num_rows($email_query_run) > 0){
	       $err['email'] = 'email is existing';
	      }
		}

		if (empty($Address))
			$err['Address'] = "Address is required"; 

		if ($_POST['NewPass'] != $_POST['RptPass']) 
			$err['password'] = "Password not match/required";

		$password = md5($_POST['NewPass']);

			if(!array_filter($err)){
					$strSql = "INSERT INTO tbl_customer(First_name, Last_name, sex, emailAddress, address, password) 
					VALUES ('$firstname', '$lastname', $Address ,'$sex', '$email', '$password') 

					";

					if (mysqli_query($con, $strSql)) {
						echo "success";
						header("location: index.php");
					}
                    else {
                        echo ' 
                                <div class="alert alert-danger alert-dismissible fade show col-4 offset-4 mt-5" role="alert">
                                    <strong>Invalid User Name/Password.</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            '; 
                    }
	
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
	<div class="container">
		<br>  <p class="text-center">Registration Form</a></p>
		<hr>
		<div class="card bg-light">
			<article class="card-body mx-auto" style="max-width: 400px;">
				<h4 class="card-title mt-3 text-center">Create Account</h4>
			<form method="post">
				<div class="form-group input-group">
					<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
					 </div>
			        <input name="First_name" class="form-control" placeholder="First Name" type="text" value="<?php echo $firstname; ?>">
			    </div> <!-- form-group// -->
			    <label class="text-danger"><?php echo $err['First_name'];?></label>

				<div class="form-group input-group">
					<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
					 </div>
			        <input name="Last_name" class="form-control" placeholder="Last Name" type="text" value="<?php echo $lastname; ?>">
			    </div> <!-- form-group// -->
			    <label class="text-danger"><?php echo $err['Last_name'];?></label>

				<div class="form-group input-group">
					<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fas fa-venus-mars"></i> </span>
					</div>
				 	<label class="form-control">Gender:
				      <div class="form-check" >

				      	<?php if ($sex =='' OR $sex == 'Male') { ?>
				        <input type="radio" name="radSex" id="flexRadioDefault1" value="Male" checked="">
				        <label class="form-check-label" for="flexRadioDefault1">
				          Male
				        </label>
				        <input type="radio" name="radSex" id="flexRadioDefault1" value="Female">
				        <label class="form-check-label" for="flexRadioDefault1">
				          Female
				        </label>
				        <?php } else {?>
				        <input type="radio" name="radSex" id="flexRadioDefault1" value="Male" >
				        <label class="form-check-label" for="flexRadioDefault1">
				          Male
				        </label>
				        <input type="radio" name="radSex" id="flexRadioDefault1" value="Female" checked="">
				        <label class="form-check-label" for="flexRadioDefault1">
				          Female
				        </label>
				    <?php } ?>
				  </label>      
			      </div>
			    </div> 
			     <!-- form-group// -->

			    <div class="form-group input-group">
			    	<div class="input-group-prepend">
					    <span class="input-group-text"><i class="fas fa-home"></i></span>
					 </div>
			        <input name="Address" class="form-control" placeholder="Address" type="text" value="<?php echo $Address; ?>">	        
			    </div>
			    <label class="text-danger"><?php echo $err['Address'];?></label>

			    <div class="form-group input-group">
			    	<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
					 </div>
			        <input name="txtEmail" class="form-control" placeholder="Email address" type="email" value="<?php echo $email; ?>">
			    </div> 
			    <label class="text-danger"><?php echo $err['email'];?></label>

			    <div class="form-group input-group">
			    	<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
					</div>
			        <input name="NewPass" class="form-control" placeholder="Create password" type="password">
			    </div> 

			    <div class="form-group input-group">
			    	<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
					</div>
			        <input name="RptPass" class="form-control" placeholder="Repeat password" type="password">
			    </div> 
			    <label class="text-danger"><?php echo $err['password'];?></label>

			    <div class="form-group">
			        <button type="submit" name="Register_acc" class="btn btn-primary btn-block"> Create Account  </button>
			    </div> 

			    <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>                                                                 
			</form>
			</article>
		</div> 
	</div> 	
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>	