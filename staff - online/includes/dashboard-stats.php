  <?php
      $member_sql = "SELECT * FROM members";
      $member_query = mysqli_query($conn, $member_sql);
      $member_count = mysqli_num_rows($member_query);

      $staff_sql = "SELECT * FROM admin_profile";
      $staff_query = mysqli_query($conn, $staff_sql);
      $staff_count = mysqli_num_rows($staff_query);

      $volunteer_sql = "SELECT * FROM volunteers";
      $volunteer_query = mysqli_query($conn, $volunteer_sql);
      $volunteer_count = mysqli_num_rows($volunteer_query);

      $tasklist_sql = "SELECT * FROM tasklist WHERE user_id = '$id'";
      $tasklist_query = mysqli_query($conn, $tasklist_sql);
      $tasklist_count = mysqli_num_rows($tasklist_query);

      $news_sql = "SELECT * FROM news";
      $news_query = mysqli_query($conn, $news_sql);
      $news_count = mysqli_num_rows($news_query);

      $announcement_sql = "SELECT * FROM announcement";
      $announcement_query = mysqli_query($conn, $announcement_sql);
      $announcement_count = mysqli_num_rows($announcement_query);
 $mail_sql = "SELECT * FROM admin_profile WHERE id='$id'";
          $mail_query = mysqli_query($conn, $mail_sql);
          if (mysqli_num_rows($mail_query) > 0) {
            while ($row = mysqli_fetch_assoc($mail_query)) {
              $user_id = $row['id'];
              $full_name = $row['first_name']." ".$row['last_name'];
              $user_email = $row['email'];
            }
          }
       $inbox = "SELECT * FROM messages WHERE receiver_email = '$user_email'";
 $inbox_query = mysqli_query($conn, $inbox);
 $inbox_counter = mysqli_num_rows($inbox_query);
      // $sermon_sql = "SELECT * FROM sermon";

 $study_groups_sql = "SELECT * FROM study_groups";
      $study_groups_query = mysqli_query($conn, $study_groups_sql);
      $study_groups_count = mysqli_num_rows($study_groups_query);
      ?>
 <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $member_count; ?></h3>

              <p>Members</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="view-members.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $staff_count; ?></h3>

              <p>Church Staff</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-tie"></i>
            </div>
            <a href="view-staff.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $volunteer_count; ?></h3>

              <p>Volunteers</p>
            </div>
            <div class="icon">
              <i class="fa fa-award"></i>
            </div>
            <a href="view-volunteers.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $inbox_counter; ?></h3>

              <p>Messages</p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope"></i>
            </div>
            <a href="mailbox.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3><?php echo $tasklist_count; ?></h3>

              <p>Tasks</p>
            </div>
            <div class="icon">
              <i class="fa fa-cog"></i>
            </div>
            <a href="view-tasks.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
           <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php echo $news_count; ?></h3>

              <p>News</p>
            </div>
            <div class="icon">
              <i class="fa fa-newspaper"></i>
            </div>
            <a href="view-news.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
           <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h3><?php echo $announcement_count; ?></h3>

              <p>Announcement</p>
            </div>
            <div class="icon">
              <i class="fa fa-exclamation"></i>
            </div>
            <a href="view-announcement.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
           <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3><?php echo $study_groups_count; ?></h3>

              <p>Study Groups</p>
            </div>
            <div class="icon">
              <i class="fa fa-users-cog"></i>
            </div>
            <a href="view-groups.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        </div>
