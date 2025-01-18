<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
$cy=date('Y');
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$rt=$_REQUEST['rt'];
$brncd=$_REQUEST['brncd'];if($brncd==""){$brncd1="";}else{$brncd1=" and main_stock.bcd='$brncd'";}
$cat1="";
$scat1="";
if($scatsl!=""){$scat1=" and scat='$scatsl'";}


if($fdt!="" and $tdt!="")
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));	
$todt=" and main_stock.dt between '$fdt' and '$tdt'";}else{$todt="";}

$val="stk_summarys_product_xls.php?brncd=$brncd&scat=$scatsl&rt=$rt&fdt=$fdt&tdt=$tdt";

set_time_limit(0);
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;

border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<script>
function xls()
{
var val= document.getElementById('val').value;
document.location=val;
}
</script>


</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Stock Summary
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Stock Summary </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                   

                   

                    <!-- Main row -->
                    
                        <!-- Left col -->
                       
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        
                           

                            <!-- Chat box -->
					
                     <!-- /.box (chat box) -->

                            <!-- TO DO List -->
<form method="post" action="stk_summarys_product.php" id="form1" name="form1">
<input type="hidden" id="val" name="val" value="<?php  echo $val?>" class="form-control" > 
<input type="button" value=" Export To Excel " onclick="xls()" class="btn btn-warning">
<div class="box box-success" >
<table  width="100%" class="advancedtable" >
<tr bgcolor="#a2cee6">
<td align="left" rowspan="2"><b>Particulars</b></td>
<td align="center" colspan="3"><b>Opening Balance</b></td>
<td align="center" colspan="3"><b>Inwards</b></td>
<td align="center" colspan="3"><b>Outwards</b></td>
<td align="center" colspan="3"><b>Transfer IN</b></td>
<td align="center" colspan="3"><b>Transfer OUT</b></td>
<td align="center" colspan="3"><b>Closing Balance</b></td>
</tr>
<tr>
<td align="left" bgcolor="#66ffcc" ><b>Quantity</b></td>
<td align="left" bgcolor="#66ffcc" ><b>Rate</b></td>
<td align="left" bgcolor="#66ffcc" ><b>Value</b></td>

<td align="left" bgcolor="#ccffcc" ><b>Quantity</b></td>
<td align="left" bgcolor="#ccffcc" ><b>Rate</b></td>
<td align="left" bgcolor="#ccffcc" ><b>Value</b></td>

<td align="left" bgcolor="#66ccff" ><b>Quantity</b></td>
<td align="left" bgcolor="#66ccff" ><b>Rate</b></td>
<td align="left" bgcolor="#66ccff" ><b>Value</b></td>

<td align="left" bgcolor="#cccc00" ><b>Quantity</b></td>
<td align="left" bgcolor="#cccc00" ><b>Rate</b></td>
<td align="left" bgcolor="#cccc00" ><b>Value</b></td>

<td align="left" bgcolor="#cc99ff" ><b>Quantity</b></td>
<td align="left" bgcolor="#cc99ff" ><b>Rate</b></td>
<td align="left" bgcolor="#cc99ff" ><b>Value</b></td>


<td align="left" bgcolor="#99ffcc" ><b>Quantity</b></td>
<td align="left" bgcolor="#99ffcc" ><b>Rate</b></td>
<td align="left" bgcolor="#99ffcc" ><b>Value</b></td>
</tr>

<?php 


$sln=0;
$topen_stk=0;
$topen_val=0;
$data2= mysqli_query($conn,"select * from main_product where sl>0 and typ='0' $scat1 order by pnm")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$pnm=$row1['pnm'];
$pcd=$row1['sl'];

$open_val=0;
$open_stk=0;
$open_rt=0;
$query4="Select sum(main_stock.opst+main_stock.stin-main_stock.stout) as stck1 from main_stock where pcd='$pcd' and  main_stock.dt<'$fdt'  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$open_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and  main_stock.dt<'$fdt'and (main_stock.opst>0 or main_stock.stin>0)   $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$open_rt=round($R4['stck1'],2);
}
$open_val=$open_stk*$open_rt;
$topen_stk+=$open_stk;
$topen_val+=$open_val;

$in_val=0;
$in_stk=0;
$in_rt=0 ;
$query4="Select sum(main_stock.stin) as stck1 from main_stock where pcd='$pcd'  and (main_stock.nrtn='Purchase' or main_stock.nrtn='Sale Return') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$in_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and main_stock.stin>0  and (main_stock.nrtn='Purchase' or main_stock.nrtn='Sale Return') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$in_rt=round($R4['stck1'],2);
}
$in_val=$in_stk*$in_rt;

