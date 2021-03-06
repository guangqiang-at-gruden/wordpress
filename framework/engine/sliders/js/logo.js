jQuery(document).ready( function($) {

$('.logo_slider_content').each(function() {
	var nofel = $(this).find('.one_logo').size();
	var size = $(this).find('.one_logo').outerWidth();
	//console.log( nofel + ' ' + size );
	$(this).css('width', nofel * size );
	
});

$('.logo_slider_arrow_right').disableSelection();
$('.logo_slider_arrow_left').disableSelection();

$('.logo_slider_arrow_right').click(function() {
	if( $(this).parents('.logo_slider').find(':animated').size() != 0) return false;
	
	var logo_slider_content = $(this).parent().parent().find('.logo_slider_content');
	var one_logo_width =logo_slider_content.find('.one_logo').outerWidth();
	var logo_slider_content_width = logo_slider_content.outerWidth();
	var left_pos = logo_slider_content.position().left;
	
	var logo_slider_wrapper_width = $(this).parent().parent().find('.logo_slider_content_wrapper').outerWidth();
	//console.log( left_pos - one_logo_width + logo_slider_content_width );
	//alert( left_pos + ' ' + one_logo_width + ' ' + logo_slider_content_width );
	
	if( left_pos - one_logo_width + logo_slider_content_width <logo_slider_wrapper_width ) {
		var logo_slider_content_wrapper = $(this).parent().parent().find('.logo_slider_content_wrapper');
		var new_left = logo_slider_content.outerWidth() - logo_slider_content_wrapper.outerWidth();
		
		
		logo_slider_content.stop().animate({left: left_pos - 10}, 150).animate({left: -new_left }, 150);
		return false;
	}
	
	
	
	logo_slider_content.animate({left: left_pos - one_logo_width}, 300);
});

$('.logo_slider_arrow_left').click(function() {
	
	if( $(this).parents('.logo_slider').find(':animated').size() != 0) return false;
	
	var logo_slider_content = $(this).parent().parent().find('.logo_slider_content');
	var one_logo_width =logo_slider_content.find('.one_logo').outerWidth();
	var logo_slider_content_width = logo_slider_content.outerWidth();
	var left_pos = logo_slider_content.position().left;
	
	if( left_pos + one_logo_width > 0 ) { 
		logo_slider_content.stop().animate({left: left_pos +10}, 150).animate({left: 0}, 150);
		return false;
	}
	
	logo_slider_content.animate({left: left_pos + one_logo_width}, 300);
});


        
$('.one_logo a').hover(function() {
	$(this).stop().animate({opacity:0.5}, 200);
}, function() {
	$(this).stop().animate({opacity:1}, 200);
} ); 

});

(function($){

$.fn.disableSelection = function() {
    return this.each(function() {           
        $(this).attr('unselectable', 'on')
               .css({
                   '-moz-user-select':'none',
                   '-webkit-user-select':'none',
                   'user-select':'none',
                   '-ms-user-select':'none'
               })
               .each(function() {
                   this.onselectstart = function() { return false; };
               });
    });
};

})(jQuery);

      jQuery(function() {
       // jQuery('.one_logo').find('img').hide().fadeIn(1000); // fade in the grayscaled images to avoid visual jump
      });
      jQuery(window).load(function () { // user window.load to ensure images have been loaded
        jQuery('.one_logo').find('img').greyScale({
          fadeTime: 0 // call the plugin with non-defult fadeTime (default: 400ms)
        });
      });

