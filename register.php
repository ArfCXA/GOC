<!DOCTYPE html>
<html>
<head>
	<link href="jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen"/>
	<script src="js/jquery-1.9.1.min.js"></script>
	<link href="style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php include('dbconn.php'); ?>
</head>

<body>

				<script>
			jQuery(document).ready(function(){
			jQuery("#login_form").submit(function(e){
					e.preventDefault();
					var formData = jQuery(this).serialize();
					$.ajax({
						type: "POST",
						url: "login.php",
						data: formData,
						success: function(html){
						if(html=='true')
						{
						$.jGrowl("Welcome Back!", { header: 'Access Granted' });
						var delay = 2000;
							setTimeout(function(){ window.location = 'home.php'  }, delay);  
						}
						else
						{
						$.jGrowl("Please Check your username and Password", { header: 'Login Failed' });
						}
						}
						
					});
					return false;
				});
			});
			</script>  

  
<div class="loginpage">
<div id="login">
 <h3>Register here</h3>
<form method="POST" action="signup.php" id="signup">
	<input type="text" name="username" Placeholder="Username" required><br /><br />
	<input type="password" name="password" Placeholder="Password" required><br /><br />
	<input type="text" name="firstname" Placeholder="First Name" required><br /><br />
	<input type="text" name="lastname" Placeholder="Last Name" required><br /><br><br />
	<button name="save" type="submit">Sign Up</button>
</form>
<div id="signupbtn">
Already have an account? <a href="index.php">Sign In</a></div>
<br>
</div>
</div>
</center>
<?php include('scripts.php');?>

</body>
</html>
 
 
 
 
 
 
 
 
 