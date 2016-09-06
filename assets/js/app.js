(function($){
	$('#header_icon').on('click', function(e){
		e.preventDefault();
		$('body').toggleClass('with_sidebar');
	}); 	
	$('.site-cache').on('click', function(e){
		$('body').removeClass('with_sidebar');
	});
	
	
	$("tabs-x").tabsX({
		enableCache: true,
		maxTitleLength: 10
	});

    $("tabs-x-2").tabsX({
        enableCache: true,
        maxTitleLength: 10
    });

    $('#myModal').on('hide.bs.modal', function(e) {
        $('.modal-content').html('');
        $(this).removeData('bs.modal');
    });
})(jQuery);

