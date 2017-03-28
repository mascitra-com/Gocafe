var token = $('meta[name="csrf-token"]').attr('content');

function ajax_config() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': token
		}
	});	
}

function setCategoryField(name, $id) {
	var data = name;
	var id = id;
	$("input[name='category_name']").val(data);
	$("input[name='category_id']").val(id);
}

function refreshCategory() {
	$("#category-list").empty();
	$('#category-list-list').append("<p class='col-xs-12 text-center'><i class='fa fa-refresh fa-spin'></i> Mengambil kategori...</p>")
	$.getJSON(target_url+'categories/refresh', function(result){
		$("#category-list").empty();
		console.log(result);
		for(var i = 0; i < result.length; i++) {
			var obj = result[i];
			$("#category-list").append("<tr><td><i class='fa fa-circle' style='color:"+obj.colour+"'></i></td><td>"+obj.name+"</td><td class='text-right'><button class='btn btn-primary btn-xs' data-kategori='"+obj.name+"' data-kategoris='"+obj.id+"' data-dismiss='modal' aria-label='Close'>pilih kategori</button></td></tr>");
		}
	});
}

function addCategory() {
	ajax_config();
	$.post(target_url+'categories/add',
	{
		_method: 'POST',
		_token: token,
		name: $('#category_name').val(),
		colour: $('#category_colour').val()
	},
	function(data, status){
		if (status == 'success') {
            $('#tabel-kategori').find("#category-list").append("<tr><td><i class='fa fa-circle' style='color:"+data.category_colour+"'></i></td><td>"+data.category_name+"</td><td class='text-right'><button class='btn btn-primary btn-xs' data-kategori='"+data.category_name+"' data-kategoris='"+data.category_id+"' data-dismiss='modal' aria-label='Close' onclick='setCategoryField("+(data.category_name).toString()+","+String(data.category_id)+")'>pilih kategori</button></td></tr>").fadeIn('slow');
		}else{
            alert('Kategori Tidak Berhasil Masuk ke DB');
		}
	});
}

function delete_category(id) {
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
			alert('Kategori Gagal Dihapus');
		}
	});
}