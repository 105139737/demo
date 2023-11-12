<?php
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dt=date('d-M-Y');
$cy=date('Y');

$fdt1=$_REQUEST['fdt'];
$tdt1=$_REQUEST['tdt'];
$all=rawurldecode($_REQUEST[src]);
$al="%".$all."%";
if($all!="")
{
	$all1=" and (call_id LIKE '$al' or tech_id LIKE '$al' or cnm LIKE '$al' or cmob LIKE '$al' or addr LIKE '$al' or brand LIKE '$al' or model LIKE '$al' or serial_no LIKE '$al' or call_type LIKE '$al' or remark LIKE '$al')";
}
else
{
	$all1="";	
}

$fdt=date('Y-m-d', strtotime($fdt1));
$tdt=date('Y-m-d', strtotime($tdt1));

if($fdt!="" and $tdt!="")
{	
	$ftdt=" and cdt between '$fdt' and '$tdt'";
}
else
{
	$ftdt="";
}

$pno=rawurldecode($_REQUEST['pno']);

$ps=rawurldecode($_REQUEST['ps']);
if($ps=="")
{
$ps=30;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;

$c=0;
$sl=$start;
$ttl=0;
$ttl1=0;
$datatt=mysqli_query($conn,"SELECT * FROM main_call where stat='1' order by sl")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"SELECT * FROM main_call where stat='1' $all1 $ftdt order by sl")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$get=mysqli_query($conn,"select * from main_call where stat='1' $all1 $ftdt order by sl limit $start,$ps") or die(mysqli_error($conn));
$total=mysqli_num_rows($get);
if($total!=0)
{
?>
<br>
<div align="left">
<input type="text" name="ps" id="ps" value="<?=$ps;?>" size="7" onblur="pagnt1(this.value)" style="width:50px;">
</div>
<div class="box box-success">
<table class="table table-hover table-striped table-bordered" style="width:100%;" align="center">
<tr><td colspan="6" align="center"><font color="#dd4f43" size="4"><b>Total <?=$rcntttl;?></b></font></td></tr>
<tr>
<td style="text-align:center"><font size="2" color="#109e59"><b>Sl No.</b></font></td>
<td style="text-align:center"><font size="2" color="#109e59"><b>Call Details</b></font></td>
<td style="text-align:center"><font size="2" color="#109e59"><b>Customer Details</b></font></td>
<td style="text-align:center"><font size="2" color="#109e59"><b>Product</b></font></td>
<td style="text-align:center"><font size="2" color="#109e59"><b>Remark</b></font></td>
<td style="text-align:center"><font size="2" color="#109e59"><b>Action</b></font></td>
</tr>
<?
while($row=mysqli_fetch_array($get))
{
	//call_id	tech_id	cnm	cmob	addr	brand	model	serial_no	call_type	remark	parts	edt	edtm	eby	stat
	$c++;
	$sl=$row['sl'];
	$call_id=$row['call_id'];
	$tech_id=$row['tech_id'];
	$cnmsl=$row['cnm'];
	$cmob=$row['cmob'];
	$addr=$row['addr'];
	$brandsl=$row['brand'];
	$model=$row['model'];
	$serial_no=$row['serial_no'];
	$call_typesl=$row['call_type'];
	$remark=$row['remark'];
	$parts=$row['parts'];
	$edt=$row['edt'];
	$edtm=$row['edtm'];
	$eby=$row['eby'];
	$stat=$row['stat'];
	$cdt=$row['cdt'];
	
	$get1=mysqli_query($conn,"select * from main_cust where sl='$cnmsl'") or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($get1))
	{
		$cnm=$row1['nm'];
	}
	$get2=mysqli_query($conn,"select * from main_brand where sl='$brandsl'") or die(mysqli_error($conn));
	while($row2=mysqli_fetch_array($get2))
	{
		$brand=$row2['brand'];
	}
	$get3=mysqli_query($conn,"select * from main_call_typ where sl='$call_typesl'") or die(mysqli_error($conn));
	while($row3=mysqli_fetch_array($get3))
	{
		$call_type=$row3['call_typ'];
	}
	
?>
<tr>
<td style="text-align:center;"><?=$c;?></td>
<td style="text-align:left;">
<b>Call ID: </b><?=$call_id;?><br>
<b>Call Type: </b><?=$call_type;?><br>
<b>Call Date: </b><?=date('d-m-Y',strtotime($cdt));?>
</td>
<td style="text-align:left;">
<b>Name: </b><?=$cnm;?><br>
<b>Address: </b><?=$addr;?><br>
<b>Mobile: </b><?=$cmob;?>
</td>
<td style="text-align:left;">
<b>Brand: </b><?=$brand;?><br>
<b>Model: </b><?=$model;?><br>
<b>Serial No.: </b><?=$serial_no;?>
</td>
<td style="text-align:center"><?=$remark;?></td>
<td style="text-align:center">
<button type="button" class="btn btn-info" onclick="astntcn('<?=$sl;?>')">Assign to Technician</button>
</td>
</tr>
<?															
}
?>
</table>
</div>
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
$cnt1=$c+$start;
$flt="";
if($rcnt!=$rcntttl)
{
    $flt="(filtered from ".$rcntttl." total entries)";
}
echo "Showing ".($start+1)." to ".($cnt1)." of ".$rcnt." entries".$flt;
?>
<center>
<div class="pagination pagination-centered">
    <table border="0" style="width:10%">
        <tr>
            <td>
            <input type="text" size="10" id="pgn" name="pgn" value="<?=$pno;?>" style="text-align:center; width:50px;">
            </td><td>
            <input type="button" value="Go" onclick="pagnt1()">
            </td>
        </tr>
    </table>


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
</center>
<?
}
else
{
?>
<table class="table table-hover table-striped table-bordered">
<tr>
<td style="text-align:center;"><font size="4" color="red"><b>No Records Available</b></font></td>
</tr>
</table>
<?
}
?>