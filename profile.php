<?php
include("header.php");
include("head-bar.php");
ob_start();
include("config.php");
$uid = $_SESSION["user_id"];

?>
    <!-- Content -->
	  <!-- The Modal -->
	  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Profile Photo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
		<form  action="save-profile.php" method="POST" enctype="multipart/form-data">
			<div class="modal-body row">
				<div class="col-12">
					<label for="formFileSm" class="form-label">Upload Only jpg,jpeg,png imgage or less than 2mb.</label>
					<input class="form-control form-control-sm" id="formFileSm" type="file" name="fileToUpload"  required>
					
				</div>
				<div class="col-12 mt-4">
				<input type="submit" name="submit" class="btn btn-danger" value="Post" required />
				</div>
			</div>

		</form>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
    <div class="page-content bg-white pt-10">
        <!-- inner page banner -->
        <div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner1.jpg);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Profile</h1>
				 </div>
            </div>
        </div>
		<!-- Breadcrumb row -->
		<div class="breadcrumb-row">
			<div class="container">
				<ul class="list-inline">
					<li><a href="index.php">Home</a></li>
					<li>Profile</li>
				</ul>
			</div>
		</div>
		<!-- Breadcrumb row END -->
        <!-- inner page banner END -->
		<div class="content-block">
            <!-- About Us -->
			<?php
			// code for save profile details
			if (isset($_POST['save-profile'])) {
				$name = strip_tags($_POST['name']);
				$dob = strip_tags($_POST['dob']);
				$gender = strip_tags($_POST['gender']);
				$phone = strip_tags($_POST['phone']);
				$address = strip_tags($_POST['address']);
				$city = strip_tags($_POST['city']);
				$state = strip_tags($_POST['state']);
				$pincode = strip_tags($_POST['pincode']);
				$linkedin = strip_tags($_POST['linkedin']);
				$facebook = strip_tags($_POST['facebook']);
				$twitter = strip_tags($_POST['twitter']);
				$instagram = strip_tags($_POST['instagram']);

				$sql1 = "UPDATE users SET user_name='{$name}',user_dob='{$dob}',user_gender='{$gender}',user_phone='{$phone}',
				user_address='{$address}',user_city='{$city}',user_state='{$state}',user_pincode='{$pincode}',linkedin='{$linkedin}',
				facebook='{$facebook}',twitter='{$twitter}',instagram='{$instagram}' WHERE user_id = $uid";
				if (mysqli_query($conn, $sql1)) {
					echo '<script> alert("Profile changed succesful."); </script>';
					header("Location:{$hostname}/profile.php");
				}else{
					echo '<script> alert("Something went wrong.."); </script>';
				}
			}

			// code for update password

			if (isset($_POST['change-password'])) {
				$password = strip_tags($_POST['cpassword']);
				$newpassword = strip_tags($_POST['newpassword']);
				$renewpassword = strip_tags($_POST['renewpassword']);

				if (empty($password) || empty($newpassword) || empty($renewpassword)) {
					echo '<script> alert("Please enter all fields."); </script>';
				}else{ 
					if ($newpassword == $renewpassword) {
						$mdpass = md5($_POST['cpassword']);
						$mdnewpass = md5($_POST['newpassword']);
						
						$sql2 = "UPDATE users SET user_password='{$mdnewpass}' WHERE user_id = '{$uid}' AND user_password= '{$mdpass}'";
						if (mysqli_query($conn, $sql2)) {
							echo '<script> alert("Password changed succesful."); </script>';
							// header("Location:{$hostname}/profile.php");
						} else {
							echo '<script> alert("Password not matched. "'.$mdpass.'); </script>';
						}
						
					}else{
						echo '<script> alert("Re write password not matched."); </script>';
					}
			
				}
				
				
			}

			//code for load profile data from data base...

			$sql = "SELECT * FROM users WHERE user_id = {$uid}";
			$result = mysqli_query($conn,$sql) or die ("Query Failed.");
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					?>
			<div class="section-area section-sp1">
                <div class="container">
					 <div class="row">
						<div class="col-lg-3 col-md-4 col-sm-12 m-b30">
							<div class="profile-bx text-center">
								<div class="user-profile-thumb">
									<img src="./upload/<?php echo $row["user_profile"]; ?>" alt=""/>
								</div>
									<div style="margin-top: -33px;margin-left: 50px;margin-bottom:8px;" >
										<button style="border:none;border-radius: 50%;background: #ddd;" data-toggle="modal" data-target="#myModal"><i class="fa qfa-duotone fa-camera"><input class="d-none" type="file" /> </i></button>
									</div>
								<div class="profile-info">
									<h4><?php echo ucwords($row["user_name"]); ?></h4>
									<span><?php echo ucwords($row["user_email"]); ?></span>
								</div>
								<div class="profile-social">
									<ul class="list-inline m-a0">
										<li><a href="<?php echo $row["facebook"]; ?>" target="_blank"><i class="fa fa-facebook "></i></a></li>
										<li><a href="<?php echo $row["twitter"]; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
										<li><a href="<?php echo $row["linkedin"]; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
										<li><a href="<?php echo $row["instagram"]; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
										<li><a href="<?php echo $row["twitter"]; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
									</ul>
								</div>
								<div class="profile-tabnav">
									<ul class="nav nav-tabs">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#courses"><i class="ti-book"></i>Courses</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#quiz-results"><i class="ti-bookmark-alt"></i>Quiz Results </a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#edit-profile"><i class="ti-pencil-alt"></i>Edit Profile</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#change-password"><i class="ti-lock"></i>Change Password</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-9 col-md-8 col-sm-12 m-b30">
							<div class="profile-content-bx">
								<div class="tab-content">
									<?php 
										
									?>
									<div class="tab-pane active" id="courses">
										<div class="profile-head">
											<h3>My Courses</h3>
											<div class="feature-filters style1 ml-auto">
												<ul class="filters" data-toggle="buttons">
													<li data-filter="" class="btn active">
														<input type="radio">
														<a href="#"><span>All</span></a> 
													</li>
													<!-- <li data-filter="publish" class="btn">
														<input type="radio">
														<a href="#"><span>Publish</span></a> 
													</li>
													<li data-filter="pending" class="btn">
														<input type="radio">
														<a href="#"><span>Pending</span></a> 
													</li> -->
												</ul>
											</div>
										</div>
										
									
										<div class="courses-filter">
											<div class="clearfix">
												<ul id="masonry" class="ttr-gallery-listing magnific-image row list-inline">
												<?php
												$fetchCourse = "SELECT * FROM user_course WHERE user_id = {$row["user_id"]}";
												$resultCourse = mysqli_query($conn, $fetchCourse) or die("Query Failed.");
												if (mysqli_num_rows($resultCourse) > 0) {
													while ($rowCourse = mysqli_fetch_assoc($resultCourse)) {


														$sqlcl = "SELECT * FROM courses WHERE c_id = {$rowCourse["c_id"]}";
														$resultcl = mysqli_query($conn, $sqlcl) or die("Query Failed.");
														if (mysqli_num_rows($resultcl) > 0) {
															while ($rowcl = mysqli_fetch_assoc($resultcl)) {
																?>
													<li class="action-card col-xl-4 col-lg-6 col-md-12 col-sm-6 publish text-decoration-none">
														<div class="cours-bx">
															<div class="action-box">
																<img src="./course/<?php echo $rowcl["c_photo"]; ?>" alt="">
																<a href="#" class="btn">Read More</a>
															</div>
															<div class="info-bx text-center">
																<h5><a href="#"><?php echo $rowcl["c_name"]; ?></a></h5>
																<span>
																	<?php 
																$rowCourse = "SELECT * FROM course_type JOIN type ON course_type.type_id = type.type_id WHERE c_id = {$rowcl['c_id']}";
																$resultC = mysqli_query($conn, $rowCourse) or die("Query Failed.");
																if (mysqli_num_rows($resultC) > 0) {
																		$flag = true;
																	while ($rowc = mysqli_fetch_assoc($resultC)) {
																		if($flag == true){
																			echo $rowc["type_name"];
																				$flag = false;
																		}else{
																			echo ", ",$rowc["type_name"];
																		}

																	}
																}
																
																?>
																</span>
																<hr>
																<h6>Duration:- <span><?php echo $rowcl["duration"]; ?> Months</span></h6>
															</div>
															<div class="cours-more-info">
																<div class="review">
																	<span>3 Review</span>
																	<ul class="cours-star">
																		<li class="active"><i class="fa fa-star"></i></li>
																		<li class="active"><i class="fa fa-star"></i></li>
																		<li class="active"><i class="fa fa-star"></i></li>
																		<li><i class="fa fa-star"></i></li>
																		<li><i class="fa fa-star"></i></li>
																	</ul>
																</div>
																<div class="price">
																	<del><?php echo $rowcl["price"]; ?></del>
																	<h5><?php echo $rowcl["price"]; ?></h5>
																</div>
															</div>
														</div>
													</li>
													<?php
															}
														}
													}
												}else{
													echo "<h4>You have not opted any courses yet.</h4>";
												}
										?>
												</ul>
											</div>
										</div>
										
									</div>
									<div class="tab-pane" id="quiz-results">
										<div class="profile-head">
											<h3>Quiz Results</h3>
										</div>
										<div class="courses-filter">
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<ul class="course-features">
														<li><i class="ti-book"></i> <span class="label">Lectures</span> <span class="value">8</span></li>
														<li><i class="ti-help-alt"></i> <span class="label">Quizzes</span> <span class="value">1</span></li>
														<li><i class="ti-time"></i> <span class="label">Duration</span> <span class="value">60 hours</span></li>
														<li><i class="ti-stats-up"></i> <span class="label">Skill level</span> <span class="value">Beginner</span></li>
														<li><i class="ti-smallcap"></i> <span class="label">Language</span> <span class="value">English</span></li>
														<li><i class="ti-user"></i> <span class="label">Students</span> <span class="value">32</span></li>
														<li><i class="ti-check-box"></i> <span class="label">Assessments</span> <span class="value">Yes</span></li>
													</ul>
												</div>
												<div class="col-md-6 col-lg-6">
													<ul class="course-features">
														<li><i class="ti-book"></i> <span class="label">Lectures</span> <span class="value">8</span></li>
														<li><i class="ti-help-alt"></i> <span class="label">Quizzes</span> <span class="value">1</span></li>
														<li><i class="ti-time"></i> <span class="label">Duration</span> <span class="value">60 hours</span></li>
														<li><i class="ti-stats-up"></i> <span class="label">Skill level</span> <span class="value">Beginner</span></li>
														<li><i class="ti-smallcap"></i> <span class="label">Language</span> <span class="value">English</span></li>
														<li><i class="ti-user"></i> <span class="label">Students</span> <span class="value">32</span></li>
														<li><i class="ti-check-box"></i> <span class="label">Assessments</span> <span class="value">Yes</span></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="edit-profile">
										<div class="profile-head">
											<h3>Edit Profile</h3>
										</div>
										<form class="edit-profile" action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
											<div class="">
												<div class="form-group row">
													<div class="col-12 col-sm-9 col-md-9 col-lg-10 ml-auto">
														<h3>1. Personal Details</h3>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Full Name</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input name="name" class="form-control" type="text" value="<?php echo ucwords($row["user_name"]); ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Date Of Birth</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input class="form-control" name="dob" type="date" value="<?php echo $row["user_dob"]; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Gender</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input class="" name="gender"id="male" value="0"  type="radio" <?php if ($row["user_gender"] != null) {
															if ($row['user_gender'] == 0) {
																echo "checked";
															}
															?> >
														<label class="col-form-label" for="male">Male</label>
														<input class="" name="gender"id="female" value="1"  type="radio" <?php if ($row['user_gender'] == 1) {
															echo "checked";
														} ?> >
														<label class="col-form-label" for="female">Female</label>
														<input class="" name="gender"id="other" value="2"  type="radio" <?php if ($row['user_gender'] == 2) {
															echo "checked";
														}
														} ?> >
														<label class="col-form-label" for="other">Other</label>
														<!-- <span class="help">If you want your invoices addressed to a company. Leave blank to use your full name.</span> -->
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Phone No.</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input name="phone" class="form-control" type="text" value="<?php echo $row["user_phone"]; ?>" maxlength="10">
													</div>
												</div>
												
												<div class="seperator"></div>
												
												<div class="form-group row">
													<div class="col-12 col-sm-9 col-md-9 col-lg-10 ml-auto">
														<h3>2. Address</h3>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Address</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input name="address" class="form-control" type="text" value="<?php echo $row["user_address"]; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">City</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input name="city" class="form-control" type="text" value="<?php echo $row["user_city"]; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">State</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input name="state" class="form-control" type="text" value="<?php echo $row["user_state"]; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Postcode</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input name="pincode" class="form-control" type="text" value="<?php echo $row["user_pincode"]; ?>" maxlength="6">
													</div>
												</div>

												<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>

												<div class="form-group row">
													<div class="col-12 col-sm-9 col-md-9 col-lg-10 ml-auto">
														<h3 class="m-form__section">3. Social Links</h3>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Linkedin</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input name="linkedin" class="form-control" type="text" value="<?php echo $row["linkedin"]; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Facebook</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input name="facebook" class="form-control" type="text" value="<?php echo $row["facebook"]; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Twitter</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input name="twitter" class="form-control" type="text" value="<?php echo $row["twitter"]; ?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Instagram</label>
													<div class="col-12 col-sm-9 col-md-9 col-lg-7">
														<input name="instagram" class="form-control" type="text" value="<?php echo $row["instagram"]; ?>">
													</div>
												</div>
											</div>
											<div class="">
												<div class="">
													<div class="row">
														<div class="col-12 col-sm-3 col-md-3 col-lg-2">
														</div>
														<div class="col-12 col-sm-9 col-md-9 col-lg-7">
															<button type="submit" name="save-profile" class="btn">Save changes</button>
															<button type="reset" class="btn-secondry">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="tab-pane" id="change-password">
										<div class="profile-head">
											<h3>Change Password</h3>
										</div>
										<form class="edit-profile" action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
											<div class="">
												<div class="form-group row">
													<div class="col-12 col-sm-8 col-md-8 col-lg-9 ml-auto">
														<h3>Password</h3>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-4 col-md-4 col-lg-3 col-form-label">Current Password</label>
													<div class="col-12 col-sm-8 col-md-8 col-lg-7">
														<input class="form-control" type="password" name="cpassword">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-4 col-md-4 col-lg-3 col-form-label">New Password</label>
													<div class="col-12 col-sm-8 col-md-8 col-lg-7">
														<input class="form-control" type="password" name="newpassword">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-12 col-sm-4 col-md-4 col-lg-3 col-form-label">Re Type New Password</label>
													<div class="col-12 col-sm-8 col-md-8 col-lg-7">
														<input class="form-control" type="password" name="renewpassword">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-12 col-sm-4 col-md-4 col-lg-3">
												</div>
												<div class="col-12 col-sm-8 col-md-8 col-lg-7">
													<button type="submit" name="change-password"  class="btn">Save changes</button>
													<button type="reset" class="btn-secondry">Cancel</button>
												</div>
											</div>
												
										</form>
									</div>
								</div> 
							</div>
						</div>
					</div>
				</div>
            </div>
			<?php
				}
			}else{
				echo "<div class='alert alert-danger'>Something went wrong. </div>".$uid;
			}

			?>
        </div>
		<!-- contact area END -->
    </div>
    <!-- Content END-->
<?php 
include("footer.php");

?>
