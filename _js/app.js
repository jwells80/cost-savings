$(document).ready(function() {
// Initially hides later Fuctionality.	
	$('.errors-div').hide();
	$('#costTab').hide();
	$('#updateTab').hide();
	$('#updatecostTab').hide();
// Initially retrieve data
	getRep();
	getCono();
	refresh();
	newCustSub();
	filter();
	dataUpdate();
	updateCostSav();
	newCostSav();

// Refresh table to defaults	
	$('#refreshdata').click(function() {
		event.preventDefault();
		refresh();
	});
//Tab activations	
	$('#myTab a').click(function (event) {
		event.preventDefault();
		$(this).tab('show');
	});
});
