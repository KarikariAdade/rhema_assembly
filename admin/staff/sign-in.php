<?php
session_start();
include 'includes/connect.php';
?>
<?php if (isset($_SESSION['id'])):?>
    <?php  echo "<script>window.location = 'index.php';</script>"; ?>
    <?php else:?>
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
                                                <h1 class="mb-2">Rhema Assembly</h1>
                                                <?php
                                                if (isset($_GET['account']) && isset($_GET['username'])) {
                                                    $success =  $_GET['account'];
                                                    $username = $_GET['username'];
                                                    if ($success == 'success' && $username == $username ) {
                                                        echo "<p>Thanks for signing up, ".$username.".<br /> Please sign in below.</p>";
                                                    }
                                                }else{
                                                    echo "<p>Welcome back, please sign in below.</p>";
                                                }
                                                ?>
                                                <p id="formError"></p>
                                                <form action="includes/admin_sign_in.php" method="POST" id="sign_in_form" class="mt-3 mt-sm-5">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Email*</label>
                                                                <input type="text" class="form-control" placeholder="" name="email" id="email" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Password*</label>
                                                                <input type="password" class="form-control" placeholder="" name="password" id="password" />
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-12">
                                                            <div class="d-block align-items-center">
                                                                <a href="forgot-password.php" class="ml-auto">Forgot Password ?</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <button class="btn btn-primary text-uppercase" type="submit" name="sign_in_btn" id="sign_in_btn">
                                                            Sign In</button>
                                                        </div>
                                                        <div class="col-12  mt-3">
                                                            <p>Don't have an account ?<a href="sign-up.php"> Sign Up</a></p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xxl-9 col-lg-7 sign_in_svg o-hidden order-1">
                                        <img class="img-fluid" src="../assets/dist/img/church_building.jpg" alt="">
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
                $('#sign_in_form').submit(function (event){
                    event.preventDefault();
                    var password = $('#password').val();
                    var email = $("#email").val();
                    var sign_in_btn = $("#sign_in_btn").val();
                    $("#formError").load('includes/admin_sign_in.php',{
                        password: password,
                        email: email,
                        sign_in_btn: sign_in_btn
                    });
                });
            });
        </script>
    </body>


    </html>
    <?php endif;?>