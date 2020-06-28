        <div class="modal fade" id="membershipModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header"> -->
            <div class="modal-title" style="padding-bottom: 8%">
              <span data-dismiss="modal" style="cursor: pointer;">&times</span>
              <h3>Membership Form</h3>
            </div>
            <span id="service_error"></span>
            <small style="padding-left: 5%;">NB: DoB means Date of Birth <br />DoM means Date of Membership</small>
            <div class="modal-body">
              <div class="container-fluid">
                  <form class="row" method="POST" action="membership_validation.php" id="membership_form">
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                </div>
                <input class="form-control" placeholder="First Name *" type="text" name="first_name" id="first_name">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                </div>
                <input class="form-control" placeholder="Last Name *" type="text" name="last_name" id="last_name">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <!-- <label>BirthDate</label> -->
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="font-weight: bold">DoB</span>
                </div>
                <input class="form-control" placeholder="Date of Birth" type="date" id="birthdate" name="birthdate">
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                </div>
                <input class="form-control" placeholder="Address *" type="text" name="address" id="address">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input class="form-control" placeholder="Email *" type="email" name="email" id="email">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                <input class="form-control" placeholder="Phone *" type="tel" name="phone" id="phone">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <!-- <label>BirthDate</label> -->
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="font-weight: bold">DoM</span>
                </div>
                <input class="form-control" placeholder="Date of Membership" type="date" id="duration" name="duration">
              </div>
            </div>
          </div>
           <div class="col-md-6">
            <div class="form-group">
              <div class="input-group credential_form">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                </div>
                <input class="form-control" placeholder="Occupation (Indicate if Student) *" type="text" name="occupation" id="occupation">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group credential_form">
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="career_field" id="career_field">
                    <option selected>Select Career Field</option>
                    <option>IT Personnel</option>
                    <option>Hospitality</option>
                    <option>Health Personnel</option>
                    <option>Entrepreneur</option>
                    <option>Civil Service</option>
                    <option>Education</option>
                    <option>Other</option>
                  </select>
                </div>

          </div>
            <div class="col-md-6">
            <div class="form-group credential_form">
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="gender" id="gender">
                    <option>Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
          </div>
          <div class="col-md-6">
            <div class="form-group credential_form">
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="ministry" id="ministry">
                    <option>Member of what Ministry?</option>
                    <option>None</option>
                    <option>Evangelism Ministry</option>
                    <option>Men Ministry</option>
                    <option>Women Ministry</option>
                    <option>Children Ministry</option>
                    <option>Youth Ministry</option>
                  </select>
                </div>

          </div>
           <div class="col-md-6">
            <div class="form-group credential_form">
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="marital_status" id="marital_status">
                    <option>Marital Status</option>
                    <option>In a Relationship</option>
                    <option>Single</option>
                    <option>Married</option>
                    <option>Divorced</option>
                    <option>Complicated</option>
                    <option>Widowed</option>
                  </select>
                </div>

          </div>
            <div class="col-md-6">
            <div class="form-group credential_form">
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="baptism" id="baptism">
                    <option>Have you been Baptised?</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>
          </div>

          <div class="col-md-12">
            <div class="form-group textarea" align="center">
              <div class="input-group credential_form">
                <textarea type="text" name="comment_description" rows="5" cols="300" placeholder="Any other information/feedback/contribution?" name="user_comment" id="user_comment"></textarea>
              </div>
            </div>

          </div>
          <p id="contact_form_submit"><button class="btn" id="member_submit_btn" name="member_submit_btn">Submit</button></p>
        </form>
              </div>
            </div>
          </div>
        </div>
      </div>
     