var token = $('meta[name="csrf-token"]').attr('content');

function ajax_config() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': token
		}
	});	
}

function change_avatar(id) {

	var formData = new FormData();
	formData.append('avatar', $('#avatar')[0].files[0]);

	ajax_config();

	$.ajax({
		url: base_url+'/avatar/replace/'+id,
		type: "POST",
		data: formData,
		contentType: false,
		cache: false,
		processData: false,
		dataType: "JSON",
		success: function(data, status){
			if (data.status) {
				alert(data.status);
				change_avatar_name(id ,data.avatar_name, data.avatar_mime);
                location.reload(true);
            }else{
				alert('shet');
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert('error');
		}
	});
}

function change_avatar_name(id, avatar_name, avatar_mime) {
	ajax_config();

	$.post(base_url+'/avatar/change/'+id,
	{
		_method: 'put',
		_token: $('meta[name="csrf-token"]').attr('content'),
		avatar_name: avatar_name,
		avatar_mime: avatar_mime
	},
	function(data, status){
		if (data.status) {
			// location.reload(true);
			alert('sukses update avatar');
		}else{
			alert('artikel berhasil dihapus');
		}
	});
}