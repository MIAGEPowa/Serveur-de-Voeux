$(document).ready(function() {
	$(".progression").each(function(i) {
		var width = $(this).width();
		$(this).width(0).animate({"width": width}, 2000);
	});
});