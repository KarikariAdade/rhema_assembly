        <div class="modal fade" id="staff_request_form" tabindex="-1" role="dialog" style="position: absolute; z-index: 999995;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header"> -->
            <div class="modal-title" style="padding-bottom: 8%">
              <span data-dismiss="modal" style="cursor: pointer;">&times</span>
              <h3>Staff Request Form</h3>
            </div>
            <span id="service_error"></span>
            <div class="modal-body">
              <div class="container">
                  <form class="row" method="POST" action="staff_request_validation.php" id="staff_request_form">
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                </div>
                <input class="form-control" placeholder="First Name" type="text" name="first_name" id="first_name">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                </div>
                <input class="form-control" placeholder="Last Name" type="text" id="last_name" name="last_name">
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                <input class="form-control" placeholder="Phone Number" type="text" name="phone_number" id="phone_number">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input class="form-control" placeholder="Email" type="email" name="user_email" id="user_email">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group credential_form">
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="user_gender" id="user_gender">
                    <option>Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>

          </div>
          <div class="col-md-12">
            <div class="form-group textarea" align="center">
              <div class="input-group credential_form">
                <textarea type="text" name="staff_description" rows="5" cols="300" placeholder="Write something brief about yourself and why you want to be part of church staff" id="staff_description"></textarea>
              </div>
            </div>

          </div>
          <p id="contact_form_submit"><button class="btn" id="staff_submit_btn" name="staff_submit_btn">Submit</button></p>
        </form>
              </div>
            </div>
          </div>
        </div>
      </div>
     