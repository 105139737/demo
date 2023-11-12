<?php
$reqlevel = 3;
include("membersonly.inc.php");
$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$fdt=$_REQUEST[fdt];
$tdt=$_REQUEST[tdt];
$stat=$_REQUEST[stat];
$bcd=$_REQUEST[bcd];

if($fdt!="" and $tdt!="")
{
	$fdt=date("Y-m-d", strtotime($fdt));
$tdt=date("Y-m-d", strtotime($tdt));
$dtt=" and dt between '$fdt' and '$tdt'";
}
else
{
	$dtt="";
}
if($stat!='')
	{
			
	$stat1=" and stat='$stat'";
	}
	else
	{$stat1="";}
if($bcd!='')
	{
			
	$bcd1=" and tbcd='$bcd'";
	}
$pno=$_REQUEST[pno];
$src=rawurldecode($_REQUEST[src]);
//echo $src;
$ps=$_REQUEST[ps];
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;




?>
<div align="left">
<input type="text" value="<?=$ps;?>" name="ps" id="ps" size="6">
</div>

<table width="100%" class="table table-hover table-striped table-bordered" >
<tr>
<td align="center">Trn. No.</td>

<td align="center">To Godown</td>
<td align="center">Date</td>
<td align="center">Action</td>
</tr>
<?
$sl=$start;
$c='odd';


$datatt= mysqli_query($conn,"select * from main_trns where sl>0 $stat1")or die(mysqli_error($conn));
$datar= mysqli_query($conn,"select * from main_trns where sl>0 ".$stat1.$dtt.$bcd1)or die(mysqli_error($conn));
$data= mysqli_query($conn,"select * from main_trns where sl>0 $stat1 $dtt $bcd1 order by sl DESC limit $start,$ps ")or die(mysqli_error($conn));

$rcntttl=mysqli_num_rows($datatt);
$rcnt=mysqli_num_rows($datar);
while ($row = mysqli_fetch_array($data))
{
$fbcd=$row['fbcd'];
$tbcd=$row['tbcd'];
$dt=$row['dt'];
$blno=$row['blno'];
$stat=$row['stat'];


$query="Select * from main_godown where sl='$fbcd'";
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
	<tr>
	<td align="center">
	<b><a href="bill_new_trn.php?blno=<?=rawurlencode($blno);?>" target="_blank"><font color="red"><u><?=$blno; ?></u></font></a></b></font>
	</td>
	
	<td align="center"><?=$tgnm;?></td>
	<td align="center"><?=$dt; ?></td>
	<td align="center">
	<input type="button" class="btn btn-info" id="button2" name="" value="View" onclick="recieve('<?=$blno;?>')" >
	<?

	if($user_current_level<0 and $stat==0){?>
	<input type="button" class="btn btn-success" id="button2" name="" value="Edit" onclick="edit('<?=$blno;?>')" >
	<?}

	?>
	</td>
		
</tr>
<?}?>	


</table>
<div >
<?
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
<div align="center"><input type="text" size="10" id="pgn" name="pgn" value="<? echo $pno;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>
<div class="pagination pagination-centered">
                            <ul class="pagination pagination-sm inline">
							<li <? if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>
                            <li <? if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>
                            <?
                            
                            if($tp<=5)
                            {
                              $n=1;  
                              while($n<=$tp)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
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
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }     
                                }
                                elseif($pno>$tp-3)
                                {
                                    $n=$tp-5;
                                    while($n<=5)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }   
                                }
                                else
                                {
                                $n=$pno-2; 
                                 while($n<=$pno+2)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }     
                                }
                               
                                
                                
                            }
                            ?>
                            <li <? if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>
                            <li <? if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>
                            </ul>
                            </div>
							