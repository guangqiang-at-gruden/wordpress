
// 2 functions from http://www.w3schools.com/js/js_cookies.asp

function setCookie(c_name,value){
    /*
    // http://stackoverflow.com/questions/1783302/clear-cookies-on-browser-close
    //var exdate=new Date();
    //exdate.setDate(exdate.getDate() + 1);
    var c_value=escape(value) + "; expires="+exdate.toUTCString();
    */
    var c_value=escape(value);
    //var __path ='/wiseguys/';
    var __path = document.URL.split("wp/")[0].split("http://demo.freshface.net")[1];
    document.cookie=c_name + "=" + c_value + ';  path=' + __path;
    reload_styleswitcher_box_with_cookies()
}

function getCookie(c_name){
    var i,x,y,ARRcookies=document.cookie.split(";");
    for (i=0;i<ARRcookies.length;i++){
        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
        y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
        x=x.replace(/^\s+|\s+$/g,"");
        if (x==c_name) {
            if( 'false' == y){
                return false;
            }
            return unescape(y);
        }
    }
    return false;
}

jQuery('.resetCookies').click(function () {
    setCookie('tmplColor',false);
    setCookie('tmplPattern',false);
    setCookie('tmplSolidBg',false);
    setCookie('tmplBgImg',false);
    setCookie('tmplLayout',false);
    setCookie('tmplSwitcherClosed',false);
    location.reload();
});

function reload_styleswitcher_box_with_cookies(){
    jQuery('#cookie_info').html('');
    jQuery('#cookie_info').prepend('tmplColor: <b>'  +getCookie('tmplColor')+  '</b><br />');
    jQuery('#cookie_info').prepend('tmplPattern: <b>'+getCookie('tmplPattern')+'</b><br />');
    jQuery('#cookie_info').prepend('tmplSolidBg: <b>'+getCookie('tmplSolidBg')+'</b><br />');
    jQuery('#cookie_info').prepend('tmplBgImg: <b>'  +getCookie('tmplBgImg')+  '</b><br />');
    jQuery('#cookie_info').prepend('tmplLayout: <b>' +getCookie('tmplLayout')+ '</b><br />');
}

function reload_styleswitcher_data_by_cookies(){
    if( getCookie('tmplColor')   ) jQuery('.styleSwitcherColors a[data-value="' +   getCookie('tmplColor')  +  '"]').click();
    if( getCookie('tmplPattern') ) jQuery('.styleSwitcherPatterns a[data-value="' + getCookie('tmplPattern') + '"]').click();
    if( getCookie('tmplSolidBg') ) jQuery('.styleSwitcherSolidBg a[data-value="' +  getCookie('tmplSolidBg') + '"]').click();
    if( getCookie('tmplBgImg') )   jQuery('.switcherBgImg').click();
    if( getCookie('tmplLayout') )  jQuery('.styleSwitcherLayout a[data-value="' +   getCookie('tmplLayout') +  '"]').click();

    //jQuery('body').prepend('<div id="cookie_info" style="height:100px;width:200px;position:fixed;bottom:0;right:0;background:#FFF;border: 2px solid Gray;z-index:1000;padding:10px 20px"></div>');
    //reload_styleswitcher_box_with_cookies();
}

jQuery('.styleSwitcherColors').find('a').click(function () {
    setCookie('tmplColor',   jQuery(this).attr('data-value') );
    return false;
});

jQuery('.styleSwitcherPatterns').find('a').click(function () {
    setCookie('tmplPattern', jQuery(this).attr('data-value') );
    setCookie('tmplSolidBg', false);
    setCookie('tmplBgImg',   false);
    return false;
});

jQuery('.styleSwitcherSolidBg').find('a').click(function () {
    setCookie('tmplPattern', false);
    setCookie('tmplSolidBg', jQuery(this).attr('data-value') );
    setCookie('tmplBgImg',   false);
    return false;
});

jQuery('.switcherBgImg').click(function () {
    setCookie('tmplPattern', false);
    setCookie('tmplSolidBg', false );
    setCookie('tmplBgImg',   true);
    return false;
});

jQuery('.styleSwitcherLayout').find('a').click(function () {
    setCookie('tmplLayout',   jQuery(this).attr('data-value') );
    return false;
});