$tpin_val+=$in_val;
$tpin_stk+=$in_stk;

$out_val=0;
$out_stk=0;
$out_rt=0;
$query4="Select sum(main_stock.stout) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Sale' or main_stock.nrtn='Purchase Return') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$out_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and main_stock.stout>0 and (main_stock.nrtn='Sale' or main_stock.nrtn='Purchase Return') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$out_rt=round($R4['stck1'],2);
}
$out_val=$out_stk*$out_rt;

$tsout_val+=$out_val;
$tsout_stk+=$out_stk;

$tin_val=0;
$tin_stk=0;
$tin_rt=0;
$query4="Select sum(main_stock.stin+main_stock.opst) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Receive' or main_stock.nrtn='Opening' or main_stock.nrtn='Adjustment')  $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tin_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Receive' or main_stock.nrtn='Opening' or main_stock.nrtn='Adjustment') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tin_rt=round($R4['stck1'],2);
}
$tin_val=$tin_stk*$tin_rt;

$ttin_val+=$tin_val;
$ttin_stk+=$tin_stk;

$tout_val=0;
$tout_stk=0;
$tout_rt=0;
$query4="Select sum(main_stock.stout) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Transfer' or main_stock.nrtn='Opening Out' or main_stock.nrtn='Adjustment') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tout_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Transfer' or main_stock.nrtn='Opening Out' or main_stock.nrtn='Adjustment') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tout_rt=round($R4['stck1'],2);
}
$tout_val=$tout_stk*$tout_rt;
$ttout_val+=$tout_val;
$ttout_stk+=$tout_stk;

$colse_val=0;
$close_stk=0;
$close_rt=0;
$query4="Select sum(main_stock.opst+main_stock.stin-main_stock.stout) as stck1 from main_stock where pcd='$pcd' and main_stock.dt<='$tdt'  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and  main_stock.dt<='$tdt' and (main_stock.opst>0 or main_stock.stin>0)  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_rt=round($R4['stck1'],2);
}
$colse_val=$close_stk*$close_rt;

$tcolse_val+=$colse_val;
$tclose_stk+=$close_stk;

?>
<tr>
<td align="left" ><b><?php  echo $pnm;?></b></td>

<td align="center" ><b><?php  echo $open_stk;?></b></td>
<td align="right" ><b><?php  echo $open_rt;?></b></td>
<td align="right" ><b><?php  echo $open_val;?></b></td>

<td align="center" ><b><?php  echo $in_stk;?></b></td>
<td align="right" ><b><?php  echo $in_rt;?></b></td>
<td align="right" ><b><?php  echo $in_val;?></b></td>

<td align="center" ><b><?php  echo $out_stk;?></b></td>
<td align="right" ><b><?php  echo $out_rt;?></b></td>
<td align="right" ><b><?php  echo $out_val;?></b></td>

<td align="center" ><b><?php  echo $tin_stk;?></b></td>
<td align="right" ><b><?php  echo $tin_rt;?></b></td>
<td align="right" ><b><?php  echo $tin_val;?></b></td>

<td align="center" ><b><?php  echo $tout_stk;?></b></td>
<td align="right" ><b><?php  echo $tout_rt;?></b></td>
<td align="right" ><b><?php  echo $tout_val;?></b></td>

<td align="center" ><b><?php  echo $close_stk;?></b></td>
<td align="right" ><b><?php  echo $close_rt;?></b></td>
<td align="right" ><b><?php  echo $colse_val;?></b></td>
</tr> 

<?php 
}
?>
<tr bgcolor="#a2cee6">
<td align="left" ><font size="3"><b>Total</b></font></td>

<td align="center" ><font size="3"><b><?php  echo $topen_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $topen_val;?></b></font></td>

<td align="center" ><font size="3"><b><?php  echo $tpin_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $tpin_val;?></b></font></td>

<td align="center" ><font size="3"><b><?php  echo $tsout_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $tsout_val;?></b></font></td>

<td align="center" ><font size="3"><b><?php  echo $ttin_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $ttin_val;?></b></font></td>

<td align="center" ><font size="3"><b><?php  echo $ttout_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $ttout_val;?></b></font></td>

<td align="center" ><font size="3"><b><?php  echo $tclose_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $tcolse_val;?></b></font></td>
</tr> 
</table>
</div>
	

	</div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->
   

    </body>
</html>