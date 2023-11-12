<?php
$reqlevel=1;
include("membersonly.inc.php");
$prid=$_REQUEST[prid];



?>
<select name="from"  id="from" class="sc" onchange="stk(this.value)">
<option value="">---Select---</option>
  <?
  	  $data1= mysqli_query($conn,"select * from  main_stock where pcd='$prid' group by bcd");
while ($row1 = mysqli_fetch_array($data1))
{
  $bcd=$row1['bcd'];
  

	  $data= mysqli_query($conn,"select * from  main_branch where sl='$bcd'");
while ($row = mysqli_fetch_array($data))
{
  $bnm=$row['bnm'];
  $sl=$row['sl'];

  ?>
  
   <option value="<?echo $sl;?>"><?echo $bnm;?></option>
  <?
  }
  }
  ?>

</select>


 