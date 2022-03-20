
	$(document).ready(function (){
		$('.file_drag_area').on('dragover', function (){
			$(this).addClass('file_drag_over');
			return false;
		});

		$('.file_drag_area').on('dragleave', function (){
			$(this).removeClass('file_drag_over');
			return false;
		});
		$('.file_drag_area').on('drop', function (e){
			e.preventDefault();
			$(this).removeClass('file_drag_over');
			var formData = new FormData();
			var files_list = e.originalEvent.dataTransfer.files;
			for (var i=0; i<files_list.length; i++) {
				formData.append('file[]',files_list[i]);
			}
			$.ajax({
				url: 'includes/gallery-uploads.php',
				method: 'POST',
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					swal("Thank You", "You successfully uploaded your picture(s)"+data, "success");
				}
			});
		});
	});
	$(document).ready(function (){
		$('.file_drag_area2').on('dragover', function (){
			$(this).addClass('file_drag_over2');
			return false;
		});

		$('.file_drag_area2').on('dragleave', function (){
			$(this).removeClass('file_drag_over2');
			return false;
		});
		$('.file_drag_area2').on('drop', function (e){
			e.preventDefault();
			$(this).removeClass('file_drag_over2');
			var formData = new FormData();
			var files_list = e.originalEvent.dataTransfer.files;
			for (var i=0; i<files_list.length; i++) {
				formData.append('file[]',files_list[i]);
			}
			$.ajax({
				url: 'includes/gallery-uploads2.php',
				method: 'POST',
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					swal("Thank You", "You successfully uploaded your picture(s)"+data, "success");
				}
			});
		});
	});
$(document).ready(function (){
		$('.file_drag_area3').on('dragover', function (){
			$(this).addClass('file_drag_over3');
			return false;
		});

		$('.file_drag_area3').on('dragleave', function (){
			$(this).removeClass('file_drag_over3');
			return false;
		});
		$('.file_drag_area3').on('drop', function (e){
			e.preventDefault();
			$(this).removeClass('file_drag_over3');
			var formData = new FormData();
			var files_list = e.originalEvent.dataTransfer.files;
			for (var i=0; i<files_list.length; i++) {
				formData.append('file[]',files_list[i]);
			}
			$.ajax({
				url: 'includes/gallery-uploads3.php',
				method: 'POST',
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					swal("Thank You", "You successfully uploaded your picture(s)"+data, "success");
				}
			});
		});
	});
$(document).ready(function (){
		$('.file_drag_area4').on('dragover', function (){
			$(this).addClass('file_drag_over4');
			return false;
		});

		$('.file_drag_area3').on('dragleave', function (){
			$(this).removeClass('file_drag_over4');
			return false;
		});
		$('.file_drag_area4').on('drop', function (e){
			e.preventDefault();
			$(this).removeClass('file_drag_over4');
			var formData = new FormData();
			var files_list = e.originalEvent.dataTransfer.files;
			for (var i=0; i<files_list.length; i++) {
				formData.append('file[]',files_list[i]);
			}
			$.ajax({
				url: 'includes/gallery-uploads4.php',
				method: 'POST',
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				success:function(data){
					swal("Thank You", "You successfully uploaded your picture(s)"+data, "success");
				}
			});
		});
	});