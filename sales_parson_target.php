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
function show()
 {
 var spid= document.getElementById('spid').value;
 $('#sgh').load('sales_parson_target_list.php?spid='+spid).fadeIn('fast');
 }
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>      
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Sales Parson Target
                        <small>Setup</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Sales Parson Target</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body>

<div class="box box-success" >
<form method="post" action="sales_parson_targets.php" id="form1" onSubmit="return check1()" name="form1"> 

<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" width="30%" style="padding-top:15px"> <font size="3"><b>Sales Person :</b></font></td>
<td align="left" width="40%">

<select name="spid" class="form-control" id="spid">
<Option value="">---ALL---</option>
<?php 
$data2 = mysqli_query($conn,"Select * from main_sale_per where sl>0 order by nm");
while ($row2 = mysqli_fetch_array($data2))
{
$ssl=$row2['sl'];
$spid=$row2['spid'];
$nm=$row2['nm'];
echo "<option value='".$ssl."'>".$spid.' ('.$nm.')'."</option>";
}
?>
</select>

</td>
<td align="left" width="30%">
<input type="button" value=" Show " class="btn btn-primary" onclick="show()">
</td>
</tr>
</table>

<div id="sgh"></div>
</form>
</div>	

                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   
</body>
	 <link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
$('#spid').chosen({
no_results_text: "Oops, nothing found!",
});
</script>
</body>