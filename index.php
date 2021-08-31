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
	<div class="loginpage">
<div id="login">
	   <form id="login_form"  method="post">
		   <center>
		   <div id="logo">
	   <img src="logo.png" alt="logo">
</div></center>
        <input type="text"  id="username" name="username" placeholder="Username" required><br><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br><br>
        <button name="login" type="submit">Sign In</button>
		      </form>
			  <div id="signupbtn">
Don't have an account? <a href="register.php">Sign Up</a></div>
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
</div>
</div>
<?php include('scripts.php');?>

</body>
</html>