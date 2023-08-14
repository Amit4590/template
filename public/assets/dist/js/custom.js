function showValidationMessage(data) {
	if(data.length != 0){
		$.each(data,function(index,value){
			$('#'+index).parent('.form-group, .custom-file').find('span[class="text-danger"]').remove();
			$('#'+index).parent('.form-group, .custom-file').append('<span class="text-danger">'+value+'</span>');
			setTimeout(function(){
				$('#'+index).parent('.form-group, .custom-file').find('span[class="text-danger"]').remove();
			},5000)
		});
	}
}

function showImage(obj,showImgId) {
	const file = obj.files[0];
  const reader = new FileReader();
  reader.onload = function() {
  	$('#'+showImgId).html('<img src="'+reader.result+'" style="height:200px;width:100%;border:1px solid; padding:5px;">');
  }
  if (file) {
    reader.readAsDataURL(file);
  }
}

function editShowImage(imageId,url) {
	$('#'+imageId).html('<img src="'+url+'" style="height:200px;width:100%;border:1px solid; padding:5px;">');
}

function getImageUrl(imageData) {
	let host = imageData.host_url;
	let folder_name = imageData.folder_name;
	let image_name = imageData.image_name;
	return host+'/'+folder_name+'/'+image_name;
}

function formClear(fromName,image = null) {
	$("form[name='"+fromName+"']").trigger("reset");
	if(image){
		$('#'+image).empty();
	}
}

function capitalize(str='') {
      strVal = '';
      str = str.split(' ');
      for (var chr = 0; chr < str.length; chr++) {
        strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
      }
      return strVal
}

function showLoader(){
  $("body").addClass("loading");
}


function hideLoader(){
  $("body").removeClass("loading"); 
}