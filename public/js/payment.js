$("tr.credit_card").hide();
$('input#cash_received').number(true, 0, ',', '.');
$('input#refund').number(true, 0, ',', '.');

function validateForm() {
    var table_number = document.getElementById("table_number").value;
    if(!table_number) {
        alert('Silahkan Pilih Nomor Meja!')
    }
    return !!table_number;
}

function update_refund() {
    var cash_received = $('input#cash_received').val()
    var total_payment = $("label.final").html();
    total_payment = parseInt(total_payment.replace('Rp. ', '').replace('\.', '').replace('\.', ''));
    var refund = cash_received - total_payment;
    $('input#refund').val(refund);
}

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
    update_refund();
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
        update_refund();
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
            update_refund();
        }
        return false;
    }).on('click', 'input#cash', function () { // <-- changes
        $("tr.cash").show();
        $("tr.credit_card").hide();
    }).on('click', 'input#credit', function () { // <-- changes
        $("tr.credit_card").show();
        $("tr.cash").hide();
    }).on('keyup', 'input#cash_received', function () { // <-- changes
        update_refund();
    });

function showMenus(idCategory) {
    var menus = $('#menus').find('tbody').empty();
    $.ajax({
        url: '/menus/getMenus/' + idCategory,
        dataType: 'json',
        success: function (response) {
            $.each(response.menus, function (i, menu) {
                var id = menu.id;
                var name = menu.name;
                var price = $.number(menu.price, 0, '', '.');
                var discount = "(- Rp. " + $.number(menu.price * menu.discount, 0, '', '.') + ")";
                var markup = "<tr onclick=\"addMenuToCheck('" + id + "')\" id='tr-menu' class='tr-selection text-quintuple'><td width='150px'><img src='"+menu.thumbnail+"' class='img img-responsive' style='width: 150pt;'></td><td>" + name + "</td><td class='price text-right'>Rp. " + price + " <br>"+ (discount != '(- Rp. 0)' ? discount  : '') +"</td></tr>";
                $("#menus").find('tbody').append(markup);
            });
        }
    });
}

function showPackages() {
    var menus = $('#menus').find('tbody').empty();
    $.ajax({
        url: '/packages/getPackages/',
        dataType: 'json',
        success: function (response) {
            $.each(response.packages, function (i, package) {
                var id = package.id;
                var name = package.name;
                var thumbnailId = package.menus[0].id;
                var price = $.number(package.price, 0, '', '.');
                var markup = "<tr onclick=\"addPackageToCheck('" + id + "')\" id='tr-menu' class='tr-selection text-quintuple'><td width='150px'><img src='" + getThumbnail(thumbnailId) + "' class='img img-responsive' style='width: 150pt;'></td><td>" + name + "</td><td class='price text-right'>Rp. " + price + "</td></tr>";
                $("#menus").find('tbody').append(markup);
            });
        }
    });
}

function set_new_final_payment() {
    var final = parseInt($("label.total").html().replace('Rp. ', '').replace('\.', '').replace('\.', '')) - parseInt($("label.discount").html().replace('- Rp. ', '').replace('\.', '').replace('\.', ''));
    final = 'Rp. ' + $.number(final, 0, '', '.');
    $("label.final").html(final);
}

function addMenuToCheck(idMenu, amount) {
    $.ajax({
        url: '/menus/getMenu/' + idMenu,
        dataType: 'json',
        success: function (response) {
            $.each(response.menu, function (i, menu) {
                var id = menu.id;
                var name = menu.name;
                var discount = menu.price * menu.discount;
                if (!discount) {
                    discount = 0;
                }
                var price;
                var count;
                if(amount) {
                    count = amount;
                    price = 'Rp. ' + $.number(menu.price * amount, 0, '', '.');
                } else {
                    count = 1;
                    price = 'Rp. ' + $.number(menu.price, 0, '', '.');
                }
                var markup = "<tr><input type='hidden' name='ids_menu[]' value='" + id + "'><input type='hidden' class='discount' value='" + discount + "'><td><button class='deleteMenu'><i class='fa fa-times'></i></button></td><td>" + name + "</td><td class='input-group'><span class='input-group-btn'><button class='btn btn-default btn-xs decrease' type='button'><i class='fa fa-arrow-down'></i></button></span><input class='form-control input-xs' maxlength='' type='text' name='amount[]' value='"+count+"' min='1' max='999' title='amount' readonly/><span class='input-group-btn'><button class='btn btn-default btn-xs increase' type='button'><i class='fa fa-arrow-up'></i></button></span></td><td><label class='price' for='price'>" + price + "</label></td></tr>";
                $("#bill").find('tbody').append(markup);
                // Set Total Payment
                set_total_payment(price);
                set_new_discount(discount, true);
                set_new_final_payment();
                update_refund();
            });
        }
    });
}

function addPackageToCheck(idPackage, amount) {
    $.ajax({
        url: '/packages/getPackage/' + idPackage,
        dataType: 'json',
        success: function (response) {
            $.each(response.package, function (i, package) {
                var id = package.id;
                var name = package.name;
                var price;
                var count;
                if(amount) {
                    count = amount;
                    price = 'Rp. ' + $.number(package.price * amount, 0, '', '.');
                } else {
                    count = 1;
                    price = 'Rp. ' + $.number(package.price, 0, '', '.');
                }
                var markup = "<tr><input type='hidden' name='ids_menu[]' value='" + id + "'><td><button class='deleteMenu'><i class='fa fa-times'></i></button></td><td>" + name + "</td><td class='input-group'><span class='input-group-btn'><button class='btn btn-default btn-xs decrease' type='button'><i class='fa fa-arrow-down'></i></button></span><input class='form-control input-xs' maxlength='' type='text' name='amount[]' value='"+count+"' min='1' max='999' title='amount' readonly/><span class='input-group-btn'><button class='btn btn-default btn-xs increase' type='button'><i class='fa fa-arrow-up'></i></button></span></td><td><label class='price' for='price'>" + price + "</label></td></tr>";
                $("#bill").find('tbody').append(markup);
                // Set Total Payment
                set_total_payment(price);
                set_new_final_payment();
                update_refund();
            });
        }
    });
}

function set_total_payment(price) {
    var total = $("label.total").html();
    total = parseInt(total.replace('Rp. ', '').replace('\.', '').replace('\.', ''));
    var new_total = parseInt(total) + parseInt(price.replace('Rp. ', '').replace('\.', '').replace('\.', ''));
    new_total = 'Rp. ' + $.number(new_total, 0, '', '.');
    $("label.total").html(new_total);
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

function getThumbnail(idMenu) {
    return "http://gocafe.dev/menus/showThumbnail/" + idMenu;
}