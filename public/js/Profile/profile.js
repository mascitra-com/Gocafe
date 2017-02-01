var token =  $.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	}
});


function change_avatar(id) {
	console.log(id);
	console.log(base_url+'/avatar/change/'+id);
	var token = $('meta[name="csrf-token"]').attr('content');
	console.log(token);

	$.ajax({
		url: base_url+'/avatar/change/'+id,
		type: "POST",
		data: {
			'avatar':$("input[type=file][name=avatar]").val(),
			'_method': 'POST',
			'_token': token,
		},
		contentType: false,
		cache: false,
		processData: false,
		dataType: "JSON",
		success: function(data, status){
			if (status) {
				alert(data.response)
			}else{
				alert('shet');
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert('error');
		}
	});
}