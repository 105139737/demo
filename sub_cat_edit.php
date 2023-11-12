<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";

$ssl=$_REQUEST['sl'];
$eget=mysqli_query($conn,"select * from main_scat where sl='$ssl'") or die(mysqli_error($conn));
while($erow=mysqli_fetch_array($eget))
{
	$ssl=$erow['sl'];
	$brand=$erow['cat'];
	$igst=$erow['igst'];
	$nm=$erow['nm'];
	$hsn=$erow['hsn'];	
}

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
<script type="text/javascript" language="javascript">

function check(evt)
{
evt =(evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;						// ONLY NUMBER FOR NUMBER FIELD
if(charCode > 31 && (charCode < 48 || charCode > 57))
{
return false;
}
 return true;	
}
</script>	 
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Category
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Category Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body>
<div class="box box-success">
<form method="post" action="sub_cat_edts.php" id="form1" name="form1">                    
<input type="hidden" name="ssl" id="ssl" value="<?echo $ssl;?>">
<table border="0" class="table table-hover table-striped table-bordered">
            <tr>
			<td align="right" width="20%" style="padding-top:15px;" ><b>Brand :</b></td>
			<td  align="left" width="30%">
			<select name="brand" id="brand" class="form-control">
			<option value="">--Select--</option>
			<?
			$dsql=mysqli_query($conn,"select * from main_catg order by sl") or die (mysqli_error($conn));
			while($erow=mysqli_fetch_array($dsql))
			{
				$bsl=$erow['sl'];
				$cnm=$erow['cnm'];
			?>
			<option value="<?php echo $bsl;?>" <?php if($brand==$bsl){echo 'selected';}?>><?php echo $cnm;?></option>
			<?
			}
			?>
			</select>
			</td>
		    <td align="right" width="20%" style="padding-top:15px;" ><b>Category :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="nm" id="nm" value="<?echo $nm;?>" placeholder="Enter Category...." required>
			</td>
			
		
			</tr>
			<tr>
			<td align="right" width="20%" style="padding-top:15px;" ><b>HSN :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="hsn" id="hsn" value="<?echo $hsn;?>" placeholder="Enter HSN....">
			</td>
			<td align="right" width="20%" style="padding-top:15px;" ><b>IGST :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="igst" id="igst" value="<?echo $igst;?>" onkeypress="return check(event)" placeholder="0.00" required>
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