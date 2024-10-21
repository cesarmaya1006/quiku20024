$("document").ready(function () {
    $('.navbar').addClass('d-none');
	"use strict";
	$(".box").animate({
		top: "0px"
	}, 750, function () {
        $(".box").animate({
			width: "600px"
		}, 750, function () {
			$(".box").animate({
				height: "550px"
			}, 750, function () {
				$(".box").animate({
					borderRadius: "10px"
				}, 750, function () {
					$("img").fadeIn(750, function () {
						$("h3").slideDown(750, function () {
							$(".form-control").slideDown(750, function () {
								$(".btn-warning").slideDown(750, function () {
                                    $("a").fadeIn(function () {
                                        $("a").animate({right: "0px"}, 300);
                                        $('.navbar').removeClass('d-none');
                                    });
                                });
							});
						});
					});
				});
			});
		});
	});
});
