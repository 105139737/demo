<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$ssl=$_REQUEST['sl'];
$eget=mysqli_query($conn,"select * from main_godown where sl='$ssl'") or die(mysqli_error($conn));
while($erow=mysqli_fetch_array($eget))
{
	$ssl=$erow['sl'];
	$bnm=$erow['bnm'];
	$gnm=$erow['gnm'];
	$addr=$erow['addr'];	
}
$fdt=date('Y-m-d');
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
color:#000;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 
<script>

</script>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
font-family: Arial;
font-size: 13px;
z-index: 1003 !important;
display: none;
}
</style>
<script type="text/javascript" language="javascript">
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>      
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Godown
                        <small>Edit</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Godown</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body >
<div class="box box-success">
<form method="post" action="godowns.php" id="form1" onSubmit="return check1()" name="form1">   
<input type="hidden" name="sl" id="sl" value="<?echo $ssl;?>">
                 
<table border="0" class="table table-hover table-striped table-bordered">
            <tr>
			<!--<td align="right" width="20%" style="padding-top:15px;" ><b>Branch :</b></td>
			<td  align="left" width="30%">
			<select name="bnm" id="bnm" class="form-control">
			<option value="">--Select--</option>
			<?
			$dsql=mysqli_query($conn,"select * from main_branch order by bnm") or die (mysqli_error($conn));
			while($erow=mysqli_fetch_array($dsql))
			{
				$bsl=$erow['sl'];
				$bnm5=$erow['bnm'];
			?>
			<option value="<?php echo $bsl;?>"<?if($bsl==$bnm){echo 'selected';}?>><?php echo $bnm5;?></option>
			<?
			}
			?>
			</select>
			</td>-->
			<td align="right" width="10%" style="padding-top:15px;" ><b>Godown :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="gnm" id="gnm" value="<?echo $gnm;?>" placeholder="Enter Godown Name...." required>
			</td>
		
			<td align="right" width="10%" style="padding-top:15px;" ><b>Address :</b></td>
            <td  align="left" colspan="">
            <input type="text" class="form-control" name="addr" id="addr" value="<?echo $addr;?>" placeholder="Enter Godown Address....">
			</td>
		
			</tr>
			<tr>
			<td align="right" colspan="4" width="30%">
		    <input type="submit" class="btn btn-success" value="Update" name="B1" >
		    </td>
		    </tr>
</table>
      
   </div>



</form>


                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   
</body>