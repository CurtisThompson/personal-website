$('textarea').on('keydown', function(e){

    if(e.which == 13) {
    	e.preventDefault();
    }

}).on('input', function(){
    $(this).height(1);
    var totalHeight = $(this).prop('scrollHeight') - parseInt($(this).css('padding-top')) - parseInt($(this).css('padding-bottom'));
    $(this).height(totalHeight);
});