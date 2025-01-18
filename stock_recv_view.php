<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$blno=$_REQUEST['blno'];
$query111 = "SELECT * FROM main_trns where blno='$blno'";
$result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$stat=$R111['stat'];
$fbcd=$R111['fbcd'];
$tbcd=$R111['tbcd'];
}
$bcd_tags=[];
$geti=mysqli_query($conn,"select * from main_godown_tag where brncd='$branch_code' group by bcd") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($geti))
{
$bcd_tags[]=$row['bcd'];
}
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<style type="text/css"> 


input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<script>
function recieve(sl4)
{
document.location = 'stockrecv.php?sl4='+sl4;
}
</script>
</head>
<body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
              Transfer Details  <small> <?php echo $blno;?> </small> 
                    
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="stock_recv.php"><i class="fa fa-home"></i> Transfer List</a></li>
                        <li class="active">Transfer Details</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<form method="post" action="stock_recevs.php" id="form1" name="form1"   style="position:relative;">
<input type="hidden" id="blno" name="blno" value="<?php  echo $blno;?>">                   
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" hidden style="padding-top:10px" ><font size="4" ><b>From :</b></font></td>
<td align="left" hidden >
<select name="fbcd" class="form-control" size="1" id="fbcd" style="width:300px" onchange="cbcd()" >
<?php 

$query="Select * from main_godown where sl='$fbcd'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
$gnm=$R['gnm'];

?>
<option value="<?php  echo $sl;?>"><?php  echo $gnm;?></option>
<?php 
}
?>
</select>
</td>
	           
<td align="right" style="padding-top:10px" ><font size="4" ><b>To-Godown :</b></font></td>
<td align="left" >
<select name="tbcd" class="form-control" size="1" id="tbcd" style="width:300px"  >
<?php 
$query="Select * from main_godown where sl='$tbcd'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm6=$R['bnm'];
$gnm6=$R['gnm'];
?>
<option value="<?php  echo $sl;?>"><?php  echo $gnm6;?></option>
<?php 
}
?>
</select>
</td>
</tr>
</table>

<table width="800px" class="table table-hover table-striped table-bordered">
<tr>
<td>
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="22%"><b>Particulars</b></td>
<td  align="left" width="16%"><b>From Godown</b></td>
<td  align="left" width="10%"><b>Unit</b></td>
<td  align="left" width="16%"><b>Serial No.</b></td>
<td align="center" width="16%" ><b>Quantity</b></td>
<td align="center" width="16%" ><b>Remark</b></td>
</tr>
</table>
</td>
</tr>

<tr>
<td>
<table border="0" width="100%" class="advancedtable">
<?php 
$query100 = "SELECT * FROM main_trndtl where blno='$blno' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$prnm=$R100['prnm'];
$prsl=$R100['prsl'];
$qnty=$R100['qty'];
$unit=$R100['unit'];
$betno=$R100['betno'];
$remk=$R100['remk'];
$fbcd=$R100['fbcd'];

$query6="select * from  ".$DBprefix."product where sl='$prsl'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
}
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$prsl'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$unit_name=$roww[$unit];
}

$bcdnm="";
$getii=mysqli_query($conn,"select * from main_godown where sl='$fbcd'") or die(mysqli_error($conn));
while($rowii=mysqli_fetch_array($getii))
{
$bcdnm=$rowii['gnm'];
}
?>
<tr class="even">
<td  align="left" width="22%"><b><?php  echo $pnm;?></b></td>
<td  align="left" width="16%"><b><?php  echo $bcdnm;?></b></td>
<td  align="left" width="10%"><b><?php  echo $unit_name;?></b></td>
<td  align="left" width="16%"><b><?php  echo $betno;?></b></td>
<td align="center" width="16%" ><b><?php  echo $qnty;?></b></td>
<td align="center" width="16%" ><b><?php  echo $remk;?></b></td>
</tr>
<?php }?>
</table>
</td>
</tr>

<tr>
<td align="right">
<?php 
$tag_bcd_exists=array_search($tbcd,$bcd_tags);
if($stat==0 and ($user_current_level<0 or $tag_bcd_exists!=""))
{
?>
<input type="submit" class="btn btn-success" id="button2" name="" value="Submit"  >
<?php 
}
?>
</td>
</tr>

	   </table>
		
  </div>
								</form><!-- /.box-body -->
                                           </section><!-- /.content -->
            </aside><!-- /.right-side -->     
    </body>            
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

      
   

        <!-- add new calendar event modal -->

     


</html>