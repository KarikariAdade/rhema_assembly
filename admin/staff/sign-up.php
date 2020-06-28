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
    <link rel="shortcut icon" href="/img/pentecost.png">
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
                                        <h1 class="mb-2">Rhema Assembly</h1>
                                        <p>Welcome, please sign up below.</p>

                                        <p id="formError"></p>
                                        <form action="includes/admin_sign_up.php" method="post" class="mt-3 mt-sm-5" id="sign_up_form">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="control-label">First Name*</label>
                                                        <input type="text" class="form-control" name="first_name" placeholder="" id="first_name" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Last Name*</label>
                                                        <input type="text" class="form-control" name="last_name" placeholder="" id="last_name" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Email*</label>
                                                        <input type="text" class="form-control" name="email" placeholder="" id="email" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Password*</label>
                                                        <input type="password" class="form-control" name="password" placeholder="" id="password" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Confirm Password*</label>
                                                        <input type="password" class="form-control" name="confirm_password" placeholder="" id="confirm_password" />
                                                    </div>
                                                </div>
                                                
                                                  <div class="col-12 mt-3">
                                                    <button class="btn btn-primary text-uppercase" type="submit" name="sign_up_btn" id="sign_up_btn">
                                                    Sign up</button>
                                                </div>
                                                <div class="col-12  mt-3">
                                                    <p>Already have an account ?<a href="sign-in.php"> Sign In</a></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xxl-9 col-lg-7 sign_in_svg">
                                <div class="row align-items-center h-100">
                                    <div class="col-7 mx-auto ">
                                        <img class="img-fluid" src="../assets/dist/img/coming-soon-bg.svg" alt="">
                                    </div>
                                </div>
                            </div>
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
        $('#sign_up_form').submit(function (event){
            event.preventDefault();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            var email = $("#email").val();
            var sign_up_btn = $("#sign_up_btn").val();
            $("#formError").load('includes/admin_sign_up.php',{
                first_name: first_name,
                last_name: last_name,
                password: password,
                confirm_password: confirm_password,
                email: email,
                sign_up_btn: sign_up_btn
            });
        });
    });
    </script>
</body>


</html> 