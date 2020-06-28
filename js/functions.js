 (function (document, $) {

    var $scrollElement = (function () {
        // Find out what to scroll (html or body)
        var $html = $(document.documentElement),
        $body = $(document.body),
        bodyScrollTop;
        if ($html.scrollTop()) {
            return $html;
        } else {
            bodyScrollTop = $body.scrollTop();
            // If scrolling the body doesn’t do anything
            if ($body.scrollTop(bodyScrollTop + 1).scrollTop() == bodyScrollTop) {
                return $html;
            } else {
                // We actually scrolled, so undo it
                return $body.scrollTop(bodyScrollTop);
            }
        }
    });

    $.fn.smoothScroll = function (speed) {
        speed = ~~speed || 400;
        // Look for links to anchors (on any page)
        return this.find('a[href*="#"]').click(function (event) {
            var hash = this.hash,
                $hash = $(hash); // The in-document element the link points to
            // If it’s a link to an anchor in the same document
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                // If the anchor actually exists…
                if ($hash.length) {
                    // …don’t jump to the link right away…
                    event.preventDefault();
                    // …and smoothly scroll to it
                    $scrollElement.stop().animate({
                        'scrollTop': $hash.offset().top
                    }, speed, function () {
                        location.hash = hash;
                    });
                }
            }
        }).end();
    };

}(document, jQuery));

 $('html').smoothScroll();
 $('html').smoothScroll(1200);
 function clicker (){
    $('#icon').addClass("fa-minus");
    $('#icon').toggleClass('fa-plus');
}
function clicker2 (){
    $('#icon2').addClass("fa-plus");
    $('#icon2').toggleClass('fa-minus');
}
function clicker3 (){
    $('#icon3').addClass("fa-plus");
    $('#icon3').toggleClass('fa-minus');
}
function clicker4 (){
    $('#icon4').addClass("fa-plus");
    $('#icon4').toggleClass('fa-minus');
}


function navbarFixed(){
    if ( $('.main_header_area').length ){ 
        $(window).on('scroll', function() {
            var scroll = $(window).scrollTop();   
            if (scroll >= 120 ) {
                $("#header").addClass("navbar_fixed");
            } else {
                $("#header").removeClass("navbar_fixed");
            }
        });
    };
};
    // Scroll to top
    function scrollToTop() {
        if ($('.scroll-top').length) {  
            $(window).on('scroll', function () {
                if ($(this).scrollTop() > 200) {
                    $('.scroll-top').fadeIn();
                } else {
                    $('.scroll-top').fadeOut();
                }
            }); 
            //Click event to scroll to top
            $('.scroll-top').on('click', function () {
                $('html, body').animate({
                    scrollTop: 0
                }, 1000);
                return false;
            });
        }
    }
    
    scrollToTop();
    navbarFixed();
    $('.verify_admin_form').submit(function (e){
        e.preventDefault();
        var token = $('#token').val();
        var admin_email = $('#admin_email').val();
        var admin_password = $('#admin_password').val();
        var verify_admin_btn = $('.verify_admin_btn').val();
        $.ajax({
            url: 'includes/verify-admin.php',
            method: 'POST',
            data:{
                token: token,
                admin_email: admin_email,
                admin_password: admin_password,
                verify_admin_btn: verify_admin_btn
            },
            success:function(data){
                if (data == "You have been verified") {
                    alert('wow');
                    swal({
                      title: "You have been verified!",
                      text: "The administrator verification process is complete!",
                      type: "success",
                      confirmButtonClass: "btn-success",
                      confirmButtonText: "Go to Dashboard!",
                      closeOnConfirm: false,
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                         window.location = 'admin/staff/sign-in.php';
                     }
                 });
                }else{
                    $('#formError').html(data);
                }
            }
        })
    })
    var password = $('#admin_password');
    var show_hide_btn = $('.show_hide_btn');
    var checked = false;
    $('.input-group-append').click(function (){
        if ($('.show_hide_btn').toggleClass("fa fa-eye-slash")) {
           $('.show_hide_btn').addClass("fa fa-eye");
       }
   });
    function HOS(){
        if (checked === false) {
            password.attr("type", "text");
            checked = true;
        } else if (checked === true) {
            show_hide_btn.toggleClass("fa fa-eye");
            password.attr("type", "password");
            checked = false;
        }
    }
    $('#amount_number').change(function(){
        this.value = parseFloat(this.value).toFixed(2);
    })
    $('.proceed_btn').click(function(){
        var amount_number = $('#amount_number').val();
        var give_full_name = $('#give_full_name').val();
        var give_email = $('#give_email').val();
        var give_type = $('#give_type').val();
        var proceed_btn = $('.proceed_btn').val();
        var payment_submit_btn = $('#payment_submit_btn').val();
        $.ajax({
            url: 'includes/payment-sect.php',
            method: 'POST',
            data:{
                amount_number: amount_number,
                give_full_name: give_full_name,
                give_email: give_email,
                give_type: give_type,
                proceed_btn: proceed_btn
            },
            success:function(data){
                if (data == "Proceed to next page") {
                    $('.form_section_1').toggle();
                    $('.form_section_2').toggle();
                    return true;
                }
                swal('Alert', ''+data, 'error');
                return false;
            }
        })
    })
    $('.previous_btn').click(function(){
        $('.form_section_1').toggle();
        $('.form_section_2').toggle();
    })
    $('.payment_form').submit(function(e){
        e.preventDefault();
        var amount_number = $('#amount_number').val();
        var give_full_name = $('#give_full_name').val();
        var give_email = $('#give_email').val();
        var give_type = $('#give_type').val();
        var payment_form_submit_btn = $('.payment_form_submit_btn').val();
        var phone_number = $('#phone_number').val();
        $.ajax({
            url: 'includes/payment-sect.php',
            method: 'POST',
            data:{
                amount_number: amount_number,
                give_full_name: give_full_name,
                give_type: give_type,
                give_email: give_email,
                phone_number: phone_number,
                payment_form_submit_btn: payment_form_submit_btn
            },
            success:function(data){
                swal('Alert', ''+data, 'error');
            }
        })
    })
    