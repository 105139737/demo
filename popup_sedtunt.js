
function openOfferslDialog() {

	$('#overlay').fadeIn('fast', function() {
		$('#boxpopup').css('display','block');
		
        $('#boxpopup').animate({'left':'35%'},500);
    });
}


function closeOfferslDialog(prospectElementID) {




$('#' + prospectElementID).animate({'left':'100%'}, 500, function() {
				$('#' + prospectElementID).css('position','fixed');
				$('#overlay').fadeOut('fast');
			});
	
}