function show_flash(e){$("#"+e).fadeIn("slow");setInterval(function(){$("#"+e).fadeOut("slow")},5e3)}function show_logout(){$("#logout_box").fadeIn("slow")}function hide_logout(){$("#logout_box").fadeOut("slow")}function checkPassword(){if(checkNull($("#newPass").val())||checkNull($("#conPass").val())||checkNull($("#oldPass").val())){$("#newPass, #conPass").css({"box-shadow":"0px 0px 3px #f00"});alert("empty");return false}if($("#newPass").val()!==$("#conPass").val()){$("#newPass, #conPass").css({"box-shadow":"0px 0px 3px #f00"});alert("not equal");return false}}function showImg(e){if(e.files&&e.files[0]){var t=new FileReader;t.onload=function(e){$("#imgLocation").attr("src",e.target.result)},t.readAsDataURL(e.files[0])}}function removeShadow(e){$("#"+e).css({"box-shadow":"none"})}function checkNull(e){if(e===null||e==="")return true;else return false}function bookProduct(e){if(e!==1){closeReadMore()}$("#readMoreBack").fadeIn();$("#readMoreCont").fadeIn("slow");$("#title").html("Book Product");$.ajax({url:"getBookPanel",type:"GET",success:function(e){$("#content").html(e)},failure:function(){$("#content").html("No data recieved.")},dataType:"html"});setScrollPosition()}function readMore(e){$("#readMoreBack").fadeIn();$("#readMoreCont").fadeIn("slow");if(e!==0){$("#title").html("Product Details");$.ajax({url:"getReadMore?id="+e,type:"GET",success:function(e){$("#content").html(e)},failure:function(){$("#content").html("No data recieved.")},dataType:"html"})}setScrollPosition()}function closeReadMore(){$("#readMoreBack").fadeOut("slow");$("#readMoreCont").fadeOut();unsetScrollPosition()}function setScrollPosition(){var e=[self.pageXOffset||document.documentElement.scrollLeft||document.body.scrollLeft,self.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop];var t=jQuery("html");t.data("scroll-position",e);t.data("previous-overflow",t.css("overflow"));t.css("overflow","hidden");window.scrollTo(e[0],e[1])}function unsetScrollPosition(){var e=jQuery("html");var t=e.data("scroll-position");e.css("overflow",e.data("previous-overflow"));window.scrollTo(t[0],t[1])}function menu_list_on(){$("#product").css({background:"#003399"});$(".menu_list").css({display:"block"})}function menu_list_off(){$("#product").css({background:"#ff6600"});$(".menu_list").css({display:"none"})}$(document).ready(function(){$("#readMoreClose").click(function(){closeReadMore()});$("#bookProduct").click(function(){closeReadMore()});$("#readMoreClose").click(function(){closeReadMore()});$("#bookProduct").click(function(){closeReadMore()});$("#name_link").click(function(){show_logout()});$("#name_link").focusout(function(){hide_logout()});$("#newPass").focus(function(){removeShadow("newPass")});$("#conPass").focus(function(){removeShadow("conPass")});$("#img").change(function(){showImg(this)});$("#deleteImage").change(function(){if(this.checked){$("#browseBtn").css({display:"block"})}else{$("#browseBtn").css({display:"none"})}})})