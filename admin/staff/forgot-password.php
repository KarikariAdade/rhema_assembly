<!DOCTYPE html>
<html lang="en">


<head>
    <title>Rhema Assembly Admin Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="../img/pentecost.png">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <!-- custom style -->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
</head>

<body class="bg-white">
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
           

            <!--start login contant-->
            <div class="app-contant">
                <div class="bg-white">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">
                            <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                                <div class="d-flex align-items-center h-100-vh">
                                    <div class="login p-50">
                                        <h1 class="mb-2">Forgot Password?</h1>
                                        <p>Please fill the forms below to start the Password Recovery Process.</p>
                                        <p id="formError"></p>
                                        <form action="includes/forgot-password.php" method="POST" id="forgot-password-form" class="mt-3 mt-sm-5">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Account Last Name *</label>
                                                        <input type="text" class="form-control" placeholder="" name="account_last_name" id="account_last_name" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Account Email *</label>
                                                        <input type="email" class="form-control" placeholder="" name="account_email" id="account_email" />
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button class="btn btn-primary text-uppercase" type="submit" name="proceed_reset_btn" id="proceed_reset_btn">
                                                    Proceed Reset</button>
                                                </div>
                                                <div class="col-12  mt-3">
                                                    <p>Remembered your Password?<a href="sign-in.php"> Sign In</a></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xxl-9 col-lg-7 sign_in_svg o-hidden order-1">
                                        <!-- <div class="row align-items-center h-10"> -->
                                            <!-- <div class="col-12"> -->
                                                <img class="img-fluid" src="../assets/dist/img/church_building.jpg" alt="">
                                            <!-- </div> -->
                                        <!-- </div> -->
                                    </div>
                            <!-- <div class="col-sm-6 col-xxl-9 col-lg-7 sign_in_svg o-hidden order-1 order-sm-2">
                                <div class="row align-items-center h-100">
                                    <div class="col-7 mx-auto ">
                                        <img class="img-fluid" src="../assets/dist/img/login.svg" alt="">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!--end login contant-->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->


<script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function (){
		$('#forgot-password-form').submit(function (e){
			var proceed_reset_btn = $('#proceed_reset_btn').val();
		var account_last_name = $('#account_last_name').val();
		var account_email = $('#account_email').val();
			e.preventDefault();
			$.ajax({
				url: 'includes/forgot-password.php',
				method: 'POST',
				data:{
					proceed_reset_btn: proceed_reset_btn,
					account_last_name: account_last_name,
					account_email: account_email
				},
				success:function(data){
					$('#formError').html(data);
				}
			})
		})
	})
</script>
</body>


</html>