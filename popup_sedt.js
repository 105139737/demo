function openOfferslDialog() {
	$('#overlayl').fadeIn('fast', function() {
		$('#boxpopupl').css('display','block');
        $('#boxpopupl').animate({'left':'30%'},500);
    });
}


function closeOfferslDialog(prospectElementID) {
	$(function($) {
		$(document).ready(function() {
			$('#' + prospectElementID).css('position','fixed');
			$('#' + prospectElementID).animate({'left':'-100%'}, 500, function() {
				$('#' + prospectElementID).css('position','fixed');
				$('#' + prospectElementID).css('left','100%');
				$('#overlayl').fadeOut('fast');
			});
		});
	});
}
