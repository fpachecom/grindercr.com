$(document).ready(function(){    
    $("#contactForm").validate();
    
    // category-images-widget slider
    /*
    $('.category-images-widget').flexslider({
        animation: "slide",
        animationLoop: true,
        controlNav: false,
        minItems: 2,
        maxItems: 4,
        itemWidth: 209,
        itemMargin: 15
    });
    */
    /*	CarouFredSel: a circular, responsive jQuery carousel.
        Configuration created by the "Configuration Robot"
        at caroufredsel.dev7studios.com
    */
    $(".category-images-widget").carouFredSel({
        width: "100%",
        responsive: true,
        items: {
            visible: {
                min: 2,
                max: 4
            },
            width: 215
        },
        scroll: {
            easing: "swing",
            duration: 500
        },
        prev: {
            button  : ".flex-prev",
        },
        next: {
            button  : ".flex-next",
        },
        swipe: true
    });
    
    $(window).resize(function(){
        var $catHeight = $(".cat-slider-item img").height();
        $(".carousel-wrapper .caroufredsel_wrapper").height($catHeight);
    });
    
    /*$('.products-slider').flexslider({
        animation: "slide",
        animationLoop: true,
        controlNav: false,
        minItems: 2,
        maxItems: 5,
        itemWidth: 177,
        itemMargin: 0
    });
    */
    
    // hide reviews
    $('.commentlist li').each(function(i){
        i++;
        if (i >= 5) {$(this).addClass('hiddenReview');}
    });

    // Markup fixes
    /*var menuWidth = 0;
    $('#main-menu ul>li').each(function(){
        if($(this).width() > 0){
            menuWidth += $(this).width() + 12;
        }
    });
    var emptyPlace = $('body').width() - menuWidth;
    $('#main-menu').css('paddingLeft', (emptyPlace / 3)+'px' );
    */ 
    
    // Create a columns for second menu level
    $('#main-menu .sub-menu').autocolumnlist({ columns: 3, min: 4 });
    
    // Menu Sub nav
    $("#main-menu .sub-menu").each(function(){
        var elem = $(this).contents(".menu-col");
        var count = elem.size();
        $(this).attr("style", "width:"+(131*count-1)+"px");
    });
    
    // Add 'parent' class to LI, that have a sub-menu    
    $("#main-menu li.menu-item-depth-0").each(function(){
        var $thisObj = $(this);
        if ($thisObj.children('ul').hasClass('sub-menu')){$thisObj.addClass('first-level').append('<span class="menu-fixer"></span>');}
    });
    
    $("#main-menu ul.sub-sub-menu").each(function(){
        var $thisObj = $(this);
        $thisObj.parent().append('<span class="sub-corner"></span>');
    });
    
    // Mobile menu
    $('.mobile-menu').change(function(){
        location = $(this).val();
    });
    
    $('.mobile-menu option').each(function(){
        if ($(this).val() == $(location).attr('href')) $(this).attr('selected', 'selected');
    });
    
    $("#user-menu").hover(function() {
        $(this).contents("ul.user-menu-items").stop(1,1).show('fast');
    
        $(this).hover(function() {
        }, function(){
            $(this).parent().find("ul.user-menu-items").hide(200);
        });
    });
    
    $("#main-menu li").hover(function() {
        var $thisUl = $(this).contents("ul.sub-menu");
        if ($thisUl.hasClass('menu-depth-1')){
            $thisUl.stop(1,1).slideDown('fast');
        } else {
            if ($thisUl.hasClass('sub-sub-menu')){
                $thisUl.parent().find('.sub-corner').stop(1,1).fadeIn('fast');
                $thisUl.find('.sub-corner').hide();
                $thisUl.stop(1,1).fadeIn('fast');
            }
        }
    
        $(this).hover(function() {
        }, function(){
            var $thisUl = $(this).contents("ul.sub-menu");
            if ($thisUl.hasClass('menu-depth-1')){
                $thisUl.stop(1,1).slideUp('fast');
            } else {
                if ($thisUl.hasClass('sub-sub-menu')){
                    $thisUl.parent().find('.sub-corner').fadeOut('fast');
                    $thisUl.fadeOut('fast');
                }
            }
        });
    });
    
    // Add classes for categories slider
    var i = 0;
    $('.category-images-widget li').each(function(){
        i++;
        if (i==2 || i==4 || i==6 || i==8 || i==10 || i==12 || i==14 || i==16 || i==18 || i==20 || i==22) {$(this).addClass('slider-cat-name-white');}
        else
            if (i==1 || i==5 || i==9 || i==13 || i==17 || i==21) {$(this).addClass('slider-cat-name-blue');}
            else
                if (i==3 || i==7 || i==11 || i==15 || i==19 || i==23) {$(this).addClass('slider-cat-name-dark');}
    });
    
    $('.cat-slider-item').mouseenter(function() {
        $(this).find('.slider-cat-name').stop(1,1).show().animate({bottom: '4px', opacity: 1}, 500);
    });
    
    $('.cat-slider-item').mouseleave(function() {
        $(this).find('.slider-cat-name').animate({bottom: '-50px', opacity: 0}, 600).hide();
    });
    
    $('.bestsellers-widget .slider-line .content-slider').each(function(){
        var ElemCount = $(this).find('li').length;
        var $thisObj = $(this);
        if (ElemCount <= 5) {
            $thisObj.parent().parent().find('.prev').hide();
            $thisObj.parent().parent().find('.next').hide();
        }
    });
    
    $('.category-images-widget .slider-line .content-slider').each(function(){
        var ElemCount = $(this).find('li').length;
        var $thisObj = $(this);
        if (ElemCount <= 4) {
            $thisObj.parent().parent().find('.prev').hide();
            $thisObj.parent().parent().find('.next').hide();
        }
    }); 
    
    // gallery
    $("#single-gallery ul li a").mouseenter(function(e){        
        $(this).find("img").animate({opacity:0.7},300);
    });
    
    $("#single-gallery ul li a").mouseleave(function(){
        $(this).find("img").animate({opacity:1},300);
    });
    
    $("#imgslider a").attr("href",$(".product_slider ul li:first-child a").attr("alt"));
    
    $("#single-gallery ul li a").click(function(e){
        e.preventDefault();
        var src = $(this).attr("href");
        var srcBig = $(this).attr("alt");
        
        $("#all-prod-images a").each(function(){
            var link = $(this).attr('href');
            if (link == srcBig) {
                $(this).attr("rel"," ");
            } else {
                $(this).attr("rel","lightbox[product]");
            }
        });
        
        $("#imgslider .back-img").animate({opacity: 0}, 250, function(){
            $("#imgslider .back-img").attr("src", src).delay(500);
            $("#imgslider a").attr("href", srcBig);
            $("#imgslider .back-img").animate({opacity: 1},250);
        });        
    });
    
    $("#imgslider a").hover(function() {
        $(this).find(".zoom").stop(1,1).animate({top:"50%", opacity:1},300);
    
        $(this).hover(function() {
        }, function(){
            $(this).find(".zoom").animate({top:"70%", opacity:0},300);;
        });
    });
    
    $('.news-image').mouseenter(function() {
        var $thisObj = $(this);
        $thisObj.find('.news-image-title').stop(1,1).animate({bottom: 0, opacity: 1}, 500);
        $thisObj.find('.zoom').stop(1,1).animate({marginTop:-70, opacity: 1}, 500);
        $thisObj.find('.zoom a').stop(1,1).show().animate({opacity: 1}, 500);
    });
    
    $('.news-image').mouseleave(function() {
        var $thisObj = $(this);
        $thisObj.find('.news-image-title').animate({bottom: '-50px', opacity: 0}, 600);
        $thisObj.find('.zoom').animate({marginTop:0, opacity: 0}, 600);
        $thisObj.find('.zoom a').animate({opacity: 1}, 500);
    });
    
    $('.product-item-thumb').mouseenter(function() {
        var $thisObj = $(this);
        $(this).find('.product-item-descr').stop(1,1).animate({bottom: 0, opacity: 1}, 500);
        $thisObj.parent().find('.product-link').css('color','#4f9ef4');
    });
    
    $('.product-item-thumb').mouseleave(function() {
        var $thisObj = $(this);
        $(this).find('.product-item-descr').animate({bottom: '-50px', opacity: 0}, 500);
        $thisObj.parent().find('.product-link').css('color','#484848');
    });
    
    $('.change-to-list-view').click(function(e){
        e.preventDefault();
        $('.change-to-grid-view').removeClass('current-catalog-view');
        $(this).addClass('current-catalog-view');
        $('.product-list .grid').removeClass('current-catalog-view').hide();
        $('.product-list .list').addClass('current-catalog-view').fadeIn(700);
        $.cookie("catalogView", "list", {expires: 7, path: '/'});
    });
    
    $('.change-to-grid-view').click(function(e){
        e.preventDefault();
        $('.change-to-list-view').removeClass('current-catalog-view');
        $(this).addClass('current-catalog-view');
        $('.product-list .list').hide();
        $('.product-list .grid').fadeIn(700);
        $.cookie("catalogView", "grid", {expires: 7, path: '/'});
    });
    
    $('.current-catalog-view').click(function(e){e.preventDefault();});
    
    $(".back-to-top").click(function(e){
        e.preventDefault();
        var targetOffset = $("body").offset().top;
        $("html,body").stop().animate({
            scrollTop: targetOffset
        }, 1000 );
    });
    
    $('#go-up').click(function(){
        var $thisObj = $(this);
        var $list = $thisObj.parent().find('ul');
        var itemH = 95;
        var countItem = $list.find('li').length;
        var bottom = countItem*itemH -(4*itemH) + "px";
        
        if ($list.css('marginTop') == "-"+bottom){
            $list.stop(1,1).animate({marginTop: "0px"}, 300);
        } else {
            var up = ($list.css('marginTop').replace('px',''))*1 - itemH; 
            $list.stop(1,1).animate({marginTop: up+"px"}, 300);
        }
    });
    
    $('#go-down').click(function(){
        var $thisObj = $(this);
        var $list = $thisObj.parent().find('ul');
        var itemH = 95;
        var countItem = $list.find('li').length;
        var bottom = countItem*itemH -(4*itemH) + "px";
        
        if ($list.css('marginTop') == 0+"px"){
            $list.stop(1,1).animate({marginTop: "-"+bottom}, 300);
        } else {
            var up = ($list.css('marginTop').replace('px',''))*1 + itemH; 
            $list.stop(1,1).animate({marginTop: up+"px"}, 300);
        }
    });
    
    $('.toeAddToCartMsg').click(function(){
        $(this).text('');
    });
    
    
});