var token = $('meta[name="csrf-token"]').attr('content');

function ajax_config() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': token
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