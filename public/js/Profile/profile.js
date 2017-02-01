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

	$.post(base_url+'/avatar/change/'+id,
	{
		_method: 'PATCH',
		_token: token
	},
	function(data, status){
		if (status) {
			alert(data.response)
		}else{
			alert('shet');
		}
	});
}