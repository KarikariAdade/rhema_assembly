<!DOCTYPE html>
<html>
<head>
	<title>Rhema Assembly | Membership Form</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="The Church of Pentecost, Rhema Assembly-Agona Ashanti. Come worship with us and be Blessed">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="img/pentecost.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<style type="text/css">

</style>
</head>
<body>
	<?php include 'includes/navbar.php'; ?>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card msform_card px-0 pt-4 pb-0 mt-3 mb-3">
					<h2 id="heading" align="center">Become a Member of Rhema Assembly</h2>
					<p align="center">Fill all form fields <strong><i>correctly</i></strong> to go to next step</p>
					<form id="msform" method="POST" enctype="multipart/form-data">
						<!-- progressbar -->
						<ul id="progressbar">
							<li class="active" id="account"><strong>Personal</strong></li>
							<li id="personal"><strong>Church</strong></li>
							<li id="payment"><strong>Others</strong></li>
							<li id="image"><strong>Image Upload</strong></li>
							<li id="confirm"><strong>Finish</strong></li>
						</ul>
						<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
						</div> <br> <!-- fieldsets -->
						<fieldset>

							<div class="form-card">
								<div class="row">
									<div class="col-7">
										<h2 class="fs-title">Personal Information:</h2>
									</div>
									<div class="col-5">
										<h2 class="steps">Step 1 - 5</h2>
									</div>
								</div> 
								<div class="row">
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">First Name: *</label>
										<input type="email" name="first_name" id="first_name" placeholder="First Name" />

									</div>
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Last Name: *</label>
										<input type="text" name="last_name" id="last_name" placeholder="Last Name" />
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Gender: *</label><br>
										<select class="form-control member-select" name="gender" id="gender">
											<option></option>
											<option>Male</option>
											<option>Female</option>
										</select>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Birthdate: *</label> 
										<input type="date" name="birthdate" id="birthdate" placeholder="Birthdate" /> 
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Email Address *</label> 
										<input type="email" name="email" id="email" placeholder="Email Address" /> 
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">House Address : *</label> 
										<input type="text" name="address" id="address" placeholder="Digital Address Preferred" /> 
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Phone: *</label> 
										<input type="tel" name="phone" id="phone" placeholder="Phone" /> 
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Marital Status: *</label> 
										<select class="member-select form-group" name="marital_status" id="marital_status">
											<option></option>
											<option>In a Relationship</option>
											<option>Single</option>
											<option>Married</option>
											<option>Divorced</option>
											<option>Complicated</option>
											<option>Widowed</option>
										</select>
									</div>
								</div>
							</div>
							<input type="button" name="next" class="next1 action-button" value="Next" />
						</fieldset>
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-7">
										<h2 class="fs-title">Church Information:</h2>
									</div>
									<div class="col-5">
										<h2 class="steps">Step 2 - 5</h2>
									</div>
								</div> 
								<div class="row">
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Date of Membership: *</label> 
										<input type="date" name="duration" id="duration" placeholder="Date of Membership" /> 
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Member of what Ministry? *</label> 
										<select class="member-select form-group" name="ministry" id="ministry">
											<option></option>
											<option>None</option>
											<option>Evangelism Ministry</option>
											<option>Men Ministry</option>
											<option>Women Ministry</option>
											<option>Children Ministry</option>
											<option>Youth Ministry</option>
										</select>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Have you been Baptised? *</label> 
										<select class="member-select form-group" name="baptism" id="baptism">
											<option></option>
											<option>Yes</option>
											<option>No</option>
										</select>
									</div>
								</div>
							</div>
							<input type="button" name="next" class="next2 action-button" value="Next" /> 
							<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
						</fieldset>
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-7">
										<h2 class="fs-title">Other Credentials:</h2>
									</div>
									<div class="col-5">
										<h2 class="steps">Step 3 - 5</h2>
									</div>
								</div> 
								<div class="row">
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Select Career Field: *</label> 
										<select class="member-select form-group" name="career_field" id="career_field">
											<option selected></option>
											<option>Accounting & Finance</option>
											<option>Admin & Office</option>
											<option>Art & Design</option>
											<option>Science & Engineering</option>
											<option>Management</option>
											<option>Education</option>
											<option>Restaurant & Hospitaliry</option>
											<option>Computer & Data</option>
											<option>Legal</option>
											<option>Manufactoring</option>
											<option>Healthcare</option>
											<option>Community & Social Services</option>
											<option>Retail & Sales</option>
											<option>Sports & Entertainment</option>
											<option>Transportation</option>
											<option>Media & Communication</option>
											<option>Protective Services</option>
											<option>Contruction & Mining</option>
											<option>Personal Care</option>
											<option>Farming & Forestry</option>
											<option>Cleaning & Facilities</option>
											<option>Others</option>
										</select>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6">
										<label class="fieldlabels">Occupation: *</label> 
										<input type="text" name="occupation" id="occupation" placeholder="Occupation" /> 
									</div>
									<div class="col-sm-12 col-xs-12 col-md-12">
										<label class="fieldlabels">Description: *</label> 
										<textarea rows="8" placeholder="Any other information/feedback/contribution?" name="user_comment" id="user_comment"></textarea>
									</div>
								</div>
							</div> 
							<input type="button" name="next" class="next3 action-button" value="Next" /> 
							<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
						</fieldset>
						<fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Image Upload:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 5</h2>
                                </div>
                            </div>
                             <label class="fieldlabels">Upload Your Passport-sized Photo:</label> 
                             <input type="file" name="file" accept="image/*" id="pic"> <label class="fieldlabels">Upload 
                        </div> 
                        <input type="submit" id="next4" name="next4" class="next action-button" value="Submit" /> 
                        <input type="button" name="previous" id="last_previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-7">
										<h2 class="fs-title">Finish:</h2>
									</div>
									<div class="col-5">
										<h2 class="steps">Step 5 - 5</h2>
									</div>
								</div> <br><br>
								<h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
								<div class="row justify-content-center">
									<div class="col-3"> 
										<img src="img/success.png" class="fit-image">
									</div>
								</div> <br><br>
								<div class="row justify-content-center">
									<div class="col-7 text-center">
										<h5 class="purple-text text-center">Thank You for being part of Rhema Assembly</h5>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
					
				</div>
			</div>
		</div>
	</div>
	<?php include 'includes/footer.php'; ?>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
	<script type="text/javascript" src="js/swiper.min.js"></script>
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
	<script type="text/javascript" src="js/members-form.js"></script>
	<script type="text/javascript">
		//AJAX request for image upload
		$('#next4').click(function(e)
			{
			e.preventDefault();
			var form = $('#msform')[0];
			var data = new FormData(form);
			data.append("data", $('#email').val());
			$.ajax({
				url: 'includes/image-confirm.php',
				data: data,
				type: 'POST',
				contentType: false,
				async: false,
				processData: false,
				cache: false,
				success: function(data){
					swal("Information", ""+data, "info");
				}
			})	
		})
	</script>
</body>
</html>