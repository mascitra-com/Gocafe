$(document).ready(function(){
	show_menu();
});

function show_menu()
{
	$("#btn-menu").click(function(){
		var menu = $(this).data('menu');
		$(menu).animate({width:'show'},250);
		// $(menu).css('display', 'block');

		$(".nav-close a").click(function(){
			$(menu).animate({width:'hide'},250);
			// $(menu).css('display', 'none');
		});
	});
}