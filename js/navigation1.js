
$(document).ready(function(){
	var scrollLink = $('.scroll');
	
	//smooth scrolling
	scrollLink.click(function(e)	{
		e.preventDefault();	
		console.log($(".navbar").height());
		$('body, html').animate({
			scrollTop:$(this.hash).offset().top - $(".navbar").height() -10
			//$(".navbar-collapse").css({ maxHeight: $(window).height() - $(".navbar-header").height() + "px" });
		}, 1000);
	});
	
	//Active link switching
	$(window).scroll(function(){
		var scrollbarLocation = $(this).scrollTop();

		scrollLink.each(function(){
			var sectionOffset = $(this.hash).offset().top - $(".navbar").height() - 20
			
			if(sectionOffset <= scrollbarLocation){
				 $(this).parent().addClass('active');
				 $(this).parent().siblings().removeClass('active');
			}
		});
		
		if(scrollbarLocation)		{
			$('nav').addClass('sticky-top');
		}
		else{
			$('nav').removeClass('sticky-top');
		}
	});
});