(function(a){a.fn.greyScale=function(c){$options=a.extend({fadeTime:a.fx.speeds._default,reverse:false},c);function b(f,e,d){can=a("<canvas>").css({display:"none",left:"0",position:"absolute",top:"0"}).attr({width:e,height:d}).addClass("gsCanvas");ctx=can[0].getContext("2d");ctx.drawImage(f,0,0,e,d);imageData=ctx.getImageData(0,0,e,d);px=imageData.data;for(i=0;i<px.length;i+=4){grey=px[i]*0.3+px[i+1]*0.59+px[i+2]*0.11;px[i]=px[i+1]=px[i+2]=grey}ctx.putImageData(imageData,0,0);return can}if(a.browser.msie){this.each(function(){var d=$options.reverse?0:1;a(this).css({filter:"progid:DXImageTransform.Microsoft.BasicImage(grayscale="+d+")",zoom:"1"});a(this).hover(function(){var e=$options.reverse?1:0;a(this).css({filter:"progid:DXImageTransform.Microsoft.BasicImage(grayscale="+e+")"})},function(){var e=$options.reverse?0:1;a(this).css("filter","progid:DXImageTransform.Microsoft.BasicImage(grayscale="+e+")")})})}else{this.each(function(d){a(this).wrap('<div class="gsWrapper">');gsWrapper=a(this).parent();gsWrapper.css({position:"relative",display:"inline-block"});if(window.location.hostname!==this.src.split("/")[2]){a.getImageData({url:a(this).attr("src"),success:a.proxy(function(e){can=b(e,e.width,e.height);if($options.reverse){can.appendTo(gsWrapper).css({display:"block",opacity:"0"})}else{can.appendTo(gsWrapper).fadeIn($options.fadeTime)}},gsWrapper),error:function(f,e){}})}else{can=b(a(this)[0],a(this).width(),a(this).height());if($options.reverse){can.appendTo(gsWrapper).css({display:"block",opacity:"0"})}else{can.appendTo(gsWrapper).fadeIn($options.fadeTime)}}});a(this).parent().delegate(".gsCanvas","mouseover mouseout",function(d){over=$options.reverse?1:0;out=$options.reverse?0:1;(d.type=="mouseover")&&a(this).stop().animate({opacity:over},$options.fadeTime);(d.type=="mouseout")&&a(this).stop().animate({opacity:out},$options.fadeTime)})}}})(jQuery);(function(X,V){function O(){}function H(c){E=[c]}function W(c,g,e){return c&&c.apply(g.context||g,e)}function U(A){function s(K){!n++&&V(function(){g();e&&(z[w]={s:[K]});x&&(K=x.apply(A,[K]));W(A.success,A,[K,G]);W(h,A,[A,G])},0)}function o(K){!n++&&V(function(){g();e&&K!=F&&(z[w]=K);W(A.error,A,[A,K]);W(h,A,[A,K])},0)}A=X.extend({},B,A);var h=A.complete,x=A.dataFilter,J=A.callbackParameter,I=A.callback,t=A.cache,e=A.pageCache,D=A.charset,w=A.url,u=A.data,C=A.timeout,c,n=0,g=O;A.abort=function(){!n++&&g()};if(W(A.beforeSend,A,[A])===false||n){return A}w=w||y;u=u?typeof u=="string"?u:X.param(u,A.traditional):y;w+=u?(/\?/.test(w)?"&":"?")+u:y;J&&(w+=(/\?/.test(w)?"&":"?")+encodeURIComponent(J)+"=?");!t&&!e&&(w+=(/\?/.test(w)?"&":"?")+"_"+(new Date).getTime()+"=");w=w.replace(/=\?(&|$)/,"="+I+"$1");e&&(c=z[w])?c.s?s(c.s[0]):o(c):V(function(L,K,M){if(!n){M=C>0&&V(function(){o(F)},C);g=function(){M&&clearTimeout(M);L[q]=L[v]=L[p]=L[r]=null;R[m](L);K&&R[m](K)};window[I]=H;L=X(l)[0];L.id=k+b++;if(D){L[a]=D}var N=function(P){(L[v]||O)();P=E;E=undefined;P?s(P[0]):o(j)};if(f.msie){L.event=v;L.htmlFor=L.id;L[q]=function(){/loaded|complete/.test(L.readyState)&&N()}}else{L[r]=L[p]=N;f.opera?(K=X(l)[0]).text="jQuery('#"+L.id+"')[0]."+r+"()":L[d]=d}L.src=w;R.insertBefore(L,R.firstChild);K&&R.insertBefore(K,R.firstChild)}},0);return A}var d="async",a="charset",y="",j="error",k="_jqjsp",v="onclick",r="on"+j,p="onload",q="onreadystatechange",m="removeChild",l="<script/>",G="success",F="timeout",f=X.browser,R=X("head")[0]||document.documentElement,z={},b=0,E,B={callback:k,url:location.href};U.setup=function(c){X.extend(B,c)};X.jsonp=U})(jQuery,setTimeout);(function(a){a.getImageData=function(b){var d=/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;if(b.url){var c=location.protocol==="https:",h="";h=b.server&&d.test(b.server)&&b.server.indexOf("https:")&&(c||b.url.indexOf("https:"))?b.server:"//img-to-json.appspot.com/?callback=?";a.jsonp({url:h,data:{url:escape(b.url)},dataType:"jsonp",timeout:10000,success:function(e){var f=new Image;a(f).load(function(){this.width=e.width;this.height=e.height;typeof b.success==typeof Function&&b.success(this)}).attr("src",e.data)},error:function(e,f){typeof b.error==typeof Function&&b.error(e,f)}})}else{typeof b.error==typeof Function&&b.error(null,"no_url")}}})(jQuery);