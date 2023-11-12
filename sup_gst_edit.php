<?php
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$sl=base64_decode($_REQUEST['sl']);
$data= mysqli_query($conn,"select * from main_suppl_gst where  sl='$sl'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$sid=$row['spn'];

$addr=$row['addr'];
$gstin=$row['gstin'];
$pan=$row['pan'];
$st=$row['st'];
}

if($st==""){$st=1;}

?>
<html>
<head>

        <div class="wrapper row-offcanvas row-offcanvas-left">

            <?

            include "left_bar.php";

            ?>

<style type="text/css"> 
th{
text-align:center;
font-weight: 900;
color:#000;
border:1px solid #37880a;
}
input:focus{
background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<script type="text/javascript" src="prdcedt.js"></script>
<script>	
$(document).ready(function()
{
$('#overlay').fadeOut('fast');
});


function check1()
{

if(document.getElementById('spnm').value=='')
{
alert("Please Enter Supplier !");
document.form1.spnm.focus();
return false;
}
else if(document.getElementById('gstin').value=='')
{
alert("Please Enter GSTIN !");
document.form1.gstin.focus();
return false;
}
else
{
document.forms["form1"].submit();
}
}

function gstinn()
{
var gstin=document.getElementById('gstin').value;
$.get('gst_pan.php?gstin='+gstin, function(data) {

var str= data;
var stra = str.split("@")
var pan = stra.shift()
var st = stra.shift()
if(gstin!='')
{
$('#pan').val(pan);
$('#fst').val(st);
}
else
{
$('#pan').val('');
$('#fst').val('1');
}
//$("#myselect").val(3);
}); 
}



</script>
</head>
<body onload="show()" >
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Supplier GST Edit
                    </h1>
                    <ol class="breadcrumb">
                       <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Supplier GST Edit</li>
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

<HR> 	
<form method="post" action="sup_gst_edts.php" id="form1" onSubmit="return check1()" name="form1">
<input type="hidden">
<center>
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" width="15%" style="padding-top:15px"> <font size="3"><b>Supplier :</b></font></td>
<td align="left" width="" colspan="3">
    <select id="spnm" name="spnm" tabindex="1"  class="form-control" >
	<option value="">---Select---</option>
	<?
		$query="select * from main_suppl  WHERE sl>0 order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			<option value="<?=$rw['sl'];?>" <?if($sid==$rw['sl']){echo"selected";}?>><?=$rw['spn'];?> </option>
			<?
		}
	?>
	</select>
</td>
</tr>
<tr>
<td align="right" style="padding-top:15px"> <font size="3"><b>GSTIN :</b></font></td>
<td>
<input type="text" class="form-control" id="gstin" name="gstin" value="<?=$gstin;?>" placeholder="GSTIN" onblur="gstinn()" >
<input type="hidden" class="form-control" id="sl" name="sl" value="<?=$sl;?>"  >
</td>

<td align="right" style="padding-top:15px"> <font size="3"><b>PAN :</b></font></td>
<td>
<input type="text" class="form-control" id="pan" name="pan" value="<?=$pan;?>" placeholder="PAN">
</td>
</tr>

<tr>
<td align="right" style="padding-top:15px"><font size="3"><b>State : </b></font></td>
<td>
<select id="fst"  name="fst" class="form-control" >
	<?
	$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	?>
    <option value="<?=$row['sl'];?>"<?if($row['sl']==$st){echo 'selected';}?>><?=$row['sn'];?> - <?=$row['cd'];?></option>
	<?}?>
</select>

</td>
<td align="right"style="padding-top:15px"> <font size="3"><b>Address :</b></font></td>
<td align="left" >
<input type="text" class="form-control" id="addr" name="addr" value="<?=$addr;?>" placeholder="Address">

</td>
<tr></tr>
<td align="right"  colspan="4">
<input type="submit" value=" Update " class="btn btn-primary" >
</td>
</tr>
</tbody>
</table>

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
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>


$('#spnm').chosen({
no_results_text: "Oops, nothing found!",

});


</script>