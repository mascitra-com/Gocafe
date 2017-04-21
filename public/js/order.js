function showMenus(idCategory) {
    $.ajax({
        url: '/menus/getMenus/' + idCategory,
        dataType: 'json',
        success: function (response) {
            $('#product').empty();
            var markup = '';
            if(response.menus){
                $.each(response.menus, function (i, menu) {
                    var id = menu.id;
                    var name = menu.name;
                    markup += "<button class='rectangle product'><img src='"+ getThumbnail(id) + "' alt='Thumbnail'>" + name +"</button>";
                });
                $("#product").append(markup);
            }
        }
    });
}

function getThumbnail(idMenu) {
    return "http://gocafe.dev/menus/showThumbnail/" + idMenu;
}

function addToCheck(idMenu) {
    $.ajax({
        url: '/menus/getMenu/' + idMenu,
        dataType: 'json',
        success: function (response) {
            $.each(response.menu, function (i, menu) {

            });
        }
    });
}