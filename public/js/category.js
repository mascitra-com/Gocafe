var menket = (function(){
    $("#menkat #menu > li").on('mouseenter', eventMouseIn);
    $("#menket").on('mouseleave', eventMouseOut);
    $("*:not(#menket *)").on('mouseleave', eventMouseOut);

    function eventMouseIn(e) {
        eventMouseOut(e);
        var content_class = $(e.currentTarget).data('content');
        $(content_class).addClass('content-show');
    }

    function eventMouseOut(e) {
        $("#menkat .content-value").removeClass('content-show');
    }
})();