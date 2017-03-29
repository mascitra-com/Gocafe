$(document).ready(function(){
	show_menu();
	$("input[type='date']").attr('type', 'text').datepicker();
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