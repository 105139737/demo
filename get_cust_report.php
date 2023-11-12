<?
$reqlevel = 1;
include("membersonly.inc.php");
$brand=$_REQUEST['brand'];
?>
<select name="cust[]"  class="form-control" size="1" id="cust" multiple tabindex="8"  >
<?

$query="select * from main_cust WHERE sl>0 and brncd='1' and  FIND_IN_SET(brand, '$brand')>0 order by nm";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
			
?>
<option value="<?=$rw['cont'];?>"><?=$rw['nm'];?> <?if($rw['cont']!=""){?>( <?=$rw['cont'];?> )<?}?> </option>
<?
}
?>				

</select>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>
$('#cust').chosen({no_results_text: "Oops, nothing found!",});	
$('#cust').css('width','100%');	

</script>