var token = $('meta[name="csrf-token"]').attr('content');

function ajax_config() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': token
		}
	});	
}

function addCategory() {
	ajax_config();

	// alert($('#category_name').val() +" "+ $('#category_colour').val());

	$.post(target_url+'/categories',
	{
		_method: 'POST',
		_token: token,
		name: $('#category_name').val(),
		colour: $('#category_colour').val()
	},
	function(data, status){
		if (status) {
			alert('sukses');
		}else{
			alert('Gagal menambahkan kategori menu');
		}
	});
}

function delete_staff(id) {
	confirm('Apakah anda yakin?');
	ajax_config();

	$.post(base_url+'/'+id,
	{
		_method: 'delete',
		_token: token
	},
	function(data, status){
		if (status) {
			location.reload(true);
		}else{
			alert('artikel gagal dihapus');
		}
	});
}