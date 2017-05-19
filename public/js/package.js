var hostname = window.location.hostname;
var data = [];
var menu_id = [];

$('.btn-tambah').click(function(){
    $input = $("input[list='data-list']").val();
    if ($input) {
        var id = $input.split("|");
        data.push($input);
        menu_id.push(id[1]);
        refresh();
        $("input[list='data-list']").val('');
    }else{
        alert('Pilih menu terlebih dahulu!');
    }
});

$("tbody").delegate('.btn-remove','click', function(){
    var ind = $(this).data('index');
    if (ind > -1) {
        data.splice(ind, 1);
    }
    refresh();
});

function refresh() {
    $(".table-menu > tbody").empty();
    data.forEach(function (item, index) {
        var data = item.split("|");
        var html = "<tr><td><img src='"+ getThumbnail(data[1]) +"' alt='thumbnail' class='menu-thumbnail'></td>";
        html+= "<td><h4>"+ item +"</h4><p>"+ "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, deleniti." +"</p></td>";
        html+= "<td><span class='label label-success'>"+ "Rp 10.000" + "</span></td>"
        html+= "<td class='text-nowrap'><button class='btn btn-default btn-xs' data-index='" + (index) + "' type='button'><i class='fa fa-ellipsis-h'></i></button>";
        html+= "<button class='btn btn-default btn-xs  btn-remove' data-index='" + (index) + "' type='button'><i class='fa fa-times text-red'></i></button></td></tr>";
        $(".table-menu > tbody").append(html);
    });
}

$('form').on('submit', function(e){
    e.preventDefault();
    $.post('/packages',
        {
            _method: 'POST',
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: $("input[name='name']").val(),
            description: $("textarea[name='description']").val(),
            price: $("input[name='price']").val(),
            menus_id: menu_id
        },
        function(data, status){
            if (status) {
                alert('Input paket Berhasil');
                window.location.href = "";
            }else{
                alert('Input paket gagal');
            }
        });
});

function getThumbnail(idMenu) {
    return "http://"+ hostname + "/menus/showThumbnail/" + idMenu;
}