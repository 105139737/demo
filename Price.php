<?php 
include("config.php");
$datas=mysqli_query($conn,"select * from global where sl=1")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($datas))
{
$sms=$row['sms'];
$linkGen=$row['linkGen'];
}

$vxy=explode("@",$_REQUEST['tp']);

if($vxy[2]!=$linkGen)
{
    die("Sorry, Something went wrong. Please contact your administrator.");
}
?>

<head>
	<meta name='viewport' content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link href="price.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inview/1.0.0/jquery.inview.min.js" integrity="sha512-dy8Q+KMsxJmEgLqvZA7kk/Pcaij/OhCK1LPj+oGuxfd/tcbbqrDSGOtiXNfzKbMun+ZBnQsTWUnhuXhVkISDOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>

</style>
<h3>Price List</h3>
<div id='search-box'>
<form  id='search-form' method='get' target='_top'>
<input id='searchtext' name='searchtext' onkeyup="getData()" placeholder='Search By Model Name' type='text'/>
<button id='search-button' onclick="getData()" type='button'><span>Search</span></button>
</form>
</div>
<?php 
$tp=explode("@",$_REQUEST['tp']);

?>
<input type="hidden" id="pageno" value="1">
<input type="hidden" id="tp" value="<?php echo $tp[0]?>">
<input type="hidden" id="cat" value="<?php echo $tp[1]?>">
<div id="PriceDiv">
</div>

<center><div id="loader" >&nbsp</div></center>
<script>
	getData();
	function getData()
	{
			var searchtext = jQuery('#searchtext').val();
			var tp = jQuery('#tp').val();
			var cat = jQuery('#cat').val();
			$("#loader").show();
			var nextPage = 1;
                     $.ajax({
                         type: 'POST',
                         url: 'prices.php',
                         data: { 'pageno': nextPage,'searchtext':searchtext,'tp':tp,'cat':cat },
                         success: function(data){
                             if(data != ''){							 
                                 $('#PriceDiv').html(data);
                                 $('#pageno').val(nextPage);
								// $("#loader").hide();
                             } else {								 
                                 $("#loader").hide();
                             }
                         }
                     });
            	
	}


         $(document).ready(function(){
             $('#loader').on('inview', function(event, isInView) {
                 if (isInView) {
                     var nextPage = parseInt($('#pageno').val())+1;
					 var searchtext = jQuery('#searchtext').val();
					 var tp = jQuery('#tp').val();
					var cat = jQuery('#cat').val();
                     $.ajax({
                         type: 'POST',
                         url: 'prices.php',
                         data: { 'pageno': nextPage,'searchtext':searchtext,'tp':tp,'cat':cat},
                         success: function(data){
                             if(data != ''){	
								console.log("test",data.length) ;
								if(data.length>420){				 
                                 $('#PriceDiv').append(data);
                                 $('#pageno').val(nextPage);
								 $("#loader").show();
								}
								else
								{
									$("#loader").hide();
								}
                             } else {								 
                                 $("#loader").hide();
                             }
                         }
                     });
                 }
             });

			
         });
     </script>
</script>
