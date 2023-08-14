$(document).ready(function(){
	showCategoryData();
});

$('#category_image').on('change', function() {
	showImage(this,'show_image');
});


$(document).on('submit','form[name="categoryForm"]',function(e){
	e.preventDefault();
	showLoader();
	$.ajaxSetup({
      headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
  });
	$.ajax({
		'url': $(this).data('url'),
		'method': 'POST',
		'data' : new FormData(this),
		'dataType' : 'JSON',
		'processData' : false,
    'contentType' : false,
		'success' : function(response){
			if(response.status == 2000){
				formClear('categoryForm','show_image');
				showCategoryData();
				toastr.success(response.message);
			}else if(response.status == 3001){
				showValidationMessage(response.validator);
			}else {
				toastr.error(response.message);
			}
			hideLoader();
		},
		'error' : function(jqXHR, textStatus, errorThrown) {
			hideLoader();
			toastr.info('Something went wrong !!');
			console.log(textStatus, errorThrown);
		}
	});
});

function showCategoryData(){
	$("#categoryTable").DataTable().destroy();
	var url = $('#categoryTable').data('url');
	$('#categoryTable').DataTable({
		processing: true,
    serverSide: true,
    ajax: url,	
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
      {data: 'category_image', name: 'category_image'},
      {data: 'category_name', name: 'category_name'},
      {data: 'action', name: 'action', orderable: false, searchable: false},
  	]
	});
}

function __edit(url) {
	if(url){
		showLoader();
		$.ajax({
			'url' : url,
			'type' : "GET",
			'success' : function(response){
				if(response.status == 2000){
					$('#category_name').val(response.data.category_name);
					$('form[name="categoryForm"]').attr('data-url',response.data.url);
					$('form[name="categoryForm"]').attr('data-id',response.data.id);
					if(response.data.image){
						let imageUrl = getImageUrl(response.data.image);
						editShowImage('show_image',imageUrl);
					}else{
						$('#show_image').empty();
					}
				}else {
					toastr.error(response.message);
				}
				hideLoader();
			},
			'error' : function(jqXHR, textStatus, errorThrown) {
				hideLoader();
				toastr.info('Something went wrong !!');
				console.log(textStatus, errorThrown);
			}
		});
	}
}

function __status(url) {
	if(url){
		showLoader();
		$.ajaxSetup({
	      headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
	  });
		$.ajax({
			'url' : url,
			'type' : "POST",
			'success' : function(response){
				hideLoader();
				if(response.status == 2000){
					toastr.success(response.message);
					showCategoryData();
				}else{
					toastr.error(response.message);
				}
			},
			'error' : function(jqXHR, textStatus, errorThrown) {
				hideLoader();
				toastr.info('Something went wrong !!');
				console.log(textStatus, errorThrown);
			}
		});
	}
}

function __delete(url) {
	if(url){
		showLoader();
		$.ajaxSetup({
	      headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
	  });
		$.ajax({
			'url' : url,
			'type' : "DELETE",
			'success' : function(response){
				hideLoader();
				if(response.status == 2000){
					toastr.success(response.message);
					showCategoryData();
				}else{
					toastr.error(response.message);
				}
			},
			'error' : function(jqXHR, textStatus, errorThrown) {
				hideLoader();
				toastr.info('Something went wrong !!');
				console.log(textStatus, errorThrown);
			}
		});	
	}
}