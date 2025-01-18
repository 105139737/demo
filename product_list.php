<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
$cy=date('Y');
$all=rawurldecode($_REQUEST['all']??"");
$cat=$_REQUEST['cat'] ?? "";
$bnm=$_REQUEST[bnm];
$brncd=$_REQUEST['brncd'] ?? "";
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($cat==""){$cat1="";}else{$cat1=" and cat='$cat'";}
if($bnm==""){$bnm1="";}else{$bnm1=" and bnm='$bnm'";}
$al="%".$all."%";
if($all!="")
{
	$all1=" and (mnm LIKE '$al' or pnm LIKE '$al')";
}
else
{
$all1="";	
}
$pno=rawurldecode($_REQUEST['pno'] ?? "");
$ps=rawurldecode($_REQUEST['ps'] ?? "");
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;
?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?php  echo $ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
  <table  class="table table-hover table-striped table-bordered"  >
	     <tr>
		  <td  align="center" >
			<b>Sl</b>
			</td>
			 <td  align="left" >
		<b>Product Name</b>
			</td>
			<td  align="center" >
			<b>Product Category</b>
			</td>
          	<td  align="center" >
			<b>Brand Name</b>
			</td>
			

			<td  align="center" >

			<b>Opening</b>

			</td>

			<td  align="center" >

			<b>In</b>

			</td>

			<td  align="center" >

			<b>Out</b>

			</td>
			<td  align="center" >

			<b>	In Transit</b>

			</td>
		

		   <td  align="center" >

			<b>Current</b>

			</td>

			<td  align="center" >

			<b>Stock Value</b>

			</td>

		     </tr>

<?php 



$sl=$start;

$c1='odd';

$c3=0;

$sln=0;

$open1=0;

$stkf=0;

$stin1=0;

$stout1=0;
$it=0;

$to=0;

$datatt= mysqli_query($conn,"select * from  main_product where sl!=''")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from  main_product where sl!='' $all1 $cat1 $bnm1")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
 $data= mysqli_query($conn,"select * from  main_product where sl!='' $all1 $cat1 $bnm1 order by pnm limit $start,$ps ")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))	
{
$c3++;
$sln++;
$slno=$row['sl'];
$csl=$row['cat'];
$pcd=$row['sl'];
$bnm2=$row['bnm'];
$pnm2=$row['pnm'];
$mnm=$row['mnm'];
$ret=$row['mrp'];
 $data1= mysqli_query($conn,"select * from main_catg where sl='$csl'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm2=$row1['cnm'];
}
 $data17= mysqli_query($conn,"select * from main_brand where sl='$bnm2'")or die(mysqli_error($conn));
while ($row17 = mysqli_fetch_array($data17))
{
$bnm24=$row17['brand'];
}
$ptu=1;
 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' $brncd1";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{

$stck=$R4['stck1'];

}



$stkf=$stck;

$query6="Select sum(opst) as open from ".$DBprefix."stock where pcd='$pcd' $brncd1";
$result6 = mysqli_query($conn,$query6);

  while ($R6 = mysqli_fetch_array ($result6))

{

$open=$R6['open'];

}

$open1=$open;
$query7="Select sum(stin) as stin from ".$DBprefix."stock where pcd='$pcd' $brncd1";
$result7 = mysqli_query($conn,$query7);
while ($R7 = mysqli_fetch_array ($result7))
{
$stin=$R7['stin'];
}
$stin1=$stin;
$query8="Select sum(stout) as stout from ".$DBprefix."stock where pcd='$pcd' and stat='1' $brncd1";
$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$stout=$R8['stout'];
}
$stout1=$stout;

$query8="Select sum(stout) as it from ".$DBprefix."stock where pcd='$pcd' and stat='0' $brncd1";
$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$it=$R8['it'];
}
if($it=="")
{
	$it=0;
}
$to=0;
$ret=0;
 $query3="Select * from ".$DBprefix."stock where pcd='$pcd' order by ret";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$ret=$R3['ret'];
}	
$to=$stkf*$ret;
			 ?>

		   <tr  >

		   

		    <td  align="center" >

			<?php  echo $sln;?>

			</td>

			 <td  align="left">

		<?php  echo $pnm2;?> 

			</td>

	

            <td  align="center" >

			<?php  echo $cnm2;?>

			</td>

			 <td  align="center" >

			<?php  echo $bnm24;?>

			</td>

			<td  align="center" >

		<?php  echo $open1;?>

			</td>

			<td  align="center" >

		<?php  echo $stin1;?>

			</td>

			<td  align="center" >

		<?php  echo $stout1;?>

			</td>
				<td  align="center" >

		<?php  echo $it;?>

			</td>

			<td  align="center" >

		<b><?php  echo $stkf;?></b>

			</td>

		

			<td   align="right" >

		<b><?php echo number_format($to,2);?></b>

			</td>

		

		     </tr>	 

<?php 

$to1=$to+$to1;

$stkf=0;

$stout1=0;

$stin1=0;

$open1=0;

}?>

<tr>

<td colspan="9" align="right">

<b>Total Value </b>

</td>

<td align="right" >

<b><?php echo number_format($to1,2);?></b>

</td>

</tr>



	  </table>

<?php 

$tp=$rcnt/$ps;

if(($rcnt%$ps)>0)

{

    $tp=floor($tp)+1;

}

if($pno==1)

{

    $prev=1;

}

else

{

$prev=$pno-1;    

}

if($pno==$tp)

{

 $next=$tp;   

}

else

{

$next=$pno+1;

}

$flt="";

if($rcnt!=$rcntttl)

{

    $flt="(filtered from ".$rcntttl." total entries)";

}

echo "Showing ".($start+1)." to ".($sl)." of ".$rcnt." entries".$flt;

?>

<div align="center"><input type="text" size="10" id="pgn" name="pgn" value="<?php  echo $pno;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>

<div class="pagination pagination-centered">

                            <ul class="pagination pagination-sm inline">

							<li <?php  if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>

                            <li <?php  if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>

                            <?php 

                            

                            if($tp<=5)

                            {

                              $n=1;  

                              while($n<=$tp)

                              {

                                ?>

                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   

                                <?php 

                                $n+=1;

                              }  

                            }

                            else

                            {

                                if($pno<4)

                                {

                                  $n=1;

                                  while($n<=5)

                              {

                                ?>

                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   

                                <?php 

                                $n+=1;

                              }     

                                }

                                elseif($pno>$tp-3)

                                {

                                    $n=$tp-5;

                                    while($n<=5)

                              {

                                ?>

                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   

                                <?php 

                                $n+=1;

                              }   

                                }

                                else

                                {

                                $n=$pno-2; 

                                 while($n<=$pno+2)

                              {

                                ?>

                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   

                                <?php 

                                $n+=1;

                              }     

                                }

                               

                                

                                

                            }

                            ?>

                            <li <?php  if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>

                            <li <?php  if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>

                            </ul>

                            </div>

							