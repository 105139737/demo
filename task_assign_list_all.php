<?php
$reqlevel = 3;
include("membersonly.inc.php");


$frmnm='';


$cy=date('Y');
$spid=rawurldecode($_REQUEST[spid]);
$fdt=rawurldecode($_REQUEST[fdt]);
$tdt=rawurldecode($_REQUEST[tdt]);

if($spid!="")
{
	$all1=" and spid='$spid'";
}
else
{
$all1="";	
}
if($fdt!="" or $tdt!='')
{
	$fdt1=date('Y-m-d',strtotime($fdt));
	$tdt1=date('Y-m-d',strtotime($tdt));
$ff=" and dt between '$fdt1' and '$tdt1'";
}
$pno=rawurldecode($_REQUEST[pno]);

//echo $src;
$ps=rawurldecode($_REQUEST[ps]);
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;


$sl=$start;
$sln=0;

//echo "select * from  main_task where sl>0 $cstnm1 $all1 order by sl limit $start,$ps ";

$datatt= mysqli_query($conn,"select * from  main_task where sl>0 $all1 $ff")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from main_task where sl>0  $all1 $ff")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);

$data= mysqli_query($conn,"select * from  main_task where sl>0 $all1 $ff order by dt,spid limit $start,$ps ")or die(mysqli_error($conn));
$ccnt=mysqli_num_rows($datar);
if($ccnt>0)
{
	
?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?=$ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
<table  class="table table-hover table-striped table-bordered"  >

<tr>
<!-- <th width="5%">Action</font></th>-->
<th width="5%">Sl</font></th>
<th style="text-align:center">Date</font></th>
<th style="text-align:left">Sales Person</font></th>
<th style="text-align:left">Day</font></th>
<th style="text-align:left">Assigned Customer</font></th>
<th style="text-align:left">Visited Customer</font></th>


</tr>
<?


while ($row = mysqli_fetch_array($data))
{
$sln++;
$sl++;
$x=$row['sl'];
$spid=$row['spid'];
$cust_visit_sl=$row['cust_visit_sl'];
$cust=$row['cust'];
$day=$row['day'];
$dt=$row['dt'];



$spid2="";
$data1 = mysqli_query($conn,"Select * from main_sale_per where spid='$spid'");
while ($row1 = mysqli_fetch_array($data1))
	{

	$spid2=$row1['spid'];
	}
	
	$cnt=0;
	$csl="";
	$cnm="";

	$data13 = mysqli_query($conn,"Select * from main_cust where FIND_IN_SET(sl, '$cust')");
	while ($row13 = mysqli_fetch_array($data13))
	{
		
	$cnt++;	
	$cust_sl=$row13['sl'];
	$color="";
	if($custm==$cust_sl){$color="red";}
	$cnm="<font color='$color'>".$row13['nm']."</font>";
	if($csl=="")
	{
	 $csl=$cnt.") ".$cnm;	
	}
	else
	{
	$csl=$csl." <br/> ".$cnt.") ".$cnm;
	}
	
	}
	
	
	$cnte=0;
	$csle="";
	$cnme="";

	$data13e = mysqli_query($conn,"Select * from main_cust where FIND_IN_SET(sl, '$cust_visit_sl')");
	while ($row13e = mysqli_fetch_array($data13e))
	{
		
	$cnte++;	
	$cust_sle=$row13e['sl'];
	
	$mnnm=mysqli_query($conn,"select * from  main_task_visit_log where tasksl='$x' and custsl='$cust_sle' and spid='$spid'") or die (mysqli_error($conn));
	while($rftg=mysqli_fetch_array($mnnm))
	{
		$edtm=$rftg['edtm'];
	}
	$colore="";
	if($custme==$cust_sle){$color="red";}
	$cnme="<font color='$color'>".$row13e['nm']."</font>";
	if($csle=="")
	{
	 $csle=$cnte.") ".$cnme."--Time:".$edtm;	
	}
	else
	{
	$csle=$csle." <br/> ".$cnte.") ".$cnme."--Time:".$edtm;;
	}
	
	}
	


?>
	<tr>
	<td align="center"><? echo $sln;?></td>
	<td align="center"><? echo date('d-m-Y',strtotime($dt));?></td>
	<td align="left"><? echo $spid2;?></td>
	<td align="left"><? echo $day;?></td>
    <td align="left">
	
	<?
	$cnt2=0;
	$data13 = mysqli_query($conn,"Select * from main_cust where FIND_IN_SET(sl, '$cust')");
	while ($row13 = mysqli_fetch_array($data13))
	{
		
	$cnt2++;	
	$cust_sl=$row13['sl'];
	$color="";
	if($custm==$cust_sl){$color="red";}
	 $cnm="<font color='$color'>".$row13['nm']."</font>";
	
	?>
	<a href="details.php?cust_sle=<?echo $cust_sl;?>&dt=<?echo $dt;?>"><?echo $cnt2.")".$cnm."<br>";?></a>
	<?
	}
	
	?>
	
	</td>
    <td align="left"><? 
	
	$cnte=0;
	$csle="";
	$cnme="";

	$data13e = mysqli_query($conn,"Select * from main_cust where FIND_IN_SET(sl, '$cust_visit_sl')");
	while ($row13e = mysqli_fetch_array($data13e))
	{
		
	$cnte++;	
	$cust_sle=$row13e['sl'];
	
	$mnnm=mysqli_query($conn,"select * from  main_task_visit_log where tasksl='$x' and custsl='$cust_sle' and spid='$spid'") or die (mysqli_error($conn));
	while($rftg=mysqli_fetch_array($mnnm))
	{
		$edtm=$rftg['edtm'];
	}
	$colore="";
	if($custme==$cust_sle){$color="red";}
	$cnme="<font color='$color'>".$row13e['nm']."</font>";
	
	 $csle=$cnte.") ".$cnme."--Time:".$edtm;	
	
	 ?><a href="details.php?cust_sle=<?echo $cust_sle;?>&&dt=<?echo $dt;?>"><?echo $csle."<br>";?></a><?
	}
	
	
	?></td>
    
		</tr>	 
<?
}


?>
</table>
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
<?
}
else
{
	?>
	<center><font color="red" size="4"><b>No Data Available...</b></font></center>
	<?
}
?>