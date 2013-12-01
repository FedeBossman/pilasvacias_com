$(document).ready(function () {
	/*Changes activated header section. Also collapses in case of responsive drawer*/

	$("ul.nav").children("li").click(function (){
		$("ul.nav").children("li").removeClass("active");
		$(this).addClass("active");
		if ($("button.navbar-toggle").is(":visible")) {
			$("button.navbar-toggle").click();
		}
	});

	/*Decides which view will appear*/
	if(window.location.href.indexOf("homepage") > -1) {
		$("#homepage").css('display', 'block');
	}
	if(window.location.href.indexOf("about-us") > -1) {
		activateHeader(1);
		$("#homepage").css('display', 'none');
		$("#about-us").css('display', 'block');
	}	
	if(window.location.href.indexOf("contact") > -1) {
		activateHeader(2);
		$("#homepage").css('display', 'none');
		$("#contact").css('display', 'block');
	}

	// PROFILES
	$("div.circly").click(
		function() {
			var index = $( "div.circly" ).index( this );
			var current = $("#profile-container").children(".cardy").eq(index);

			if ($(current).is(":visible")) {
				$( "div.circly" ).children("img").css("border", "4px solid #01414e");

				var all = $("#profile-container").children(".cardy");

				for (var i = 0; i < all.length ; i++) {
					if (all.eq(i).is(":visible")) {
						all.eq(i).stop(true, true).slideUp(300, function() {
							$('#profile').slideDown(300);
						}); 
					}
				}

			} else {

				$( "div.circly" ).children("img").css("border", "4px solid #01414e");
				$( "div.circly").eq(index).children("img").css("border", "4px solid #e44d26");

				var all = $("#profile-container").children(".cardy");

				for (var i = 0; i < all.length ; i++) {
					if (all.eq(i).is(":visible")) {
						all.eq(i).stop(true, true).slideUp(300, function() {
							$(current).slideDown(300);
						}); 
					}
				}

			}

		});
});

$(window).bind('hashchange', function() {
	if(window.location.href.indexOf("about-us") > -1) {	
		changeSection("#about-us");	
	}

	if(window.location.href.indexOf("homepage") > -1) {
		$("ul.nav").children("li").removeClass("active");
		$("ul.nav").children("li").eq(0).addClass("active");
		changeSection("#homepage");
	}
	if(window.location.href.indexOf("contact") > -1) {
		changeSection("#contact");
	} 
});

function activateHeader(index) {
	$("ul.nav").children("li").removeClass("active");
	$("ul.nav").children("li").eq(index).addClass("active");
}

function changeSection(fadeInSection) {

	if (fadeInSection != "#homepage") {
		$("#homepage").stop(true, true);
		$("#homepage").fadeOut(600);			
	}
	if (fadeInSection != "#about-us") {
		$("#about-us").stop(true, true);
		$("#about-us").fadeOut(600);
	}
	if (fadeInSection != "#contact") {
		$("#contact").stop(true, true);
		$("#contact").fadeOut(600);
	}
	$(fadeInSection).fadeIn(600);


}