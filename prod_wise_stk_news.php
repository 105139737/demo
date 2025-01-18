<?php 
$reqlevel = 3;
include("membersonly.inc.php");
set_time_limit(0);
date_default_timezone_set('Asia/Kolkata');
$cy=date('Y');

$pnm=$_REQUEST['pnm'];
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$dt=$_REQUEST['dt'];

$cat1="";
if($catsl!=""){$cat1=" and cat='$catsl'";}
$scat1="";
if($scatsl!=""){$scat1=" and scat='$scatsl'";}
if($pnm!=""){$all1=" and sl='$pnm'";}else{$all1="";	}
$dt=date('Y-m-d', strtotime($dt));	

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
<table class="table table-hover table-striped table-bordered">
<tr>
<td align="center"><b>Sl</b></td>
<td align="center"><b>Brand</b></td>
<td align="center"><b>Category</b></td>
<td align="center"><b>Model Code</b></td>
<td align="center"><b>Product Name</b></td>
<td align="center"><b>MAIN LOCATION</b></td>
<td align="center"><b>RANAGHAT</b></td>
<td align="center"><b>DAMAGE GODOWN</b></td>
<td align="center"><b>MBO KGR</b></td>
<td align="center"><b>SHOPPE</b></td>
<td align="center"><b>BETHUA</b></td>
<td align="center"><b>BURDWAN SHOWROOM</b></td>
<td align="center"><b>KARIMPUR</b></td>
<td align="center"><b>BARASAT</b></td>
<td align="center"><b>BERHAMPORE</b></td>
<td align="center"><b>KANCHRAPARA</b></td>
<td align="center"><b>BALANCE</b></td>
</tr>
<?php 
$sl=$start;
$sln=0;
$cntc=0;
$ssl=0;
$datatt=mysqli_query($conn,"select * from main_product where sl>0 and stat='0' and typ='0' $cat1  $scat1  $all1 order by pnm")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar=mysqli_query($conn,"select * from main_product where sl>0 and stat='0' and typ='0' $cat1  $scat1  $all1  order by pnm")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data=mysqli_query($conn,"select * from main_product where sl>0 and stat='0' and typ='0' $cat1  $scat1  $all1 order by pnm limit $start,$ps ")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$sl++;
	$cntc++;
	$pcd=$row['sl'];
	$unit=$row['unit'];
	$nm=$row['pnm'];
	$p_cd=$row['pcd'];
	$cat=$row['cat'];
	$scat=$row['scat'];
	$hsn=$row['hsn'];
	
	$cnm="";				
	$data12= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
	while ($row1 = mysqli_fetch_array($data12))
	{
		$cnm=$row1['cnm'];
	}
	
	$scat_nm="";				
	$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
	while ($row1 = mysqli_fetch_array($data2))
	{
		$scat_nm=$row1['nm'];
	}

	$balance=0;
	$gwn1=0;
	$query="SELECT SUM(opst+stin-stout) AS stck1 FROM ".$DBprefix."stock WHERE pcd='$pcd' AND dt<='$dt' AND bcd='1'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn1=$R['stck1'];
	}
	$gwn2=0;
	$gwn3=0;
	/*
	$gwn2=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='2'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn2=$R['stck1'];
	}
	$gwn3=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='3'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn3=$R['stck1'];
	}*/
	$gwn4=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='4'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn4=$R['stck1'];
	}
	$gwn5=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='5'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn5=$R['stck1'];
	}
	$gwn6=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='6'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn6=$R['stck1'];
	}
	$gwn7=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='7'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn7=$R['stck1'];
	}
	
	$gwn8=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='8'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn8=$R['stck1'];
	}
	
	$gwn9=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='9'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn9=$R['stck1'];
	}
	
	$gwn10=0;
/*	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='10'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn10=$R['stck1'];
	}*/
	$gwn11=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='11'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn11=$R['stck1'];
	}
	$gwn12=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='12'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn12=$R['stck1'];
	}
	$gwn13=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='13'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn13=$R['stck1'];
	}
	$gwn14=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='14'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn14=$R['stck1'];
	}
	$balance=$gwn1+$gwn4+$gwn5+$gwn6+$gwn7+$gwn8+$gwn9+$gwn10+$gwn11+$gwn12+$gwn13+$gwn14;
	
	if($gwn1==''){$gwn1=0;}
	if($gwn2==''){$gwn2=0;}
	if($gwn3==''){$gwn3=0;}
	if($gwn4==''){$gwn4=0;}
	if($gwn5==''){$gwn5=0;}
	if($gwn6==''){$gwn6=0;}
	if($gwn7==''){$gwn7=0;}
	if($gwn8==''){$gwn8=0;}
	if($gwn9==''){$gwn9=0;}
	if($gwn10==''){$gwn10=0;}
	if($gwn11==''){$gwn11=0;}
	if($gwn12==''){$gwn12=0;}
	if($gwn13==''){$gwn13=0;}
	if($gwn14==''){$gwn14=0;}
	?>
	<tr title="<?php  echo $pcd;?>, Stocksl :<?php  echo $ssl;?>">
	<td align="center"><?php  echo $cntc;?></td>
	<td align="left"><?php  echo $cnm;?></td>
	<td align="left"><?php  echo $scat_nm;?></td>
	<td align="left"><?php  echo $p_cd;?></td>
	<td align="left"><?php  echo $nm;?></td>
	<td align="center"><?php  echo $gwn1;?></td>
	<td align="center"><?php  echo $gwn4;?></td>
	<td align="center"><?php  echo $gwn5;?></td>
	<td align="center"><?php  echo $gwn6;?></td>
	<td align="center"><?php  echo $gwn7;?></td>
	<td align="center"><?php  echo $gwn8;?></td>
	<td align="center"><?php  echo $gwn9;?></td>
	<td align="center"><?php  echo $gwn11;?></td>
	<td align="center"><?php  echo $gwn12;?></td>
	<td align="center"><?php  echo $gwn13;?></td>
	<td align="center"><?php  echo $gwn14;?></td>
	<td align="center"><?php  echo $balance;?></td>
	</tr>	 
	<?php 
}
?>
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
							