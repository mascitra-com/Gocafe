$(document).on('click', 'button#reset', function () { // <-- changes
    $('#bill').find('tbody').empty();
    $("label.total").html('Rp. 0');
    $("label.discount").html('Rp. 0');
    $("label.final").html('Rp. 0');
}).on('click', 'button.deleteMenu', function () {
    // Get Price of the item
    var price = $(this).closest("tr").find("label.price").html();
    price = price.replace('Rp. ', '').replace('\.', '').replace('\.', '');
    // Set New Total
    var total = $("label.total").html();
    total = parseInt(total.replace('Rp. ', '').replace('\.', '').replace('\.', ''));
    var new_total = parseInt(total) - parseInt(price);
    new_total = 'Rp. ' + $.number(new_total, 0, '', '.');
    $("label.total").html(new_total);
    // Set New Discount
    var discount = $(this).closest("tr").find("input.discount").val();
    var amount = $(this).closest("tr").find("input.input-xs").val();
    set_new_discount(discount * amount, false);
    // Set New Final Payment
    set_new_final_payment();
    $(this).closest('tr').remove();
})
    .on('click', 'button.increase', function () { // <-- changes
        // Get Amount and Increase by 1
        var amount = parseInt($(this).closest("tr").find("input.input-xs").val());
        $(this).closest("tr").find("input.input-xs").val(amount + 1);
        // Get Price and Increase by Amount x Price
        var price = $(this).closest("tr").find("label.price").html();
        price = price.replace('Rp. ', '').replace('\.', '').replace('\.', '');
        var new_price = (price / amount) * (amount + 1);
        new_price = 'Rp. ' + $.number(new_price, 0, '', '.');
        $(this).closest("tr").find("label.price").html(new_price);
        // Get Total and Sum with New Item
        var total = $("label.total").html();
        total = parseInt(total.replace('Rp. ', '').replace('\.', '').replace('\.', ''));

        var new_total = parseInt(total) + parseInt(price / amount);
        new_total = 'Rp. ' + $.number(new_total, 0, '', '.');
        $("label.total").html(new_total);
        // Set New Discount
        var discount = $(this).closest("tr").find("input.discount").val();
        set_new_discount(discount, true);
        // Set New Final Payment
        set_new_final_payment();
    })
    .on('click', 'button.decrease', function () { // <-- changes
        var amount = parseInt($(this).closest("tr").find("input.input-xs").val());
        if (amount > 1) {
            $(this).closest("tr").find("input.input-xs").val(amount - 1);
            var price = $(this).closest("tr").find("label.price").html();
            price = price.replace('Rp. ', '').replace('\.', '').replace('\.', '');

            var new_price = (price / amount) * (amount - 1);
            new_price = 'Rp. ' + $.number(new_price, 0, '', '.');
            $(this).closest("tr").find("label.price").html(new_price);

            var total = $("label.total").html();
            total = parseInt(total.replace('Rp. ', '').replace('\.', '').replace('\.', ''));

            var new_total = parseInt(total) - parseInt(price / amount);
            new_total = 'Rp. ' + $.number(new_total, 0, '', '.');
            $("label.total").html(new_total);
            // Set New Discount
            var discount = $(this).closest("tr").find("input.discount").val();
            set_new_discount(discount, false);
            // Set New Final Payment
            set_new_final_payment();
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
                var markup = "<tr onclick=\"addToCheck('" + id + "')\" id='tr-menu' class='tr-selection text-quintuple'><td width='150px'><img src='" + getThumbnail(id) + "' class='img img-responsive' style='width: 150px;'></td><td>" + name + "</td><td class='price text-right'>Rp. " + price + "</td></tr>";
                $("#menus").find('tbody').append(markup);
            });
        }
    });
}

function getThumbnail(idMenu) {
    return "http://gocafe.dev/menus/showThumbnail/" + idMenu;
}

function set_new_final_payment() {
    var final = parseInt($("label.total").html().replace('Rp. ', '').replace('\.', '').replace('\.', '')) - parseInt($("label.discount").html().replace('- Rp. ', '').replace('\.', '').replace('\.', ''));
    final = 'Rp. ' + $.number(final, 0, '', '.');
    $("label.final").html(final);
}

function addToCheck(idMenu) {
    $.ajax({
        url: '/menus/getMenu/' + idMenu,
        dataType: 'json',
        success: function (response) {
            $.each(response.menu, function (i, menu) {
                var id = menu.id;
                var name = menu.name;
                var discount = menu.discount;
                if (!discount) {
                    discount = 0;
                }
                var price = 'Rp. ' + $.number(menu.price, 0, '', '.');
                var markup = "<tr><input type='hidden' name='id[]' value='" + id + "'><input type='hidden' class='discount' value='" + discount + "'><td><button class='deleteMenu'><i class='fa fa-times'></i></button></td><td>" + name + "</td><td class='input-group'><span class='input-group-btn'><button class='btn btn-default btn-xs decrease' type='button'><i class='fa fa-arrow-down'></i></button></span><input class='form-control input-xs' maxlength='' type='text'name='total[]' value='1' min='1' max='999' title='amount'/><span class='input-group-btn'><button class='btn btn-default btn-xs increase' type='button'><i class='fa fa-arrow-up'></i></button></span></td><td><label class='price' for='price'>" + price + "</label></td></tr>";
                $("#bill").find('tbody').append(markup);
                // Set Total Payment
                var total = $("label.total").html();
                total = parseInt(total.replace('Rp. ', '').replace('\.', '').replace('\.', ''));
                var new_total = parseInt(total) + parseInt(price.replace('Rp. ', '').replace('\.', '').replace('\.', ''));
                new_total = 'Rp. ' + $.number(new_total, 0, '', '.');
                $("label.total").html(new_total);
                set_new_discount(discount, true);
                set_new_final_payment();
            });
        }
    });
}

function set_new_discount(discount, increment) {
    var old_discount = $("label.discount").html();
    old_discount = parseInt(old_discount.replace('- Rp. ', '').replace('\.', '').replace('\.', ''));
    var new_discount = 0;
    if (increment) {
        new_discount = parseInt(old_discount) + parseInt(discount);
    } else {
        new_discount = parseInt(old_discount) - parseInt(discount);
    }
    new_discount = '- Rp. ' + $.number(new_discount, 0, '', '.');
    $("label.discount").html(new_discount);
}