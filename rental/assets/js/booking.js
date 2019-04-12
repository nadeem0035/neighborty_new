
window.onbeforeunload = function(){
	window.scrollTo(0,0);
}

var myLink = document.location.toString();

if (myLink.match('#')) {
 $('html, body').animate({ scrollTop: 0 }, 0); // OR
 $(window).scrollTop();
}    
