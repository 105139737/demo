<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$fdt=$_REQUEST['fdt']??"";
$tdt=$_REQUEST['tdt']??"";
$stat=$_REQUEST['stat']??"";
$bcd=$_REQUEST['bcd']??"";

if($fdt!="" and $tdt!="")
{
	$fdt=date("Y-m-d", strtotime($fdt));
$tdt=date("Y-m-d", strtotime($tdt));
$dtt=" and main_trns.dt between '$fdt' and '$tdt'";
}
else
{
	$dtt="";
}
if($stat!='')
	{
			
	$stat1=" and main_trns.stat='$stat'";
	}
	else
	{$stat1="";}
	$bcd1="";
if($bcd!='')
	{
			
	$bcd1=" and main_trns.tbcd='$bcd'";
	}
$pno=$_REQUEST['pno'] ?? "";
$src=rawurldecode($_REQUEST['src'] ?? "");
//echo $src;
$ps=$_REQUEST['ps'] ?? "";
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;

$bcd_tags=[];
$geti=mysqli_query($conn,"select * from main_godown_tag where brncd='$branch_code' group by bcd") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($geti))
{
$bcd_tags[]=$row['bcd'];
}
$q="";
if(!empty($bcd_tags))
{
    $bcd_tags1=implode(",",$bcd_tags);
    $q=" and (FIND_IN_SET(main_trns.tbcd, '$bcd_tags1')>0 or FIND_IN_SET(main_trndtl.fbcd, '$bcd_tags1')>0)";
}
if($user_current_level<0){
   $q=""; 
}
?>
<div align="left">
<input type="text" value="<?php  echo $ps;?>" name="ps" id="ps" size="6">
</div>

<table width="100%" class="table table-hover table-striped table-bordered" >
<tr>
<td align="center" width="15%">E-WayBill</td>
<td align="center">Trn. No.</td>
<td align="center">From Godown</td>
<td align="center">To Godown</td>
<td align="center">Date</td>
<td align="center">Action</td>
</tr>
<?php 
$sl=$start;
$c='odd';


//$datatt= mysqli_query($conn,"select main_trns.* from main_trns LEFT JOIN main_trndtl ON main_trns.blno=main_trndtl.blno where main_trns.sl>0 $q $stat1 $dtt $bcd1")or die(mysqli_error($conn));
$datar= mysqli_query($conn,"select DISTINCT main_trns.*,main_trndtl.fbcd as fromGodown from main_trns LEFT JOIN main_trndtl ON main_trns.blno=main_trndtl.blno where main_trns.sl>0 $q ".$stat1.$dtt.$bcd1)or die(mysqli_error($conn));
$data= mysqli_query($conn,"select DISTINCT main_trns.*,main_trndtl.fbcd as fromGodown from main_trns LEFT JOIN main_trndtl ON main_trns.blno=main_trndtl.blno where main_trns.sl>0 $q $stat1 $dtt $bcd1 order by sl DESC limit $start,$ps ")or die(mysqli_error($conn));

//$rcntttl=mysqli_num_rows($datatt);
$rcnt=mysqli_num_rows($datar);
$rcntttl=$rcnt;
while ($row = mysqli_fetch_array($data))
{
$blno_sl=$row['sl'];
$fbcd=$row['fbcd'];
$tbcd=$row['tbcd'];
$dt=$row['dt'];
$blno=$row['blno'];
$stat=$row['stat'];
$vno=$row['vno'];
$fromGodown=$row['fromGodown'];
$colorStatus=$row['colorStatus'];
$backg="";
if($colorStatus==1){$backg="#ffff00";}

$query="Select * from main_godown where sl='$fromGodown'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$bnm=$R['bnm'];
$fgnm=$R['gnm'];
}
$queryu="Select * from main_godown where sl='$tbcd'";
$resultu = mysqli_query($conn,$queryu);
while ($Ru = mysqli_fetch_array ($resultu))
{
$bnmu=$Ru['bnm'];
$tgnm=$Ru['gnm'];
}
$sl++; 
?>
	<tr id="trid<?php  echo $blno_sl;?>" style="background-color:<?php  echo $backg;?>">
  <td align="center">
	<input onclick="window.open('einv_json_trn.php?blno=<?php  echo $blno;?>','_blank'); document.getElementById('trid<?php  echo $blno_sl;?>').style.backgroundColor='#ffff00';" type="button" class="btn btn-info btn-xs bg-blue" id="button2" name="" value="E-WayBill Export"  >
	
</td>
	<td align="center">
  <input type="text" id="vno" name="vno" value="<?php  echo $vno;?>" placeholder="Vehicle Number" onblur="update_vno(this.value,'<?php  echo $blno_sl;?>')"><br>
	<b><a href="bill_new_trn.php?blno=<?php echo rawurlencode($blno);?>" target="_blank"><font color="red"><u><?php  echo $blno; ?></u></font></a></b></font>
	
</td>	
<td align="center"><?php  echo $fgnm;?></td>
	<td align="center"><?php  echo $tgnm;?></td>
	<td align="center"><?php  echo $dt; ?></td>
	<td align="center">
	<input type="button" class="btn btn-info" id="button2" name="" value="View" onclick="recieve('<?php  echo $blno;?>')" >
	<?php 
    $tag_bcd_exists=array_search($fromGodown,$bcd_tags);
	if(($user_current_level<0 or $tag_bcd_exists!="") and $stat==0){ ?>
	<input type="button" class="btn btn-success" id="button2" name="" value="Edit" onclick="edit('<?php  echo $blno;?>')" >
	<?php }

	?>
	</td>
		
</tr>
<?php }?>	


</table>
<div >
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
							