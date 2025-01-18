<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$fdt=date('Y-m-d');
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
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
 function get_list()
{
	 var all= document.getElementById('all').value;
	$('#div_list').load('sub_cat_list.php?all='+encodeURIComponent(all)).fadeIn('fast');
}
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
$(document).ready(function()
{
var jQueryDatePicker2Opts =
{
dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true,
showButtonPanel: false,
showAnim: 'show'
};
$("#fdt").datepicker(jQueryDatePicker2Opts);
$("#fdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
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
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>      
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Category
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Category</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="get_list()">
<div class="box box-success">
<form method="post" action="sub_cats.php" id="form1" onSubmit="return check1()" name="form1">                    
<table border="0" class="table table-hover table-striped table-bordered">
            <tr>
			<td align="right" width="20%" style="padding-top:15px;" ><b>Brand :</b></td>
			<td  align="left" width="30%">
			<select name="brand" id="brand" class="form-control">
			<option value="">--Select--</option>
			<?php 
			$dsql=mysqli_query($conn,"select * from main_catg order by sl") or die (mysqli_error($conn));
			while($erow=mysqli_fetch_array($dsql))
			{
				$bsl=$erow['sl'];
				$cnm=$erow['cnm'];
			?>
			<option value="<?php  echo $bsl;?>"><?php  echo $cnm;?></option>
			<?php 
			}
			?>
			</select>
			</td>
			<td align="right" width="20%" style="padding-top:15px;" ><b>Category :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="nm" id="nm" placeholder="Enter Category...." required>
			</td>
			</tr>

			<tr>
			<td align="right" width="20%" style="padding-top:15px;" ><b>HSN :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="hsn" id="hsn" placeholder="Enter HSN....">
			</td>
				<td align="right" width="20%" style="padding-top:15px;" ><b>IGST :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="igst" id="igst" onkeypress="return check(event)" placeholder="0.00" required>
			</td>
			</tr>
			<tr>
			<td align="right" colspan="4" width="30%">
		    <input type="submit" class="btn btn-success" value="Submit" name="B1" >
		    </td>
		    </tr>
</table>
      
   </div>



</form>
<div class="box box-success" >
<table border="0" class="table table-hover table-striped table-bordered">

			<tr>
			<td align="right" width="20%" style="padding-top:15px;" ><b>Search :</b></td>
            <td  align="left" width="50%">
            <input type="text" class="form-control" name="all" id="all" placeholder="Search Here....">
			</td>
			
			<td align="left" colspan="2" width="30%">
		    <input type="button" class="btn btn-info" value="Show" name="B1" onclick="get_list()" >
		    </td>
		    </tr>
</table>

<div id="div_list"></div>
</div>	

                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   
</body>