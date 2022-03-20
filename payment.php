<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="The Church of Pentecost, Rhema Assembly-Agona Ashanti. Come worship with us and be Blessed">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/all.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="icon" href="img/pentecost.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
  <title>The Church of Pentecost | Donate</title>
</head>
<body>
   <!-- NAVIGATION BAR BEGINS -->
  <?php include 'includes/navbar.php'; ?>
  <!-- NAVIGATION BAR ENDS -->
  <div class="">
    <form method="POST" class="payment_form">
      <div class="container-fluid give_amount">
        <label>GH&cent</label><br>
      <input type="number" name="" placeholder="0.00" min="0" step="0.1" id="amount_number" value="0.00">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-3">
        </div>
        <div class="card col-md-6 give_form_card">
          <div class="form_section_1">
            <p id="gift_help">
              <span id="gift_help"><a href='contact'>Need Help?</a></span>
            </p>
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                </div>
                <input class="form-control" placeholder="Full Name" type="text" name="give_full_name" id="give_full_name">
            </div>
          </div>
          <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input class="form-control" placeholder="Email" type="email" name="give_email" id="give_email">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group credential_form">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-donate"></i></span>
                </div>
              <select class="form-control" name="give_type" id="give_type">
                <option selected>Select Giving Type</option>
                <option>Donation</option>
                <option>Tithe</option>
                <option>Offering</option>
                <option>Welfare</option>
              </select>
            </div>
          </div>
          <div class="payment_buttons">
            <button type="button" class="btn proceed_btn" align="left">Proceed</button>
          </div>
        </div>
        <div class="form_section_2">
          <div class="section_2_intro">
            <h5>Verify your mobile Number</h5>
            <p>Enter your mobile number to receive your code <br><br><a href=""><small><span class="fa fa-exclamation-triangle fa-sm"></span> How does it work?</small></a></p>
          </div>
          <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="width: 100%;">+233</span>
                </div>
                <input class="form-control" placeholder="XXXXXXXXXX" type="tel" name="phone_number" id="phone_number">
            </div>
          </div>
          <div class="row">
             <div class="col-md-6">
          <button type="submit" style="width:80%;" class="btn payment_form_submit_btn">Send Code</button>
        </div>
          <div class="col-md-6">
           <button type="button" class="btn previous_btn">Go Back</button>
         </div>
        </div>
      </div>
        </div>
        <div class="col-md-3">
        </div>
      </div>
    </div>

    </form>
  </div>
  <!-- FOOTER BEGINS -->
<?php include 'includes/footer.php' ?>
<!-- FOOTER ENDS -->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"></script>
</body>
</html>
