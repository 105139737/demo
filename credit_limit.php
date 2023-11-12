<?
$reqlevel = 3; 
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$result = mysqli_query($conn,"SELECT * from ".$DBprefix."cust where sl='$sl'");
while($row = mysqli_fetch_array($result))
{
$credit_limit=$row['credit_limit'];  
$nm=$row['nm'];  
}
?>
<input type="hidden" class="form-control" id="cust_sl" name="cust_sl" value="<?=$sl;?>" >
<div class="box box-success" >
<table border="0" class="table table-hover table-striped table-bordered" >
<tr>
<td align="left"  >
<b>Credit Limit : <font color="blue" size="3"><?=$nm?></font></b>
<input type="text" class="form-control" id="credit_limit" name="credit_limit" value="<?=$credit_limit;?>" onfocus="this.select();" placeholder="Please Enter Credit Limit">
</td>
</tr>
<tr>
<td align="right"  >
<input type="button" class="btn btn-success" value="Update" onclick="credits()" name="B1" ></td>
</tr>
</table>
</div>
<script>
document.getElementById('credit_limit').focus();
</script>