<?php
include("header.php");


?>

<div class="page-wraper">
	<div id="loading-icon-bx"></div>
	<div class="account-form">
		<div class="account-head" style="background-image:url(../assets/images/background/bg2.jpg);">
			<a href="../index.php"><img src="../assets/images/logo-white-2.png" alt=""></a>
		</div>
		<div class="account-form-inner">
			<div class="account-container">
				<div class="heading-bx left">
					<h2 class="title-head">Login to your <span>Account</span></h2>
					<p>Don't have an account? <a href="register.php">Create one here</a></p>
				</div>	
				<form class="contact-bx" action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Email</label>
									<input name="email" type="text" required="" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Your Password</label>
									<input name="password" type="password" class="form-control" required="">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group form-forget">
								<!-- <div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
									<label class="custom-control-label" for="customControlAutosizing">Remember me</label>
								</div> -->
								<a href="./forget-password.php" class="ml-auto">Forgot Password?</a>
							</div>
						</div>
						<div class="col-lg-12 m-b30">
							<button name="login" type="submit" value="Submit" class="btn button-md">Login</button>
						</div>
						<!-- <div class="col-lg-12">
							<h6>Login with Social media</h6>
							<div class="d-flex">
								<a class="btn flex-fill m-r5 facebook" href="#"><i class="fa fa-facebook"></i>Facebook</a>
								<a class="btn flex-fill m-l5 google-plus" href="#"><i class="fa fa-google-plus"></i>Google Plus</a>
							</div>
						</div> -->
					</div>
				</form>
				<?php 
				if(isset($_POST['login'])){
					$email = strip_tags($_POST['email']);
					$password = strip_tags(md5($_POST['password']));
					
					$sql = "SELECT user_id,user_name,user_email,role FROM users WHERE user_email = '{$email}' AND user_password ='{$password}'";
					$result = mysqli_query($conn,$sql) or die("Query Failed.");
					if(mysqli_num_rows($result) > 0){
				
						while($row =mysqli_fetch_assoc($result)){
							// session_start();
							$_SESSION["user_name"] = $row['user_name'];
							$_SESSION["user_email"] = $row['user_email'];
							$_SESSION["user_id"] = $row['user_id'];
							$_SESSION["role"] = $row['role'];
							header("Location:{$hostname}/index.php");
						}
					}else{
						echo '<div class="alert alert-danger">Username and Password are not match.</div>';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php
include("footer.php");
?>



