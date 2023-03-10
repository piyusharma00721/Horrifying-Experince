<?php
	require 'dbconfig/config.php';
	$error ="";
	$username ="";
	$password ="";
	$email ="";
	
	if(isset($_POST["login"])){
		$username = $_POST['username'];
		$email= $_POST['username'];
		$password = $_POST['password'];
		$query = "select * from users WHERE username='$username' AND password='$password'";
		$query_run=mysqli_query($con , $query);
		$query2 = "select * from users WHERE mail='$email' AND password='$password'";
		$query2_run = mysqli_query($con , $query2);
		if(mysqli_num_rows($query_run)==0){
			$error = "wrong username or password";
		}
		else if(mysqli_num_rows($query2_run)==0){
			$error = "wrong username or password";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js" >
	</script>
<title>Login page</title>
<link rel="stylesheet" href="css code/style.css">
<style>

model-viewer{
		top:200px;
		width:600px;
		height:400px;
		margin: 0 auto;
		background-color: transparent;
	}
</style>
</head>
  
<body style="background-image:url(img/horror.jpg);  ">
	<div id="main-wrapper"> 
		<h1>Login</h1>
		<form  method="post">
		<div class="inputvalues">
			<i class="fa fa-user" aria-hidden="true"></i>
			<input name="username" type="text"  placeholder="Username/email-id" required><br>	
		</div>

		<div class="inputvalues">
			<i class="fa fa-lock" aria-hidden="true"></i>
			<input name="password" type="password"  placeholder="password" required><br>
		</div>
		<span style="color: red"><?php echo "$error"; ?></span>

		<input name="login" type="submit" id="signin_btn" value="Sign in"><br>
	
		<a href="create.php"><input type="button" id="create_btn" value="Create account"><br></a>
		</form>

		<div><a style="color: white" href="horror.html">skip>>></a></div>
		<?php
			if(isset($_POST["login"])){
				$query = "select * from users WHERE username='$username' AND password='$password'";
				$query_run=mysqli_query($con , $query);
				$query2 = "select * from users WHERE mail='$email' AND password='$password'";
				$query2_run = mysqli_query($con , $query2);
				if(mysqli_num_rows($query_run)>0){
					$_SESSION['username'] = $username;
					header('location:horror.html');
				}
				else if(mysqli_num_rows($query2_run)>0){
					$_SESSION['username'] = $username;
					header('location:horror.html');
				}
			}
		?>
	</div>
	<model-viewer src="img/scene.gltf" camera-controls auto-rotate auto-rotate-delay="500" rotation-per-second="40deg">
		</model-viewer>
</body>
</html>