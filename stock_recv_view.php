<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$blno=$_REQUEST[blno];
$query111 = "SELECT * FROM main_trns where blno='$blno'";
$result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$stat=$R111['stat'];
$fbcd=$R111['fbcd'];
$tbcd=$R111['tbcd'];
}

?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
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
              Transfer Details  <small> <?echo $blno;?> </small> 
                    
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
<input type="hidden" id="blno" name="blno" value="<?=$blno;?>">                   
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" hidden style="padding-top:10px" ><font size="4" ><b>From :</b></font></td>
<td align="left" hidden >
<select name="fbcd" class="form-control" size="1" id="fbcd" style="width:300px" onchange="cbcd()" >
<?

$query="Select * from main_godown where sl='$fbcd'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
$gnm=$R['gnm'];

?>
<option value="<? echo $sl;?>"><? echo $gnm;?></option>
<?
}
?>
</select>
</td>
	           
<td align="right" style="padding-top:10px" ><font size="4" ><b>To :</b></font></td>
<td align="left" >
<select name="tbcd" class="form-control" size="1" id="tbcd" style="width:300px"  >
<?
$query="Select * from main_godown where sl='$tbcd'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm6=$R['bnm'];
$gnm6=$R['gnm'];
?>
<option value="<? echo $sl;?>"><? echo $gnm6;?></option>
<?
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
<td  align="left" width="16%"><b>Godown</b></td>
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
<?
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
$cnm="";				
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm=$row1['cnm'];
}
$bcdnm="";
$getii=mysqli_query($conn,"select * from main_godown where sl='$fbcd'") or die(mysqli_error($conn));
while($rowii=mysqli_fetch_array($getii))
{
$bcdnm=$rowii['gnm'];
}
?>
<tr class="even">
<td  align="left" width="22%"><b><?=$pnm;?></b></td>
<td  align="left" width="16%"><b><?=$bcdnm;?></b></td>
<td  align="left" width="10%"><b><?=$unit_name;?></b></td>
<td  align="left" width="16%"><b><?=$betno;?></b></td>
<td align="center" width="16%" ><b><?=$qnty;?></b></td>
<td align="center" width="16%" ><b><?=$remk;?></b></td>
</tr>
<?}?>
</table>
</td>
</tr>

<tr>
<td align="right">
<?
if($stat==0)
{
?>
<input type="submit" class="btn btn-success" id="button2" name="" value="Submit"  >
<?
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