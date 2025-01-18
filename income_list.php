<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$ext="jpg";
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$pno1=$_REQUEST['pno1'];
$ledg=$_REQUEST['ledg'];
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];

if($pno1!=0)
{$pnoo=" and pno='$pno1'";}else{$pnoo="";}

$pnog=rawurldecode($_REQUEST['pnog'] ?? "");

//echo $src;
$ps=rawurldecode($_REQUEST['ps'] ?? "");
if($ps=="")
{
$ps=10;
}
if($pnog==""){$pnog=1;}
$start=($pnog-1)*$ps;


if($tdt!="" and $fdt!="")
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$qr=" and dt between '$fdt' and '$tdt'";
}
else
{
$qr="";
}
if($ledg!="")
{
$ledg1=" and (cldgr='$ledg' or dldgr='$ledg')";
}else
{
$ledg1="";	
}




?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?php  echo $ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
<table width="100%" border="0" class="table table-hover table-striped table-bordered">
<tr style="height: 30px;">
<th align="center">Sl.</th>
<th align="center">Date & JF No.</th>
<th align="center">Credit Ledger & <br>Debit Ledger</th>
<th align="center">Amount</th>
<th align="center">Payment Details</th>
<th align="center" >Narration</th>
<th align="center" >Image</th>
<th align="center">Edit</th>
<th align="center">Print</th>
<th align="center">Cancel</th>
</tr>
<tbody>
<?php 
$f=0;
$sl=$start;
$sln=0;
$datatt= mysqli_query($conn,"SELECT * FROM main_drcr where typ='33' and stat='1'".$brncd1.$pnoo.$qr.$ledg1)or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"SELECT * FROM main_drcr where typ='33' and stat='1'".$pnoo.$brncd1.$qr.$ledg1)or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data= mysqli_query($conn,"SELECT * FROM main_drcr where typ='33' and stat='1' $pnoo $brncd1 $qr $ledg1 order by dt Desc limit $start,$ps")or die(mysqli_error($conn));


while ($row = mysqli_fetch_array($data))
{
$sl1= $row['sl'];
$dt= $row['dt'];
$pno= $row['pno'];
$vno= $row['vno'];
$blnon= $row['blnon'];
$cldgr= $row['cldgr'];
$dldgr= $row['dldgr'];
$mtd= $row['mtd'];
$mtddtl= $row['mtddtl'];
$amm= $row['amm'];
$nrtn= $row['nrtn'];
$eby= $row['eby'];
$edt= $row['edt'] ?? "";
$path= $row['path'];

if($mtddtl=='')
{$mtddtl='NA';
}
if($nrtn=='')
{$nrtn='NA';
}

//$imgpath="img/income/".$vno.".jpg";

if (!file_exists($path)) {
$imgpath1="img/noimg.jpg";
}
else
{
$ext = strtolower(pathinfo($path,PATHINFO_EXTENSION));
$imgpath1=$path;
}

$data1= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$cldgr'");
while ($row1 = mysqli_fetch_array($data1))
{
$cldgr= $row1['nm'];
}

$data2= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$dldgr'");
while ($row2 = mysqli_fetch_array($data2))
{
$dldgr= $row2['nm'];
}

$data3= mysqli_query($conn,"SELECT * FROM ac_paymtd where sl='$mtd'");
while ($row3 = mysqli_fetch_array($data3))
{
$mtd= $row3['mtd'];
}
$data21= mysqli_query($conn,"SELECT * FROM main_project where sl='$pno'");
while ($row21 = mysqli_fetch_array($data21))
{
$pno= $row21['nm'];
}
if($pno=='0')
{$pno='NA';
}


$f++;
if($f%2==0)
{$cls="odd";
}
else
{$cls="even";
}
$dt=date('d-M-Y', strtotime($dt));
?>
<tr class="<?php echo $cls;?>" style="height: 20px;">
<td align="left" valign="top"><a href="#" title="By : <?php  echo $eby;?> | On :<?php  echo $edt;?>"><b><?php echo $f;?></b></td>
<td align="left" valign="top"><b>Date :</b> <?php echo $dt;?><br><b>JF No :</b> <?php echo $blnon;?></td>
<td align="left" valign="top"><b>C.Ledger :</b> <?php echo $cldgr;?><br><b>D.Ledger :</b> <?php echo $dldgr;?></td>

<td align="center" valign="top" align="right"><font color="red">Rs. <b><?php echo $amm;?></b></font></td>
<td align="left" valign="top"><b>Mode :</b> <?php echo $mtd;?><br><b>Ref. : </b><?php echo $mtddtl;?></td>
<td align="left" valign="top"><?php echo $nrtn;?></td>

<td align="center" valign="top">
<?php 
if($ext=='png' || $ext=='gif' || $ext=='jpeg' || $ext=='jpg' ){
?>
<!--<a href="<?php  echo $imgpath1;?>" target="_blank"> <img src="<?php  //echo $imgpath1;?>" width="100" height="50"/></a>--->
<a href="<?php  echo $imgpath1;?>" target="_blank">  Click Here to Download</a>
<?php  } elseif($ext!=''){ ?>
<a href="<?php  echo $imgpath1;?>" target="_blank"> Click Here to Download</a>
<?php  } else{} ?>
</td>

<td align="center" valign="top">
<a href="#" onclick="sfdtl3income('<?php  echo $sl1; ?>')" title="Edit"><img src="images/edit.png" width="30"/></a>
</td>	
<td align="center" valign="top">
<a href="income_cash_report.php?sl=<?php  echo $sl1;?>" target="_blank" title="Click Here To Print Voucher"><i class="fa fa-print fa-2x" style="color:#333333;"></i></a>
</td>	
<td align="center" valign="top">
<a href="#" onclick="cancell('<?php  echo $sl1; ?>')" title="Cancel"><font color="red"><i class="fa fa-times fa-2x"></i></font></a>
</td>

</tr>
<?php 
}
?>
</tbody>
</table>
<?php 
$tp=$rcnt/$ps;

if(($rcnt%$ps)>0)
{
$tp=floor($tp)+1;
}
if($pnog==1)
{
$prev=1;
}
else
{
$prev=$pnog-1;    
}
if($pnog==$tp)
{
$next=$tp;   
}
else
{
$next=$pnog+1;
}
$flt="";
if($rcnt!=$rcntttl)
{
$flt="(filtered from ".$rcntttl." total entries)";
}
echo "<font color=\"#000\"> Showing ".($start+1)." to ".($sl)." of ".$rcnt." entries".$flt."</font>";
?>
<div align="center"><input type="text" size="10" id="pgn" name="pgn" value="<?php  echo $pnog;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>
<div class="pagination pagination-centered">
<ul class="pagination pagination-sm inline">
<li <?php  if($pnog==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>
<li <?php  if($pnog==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>
<?php 

if($tp<=5)
{
$n=1;  
while($n<=$tp)
{
?>
<li <?php  if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
<?php 
$n+=1;
}  
}
else
{
if($pnog<4)
{
$n=1;
while($n<=5)
{
?>
<li <?php  if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
<?php 
$n+=1;
}     
}
elseif($pnog>$tp-3)
{
$n=$tp-5;
while($n<=5)
{
?>
<li <?php  if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
<?php 
$n+=1;
}   
}
else
{
$n=$pnog-2; 
while($n<=$pnog+2)
{
?>
<li <?php  if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
<?php 
$n+=1;
}     
}



}

?>
<li <?php  if($pnog==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>
<li <?php  if($pnog==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>
</ul>
</div>
