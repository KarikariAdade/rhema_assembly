 <div class="col-md-4">
  <?php
  include 'connect.php';
  ?>
  <?php
                    $counter_sql = "SELECT * FROM admin_profile";
                    $counter_query = mysqli_query($conn, $counter_sql);
                    ?>
               <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Church Staff</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger"><?php echo mysqli_num_rows($counter_query); ?> Member (s)</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <?php
                    $sql = "SELECT * FROM admin_profile ORDER BY id DESC LIMIT 8";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
                        $id = $row['id'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $admin_image = $row['admin_image'];
                        $position = $row['position'];
                    ?>
                    <li>
                      <img src="<?php echo $admin_image; ?>" alt="User Image" style="height: 65px;width: 100%;">
                      <a class="users-list-name" href="staff-detail.php?staff=<?php echo urlencode($id);?>&slug=<?php echo urlencode($last_name);?>&user=<?php echo urlencode($first_name); ?>"><?php echo $last_name; ?></a>
                      <span class="users-list-date"><?php echo $position; ?></span>
                    </li>
                    <?php
                      }
                    }
                    ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="view-staff.php" class="uppercase">View All Staff</a>
                </div>
                <!-- /.box-footer -->
              </div>
            </div>