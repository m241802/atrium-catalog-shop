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
        infinite: true,
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
        'width'           : 'auto',
        'height'          : 'auto',
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
    // there's the gallery and the selected_images
    var $gallery = $( "#gallery" ),
            $selected_images = $( "#selected-images" );

    // let the gallery items be draggable
    $( "li", $gallery ).draggable({
        cancel: "a.ui-icon", // clicking an icon won't initiate dragging
        revert: "invalid", // when not dropped, the item will revert back to its initial position
        containment: "document",
        helper: "clone",
        cursor: "move"
    });

    // let the selected_images be droppable, accepting the gallery items
    $selected_images.droppable({
        accept: "#gallery > li",
        activeClass: "ui-state-highlight",
        drop: function( event, ui ) {
            deleteImage( ui.draggable );
        }
    });

    // let the gallery be droppable as well, accepting items from the selected_images
    $gallery.droppable({
        accept: "#selected-images li",
        activeClass: "custom-state-active",
        drop: function( event, ui ) {
            recycleImage( ui.draggable );
        }
    });

    // image deletion function
    var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
    function deleteImage( $item ) {
        $item.fadeOut(function() {
            var $list = $( "ul", $selected_images ).length ?
                    $( "ul", $selected_images ) :
                    $( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $selected_images );

            $item.find( "a.ui-icon-selected-images" ).remove();
            $item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
                $item
                        .animate({ width: "48px" })
                        .find( "img" )
                        .animate({ height: "36px" });
            });
        });
    }

    // image recycle function
    var selected_images_icon = "<a href='link/to/selected-images/script/when/we/have/js/off' title='Delete this image' class='ui-icon ui-icon-selected-images'>Delete image</a>";
    function recycleImage( $item ) {
        $item.fadeOut(function() {
            $item
                    .find( "a.ui-icon-refresh" )
                    .remove()
                    .end()
                    .css( "width", "96px")
                    .append( selected_images_icon )
                    .find( "img" )
                    .css( "height", "72px" )
                    .end()
                    .appendTo( $gallery )
                    .fadeIn();
        });
    }

    // image preview function, demonstrating the ui.dialog used as a modal window
    function viewLargerImage( $link ) {
        var src = $link.attr( "href" ),
                title = $link.siblings( "img" ).attr( "alt" ),
                $modal = $( "img[src$='" + src + "']" );

        if ( $modal.length ) {
            $modal.dialog( "open" );
        } else {
            var img = $( "<img alt='" + title + "' style='display: none; padding: 8px;' />" )
                    .attr( "src", src ).appendTo( "body" );
            setTimeout(function() {
                img.dialog({
                    title: title,
                    width: 'auto',
                    modal: true
                });
            }, 1 );
        }
    }

    // resolve the icons behavior with event delegation
    $( "ul.gallery > li" ).click(function( event ) {
        var $item = $( this ),
                $target = $( event.target );

        if ( $target.is( "a.ui-icon-selected-images" ) ) {
            deleteImage( $item );
        } else if ( $target.is( "a.ui-icon-zoomin" ) ) {
            viewLargerImage( $target );
        } else if ( $target.is( "a.ui-icon-refresh" ) ) {
            recycleImage( $item );
        }

        return false;
    });
/*sortable*/
    $( "#sortable1, #sortable2" ).sortable({
        connectWith: ".connectedSortable"
    }).disableSelection();
    $( "ul.connectedSortable > li" ).click(function( event ) {
        var $item = $( this ),
                $target = $( event.target );

        if ( $target.is( "a.ui-icon-selected-images" ) ) {
            deleteImage( $item );
        } else if ( $target.is( "a.ui-icon-zoomin" ) ) {
            viewLargerImage( $target );
        } else if ( $target.is( "a.ui-icon-refresh" ) ) {
            recycleImage( $item );
        }

        return false;
    });
    $( '#cats-not-in' ).on( 'click', function() {

        //.....
        //show some spinner etc to indicate operation in progress
        //.....

        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "cat_id": $( this ).find( 'input[name=cat_id]' ).val()                
            },
            function( data ) {
                //do something with data/response returned by server
            },
            'json'
        );

        //.....
        //do anything else you might want to do
        //.....

        //prevent the form from actually submitting in browser
        return false;
    } );

});