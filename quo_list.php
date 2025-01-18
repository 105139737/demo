<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$sa=date('d-m-Y');
$saa="01-".date('m-Y');
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
color:red;
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
function show1(val)
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var snm= document.getElementById('snm').value;
var brncd= document.getElementById('brncd').value;
var prnm= document.getElementById('prnm').value;
var scat= document.getElementById('scat').value;
var cat= document.getElementById('cat').value;
if(val==0)
{
$('#data8').load('quo_lists.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd+'&prnm='+prnm+'&scat='+scat+'&cat='+cat+'&val='+val).fadeIn('fast');
}
else if(val==1)
{
document.location='quo_lists.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd+'&prnm='+prnm+'&scat='+scat+'&cat='+cat+'&val='+val;	
}
}
function view(blno)
{

window.open('quo_bill_new.php?blno='+encodeURIComponent(blno), '_blank');
window.focus();
}
function get_scat(brnd)  
{
$("#catdiv").load("get_sub_cat.php?cat="+brnd).fadeIn('fast');
}

</script>
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
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function()
{
var jQueryDatePicker2Opts =
{
dateFormat: 'dd-mm-yy',
changeMonth: true,
changeYear: true,
showButtonPanel: false,
showAnim: 'show'
};	

$("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

$("#fdt").datepicker(jQueryDatePicker2Opts);
$("#tdt").datepicker(jQueryDatePicker2Opts);
});
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>


	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
              Quotation Report
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Quotation</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action=".php" name="form1"  id="form1">
<div class="box box-success" >
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr>
<td align="left" width="25%"><b>Form:</b><br>
<input type="text" id="fdt" name="fdt" size="13" value="<?php echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td>
<td align="left" width="25%"><b>To:</b><br>
<input type="text" id="tdt" name="tdt" size="13" value="<?php echo $sa;?>" class="form-control" placeholder="Please Enter To Date">
</td>
<td align="left"  width="25%" ><b>Customer:</b><br>
<select name="snm" class="form-control"  id="snm">
<option value="">---All---</option>
<?php 
$query="Select * from  main_quo order by cust_nm";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$cust_nm=$R['cust_nm'];
$cont=$R['cont'];
?>
<option value="<?php  echo $sid;?>"><?php  echo $cust_nm;?> - <?php  echo $cont;?></option>
<?php 
}
?>
</select>
</td>
<td align="left" width="25%" ><b>Branch:</b><br>
<select name="brncd" class="form-control" size="1" id="brncd"   >
<?php 
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---All---</option>
<?php 
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<?php  echo $sl;?>"><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
</td>
</tr>

<tr>
	<td  align="left" style="padding-top:17px" ><font color="red">*</font><b>Brand :</b>
	<select name="cat" class="form-control" size="1" id="cat" tabindex="8" onchange="get_scat(this.value)"  >
	<Option value="">---Select---</option>
	<?php 
	$data1 = mysqli_query($conn,"Select * from main_catg order by cnm");
	while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$cnm=$row1['cnm'];
	echo "<option value='".$sl."'>".$cnm."</option>";
	}
	?>
	</select>
	</td>
       
	<td  align="left" style="padding-top:17px" ><b>Category :</b>
	<div id="catdiv">
	<select name="scat" class="form-control" size="1" id="scat" tabindex="8" >
	<Option value="">---Select---</option>
	<?php 
	$data1=mysqli_query($conn,"Select * from main_scat order by nm");
	while($row1=mysqli_fetch_array($data1))
	{
		$sc_sl=$row1['sl'];
		$sc_nm=$row1['nm'];
		?>
		<Option value="<?php  echo $sc_sl;?>"><?php  echo $sc_nm;?></option>
		<?php 
	}
	?>
	</select>
	</div>
	</td>
<td align="left"><b>Model:</b><br>
<select id="prnm" name="prnm" style="width:100%" class="form-control">
<option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_product where typ='-1' order by pnm");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
?>
<Option value="<?php  echo $sl;?>"><?php echo reformat($pnm);?></option>
<?php }?>
</select>
</td>


<td align="right" colspan=""><br>
<input type="button" class="btn btn-info" value="Show" onclick="show1('0')">
<input type="button" class="btn btn-warning" value="Excel Export" onclick="show1('1')">
</td>
</tr>
</thead>



</table>
<div id="data8" style="overflow-x:auto;"></div>
	 
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

     
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
$('#pnm').chosen({no_results_text: "Oops, nothing found!",});
$('#snm').chosen({no_results_text: "Oops, nothing found!",});
$('#cat').chosen({no_results_text: "Oops, nothing found!",});
$('#bnm').chosen({no_results_text: "Oops, nothing found!",});
$('#prnm').chosen({no_results_text: "Oops, nothing found!",});
$('#sale_per').chosen({no_results_text: "Oops, nothing found!",});
$('#scat').chosen({no_results_text: "Oops, nothing found!",});
  
function getv()
{
var cat= document.getElementById('cat').value;
var bnm= document.getElementById('bnm').value;
$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
</script>
    </body>
</html>