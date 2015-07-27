/* Javascript logic that are specific to Design Services Providers go here. */

$(".filter-item ul").hide().first().show();
$(".category").addClass("closed").first().removeClass("closed").addClass("open");


$("span.category").click(function() {
	if ($(this).hasClass("closed") == true){
		$(this).parent().find('ul').show();
		$(this).removeClass("closed").addClass("open");
	}
	else {
		$(this).parent().find('ul').hide();
		$(this).removeClass("open").addClass("closed");
	}
});

$("h3.category").click(function() {
	if ($(this).hasClass("closed") == true){
		$(this).next('div').find('ul').first().show();
		$(this).removeClass("closed").addClass("open");
	}
	else {
		$(this).next('div').find('ul').first().hide();
		$(this).removeClass("open").addClass("closed");
	}
});

$('.filter-options input:checked').each(function() {
    $(this).closest("ul").show();
    $(this).closest("ul").parent().find("span").first().removeClass("closed").addClass("open");
	$(this).closest("ul").parent().parent().show();
	$(this).closest("ul").parent().parent().parent().parent().find("h3").first().removeClass("closed").addClass("open");
});

$('.filter-options input:disabled').closest("span").css( "color", "#666666" );


$(".layout-onecolumn h3").parent().addClass("dsp-column");
$(".dsp-column").find("ul").addClass("second-level").find("ul").removeClass("second-level").addClass("third-level");

$(".dsp-column").each(function() {
	if ($(this).find("ul").hasClass("third-level") == true){
		$(this).addClass("nested");
    }
	else {$(this).addClass("single");}
});

$(".third-level").hide();
$(".third-level").parent().find("span").addClass("closed");
$(".third-level").find("span").removeClass("closed");


	$(".third-level").parent().find("span").click(function() {
		if ($(this).hasClass("closed") == true){
			$(this).next('ul').show();
			$(this).removeClass("closed").addClass("open");
		}
		else if ($(this).hasClass("open") == true) {
			$(this).next('ul').hide();
			$(this).removeClass("open").addClass("closed");
		}
    });
