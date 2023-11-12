<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$blno=rawurldecode($_REQUEST['blno']);
$typ=$_REQUEST['typ'];
$al="%".$blno."%";
if($blno!="")
{
	$blno1=" and (blno LIKE '$al')"; 
}
else
{
	$blno1="";	
}
if($typ!=""){  $typ1=" and stat='$typ'";}else{$typ1="";}

$pno=rawurldecode($_REQUEST['pno']);
//echo $src;
$ps=rawurldecode($_REQUEST['ps']);
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;
?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?=$ps;?>" size="7" onblur="pagnt1(this.value)">
</div>

<table class="table table-hover table-striped table-bordered">	
<tr>

<th>Sl</th>
<th>Customer</th>
<th>Bill No.</th>
<th>Bill Date </th>
<th>Payment Date</th>
<th>Date Difference</th>
<th>Discount(%)</th>
<th>Payment Amount</th>
<th>Discount Amount</th>
<th>
<label>
All
<input type="checkbox" name="chkall" onchange="checkall(this.checked)" style="width:20px;"/>
</label>
<input type="hidden" id="abc" name="abc" value=""size="10">
</th>
<th>Action</th>
</tr>
<?php
$sl=$start;
$sln=0;
$datatt=mysqli_query($conn,"select * from main_discountdtls where sl>0")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar=mysqli_query($conn,"select * from main_discountdtls where  sl>0".$blno1.$typ1)or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data=mysqli_query($conn,"select * from main_discountdtls where  sl>0 $blno1 $typ1 limit $start,$ps ")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$x=$row['sl'];
	$cid=$row['cid'];
	$blno=$row['blno'];
	$bdt1=$row['bdt'];
	$pdt1=$row['pdt'];
	$difdt=$row['difdt'];
	$prc=$row['prc'];
	$pamm=$row['pamm'];
	$damm=$row['damm'];
	$stat=$row['stat'];
	$eby=$row['eby'];
	
	$bdt=date('d-m-Y', strtotime($bdt1));
	$pdt=date('d-m-Y', strtotime($pdt1));

$sln++;   
$sl++; 

$cnm="";
$data1 = mysqli_query($conn,"Select * from main_cust where sl='$cid'");
while ($row1 = mysqli_fetch_array($data1))
{
	$cnm=$row1['nm'];
}
?>
<tr>
<td align="center"><?php echo $sl;?></td>
<td align="left"><? echo $cnm;?></td>
<td align="left"><? echo $blno;?></td>
<td align="center"><? echo $bdt;?></td>
<td align="center"><? echo $pdt;?></td>
<td align="center"><? echo $difdt;?></td>
<td align="right"><? echo $prc;?></td>
<td align="right"><? echo $pamm;?></td>
<td align="right"><? echo $damm;?></td>
<td align="right">
<input type="checkbox" name="chk[]" id="chk[]" value="<?=$x;?>"  onclick="ch1('<?=$x;?>',this.checked)" style="width:20px;"/>
</td>
<td align="right">
<?php 
if($stat=='0')
{
?>
<a style="cursor:pointer" onclick="act('<?=$x;?>','3')"><font style="color:red" class="label label-warning"><b>Cancel</b></font></a>
<?php 
}
?>
</td>
</tr>
<?php
}
if($typ=='0')
{
?>	 
<tr>	
<td align="right" colspan="11">
	<input type="submit" class="btn btn-success" value="Submit" >
</td>
</tr>	 
<?php
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
