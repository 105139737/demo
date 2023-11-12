<?
$reqlevel = 3;
include("membersonly.inc.php");
   $query = "SELECT * FROM  main_trns where stat='0' and tbcd='$branch_code'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$blno=$R['blno'];
$fbcd=$R['fbcd'];



$q11="SELECT * FROM main_branch where sl='$fbcd'";
	$r11=mysqli_query($conn,$q11) or die(mysqli_error($conn));
	while ($P=mysqli_fetch_array($r11))
	{
		$bnm=$P['bnm'];
	}


$query5="Select sum(qty) as sumqty from main_trndtl where blno='$blno' group by blno";
$result5 = mysqli_query($conn,$query5);
  while ($R5 = mysqli_fetch_array ($result5))
  {
	  $sumqty=$R5['sumqty'];
  }
  ?>
     <li>
					<a href="#">
                         <i class="fa fa-envelope-o"></i>  
						 <font  color="#f54c4d"><?=$bnm;?> (Transfer Quantity  <b><?=$sumqty;?> Pcs</b>)</font>
                        </a>
						
                      </li>
<?}?>