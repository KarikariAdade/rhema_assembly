<?php
// include 'connect.php';
include 'time_function.php';
$id = $_SESSION['id'];
$sql = "SELECT * FROM admin_profile WHERE id='$id'";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $position = $row['position'];
    $admin_image = $row['admin_image'];
    $occupation = $row['occupation'];
    $address = $row['address'];
    $status = $row['status'];
    $security_question= $row['security_question'];
    $security_answer = $row['security_answer'];
    $description = $row['description'];
    $biography = $row['description'];
    $email = $row['email'];
    $phone = $row['phone'];
    if (strlen($biography) > 200){
        $biography = wordwrap($biography,200);
        $biography =explode("\n", $biography);
        $biography = $biography[0]."...";
      }
  }
}
?>
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>R</b>AY</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Rhema</b> Assembly</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <i class="fa fa-align-left"></i>
      </a>
<style type="text/css">
    .sidebar-toggle::before{
        display: none !important;
    }
</style>
<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
 function clicker(){
  $.ajax({
    url: 'includes/church_mailbox_notification.php',
    success:function(){
      $('#church_mailbox_label').hide(500);
    }
  });
 }
 function notification_view(){
  $.ajax({
    url: 'includes/notification_view.php',
    success:function (){
      $('#notification_view_label').hide(500);
    }
  });
 }
 function private_view(){
  var email = "<?php echo $email; ?>";
  $.ajax({
    url: 'includes/private-view.php',
    method: 'POST',
    data:{email:email},
    success:function (data){
      $('#private_view_label').hide(500);
    }
  });
 }
</script>

<?php

// FETCHING MAILBOX FOR NOTIFICATIONS


$church_mailbox_sql = "SELECT * FROM mailbox WHERE message_status='unread'";
$church_mailbox_query = mysqli_query($conn, $church_mailbox_sql);
$church_mailbox_count = mysqli_num_rows($church_mailbox_query);


$notification_sql = "SELECT * FROM notification WHERE status=0";
$notification_query = mysqli_query($conn, $notification_sql);
$notification_count = mysqli_num_rows($notification_query);

$private_sql = "SELECT * FROM messages WHERE receiver_email = '$email' AND status = 'unread'";
$private_query = mysqli_query($conn, $private_sql);
$private_count = mysqli_num_rows($private_query);

