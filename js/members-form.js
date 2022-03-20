			$(document).ready(function(){
				var career_field = $('#career_field').val();
				var occupation = $('#occupation').val();
				var ministry = $('#ministry').val();
				var duration = $('#duration').val();
				
				var baptism = $('#baptism').val();
				var user_comment = $('#user_comment').val();
			var current_fs, next_fs, previous_fs; //fieldsets
			var opacity;
			var current = 1;
			var steps = $("fieldset").length;
			setProgressBar(current);

			$(".next1").click(function(e){
				e.preventDefault();
				var first_name = $('#first_name').val();
				var last_name = $('#last_name').val();
				var birthdate = $('#birthdate').val();
				var address = $('#address').val();
				var email = $('#email').val();
				var gender = $('#gender').val();
				var phone = $('#phone').val();
				var marital_status = $('#marital_status').val();
				if (first_name == '' || last_name == '' || birthdate == '' || address == '' || email == '' || gender == '' || phone == '' || marital_status == '') {
					swal("Alert", "Fill all fields before submitting", "error");
					return false;
				}else if(first_name.length < 3){
					swal("Alert", "First Name too short","error");
				}else if(last_name.length < 3){
					swal("Alert", "Last Name too short","error");
				}else if(isNaN(phone)){
					swal("Alert", "Phone field should contain only numbers","error");
				}else if(phone.length < 10){
					swal("Alert", "Phone number too short","error");
				}else{
					$.ajax({
						url: 'includes/email-validation.php',
						method: 'POST',
						data: {email:email},
						success:function(data){
							if(data == "You have already been added to the Church's database. You will be redirected"){
								swal("Alert", ""+data, "error");
								setInterval(reload, 4000);
							}
						},
						error:function(){
							swal("Alert", "Request Error","error");
						}
					});
					current_fs = $(this).parent();
					next_fs = $(this).parent().next();

			//Add Class Active
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now) {
			// for making fielset appear animation
			opacity = 1 - now;

			current_fs.css({
				'display': 'none',
				'position': 'relative'
			});
			next_fs.css({'opacity': opacity});
		},
		duration: 1500
	});
			setProgressBar(++current);
			
		}	

	});


			// Page 2 of form
			
			$(".next2").click(function(e){
				e.preventDefault();

				var ministry = $('#ministry').val();
				var duration = $('#duration').val();
				var baptism = $('#baptism').val();
				if (ministry == '' || duration == '' || baptism == '') {
					swal("Alert", "Fill all fields before submitting", "error");
				}else{
					current_fs = $(this).parent();
					next_fs = $(this).parent().next();

			//Add Class Active
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now) {
			// for making fielset appear animation
			opacity = 1 - now;

			current_fs.css({
				'display': 'none',
				'position': 'relative'
			});
			next_fs.css({'opacity': opacity});
		},
		duration: 1500
	});
			setProgressBar(++current);
		}
	});


			// Page 3 of form


			$(".next3").click(function(f){
				f.preventDefault();
				var first_name = $('#first_name').val();
				var last_name = $('#last_name').val();
				var birthdate = $('#birthdate').val();
				var address = $('#address').val();
				var email = $('#email').val();
				var gender = $('#gender').val();
				var phone = $('#phone').val();
				var marital_status = $('#marital_status').val();
				var ministry = $('#ministry').val();
				var duration = $('#duration').val();
				var baptism = $('#baptism').val();
				var career_field = $('#career_field').val();
				var occupation = $('#occupation').val();
				var user_comment = $('#user_comment').val();
				var next3 = $('.next3').val();
				if (career_field == '' || occupation == '' || user_comment == '') {
					swal("Alert", "Fill all fields before submitting", "error");
				}else{
					$.ajax({
						url: 'includes/membership_validation.php',
						method: 'POST',
						data:{
							first_name: first_name,
				              last_name: last_name,
				              birthdate: birthdate,
				              address: address,
				              email: email,
				              gender: gender,
				              phone: phone,
				              marital_status: marital_status,
				              ministry: ministry,
				              duration: duration,
				              baptism: baptism,
				              career_field: career_field,
				              occupation: occupation,
				              user_comment: user_comment,
				              next3: next3
				          },
				          success:function(data){
				          	if (data == "You have already been added to the Church's database. You will be redirected") {
				          		setInterval(reload, 4000);
				          	}
				          	swal("Success", ""+data, "success");
				          	$('#last_previous').hide();
				          },
				          error:function(){
				          	alert('there is a request error');
				          }
					});
					current_fs = $(this).parent();
					next_fs = $(this).parent().next();

			//Add Class Active
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now) {
			// for making fielset appear animation
			opacity = 1 - now;

			current_fs.css({
				'display': 'none',
				'position': 'relative'
			});
			next_fs.css({'opacity': opacity});
		},
		duration: 1500
	});
			setProgressBar(++current);
		}
	});


			//Next button (last section of form) 

			$(".next").click(function(e){
				e.preventDefault();
					current_fs = $(this).parent();
					next_fs = $(this).parent().next();

			//Add Class Active
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now) {
			// for making fielset appear animation
			opacity = 1 - now;

			current_fs.css({
				'display': 'none',
				'position': 'relative'
			});
			next_fs.css({'opacity': opacity});
		},
		duration: 1500
	});
			setProgressBar(++current);
	});


			// Previous button on click function

			$(".previous").click(function(){

				current_fs = $(this).parent();
				previous_fs = $(this).parent().prev();

			//Remove class active
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

			//show the previous fieldset
			previous_fs.show();

			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now) {
			// for making fielset appear animation
			opacity = 1 - now;

			current_fs.css({
				'display': 'none',
				'position': 'relative'
			});
			previous_fs.css({'opacity': opacity});
		},
		duration: 1500
	});
			setProgressBar(--current);
		});

			function setProgressBar(curStep){
				var percent = parseFloat(100 / steps) * curStep;
				percent = percent.toFixed();
				$(".progress-bar")
				.css("width",percent+"%")

			}


			//Reload Function
			function reload(){
				window.location = 'membership';
			}

		});