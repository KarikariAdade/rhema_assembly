        <div class="modal fade" id="volunteerModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header"> -->
            <div class="modal-title" style="padding-bottom: 8%">
              <span data-dismiss="modal" style="cursor: pointer;">&times</span>
              <h3>Become a Volunteer</h3>
            </div>
            <span id="modal_error"></span>
            <div class="modal-body">
              <div class="container">
                  <form class="row" method="POST" action="volunteer-validation.php" id="volunteer_form">
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                </div>
                <input class="form-control" placeholder="Full Name" type="text" name="full_name" id="full_name">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                <input class="form-control" placeholder="Phone" type="tel" id="phone" name="phone">
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-building"></i></span>
                </div>
                <input class="form-control" placeholder="Company" type="text" name="company" id="company">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input class="form-control" placeholder="Email" type="email" name="email" id="email">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group credential_form">
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="event" id="event">
                    <option>Volunteer Events</option>
                    <option>Crusade</option>
                    <option>Sunday Service</option>
                    <option>Camp Meetings</option>
                    <option>Visitations</option>
                    <option>Evangelism</option>
                  </select>
                </div>

          </div>
          <div class="col-md-12">
            <div class="form-group textarea" align="center">
              <div class="input-group credential_form">
                <textarea type="text" name="comment_description" rows="5" cols="300" placeholder="Write a Comment" name="comment" id="comment"></textarea>
              </div>
            </div>

          </div>
          <p id="contact_form_submit"><button class="btn" id="volunteer_submit_btn" name="volunteer_submit_btn">Submit</button></p>
        </form>
              </div>
            </div>
          </div>
        </div>
      </div>
     