?>
<span id="church_mailbox_toggle" onclick="return church_mailbox()"></span>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu" onclick="return clicker()">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope"></i>
              <?php if($church_mailbox_count > 0):?>
              <span class="label label-success" id="church_mailbox_label"><?php echo $church_mailbox_count; ?></span>
            <?php endif;?>
            </a>
            <ul class="dropdown-menu">
              <?php if($church_mailbox_count > 0):?>
              <li class="header">You have <?php echo $church_mailbox_count; ?> new/unread messages</li>
            <?php endif;?>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <?php
                    $fetch_mailbox = "SELECT * FROM mailbox ORDER BY id DESC LIMIT 5";
                    $fetch_mailbox_query = mysqli_query($conn, $fetch_mailbox);
                    if (mysqli_num_rows($fetch_mailbox_query) > 0) {
                      while ($row = mysqli_fetch_assoc($fetch_mailbox_query)) {
                          $contact_id = $row['id'];
                        $contact_name = $row['contact_name'];
                        $contact_email = $row['contact_email'];
                        $contact_phone = $row['contact_phone'];
                        $date = $row['date'];
                        $contact_message = $row['contact_message'];
                        $reply_status = $row['reply_status'];
                        $contact_reply_name = $row['contact_reply_name'];
                     ?>
                    <a href="general-mail-detail.php?contact=<?php echo urlencode($contact_id); ?>&name=<?php echo urlencode($contact_name); ?>">
                      <h4>
                        <?php echo $contact_name; ?>
                        <small><i class="fa fa-clock"></i> <?php echo time_ago($date); ?> </small>
                      </h4>
                      <?php if (isset($contact_reply_name)):?>
                      <p><?php echo $contact_reply_name." replied to this message"; ?></p>
                    <?php endif;?>
                    </a>
                    <?php
                       }
                    }
                    ?>
                  </li>

                </ul>
              </li>
              <li class="footer"><a href="general-mailbox.php">See All General Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">

            <!--  NOTIFICATION VIEW WITH JAVASCIRPT AND PHP -->


            <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="notification_view()">
              <i class="fa fa-bell"></i>
              <?php if($notification_count > 0): ?>
              <span class="label label-warning" id="notification_view_label"><?php echo $notification_count; ?></span>
              <?php endif; ?>
            </a>
            <ul class="dropdown-menu">
              <?php if ($notification_count > 0):?>
              <li class="header">You have <?php echo $notification_count; ?> new notifications</li>
            
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <?php


                    // FETCH NOTIFICATIONS 

                    $member_notif = "SELECT * FROM notification WHERE category = 'Member Add' ORDER BY id LIMIT 10";
                    $member_query = mysqli_query($conn, $member_notif);
                    $member_notif_count = mysqli_num_rows($member_query);
                    if (mysqli_num_rows($member_query) > 0) {
                      while ($row = mysqli_fetch_assoc($member_query)) {
                        $member_id = $row['id'];
                        $member_notif_category = $row['category'];
                        $member_notif_message = $row['message'];
                        $member_notif_date = $row['date'];
                      }
                    }
                    $volunteer_notif = "SELECT * FROM notification WHERE category = 'Volunteer' ORDER BY id LIMIT 10";
                    $volunteer_query = mysqli_query($conn, $volunteer_notif);
                    $volunteer_notif_count = mysqli_num_rows($volunteer_query);
                    if (mysqli_num_rows($volunteer_query) > 0) {
                      while ($row = mysqli_fetch_assoc($volunteer_query)) {
                        $volunteer_id = $row['id'];
                        $volunteer_notif_category = $row['category'];
                        $volunteer_notif_message = $row['message'];
                        $volunteer_notif_date = $row['date'];
                      }
                    }
                    $activity_notif = "SELECT * FROM notification WHERE category = 'Monthly Activity' ORDER BY id LIMIT 10";
                    $activity_query = mysqli_query($conn, $activity_notif);
                    $activity_notif_count = mysqli_num_rows($activity_query);
                    if (mysqli_num_rows($activity_query) > 0) {
                      while ($row = mysqli_fetch_assoc($activity_query)) {
                        $activity_id = $row['id'];
                        $activity_notif_category = $row['category'];
                        $activity_notif_message = $row['message'];
                        $activity_notif_date = $row['date'];
                      }
                    }
                    $event_notif = "SELECT * FROM notification WHERE category = 'Event Add' ORDER BY id LIMIT 10";
                    $event_query = mysqli_query($conn, $event_notif);
                    $event_notif_count = mysqli_num_rows($event_query);
                    if (mysqli_num_rows($event_query) > 0) {
                      while ($row = mysqli_fetch_assoc($event_query)) {
                        $event_id = $row['id'];
                        $event_notif_category = $row['category'];
                        $event_notif_message = $row['message'];
                        $event_notif_date = $row['date'];
                      }
                    }
                    $staff_notif = "SELECT * FROM notification WHERE category = 'Staff Request' AND status = 0 ORDER BY id LIMIT 10";
                    $staff_query = mysqli_query($conn, $staff_notif);
                    $staff_notif_count = mysqli_num_rows($staff_query);
                    if (mysqli_num_rows($staff_query) > 0) {
                      while ($row = mysqli_fetch_assoc($staff_query)) {
                        $staff_id = $row['id'];
                        $staff_notif_category = $row['category'];
                        $staff_notif_message = $row['message'];
                        $staff_notif_date = $row['date'];
                      }
                    }
                    ?>
                    <?php if($member_notif_count > 0):?>
                    <a href="view-members.php" style="background-color: red;">
                      <i class="fa fa-users text-aqua"></i> <?php echo $member_notif_count; ?> new member(s) joined
                    </a>
                  <?php endif;?>
                  </li>
                  <?php if ($volunteer_notif_count > 0):?>
                  <li>
                    <a href="view-volunteers.php">
                      <i class="fa fa-users text-navy"></i> <?php echo $volunteer_notif_count; ?> person(s) has agreed to volunteer
                    </a>
                  </li>
                <?php endif;?>
                <?php if($activity_notif_count > 0):?>
                  <li>
                    <a href="monthly-activity.php">
                      <i class="fa fa-edit text-green"></i> <?php echo $activity_notif_count; ?> weekly schedule(s) made
                    </a>
                  </li>
                <?php endif;?>
                <?php if($event_notif_count > 0):?>
                  <li>
                    <a href="view-event.php">
                      <i class="fa fa-calendar-alt text-red"></i> <?php echo $event_notif_count; ?> event(s) has been added
                    </a>
                  </li>
                <?php endif;?>
                <?php if($staff_notif_count > 0 && $position == "Presiding Elder"):?>
                  <li>
                    <a href="staff-request.php">
                      <i class="fa fa-user-tie text-red"></i> <?php echo $staff_notif_count; ?> new staff request(s)
                    </a>
                  </li>
                <?php endif;?>
                </ul>
              </li>
              <li class="footer">
                <a href="all-notifications.php">View all</a></li>
              <?php else:?>
                <li class="footer" style="padding: 10px 2px; text-align: center;"><h5>There are no new notifications yet</h5></li>
                 <li class="footer"><a href='all-notifications.php'>View Previous Notifications</a></li>
                <?php endif;?>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="private_view();">
              <i class="fa fa-envelope-open"></i>
              <?php if($private_count > 0):?>
              <span class="label label-danger" id="private_view_label"><?php echo $private_count; ?></span>
            <?php endif;?>
            </a>
            <ul class="dropdown-menu">
              <?php if($private_count > 0):?>
              <li class="header" id="fuckme">You have <?php echo $private_count; ?> new/unread private messages</li>
            <?php endif;?>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php
                  $private_message_sql = "SELECT * FROM messages WHERE receiver_email='$email' AND status='unread' ORDER BY id LIMIT 6";
                  $private_message_query = mysqli_query($conn, $private_message_sql);
                  if (mysqli_num_rows($private_message_query) > 0) {
                    while ($row = mysqli_fetch_assoc($private_message_query)) {
                      $message_title = $row['message_title'];
                      $message_id = $row['id'];
                      $message_date = $row['date'];
                  ?>
                  <li><!-- Task item -->
                    <a href="mail-detail.php?message=<?php echo urlencode($message_id); ?>&slug=<?php echo urlencode($message_title); ?>">
                      <h3>
                        <?php echo $message_title; ?>
                        <small class="label label-primary pull-right" style="font-size: 10px;"><span class="fa fa-clock"></span> <?php echo time_ago($message_date); ?></small>
                      </h3>
                    </a>
                  </li>
                  <?php
                  }
                  }else{
                     $private_message_sql = "SELECT * FROM messages WHERE receiver_email='$email' ORDER BY id LIMIT 6";
                  $private_message_query = mysqli_query($conn, $private_message_sql);
                  if (mysqli_num_rows($private_message_query) > 0) {
                    while ($row = mysqli_fetch_assoc($private_message_query)) {
                      $message_title = $row['message_title'];
                      $message_id = $row['id'];
                      $message_date = $row['date'];
                      echo '
                       <li><!-- Task item -->
                    <a href="mail-detail.php?message='.urlencode($message_id).'&slug='.urlencode($message_title).'">
                      <h3>
                        '.$message_title.'
                        <small class="label label-primary pull-right" style="font-size: 10px;"><span class="fa fa-clock"></span>'.time_ago($message_date).'</small>
                      </h3>
                    </a>
                  </li>
                      ';
                  }
                }
              }
                  ?>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="mailbox.php">View all Private Messages</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php if (isset($admin_image)){echo $admin_image;} ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $first_name." ".$last_name; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php if (isset($admin_image)){echo $admin_image;} ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $first_name." ".$last_name; ?> - <?php if (isset($position)){ echo $position;} ?>
                  <small><?php if (isset($occupation)){ echo $occupation;} ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="view-profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="sign-out.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-cogs"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
    <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php if (isset($admin_image)){echo $admin_image;} ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info" style="position: absolute !important;top: 20% !important;">
          <p><?php echo $first_name." ".$last_name; ?></p>
          <a href="view-profile.php"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
          <li>
          <a href="index.php">
            <i class="fa fa-home"></i> <span> Dashboard</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">new</small> -->
            </span>
          </a>
        </li>
         <li>
          <a href="theme.php">
            <i class="fa fa-scroll"></i> <span>Church Theme</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">new</small> -->
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-tie"></i> <span>Staff</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($position == "Presiding Elder"):?>
            <li><a href="add-staff.php"><i class="fa fa-arrow-right fa-sm"></i> Add Staff</a></li>
          <?php endif;?>
            <li><a href="view-staff.php"><i class="fa fa-arrow-right fa-sm"></i> View Staff</a></li>
            <?php if($position == "Presiding Elder"):?>
             <li><a href="staff-request.php"><i class="fa fa-arrow-right fa-sm"></i> Staff Requests</a></li>
           <?php endif;?>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Staff & Ministries</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="staff-elders.php"><i class="fa fa-arrow-right fa-sm"></i> Elders</a></li>
              <li><a href="staff-deacons.php"><i class="fa fa-arrow-right fa-sm"></i> Deacons</a></li>
               <li><a href="staff-deaconesses.php"><i class="fa fa-arrow-right fa-sm"></i> Deaconesses</a></li>
            <li><a href="youth-ministry.php"><i class="fa fa-arrow-right fa-sm"></i> Youth Ministry</a></li>
            <li><a href="women-ministry.php"><i class="fa fa-arrow-right fa-sm"></i> Women's Ministry</a></li>
            <li><a href="rhema-choir.php"><i class="fa fa-arrow-right fa-sm"></i> Rhema Choir</a></li>
            <li><a href="evangelism-ministry.php"><i class="fa fa-arrow-right fa-sm"></i> Evangelism Ministry</a></li>
            <li><a href="children-ministry.php"><i class="fa fa-arrow-right fa-sm"></i> Children Ministry</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-friends"></i> <span>Members</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($position == "Presiding Elder" || $position == "Elder"):?>
            
            <li><a href="edit-member.php"><i class="fa fa-arrow-right fa-sm"></i> Edit Member</a></li>
          <?php endif;?>
            <li><a href="view-members.php"><i class="fa fa-arrow-right fa-sm"></i> View Members</a></li>
            <li><a href="baptised-members.php"><i class="fa fa-arrow-right fa-sm"></i> Baptised Members</a></li>
            <li><a href="non-baptised-members.php"><i class="fa fa-arrow-right fa-sm"></i> Non-Baptised Members</a></li>
            <li><a href="advanced-members-view.php"><i class="fa fa-arrow-right fa-sm"></i> Advanced Members View</a></li>
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-hands-helping"></i> <span>Volunteers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add-volunteer.php"><i class="fa fa-arrow-right fa-sm"></i> Add Volunteers</a></li>
            <li><a href="edit-volunteer.php"><i class="fa fa-arrow-right fa-sm"></i> Edit Volunteers</a></li>
            <li><a href="view-volunteers.php"><i class="fa fa-arrow-right fa-sm"></i> View  Volunteers</a></li>
            <li><a href="ministry-volunteers.php"><i class="fa fa-arrow-right fa-sm"></i> Ministry Volunteers</a></li>
            <li><a href="event-volunteers.php"><i class="fa fa-arrow-right fa-sm"></i> Event Volunteers</a></li>
          </ul>
        </li>
         <script type="text/javascript">
      var group_coordinator = $('#group_coordinator').val();
      var coordinator_id = $('#coordinator_id').val();
      var coordinator_email = $('#coordinator_email').val();
      var coordinator_phone = $('#coordinator_phone').val();
      var coordinator_address = $('#coordinator_address').val();
      $('#generate').click(function (e){
        e.preventDefault();
        $.post('includes/generate_user.php',{
          generate:generate,
          awaiting_id: awaiting_id
        },
        function (data,status){
          $('#random_password').html(data);
          $('#generated_password').attr("value",data);
        })
      })
  </script>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Study Groups</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($position == "Presiding Elder"):?>
            <li><a href="create-group.php"><i class="fa fa-arrow-right fa-sm"></i> Create Group</a></li>
            <li><a href="edit-group.php"><i class="fa fa-arrow-right fa-sm"></i> Edit Group</a></li>
          <?php endif;?>
            <li><a href="view-groups.php"><i class="fa fa-arrow-right fa-sm"></i> View Groups</a></li>
            <?php if($position == "Presiding Elder" || $position == "Elder"):?>
            <li><a href="assign-group-members.php"><i class="fa fa-arrow-right fa-sm"></i> Assign Group Members</a></li>
          <?php endif;?>
            <li><a href="group-coordinators.php"><i class="fa fa-arrow-right fa-sm"></i> View Group Coordinators</a></li>
            <li><a href="all-group-members.php"><i class="fa fa-arrow-right fa-sm"></i> View Group Members</a></li>
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-bible"></i> <span>Sermons</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($position == "Presiding Elder" || $position == "Elder"):?>
            <li><a href="add-sermon.php"><i class="fa fa-arrow-right fa-sm"></i> Add Sermon</a></li>
          <?php endif;?>
            <li><a href="view-sermons.php"><i class="fa fa-arrow-right fa-sm"></i> View Sermon</a></li>
            <?php if($position == "Presiding Elder" || $position == "Elder"):?>
            <li><a href="view-sermons.php"><i class="fa fa-arrow-right fa-sm"></i> Update Sermon</a></li>
          <?php endif;?>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="general-mailbox.php"><i class="fa fa-arrow-right fa-sm"></i> General Mailbox</a></li>
            <li>
          <a href="mailbox.php">
            <i class="fa fa-sm fa-arrow-right"></i> <span>Private Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
            </span>
          </a>
        </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-newspaper"></i> <span>News</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($position == "Secretary" || $position == "Presiding Elder"): ?>
            <li><a href="add-news.php"><i class="fa fa-arrow-right fa-sm"></i> Add News</a></li>
          <?php endif; ?>
            <li><a href="view-news.php"><i class="fa fa-arrow-right fa-sm"></i> View News</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar-alt"></i> <span>Events</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($position == "Secretary" || $position == "Presiding Elder"): ?>
            <li><a href="add-event.php"><i class="fa fa-arrow-right fa-sm"></i> Add Event</a></li>
          <?php endif;?>
            <li><a href="view-event.php"><i class="fa fa-arrow-right fa-sm"></i> View Events</a></li>
            <li><a href="calendar.php"><i class="fa fa-arrow-right fa-sm"></i> Event Calendar</a></li>
            <?php if($position == "Secretary" || $position == "Presiding Elder"): ?>
            <li><a href="edit-calendar.php"><i class="fa fa-arrow-right fa-sm"></i> Edit Calendar</a></li>
          <?php endif;?>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bullhorn"></i> <span>Announcements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($position == "Secretary" || $position == "Presiding Elder"): ?>
            <li><a href="add-announcement.php"><i class="fa fa-arrow-right fa-sm"></i> Make Announcement</a></li>
          <?php endif;?>
            <li><a href="view-announcements.php"><i class="fa fa-arrow-right fa-sm"></i> View Announcements</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-clipboard-list"></i> <span>Activity Schedule</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($position == "Secretary" || $position == "Presiding Elder" || $position == "Elder"): ?>
            <li><a href="add-monthly-activity.php"><i class="fa fa-arrow-right fa-sm"></i> Add Monthly Activity</a></li>
            <li><a href="edit-monthly-activity.php"><i class="fa fa-arrow-right fa-sm"></i> Edit Monthly Activity</a></li>
          <?php endif;?>
            <li><a href="monthly-activity.php"><i class="fa fa-arrow-right fa-sm"></i> View Monthly Activities</a></li>
            <li><a href="all-monthly-activities.php"><i class="fa fa-arrow-right fa-sm"></i> All Monthly Activities</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-images"></i> <span>Gallery</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <?php if($position == "Presiding Elder" || $position == "Elders"):?>
            <li><a href="add-pictures.php"><i class="fa fa-arrow-right fa-sm"></i> Add Pictures</a></li>
          <?php endif;?>
            <li><a href="view-gallery.php"><i class="fa fa-arrow-right fa-sm"></i> View Gallery</a></li>
          </ul>
        </li>
         <li class="header">EXTRA FEATURES</li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-address-card"></i>
            <span>Profiles</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if (empty($security_question) && empty($security_answer)):?>
            <li><a href="add-profile.php"><i class="fa fa-arrow-right fa-sm"></i> Add Profile</a></li>
            <?php endif;?>
            <li><a href="view-profile.php"><i class="fa fa-arrow-right fa-sm"></i> View Profile</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Tasks</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add-task.php"><i class="fa fa-arrow-right fa-sm"></i> Add Task</a></li>
            <li><a href="view-tasks.php"><i class="fa fa-arrow-right fa-sm"></i> View Tasks</a></li>
          </ul>
        </li>
         <li>
          <a href="featured-pictures.php">
            <i class="fa fa-scroll"></i> <span> Featured Pictures</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">New</small>
            </span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
