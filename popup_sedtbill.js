function openOfferslDialog() {
		//sid=document.getElementById('stid').value;
		//$('#contentl').load('daybal.php').fadeIn("slow");
	
	$('#overlay').fadeIn('fast', function() {
		
		$('#boxpopup').css('display','block');
		$('.boxopen').animate({'opacity': '0'});
        $('#boxpopup').animate({'left':'70%'},500);
    });
}


function closeOfferslDialog(prospectElementID) {
	$('#overlay').fadeOut('fast', function() {
		
		$('#boxpopup').css('display','block');
        $('#boxpopup').animate({'left':'100%'},500);
		$('.boxopen').animate({'opacity': '1'});
    });
	
}