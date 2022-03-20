        <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header"> -->
            <div class="modal-title" style="padding-bottom: 8%">
              <span data-dismiss="modal" style="cursor: pointer;">&times</span>
              <h3>Serve under a Ministry</h3>
            </div>
            <span id="service_error"></span>
            <div class="modal-body">
              <div class="container">
                  <form class="row" method="POST" action="service_volunteer_validation.php" id="service_form">
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                </div>
                <input class="form-control" placeholder="Full Name" type="text" name="user_name" id="user_name">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                <input class="form-control" placeholder="Phone" type="tel" id="phone_number" name="phone_number">
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-building"></i></span>
                </div>
                <input class="form-control" placeholder="Company" type="text" name="company_name" id="company_name">
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
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="user_service" id="user_service">
                    <option>Serve God Through</option>
                    <option>Youth Ministry</option>
                    <option>Men Ministry</option>
                    <option>Women Ministry</option>
                    <option>Children Ministry</option>
                    <option>Evangelism Ministry</option>
                  </select>
                </div>

          </div>
          <div class="col-md-12">
            <div class="form-group textarea" align="center">
              <div class="input-group credential_form">
                <textarea type="text" name="comment_description" rows="5" cols="300" placeholder="Write a Comment" name="user_comment" id="user_comment"></textarea>
              </div>
            </div>

          </div>
          <p id="contact_form_submit"><button class="btn" id="service_submit_btn" name="service_submit_btn">Submit</button></p>
        </form>
              </div>
            </div>
          </div>
        </div>
      </div>
     