
          <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Your Tasklist</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
                <?php
                $task_sql = "SELECT * FROM tasklist WHERE user_id = '$id'";
                $task_query = mysqli_query($conn, $task_sql);
                if (mysqli_num_rows($task_query) > 0) {
                  while ($row = mysqli_fetch_assoc($task_query)) {
                    $task_id = $row['id'];
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    $user_position = $row['user_position'];
                    $task_title = $row['task_title'];
                    $task_schedule_date = $row['task_schedule_date'];
                    $task_schedule_time = $row['task_schedule_time'];
                    $task_status = $row['task_status'];
                    $task_marker = $row['task_marker'];
                    $full_date = $task_schedule_date." ".$task_schedule_time;
                    $timestamp = strtotime($full_date);
                    $day = date("l M d Y",$timestamp);
                    $time = date("h:ia");
                ?>
                <li>
                  <!-- todo text -->
                  <span class="text"><?php echo $task_title; ?></span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock"></i> <?php echo $day." at ".$time; ?></small>
                  <small class="label label-primary"><i class="fa fa-clock"></i> <?php echo $task_status; ?></small>
                      <?php if ($task_marker == "In Progress"): ?>
                   <small class="label label-warning"><?php echo $task_marker;?></small>
                   <?php elseif ($task_marker == "Completed"):?>
                    <small class="label label-success"><?php echo $task_marker;?></small>
                    <?php elseif($task_marker == "On Hold"):?>
                      <small class="label label-danger"><?php echo $task_marker;?></small>
                    <?php endif;?>
                  <!-- General tools such as edit or delete-->
                    <div class="tools" style="display: inline-flex;margin-top: 3px;">
                    <a href="edit-task.php?task=<?php echo urlencode($task_title); ?>"><i class="fa fa-edit"></i></a>
                    <span><form method="POST" action="includes/delete-task.php">
                      <input type="hidden" name="task_id" value="<?php echo $id; ?>">
                    <button class="btn btn-xs" type="submit" style="background-color: transparent;" name="delete_task_btn"><i class="fa fa-trash"></i></button>
                  </form>
                </span>
                  </div>
                </li>
                <?php
                 }
                }
                ?>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><a href="add-task.php"><i class="fa fa-plus"></i> Add Task</a></button>
            </div>
          </div>
          <!-- /.box -->