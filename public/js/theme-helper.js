$(document).ready(function(){
	set_background_image();
});

function set_background_image()
{
	$(".background-img").each(function(){
		var location = $(this).data('image');
		$(this).css('background-image', 'url('+location+')');
	});
}