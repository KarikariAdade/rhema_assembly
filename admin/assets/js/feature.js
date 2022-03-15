$(document).ready(function (){
	function reload_function(){
		window.location.reload();
	}
    function readURL(input){
         if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e){
                   $('.file_drag_area_img').attr('src', e.target.result);
             }
             reader.readAsDataURL(input.files[0]);
             $('#featured_image_del_btn').hide();
       }
}

 $('#picname').change(function (){
   readURL(this);
})
 $('#featured-text').keyup(function(){
   $('#countdown').html('You have used '+this.value.length + ' of 90 characters');
   if (this.value.length > 90) {
        this.value =this.value.substr(0,90);
  }
})
 $('#add_featured_btn').click(function (e){
    e.preventDefault();
    var form = $('#fileform')[0];
    var data = new FormData(form);
    data.append('data', $('#featured-text').val());
    $.ajax({
         url: 'includes/featured-item-validation.php',
         data: data,
         type: 'POST',
         contentType: false,
         async: false,
         processData: false,
         cache: false,
         success: function(data){
             swal("Information", ""+data, "info");
       }
 });
});
 $('#edit_featured_btn').click(function (e){
    e.preventDefault();
    var form = $('#fileform')[0];
    var data = new FormData(form);
    data.append('data', $('#featured-text').val());
    $.ajax({
         url: 'includes/update-feature-validation.php',
         data: data,
         type: 'POST',
         contentType: false,
         async: false,
         processData: false,
         cache: false,
         success: function(data){
             if (data == "Featured item updated") {
                  swal("Information", ""+data, "info");
                  setInterval(function(){window.location ='featured-pictures.php'}, 2000);
            }
      }
});
});
 $('.weekly-give-form').submit(function (e){
    e.preventDefault();
    var week_name = $('#week_name').val();
    var giving_type = $('#giving_type').val();
    var amount_made = $('#amount_made').val();
    var weekly_give_form_btn = $('#weekly_give_form_btn').val();
    $.ajax({
         url: 'includes/weekly-giving.php',
         method: 'POST',
         data: {
              week_name: week_name,
              giving_type: giving_type,
              amount_made: amount_made,
              weekly_give_form_btn: weekly_give_form_btn
        },
        success:function(data){
              swal('Info', ''+data, 'info');
        }
  })
})
 $('#print, #print1').click(function (){
      window.print();
});
 $('.add_harvest_form').submit(function (e){
      e.preventDefault();
      var harvest_date = $('#harvest_date').val();
      var harvest_time = $('#harvest_time').val();
      var harvest_venue = $('#harvest_venue').val();
      var submit_annual_harvest_btn = $('#submit_annual_harvest_btn').val();
      $.ajax({
            url: 'includes/submit-annual-harvest.php',
            method: 'POST',
            data: {
                  harvest_date: harvest_date,
                  harvest_time: harvest_time,
                  harvest_venue: harvest_venue,
                  submit_annual_harvest_btn: submit_annual_harvest_btn
            },
            success:function (data){
                  if (data == "Annual Harvest has been added successfully.") {
                        swal('Info', ''+data, 'info');
                  }else{
                        swal('Info', ''+data, 'info');
                        return false;
                  }
            }
      })
})
});