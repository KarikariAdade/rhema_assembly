          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <p align="center" id="quick_mail_error" style="color: red;font-weight: bold;"></p>
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                title="Remove">
                <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <form action="#" method="POST" class="quick_mail_form">
                <div class="form-group">
                  <input type="hidden" id="quick_mail_sender" value="<?= $_SESSION['id']; ?>">
                  <input type="email" class="form-control" id="emailto" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" id="message" placeholder="Message"
                  style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
              </div>
              </form>
            </div>
            
            </div>
            <script type="text/javascript">
              $(document).ready(function(){
                $('.quick_mail_form').submit(function(e){
                  e.preventDefault();
                  var emailto = $('#emailto').val();
                  var quick_mail_sender = $('#quick_mail_sender').val();
                var subject = $('#subject').val();
                var message = $('#message').val();
                var sendEmail = $('#sendEmail').val();
                $.ajax({
                  url: 'includes/quick_mail.php',
                  method: 'POST',
                  data:{
                    quick_mail_sender: quick_mail_sender,
                    emailto: emailto,
                    subject: subject,
                    message: message,
                    sendEmail: sendEmail
                  },
                  success:function (data){
                    $('#quick_mail_error').html(data);
                  },
                  error:function(){
                    $('#quick_mail_error').html('There is an error');
                  }
                })
                })
              })
            </script>