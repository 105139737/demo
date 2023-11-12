<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
include "function.php";
$sa=date('d-m-Y');
$saa="01-".date('m-Y');
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
function get_scat()  
{
var cat= document.getElementById('cat').value;
$("#catdiv").load("getscat_psw.php?cat="+cat).fadeIn('fast');
}
function get_model()  
{
var cat= document.getElementById('cat').value;
var scat= document.getElementById('scat').value;
$("#moddiv").load("getmodel_psw.php?cat="+cat+"&scat="+scat).fadeIn('fast');
}
function show1()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var snm= document.getElementById('snm').value;
var brncd= document.getElementById('brncd').value;
var cat= document.getElementById('cat').value;
var scat= document.getElementById('scat').value;
var prnm= document.getElementById('prnm').value;
var godown= document.getElementById('godown').value;
$('#data8').load('ser_purchase_list.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd+'&cat='+cat+'&scat='+scat+'&prnm='+prnm+'&godown='+godown).fadeIn('fast');
}
function edit(blno)
{
window.open('purchase_edit.php?blno='+blno,'_balnk');

}
function xls()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var snm= document.getElementById('snm').value;
var brncd= document.getElementById('brncd').value;
var cat= document.getElementById('cat').value;
var scat= document.getElementById('scat').value;
var prnm= document.getElementById('prnm').value;
var godown= document.getElementById('godown').value;
document.location='ser_purchase_list_xls.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd+'&cat='+cat+'&scat='+scat+'&prnm='+prnm+'&godown='+godown;

}
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>      
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Service Purchase Report
                        <small>List</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Service Purchase Report</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body>
<div class="box box-success" >
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr>
<td align="left" style="width:20%">
<b>Form : </b>
<input type="text" id="fdt" name="fdt" value="<?echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > 
</td>

<td align="left" style="width:20%" >
<b>To : </b>
<input type="text" id="tdt" name="tdt" value="<?echo $sa;?>"class="form-control" placeholder="Please Enter To Date">
</td>

<td align="left" style="width:20%">
<b>Company Name :</b><br>
<select name="snm" class="form-control"  id="snm"   >
<option value="">---All---</option>
<?
		$query="select * from main_suppl  WHERE sl>0 order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			<option value="<?=$rw['sl'];?>"><?=$rw['spn'];?> <?if($rw['nm']!=""){?>( <?=$rw['nm'];?> )<?}?></option>
			<?
		}
	?>

</select>
</td>

<td align="left" width="20%">
<b>Branch:</b>
<select name="brncd" class="form-control" size="1" id="brncd">
	<?
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---All---</option>
<?
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
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>
</td>

<td style="display:none;">
<b>Brand:</b>
<select id="cat" name="cat" style="width:100%" class="form-control" onchange="get_scat()">
<option value="">---All---</option>
<?
$data12 = mysqli_query($conn,"Select * from main_catg order by sl");
while ($row12 = mysqli_fetch_array($data12))
	{
	$csl=$row12['sl'];
	$cnm=$row12['cnm'];
?>
<Option value="<?=$csl;?>"><?=$cnm;?></option>
<?
}
?>
</select>
</td>
<td style="display:none;">
<b>Category:</b>
<div id="catdiv">
<select name="scat" id="scat" class="form-control" onchange="get_model()">
<option value="">---All---</option>
<?
$get=mysqli_query($conn,"Select * from main_scat where cat='$cat' order by sl");
while($row=mysqli_fetch_array($get))
{
	$sc_sl=$row['sl'];
	$sc_nm=$row['nm'];
	?>
	<option value="<?echo $sc_sl;?>"><?echo $sc_nm;?></option>
	<?
}
?>
</select>
</div>
</td>
<td style="width:20%">
<b>Service:</b>
<select id="prnm" name="prnm" style="width:100%" class="form-control">
<option value="">---All---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_product where typ='1' order by sl");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
?>
<Option value="<?=$sl;?>"><?=reformat($pnm);?></option>
<?}?>
</select>
</td>

<td style="display:none;">
<b>Godown:</b>
<select name="godown" class="form-control" size="1" id="godown" >
<option value="">---All---</option>

<?
if($user_current_level<0)
{
$query="Select * from main_branch";
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
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>
</td>
</tr>
<tr>
<td colspan="5" align="right">
<input type="button" class="btn btn-info" value="Show" onclick="show1()">
<input type="button" class="btn btn-warning" value="Excel Export" onclick="xls()">
</td>
</tr>
</thead>
</table>
<div style="overflow-x:auto;" id="data8"></div>
</div>	

                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>

$('#brand').chosen({
no_results_text: "Oops, nothing found!",
});
$('#brand1').chosen({
no_results_text: "Oops, nothing found!",
});
</script> 
</body>