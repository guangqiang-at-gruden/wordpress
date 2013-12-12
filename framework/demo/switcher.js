// using "jQuery" here instead of the dollar sign will protect against conflicts with other libraries like MooTools
jQuery(document).ready(function () {
    //Set default Jacked ease
    jQuery.easing.def = "easeOutExpo";
    jQuery.styleSwitcher();
    reload_styleswitcher_data_by_cookies();
});
// plugin structure used so we can use the "$" sign safely
(function ($) {
    //main vars
    var switcher,
    browser,
    isMobile,
    isIE8;
    
    //Blur vars
    var blurRadius;
    var IEBlurRadius;
    var supportsCanvas;
    var browser;

    //bg
    var img;
    var imgWidth;
    var imgHeight;
    var winWidth;
    var winHeight;
    var widthRatio;
    var heightRatio;
    var widthDiff;
    var heightDiff;
    var scrollTop;
    var bgImage;
    var bgType;
    var bgImg;
    var contWidth;
	var colorCookie;
    
    var boxed;
    
    // class constructor / "init" function
    $.styleSwitcher = function () {
        browser = Jacked.getBrowser();
        isMobile = (Jacked.getMobile() == null) ? false : true;
        isIE8 = Jacked.getIE();
        
        boxed = false;
        
        supportsCanvas = (document.createElement("canvas").getContext) ? true: false;
        blurRadius = 50;
        IEBlurRadius = 25;
        scrollTop = 0;
        
        contWidth = $('.container').width();
		
		//container
        switcher = $('.styleSwitcherWrapper');
		
		//cookies
		handleEmptyCookies();
        
        
        if(isMobile){
            switcher.remove();
        }
        else{
            if($('body').hasClass('boxed')){
               boxed = true;
               loadBgImage('http://demo.freshface.net/file/wgc/wp/wp-content/uploads/2013/02/skyline.jpg');
            }
            initSwitcher();
            initToggle();
            
        }
    }
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //INITIATE STYLE SWITCHER
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function handleEmptyCookies() {
		
		
		//check if color cookie is empty
		var colorCookie = getCookie('tmplColor');
		
		if(!colorCookie){
		   var colorCss = $('#wg-colors-css').attr('href');
		   
		   switcher.find('.styleSwitcherColors a').each(function () {
				var t = $(this);
				var img = t.find('img');
                var c = t.attr('data-value');
				
				if(colorCss.indexOf(c) != -1){
					img.addClass('selected');
				}
		   });
		}
		
		
		//check if pattern cookie is empty
		var patternCookie = getCookie('tmplPattern');
		
		if(!patternCookie){
			
			var cont = $('.container');
			
			//first check if bg is pattern
			if(cont.attr('data-backgroundType') == "pattern"){
				   
				   var ar = new Array();
				   ar = cont.attr('data-backgroundImage').split('/');
				   var pt = ar[ar.length-1].split('.png')[0];
				   
				   switcher.find('.styleSwitcherPatterns a').each(function () {
						var t = $(this);
						var img = t.find('img');
						var c = t.attr('data-value');
						
						if(c == pt){
							img.addClass('selected');
						}
				   });
		   
			}
		}
		
		
		//check if layout cookie is empty
		var layoutCookie = getCookie('tmplLayout');
		
		if(!layoutCookie){
		   var isFull = $('body').hasClass('fullwidth');
		   
		   if(isFull){
			   $('.switcherFull img').addClass('selected');
		   }
		   else{
			   $('.switcherBoxed img').addClass('selected');
		   }
		}
		
	}
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    //INITIATE STYLE SWITCHER
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function initSwitcher() {
        var headerBlur = $('#blurMask');
        
        var bgImg = $('#bgImage');
        //colors
        switcher.find('.styleSwitcherColors a').each(function () {
            var t = $(this);
            var c = t.attr('data-value');
            var css = template_directory_uri + "/css/colors/" + c + "Theme.css";
            t.click(function (e) {
                e.preventDefault();
                var target = $(this);
                var img = target.find('img');
                if (!img.hasClass('selected')) {
                    //remove selected
                    switcher.find('.styleSwitcherColors').find('li img').removeClass('selected');
                    img.addClass('selected');
                    $('#wg-colors-css').remove();
                    $('head').append( "<link rel='stylesheet' id='wg-colors-css' href='"+css+"' type='text/css' media='all' />" )
                    c = $(this).attr('data-value');
                    logo_img = template_directory_uri + '/images/icons/' + c +  '/logo.png';
                    $('.logo img').attr('src',logo_img);
                    return false;
                }
            });
        });
        //solid bg colors
        switcher.find('.styleSwitcherSolidBg a').each(function () {
            var t = $(this);
            var c = t.attr('data-value');
            c = '#'+c;
            t.click(function (e) {
                e.preventDefault();
                $('#bgImage').css('visibility', 'hidden');
                headerBlur.css('visibility', 'hidden');
                var target = $(this);
                var img = target.find('img');
                if (!img.hasClass('selected')) {
                    //remove selected
                    switcher.find('.styleSwitcherPatterns li img, .styleSwitcherSolidBg li img').removeClass('selected');
                    img.addClass('selected');
                    $('body').css({
                      background: 'none'
                    });
                    $('body').css('background-color', c);
                    return false;
                }
            });
        });
        //pattern bg
        switcher.find('.styleSwitcherPatterns a').each(function () {
            var t = $(this);
            var c = t.attr('data-value');
            c = template_directory_uri + '/images/backgrounds/'+c+'.png';
            t.click(function (e) {
                e.preventDefault();
                $('#bgImage').css('visibility', 'hidden');
                headerBlur.css('visibility', 'hidden');
                var target = $(this);
                var img = target.find('img');
                if (!img.hasClass('selected')) {
                    //remove selected
                    switcher.find('.styleSwitcherSolidBg li img, .styleSwitcherPatterns li img').removeClass('selected');
                    img.addClass('selected');
                    $('body').css({
                      background: 'url(' + c + ') repeat 0 0'
                    });
                    return false;
                }
            });
        });
        //bg image
        switcher.find('.switcherBgImg').click(function (e) {
                e.preventDefault();
                switcher.find('.styleSwitcherSolidBg li img, .styleSwitcherPatterns li img').removeClass('selected');
                $('#bgImage').css('visibility', 'visible');
                headerBlur.css('visibility', 'visible');
                $('body').css({
                      background: 'none'
                });
                return false;
        });
        //layout
        var hb = $('body').find('.headerBg').not('.contactInfoItem .headerBg');
        var hcb = $('body').find('.headerContentBg');
        var cb = $('body').find('.contentBgFull');
        var fb = $('body').find('.footerBgFull');
        var sfb = $('body').find('.subFooterBgFull');
        var ct = $('body').find('.container');
        switcher.find('.styleSwitcherLayout a').each(function () {
            var t = $(this);
            var img = t.find('img');
            t.click(function () {
                if (!img.hasClass('selected')) {
                    switcher.find('.styleSwitcherLayout li img').removeClass('selected');
                    var btn = $(this);
                    img.addClass('selected');
                    var l = btn.attr('data-value');
                    if (l == 'boxed') {
                        boxed = true;
                        hb.removeClass('headerBg');
                        cb.css('visibility', 'hidden');
                        fb.removeClass('footerBgFull');
                        sfb.removeClass('subFooterBgFull');
                        hcb.css('visibility', 'hidden');
                        ct.css({
                          '-webkit-box-shadow': '0px 0px 10px rgba(0,0,0,0.1)',
                          '-moz-box-shadow': '0px 0px 10px rgba(0,0,0,0.1)',
                          'box-shadow': '0px 0px 10px rgba(0,0,0,0.1)'
                          
                        });
                        
                    } else {
                        boxed = false;
                        hb.addClass('headerBg');
                        cb.css('visibility', 'visible');
                        fb.addClass('footerBgFull');
                        sfb.addClass('subFooterBgFull');
                        hcb.css('visibility', 'visible');
                        ct.css({
                          '-webkit-box-shadow': 'none',
                          '-moz-box-shadow': 'none',
                          'box-shadow': 'none'
                          
                        });
                    }
                    
                    setFullBg();
                }
                return false;
            });
        });
    }

    function initToggle() {
        
        var switcherOpen = false;
        
        if( ! getCookie('tmplSwitcherClosed') ) {
            switcher.delay(1000).animate({
                    left: 0
                  }, 500);
            switcherOpen = true;
        }
        
        
        var btn = $('.styleSwitcherToggle');
        var w = switcher.outerWidth();

        btn.click(function (e) {
            e.preventDefault();
            switcher.animate({
                left: switcherOpen ? -w : 0
              }, 500);
            switcherOpen = !switcherOpen;
            setCookie('tmplSwitcherClosed',!switcherOpen);
        });
    }
    
    
    
    function loadBgImage(bgImg) {
        

        bg = $("<div />").css({
            position: "fixed",
            top: 0,
            left: 0,
            zIndex: -999
        }).appendTo($("body")),
        img = $("<img />").attr('id', 'bgImage').css({
            position: "absolute",
            display: "none"
        }).load(loaded).appendTo(bg);
        img.attr("src", bgImg);

    }

    function loaded(event) {

        event.stopPropagation();
        $('#blurMask').css('visibility', 'hidden');

        if (supportsCanvas && $('.headerWrapper').find('#blurMask').length > 0 && $('#fullwidthslider').length < 1) {
            stackBlurImage('bgImage', 'blurCanvas', blurRadius, false, 100);
        } else if ($('.container').find('#blurMask').length > 0){

            $(document.createElement("img")).attr({
                src: bgImage
            }).css({
                'float': 'left',
                'position': 'absolute',
                'left': -IEBlurRadius + 'px',
                'top': -IEBlurRadius + 'px',
                'width': getResizedImgWidth() + 'px',
                'height': getResizedImgHeight() + 'px',
                'filter': 'progid:DXImageTransform.Microsoft.Blur(pixelRadius=' + IEBlurRadius + ')',
                '-ms-filter': 'progid:DXImageTransform.Microsoft.Blur(pixelRadius=' + IEBlurRadius + ')'
            }).appendTo($('#blurMask'));

        }

        handleWindowResize();

        img.unbind("load", loaded).fadeIn().css('visibility', 'hidden');

        //initRevolutionBanner();

    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    //WINDOW RESIZE FUNCTIONS
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function calculateBgDimensions() {

        if (img) {

            imgWidth = img.width();
            imgHeight = img.height();

            winWidth = $(window).width();
            winHeight = $(window).height();

            widthRatio = winWidth / imgWidth;
            heightRatio = winHeight / imgHeight;

            widthDiff = heightRatio * imgWidth;
            heightDiff = widthRatio * imgHeight;
        }

    }

    function handleWindowResize() {

        calculateBgDimensions();
        
        //if(bgType == 'image'){
          resizeBgImage();
        //}

    }

    function resizeBgImage() {

        if (img) {
            img.css({
                width: getResizedImgWidth() + 'px',
                height: getResizedImgHeight() + 'px'
            });

        }
        if($('.headerWrapper').find('#blurMask').length > 0){
            if (supportsCanvas) {
                $('#blurCanvas').css({
                    width: getResizedImgWidth() + 'px',
                    height: getResizedImgHeight() + 'px',
                    position: 'absolute',
                    top: ($('.container').width() > 300) ? -90 + scrollTop + 'px': -200 + scrollTop + 'px',
                    left: -(winWidth - $('.container').width()) / 2
                });
            } else {
                if(!isIE8 || isIE8 && winWidth>1040){
                    $('#blurMask img').css({
                        'width': getResizedImgWidth() + 'px',
                        'height': getResizedImgHeight() + 'px',
                        position: 'absolute',
                        top: ($('.container').width() > 300) ? -90 - IEBlurRadius + scrollTop + 'px': -200 + scrollTop + 'px',
                        left: -(winWidth - $('.container').width()) / 2 - IEBlurRadius
        
                    });
                }
            }
        }

    }

    function getResizedImgWidth() {
		

        calculateBgDimensions();

        if (heightDiff > winHeight) {

            return winWidth;

        } else {

            return widthDiff;
        }
    }

    function getResizedImgHeight() {

        calculateBgDimensions();

        if (heightDiff > winHeight) {

            return heightDiff;

        } else {

            return winHeight;
        }

    }
    
    
    function setFullBg(){
        
        var contentBg = $('.contentBgFull');
        var tFooterBg = $('.footerBgFull');
        var sFooterBg = $('.subFooterBgFull');
        var hBg = $('.headerBg').not('.contactInfoItem .headerBg');
        var hcBg = $('.headerContentBg');
        var ct = $('.boxed .container');

        if( !boxed || contWidth<=420){
            

            var w = $(window).width();
            var l = (w-contWidth)/2;
            
            
            
            //main content bg
            contentBg.css({
                width: w + 'px',
                left: -l + 'px'
            });
            
            //top footer bg
            tFooterBg.css({
                width: w + 'px',
                left: -l + 'px'
            });
            
            //sub footer bg
            sFooterBg.css({
                width: w + 'px',
                left: -l + 'px'
            });
            
            hBg.css('visibility', 'visible');
            hcBg.css('visibility', 'visible');
            contentBg.css('visibility', 'visible');
            tFooterBg.css('visibility', 'visible');
            sFooterBg.css('visibility', 'visible');
            
            ct.css({
            '-webkit-box-shadow': '0px 0px 10px rgba(0,0,0,0)',
            '-moz-box-shadow': '0px 0px 10px rgba(0,0,0,0)',
            'box-shadow': '0px 0px 10px rgba(0,0,0,0)'
           })
             
        }
        else if(contWidth>420){
            hBg.css('visibility', 'hidden');
            hcBg.css('visibility', 'hidden');
            contentBg.css('visibility', 'hidden');
            tFooterBg.css('visibility', 'hidden');
            sFooterBg.css('visibility', 'hidden');
            
            ct.css({
            '-webkit-box-shadow': '0px 0px 10px rgba(0,0,0,0.1)',
            '-moz-box-shadow': '0px 0px 10px rgba(0,0,0,0.1)',
            'box-shadow': '0px 0px 10px rgba(0,0,0,0.1)'
           })
            
        }
    
    }
    

    /////////////////////////////////
    $(window).resize(function() {
                              
            contWidth = $('.container').width();              
            resizeBgImage();
            setFullBg();
            
    

    });

    $(window).scroll(function() {
        scrollTop = $(window).scrollTop();
        resizeBgImage();
    });

})(jQuery);