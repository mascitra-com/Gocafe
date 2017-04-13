$(document).on('click', 'button.deleteMenu', function () { // <-- changes
    var price = $(this).closest("tr").find("label.price").html();
    price = price.replace('Rp. ', '').replace('\.','').replace('\.','');
    var total = $("label.total").html();
    total = parseInt(total.replace('Rp. ', '').replace('\.','').replace('\.',''));
    var new_total = parseInt(total) - parseInt(price);
    new_total = 'Rp. ' + $.number(new_total, 0, '', '.');
    $("label.total").html(new_total);
    $(this).closest('tr').remove();
    return false;
})
    .on('click', 'button.increase', function () { // <-- changes
        // Get Amount and Increase by 1
        var amount = parseInt($(this).closest("tr").find("input.input-xs").val());
        $(this).closest("tr").find("input.input-xs").val(amount + 1);
        // Get Price and Increase by Amount x Price
        var price = $(this).closest("tr").find("label.price").html();
        price = price.replace('Rp. ', '').replace('\.','').replace('\.','');
        var new_price = (price / amount) * (amount + 1);
        new_price = 'Rp. ' + $.number(new_price, 0, '', '.');
        $(this).closest("tr").find("label.price").html(new_price);
        // Get Total and Sum with New Item
        var total = $("label.total").html();
        total = parseInt(total.replace('Rp. ', '').replace('\.','').replace('\.',''));

        var new_total = parseInt(total) + parseInt(price / amount);
        new_total = 'Rp. ' + $.number(new_total, 0, '', '.');
        $("label.total").html(new_total);
    })
    .on('click', 'button.decrease', function () { // <-- changes
        var amount = parseInt($(this).closest("tr").find("input.input-xs").val());
        if(amount > 1){
            $(this).closest("tr").find("input.input-xs").val(amount - 1);
            var price = $(this).closest("tr").find("label.price").html();
            price = price.replace('Rp. ', '').replace('\.','').replace('\.','');

            var new_price = (price / amount) * (amount - 1);
            new_price = 'Rp. ' + $.number(new_price, 0, '', '.');
            $(this).closest("tr").find("label.price").html(new_price);

            var total = $("label.total").html();
            total = parseInt(total.replace('Rp. ', '').replace('\.','').replace('\.',''));

            var new_total = parseInt(total) - parseInt(price / amount);
            new_total = 'Rp. ' + $.number(new_total, 0, '', '.');
            $("label.total").html(new_total);
        }
        return false;
    });
function showMenus(idCategory) {
    $.ajax({
        url: '/menus/getMenus/' + idCategory,
        dataType: 'json',
        success: function (response) {
            var menus = $('#menus').find('tbody').empty();
            $.each(response.menus, function (i, menu) {
                var id = menu.id;
                var name = menu.name;
                var price = $.number(menu.price, 0, '', '.');
                var markup = "<tr onclick=\"addToCheck('" + id + "')\" id='tr-menu' class='tr-selection text-quintuple'><td width='150px'><img src='" + getThumbnail(id) + "' class='img img-responsive' style='width: 150px;'></td><td>" + name + "</td><td class='price'>Rp. " + price + "</td></tr>";
                $("#menus").find('tbody').append(markup);
            });
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
                var id = menu.id;
                var name = menu.name;
                var price = 'Rp. ' + $.number(menu.price, 0, '', '.');
                var markup = "<tr><input type='hidden' name='id[]' value='"+id+"'><td><button class='deleteMenu'><i class='fa fa-times'></i></button></td><td>"+name+"</td><td class='input-group'><span class='input-group-btn'><button class='btn btn-default btn-xs decrease' type='button'><i class='fa fa-arrow-down'></i></button></span><input class='form-control input-xs' maxlength='' type='text'name='total[]' value='1' min='1' max='999' title='amount'/><span class='input-group-btn'><button class='btn btn-default btn-xs increase' type='button'><i class='fa fa-arrow-up'></i></button></span></td><td><label class='price' for='price'>"+price+"</label></td></tr>";
                var total = $("label.total").html();
                total = parseInt(total.replace('Rp. ', '').replace('\.','').replace('\.',''));
                var new_total = parseInt(total) + parseInt(price.replace('Rp. ', '').replace('\.','').replace('\.',''));
                new_total = 'Rp. ' + $.number(new_total, 0, '', '.');
                $("label.total").html(new_total);
                $("#bill").find('tbody').append(markup);
            });
        }
    });
}