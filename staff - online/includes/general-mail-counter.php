 <?php
 $inbox = "SELECT * FROM mailbox WHERE trash='No'";
 $inbox_query = mysqli_query($conn, $inbox);
 $inbox_counter = mysqli_num_rows($inbox_query);
 $sender_sql = "SELECT * FROM mailbox WHERE reply_status = 'Yes' AND trash='No'";
                    $sender_query = mysqli_query($conn, $sender_sql);
                    $sender_counter = mysqli_num_rows($sender_query);

                     $trash_sql = "SELECT * FROM mailbox WHERE trash = 'Yes'";
                    $trash_query = mysqli_query($conn, $trash_sql);
                    $trash_counter = mysqli_num_rows($trash_query);
  ?>
 <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="general-mailbox.php"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right"><?php echo $inbox_counter; ?></span></a></li>
                <li><a href="general-sent-mail.php"><i class="fa fa-envelope"></i> Sent <span class="label label-warning pull-right"><?php echo $sender_counter; ?></span></a></li>
                <li><a href="general-trashed-mail.php"><i class="fa fa-trash"></i> Trash<span class="label label-danger pull-right"><?php echo $trash_counter; ?></span></a></li>
              </ul>
            </div>
          </div>