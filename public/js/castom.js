(function ($) {
    $(document).ready(function(){
     	$('.slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,              
			autoplaySpeed: 8000, 
			prevArrow: '<span class="slick-prev"></span>',
			nextArrow: '<span class="slick-next"></span>'
		});
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,            
            adaptiveHeight: true,
            speed: 500,
            cssEase: 'linear',
            asNavFor: '.product-gallery'
        });
        $('.product-gallery').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            prevArrow: '<div class="slider-arrow prev-arrow" style="display: inline-block;"><span></span></div>',
            nextArrow: '<div class="slider-arrow next-arrow" style="display: inline-block;"><span></span></div>'
        });
        $('.import_arr').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            draggable: false,
            prevArrow: '',
            nextArrow: ''
        });
        $("a[rel=example_group]").fancybox({
            'transitionIn'    : 'none',
            'transitionOut'   : 'none',
            'titlePosition'   : 'over',
            'minWidth'        : 'auto',
            'minHeight'       : 'auto',
            'autoScale'       : false,
            'autoSize'        : false,
            'titleFormat'   : function(title, currentArray, currentIndex, currentOpts) {
                return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
            }
        });
        $( ".click-cat" ).click(function() {
            $( this ).toggleClass("show-child");
            $( this ).toggleClass("no-show-child");            
            $( this ).parent('li').children('ul').toggleClass("display-none");
            $( this ).parent('li').children('a').children('h4').toggleClass("cat-item-active");
        });        
        $( ".toggle-stock-info" ).click(function() {
            $(".wrapp-stock-info").toggleClass("display-none");
        });        
        if(location.href == "http://atrium-ceramic.ru/shop/category/Ravak") {
            $(".wrapp-stock-info").removeClass("display-none");
        }        
        var widget_id = 'f9Vu0xmcSD';
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);
    });
}(jQuery));
