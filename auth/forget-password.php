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
					<h2 class="title-head">Forget <span>Password</span></h2>
					<p>Login Your Account <a href="login.php">Click here</a></p>
				</div>	
				<form class="contact-bx">
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Your Email Address</label>
									<input id="email" name="dzName" type="email" required="" class="form-control">
								</div>
							</div>
						</div>
						<span class="col-lg-12 m-b30" id="massage">
                        </span>
						<div class="col-lg-12 m-b30">
							<li id="f-otp" onclick="next()" name="submit" type="submit" value="Submit" class="btn button-md">Send OTP</li>
						</div>
						<div id="hide" class="d-none">
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group"> 
										<label>OTP</label>
										<input id="code" name="otp" type="password" class="form-control" >
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Create New Password</label>
										<input id="password" name="dzName" type="text" required="" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Conform Password</label>
										<input id="cpassword" name="password" type="password" required="" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12 m-b30">
								<li id="change" name="change" type="submit" value="Submit" class="btn button-md">Change Passord</li>
							</div>
							<span class="col-lg-12 m-b30" id="response">
							</span>
						</div>
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
           
        $("#f-otp").click(function(){
            var email = $("#email").val();
            var otp = <?= json_encode($genOtp, JSON_UNESCAPED_UNICODE); ?>;
            
            $.ajax({
                url : "forget-otp.php",
                type : "POST",
                data : {email:email,otp:otp},
                success : function(data){
                    $("#massage").html(data);
                }
              
            });
        });
        $("#change").click(function(){
            var email = $("#email").val();
            var name = $("#name").val();
            var password = $("#password").val();
            var cpassword = $("#cpassword").val();
            var otp = $("#code").val();
            var genOtp = <?= json_encode($genOtp, JSON_UNESCAPED_UNICODE); ?>;
            
            $.ajax({
                url : "change-password.php",
                type : "POST",
                data : {email:email,otp:otp,password:password,cpassword:cpassword,genOtp:genOtp},
                success : function(data){
                    if(data=="success"){
                        window.location.href = 'http://localhost/sviit/auth/login.php';
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