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

      $event_sql = "SELECT * FROM events";
      $event_query = mysqli_query($conn, $event_sql);
      $event_count = mysqli_num_rows($event_query);

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
      

 $study_groups_sql = "SELECT * FROM study_groups";
      $study_groups_query = mysqli_query($conn, $study_groups_sql);
      $study_groups_count = mysqli_num_rows($study_groups_query);

$baptised_sql = "SELECT * FROM members WHERE baptism='Yes'";
$baptised_query = mysqli_query($conn, $baptised_sql);
$baptised_count = mysqli_num_rows($baptised_query);

$non_baptised_sql = "SELECT * FROM members WHERE baptism='No'";
$non_baptised_query = mysqli_query($conn, $non_baptised_sql);
$non_baptised_count = mysqli_num_rows($non_baptised_query);

$sermon_sql = "SELECT * FROM sermon";
$sermon_query = mysqli_query($conn, $sermon_sql);
$sermon_count = mysqli_num_rows($sermon_query);

$home_cell_sql = "SELECT * FROM study_groups WHERE group_category = 'Home Cells'";
$home_cell_query = mysqli_query($conn, $home_cell_sql);
$home_cell_count = mysqli_num_rows($home_cell_query);

$bible_study_sql = "SELECT * FROM study_groups WHERE group_category = 'Bible Studies'";
$bible_study_query = mysqli_query($conn, $bible_study_sql);
$bible_study_count = mysqli_num_rows($bible_study_query);

   $tasklist_sql = "SELECT * FROM tasklist WHERE user_id = '$id'";
      $tasklist_query = mysqli_query($conn, $tasklist_sql);
      $tasklist_count = mysqli_num_rows($tasklist_query);