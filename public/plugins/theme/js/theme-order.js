$(document).ready(function(){
	$("#order-list > li").on("click", function(){
		$(this).find(".btn-remove-cart").addClass('show');
		$(this).find(".btn-remove-cart").removeClass('show');
	});
});