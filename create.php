<?php
 	require 'dbconfig/config.php';
 	$wrongm  = "";
 	$wronge = "";
 	$wrongp = "";
 	$wrongcp ="";
 	$wrongu="";
 	$password = "";
 	$contact = "";
 	$email = "";
 	$cpassword ="";
 	$username ="";
 	if(isset($_POST['submit_btn'])){

 		if($_POST['username']<4){
 			$wrongu="username is too small!";
 		}if($_POST['username']>15){
 			$wrongu="too big username!";
 		}if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['username'] )){
 			$wrongu = "symbols doesn't allow!";
 		}else if(!filter_var($_POST['e-mail'], FILTER_VALIDATE_EMAIL)){
 			$wronge= "wrong e-mail!";
 		}else if(strlen($_POST['mobile'])!=10){
 			$wrongm = "mobile number should be of 10 digits!";
 		}else if(!preg_match("/^[6-9]\d{9}$/", $_POST['mobile'])){
 			$wrongm = "invaid mobile number!";
 		}else if(strlen($_POST['password'])<8){
 			$wrongp= "password must be greater than 7 character!";
 		}else if(strlen($_POST['password'])>15){
 			$wrongp= "password is too big!";
 		}else if($_POST['password']!=$_POST['cpassword']){
 			$wrongcp = "password doesn't match!";
 		}else{
 			$contact = $_POST['mobile'];
 			$email= $_POST['e-mail'];
 			$password = $_POST['password'];
 			$cpassword = $_POST['cpassword'];
 			$username = $_POST['username'];
 		}
 	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Create Account</title>
<link rel="stylesheet" href="css code/style.css">
</head>
<body style="background-image:url(img/lpphoto.jpg);">
	<div id="main"> 
		<center><h1>Create Account</h1>
		</center>

		<form  method="post">
			<div class="inputvalues">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input name="username" type="text" placeholder="Username" required><br>	
			</div>
			<span style="color: red"><?php echo "$wrongu"; ?></span>
			
			<div class="inputvalues">
				<i class="fa fa-envelope" aria-hidden="true"></i>
				<input name="e-mail" type="text" placeholder="e-mail Id" required ><br>
			</div>
			<span style="color: red"><?php echo "$wronge"; ?></span>
			

			<div class="inputvalues">
				<i class="fa fa-phone-square" aria-hidden="true"></i>
				<input name="mobile" type="number" placeholder="Phone no." required><br>				
			</div>
			<span style="color: red"><?php echo "$wrongm"; ?></span>

			
			<div class="inputvalues">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input name="password" type="password" placeholder="password" required><br>
			</div>
			<span style="color: red"><?php echo "$wrongp"; ?></span>


			<div class="inputvalues">
				<i class="fa fa-check-square" aria-hidden="true"></i>
				<input name="cpassword" type="password" placeholder="confirm password" required><br>
			</div>
			<span style="color: red"><?php echo "$wrongcp"; ?></span>


			<input name="submit_btn" type="submit" id="signin_btn" value="Sign Up"><br>
			
			<a href="index.php"><input type="button" id="back_btn" value="back"><br></a>
		</form>
		<?php
			if(isset($_POST['submit_btn'])){
				//echo '<script type="text/javascript"> alert("Sign Up button clicked")</script>';
				while($contact!=""){
					
					if($password==$cpassword){
						$query = "select * from users WHERE username='$username'";
						$query_run = mysqli_query($con , $query);
						$query2 = "select * from users WHERE mail='$email'";
						$query2_run = mysqli_query($con , $query2);
						if(mysqli_num_rows($query_run)>0){
							//there is already a user with the same username.
							echo '<script type="text/javascript"> alert("user already exists.... try another username")</script>';
						}
						else if(mysqli_num_rows($query2_run)>0){
							echo '<script type="text/javascript"> alert("e-mail ID already exists.... try another e-mail ID")</script>';
						}
						else{
							$query = "insert into users values('$username' , '$email' , '$contact', '$password')";
							$query_run = mysqli_query($con , $query);

							if($query_run){
								echo '<script type="text/javascript"> alert("User account is created...Go to login page to login")</script>';

							}else{
								echo '<script type="text/javascript"> alert("Error!")</script>';
							}
						}
					}else{
							echo '<script type="text/javascript"> alert("password does not match!")</script>';
					}
					break;
				}
			}
		?>
	</div>
</body>
</html>