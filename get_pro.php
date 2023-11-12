<?
$reqlevel = 1;
include("membersonly.inc.php");
$cat=$_REQUEST[cat];
$bnm=$_REQUEST[bnm];

if($cat!="")
{
	$q=" and cat='$cat' ";
}else{$q="";	}
if($bnm!='')
{
$r=" and bnm='$bnm'";
}else{$r='';}

?>
<select name="pnm" class="form-control"  id="pnm"  >
<option value="">---All---</option>
<?
$query="Select * from  main_product where sl>0 $q $r order by pnm";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$mnm=$R['mnm'];
$pname=$R['pnm'];
?>
<option value="<? echo $sl;?>"><? echo $pname;?> - <? echo $mnm;?></option>
<?
}
?>
</select>
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
$('#pnm').chosen({no_results_text: "Oops, nothing found!",});
</script>