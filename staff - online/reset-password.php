<?php
session_start();
include 'includes/connect.php';
if (!isset($_SESSION['account_last_name']) && !isset($_SESSION['account_reset_id']) && !isset($_SESSION['account_email'])) {
	echo "<script>window.location = 'forgot-password.php';</script>";
}else{
	$account_id = $_SESSION['account_reset_id'];
	$account_fetch_sql = "SELECT * FROM admin_profile WHERE id = '$account_id'";
	$account_fetch_query = mysqli_query($conn, $account_fetch_sql);
	if (mysqli_num_rows($account_fetch_query) > 0) {
		while ($row = mysqli_fetch_assoc($account_fetch_query)) {
			$user_account_id = $row['id'];
			$security_question = $row['security_question'];
			$security_answer = $row['security_answer'];
		}
	}
}

?>
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
     <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert.css">
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
                                        <h1 class="mb-2">Reset Password</h1>
                                        <p>Please answer the Security Question to reset your Password. <br /> Use the new password to login next time</p>
                                        <p id="formError"></p>
                                        <form action="includes/recover-account.php" method="POST" id="reset-account-form" class="mt-3 mt-sm-5">
                                            <div class="row">
                                            	<input type="hidden" name="user_account_id" id="user_account_id" value="<?php echo $user_account_id;?>">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                    	<label class="control-label">Security Question *</label>
                                                        <select class="form-control" name="security_question" id="security_question">
                                                        	<option selected><?php echo $security_question;?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Security Answer *</label>
                                                        <input type="text" class="form-control" name="security_answer" id="security_answer" placeholder="Answer to your Security Question" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">New Password *</label>
                                                        <input type="password" class="form-control" placeholder="" name="new_password" id="new_password" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Confirm New Password *</label>
                                                        <input type="password" class="form-control" placeholder="" name="confirm_new_password" id="confirm_new_password" />
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button class="btn btn-primary text-uppercase" type="submit" name="reset_password_btn" id="reset_password_btn">Reset Password</button>
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
                                                <img class="img-fluid" src="../assets/dist/img/church_building.jpg" alt="" style="height: 100%;position: sticky;">
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
 <script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function (){
		$('#reset-account-form').submit(function (e){
			e.preventDefault();
			var security_question = $('#security_question').val();
			var security_answer = $('#security_answer').val();
			var new_password = $('#new_password').val();
			var confirm_new_password = $('#confirm_new_password').val();
			var reset_password_btn = $('#reset_password_btn').val();
			var user_account_id = $('#user_account_id').val();
			$.ajax({
				url: 'includes/recover-account.php',
				method: 'POST',
				data: {
					user_account_id: user_account_id,
					security_question: security_question,
					security_answer: security_answer,
					new_password: new_password,
					confirm_new_password: confirm_new_password,
					reset_password_btn: reset_password_btn
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