jQuery(document).ready(function(){$("#contactform").submit(function(){var b=$(this).attr("action"),c=$(this).serialize();$("#submit").attr("disabled","disabled").after('<img src="images/contact/ajax-loader.gif" class="loader" />');$("#message").slideUp(750,function(){$("#message").hide();$.post(b,c,function(a){$("#message").html(a);$("#message").slideDown("slow");$("#contactform img.loader").fadeOut("fast",function(){$(this).remove()});$("#submit").removeAttr("disabled");null!=a.match("success")&& $("#contactform").slideUp("slow")})});return!1})});