<?php
include("header.php");

$genOtp = rand(1000, 9999);

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
					<h2 class="title-head">Sign Up <span>Now</span></h2>
					<p>Login Your Account <a href="login.php">Click here</a></p>
				</div>	
				<form class="contact-bx">
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
                            <!-- <div class="d-none"> -->
									<!-- <label>Your Name</label>
									<input id="hidden" name="name" type="text" required="" class="form-control">
								</div> -->
								<div class="input-group">
									<label>Your Name</label>
									<input id="name" name="name" type="text" required="" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Email Address</label>
									<input id="email" name="email" type="email" required="" class="form-control">
								</div>
							</div>
						</div>
                        <div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Your Password</label>
									<input id="password" name="password" type="password" class="form-control" required="">
								</div>
							</div>
						</div>
                        <span class="col-lg-12 m-b30" id="massage">
                        </span>
                        <div class="col-lg-12 m-b30">
							<li onclick="next()" id="otp" class="btn button-md">Send OTP</li>
						</div>
                        <div id="hide" class="d-none">
                        <div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>OTP</label>
									<input id="code" name="otp" type="password" size="4" class="form-control" >
								</div>
							</div>
                        </div>
						<div class="col-lg-12 m-b30">
							<li id="signup" name="signup" type="submit" value="Submit" class="btn button-md">Sign Up</li>
						</div>

                        <span class="col-lg-12 m-b30" id="response">
                        </span>
						</div>
						<!-- <div class="col-lg-12">
							<h6>Sign Up with Social media</h6>
							<div class="d-flex">
								<a class="btn flex-fill m-r5 facebook" href="#"><i class="fa fa-facebook"></i>Facebook</a>
								<a class="btn flex-fill m-l5 google-plus" href="#"><i class="fa fa-google-plus"></i>Google Plus</a>
							</div>
						</div> -->
					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function next(){
		var element = document.getElementById("hide");
  		element.classList.remove("d-none");
	}
	</script>
<script type="text/javascript" src="./js/jquery.js"></script>
<script> 
    $(document).ready(function(){
           
        $("#otp").click(function(){
            var email = $("#email").val();
            var name = $("#name").val();
            var otp = <?= json_encode($genOtp, JSON_UNESCAPED_UNICODE); ?>;
            
            $.ajax({
                url : "otp.php",
                type : "POST",
                data : {name:name,email:email,otp:otp},
                success : function(data){
                    $("#massage").html(data);
                }
              
            });
        });
        $("#signup").click(function(){
            var email = $("#email").val();
            var name = $("#name").val();
            var password = $("#password").val();
            var otp = $("#code").val();
            var genOtp = <?= json_encode($genOtp, JSON_UNESCAPED_UNICODE); ?>;
            
            $.ajax({
                url : "conform-signup.php",
                type : "POST",
                data : {name:name,email:email,otp:otp,password:password,genOtp:genOtp},
                success : function(data){
                    if(data=="success"){
                        window.location.href = 'http://localhost/sviit/index.php';
                    }else{
                    $("#response").html(data);
                    }
                }
              
            });
        });
    });
</script>
<?php
include("footer.php");
?>