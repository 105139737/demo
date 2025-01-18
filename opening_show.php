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


<style type="text/css"> 
th{
text-align:center;
color:#FFF;
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
var ptyp= document.getElementById('ptyp').value;
var vstat= document.getElementById('vstat').value;
var blno= document.getElementById('blno').value;
var stk_dt= document.getElementById('stk_dt').value;
$('#data8').load('opening_list.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd+'&cat='+cat+'&scat='+scat+'&prnm='+prnm+'&godown='+godown+'&vstat='+vstat+'&ptyp='+ptyp+'&blno='+blno+'&stk_dt='+stk_dt).fadeIn('fast');
}
/* function edit(blno)
{
	
window.open("purchase_edit.php?blno="+blno,'_blank');
} */
function dlt(blno)
{
$('#data8').load('purchase_dlt.php?blno='+blno).fadeIn('fast');
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
var blno= document.getElementById('blno').value;
document.location='opening_list_xls.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd+'&cat='+cat+'&scat='+scat+'&prnm='+prnm+'&godown='+godown+'&blno='+blno;

}


  function getgwn()
 {
	brncd=document.getElementById('brncd').value;		
	// $("#g_gwn").load("get_gwn1.php?brncd="+brncd).fadeIn('fast');
 }

function adj()
{
var stk_dt= document.getElementById('stk_dt').value;
var dt= document.getElementById('dt').value;
var cat= document.getElementById('cat').value;
var scat= document.getElementById('scat').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var stk_godown= document.getElementById('stk_godown').value;
if(stk_dt==''  || cat=='' || scat=='')
{
    alert('Please Check Brand, Category, Date ');
}
else
{
window.open('import_stk_adjusts_out.php?stk_dt='+stk_dt+'&dt='+dt+'&cat='+cat+'&scat='+scat+'&fdt='+fdt+'&tdt='+tdt+'&stk_godown='+stk_godown,'_blank');    
}   
    
}

/*function adj()
{
var stk_dt= document.getElementById('stk_dt').value;
var dt= document.getElementById('dt').value;
var cat= document.getElementById('cat').value;
var scat= document.getElementById('scat').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
if(stk_dt==''  || cat=='' || scat=='')
{
    alert('Please Check Brand, Category, Date ');
}
else
{
window.open('import_stk_adjusts_out.php?stk_dt='+stk_dt+'&dt='+dt+'&cat='+cat+'&scat='+scat+'&fdt='+fdt+'&tdt='+tdt,'_blank');    
}   
    
}*/

function stk_in()
{
var stk_dt= document.getElementById('stk_dt').value;
var dt= document.getElementById('dt').value;
var cat= document.getElementById('cat').value;
var scat= document.getElementById('scat').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var stk_godown= document.getElementById('stk_godown').value;
if(stk_dt==''  || cat=='' || scat=='')
{
    alert('Please Check Brand, Category, Date ');
}
else
{
window.open('import_stk_adjusts_in.php?stk_dt='+stk_dt+'&dt='+dt+'&cat='+cat+'&scat='+scat+'&fdt='+fdt+'&tdt='+tdt+'&stk_godown='+stk_godown,'_blank');    
}   
    
}


function del_dtl(sl)
{
	
if(confirm("Are you sure  ??"))
{
$('#data8').load('op_del.php?sl='+sl).fadeIn('fast');
}

}
</script>
<link rel="stylesheet" href="dark-hive/jquery.ui.all.css" type="text/css">
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

$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#stk_dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#dt").datepicker(jQueryDatePicker2Opts);
$("#stk_dt").datepicker(jQueryDatePicker2Opts);
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
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
</head>
<body >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">
               <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
             APP Opening
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> APP Opening</li>
                    </ol>
                </section>
                <section class="content">
                            <!-- TO DO List -->
<form method="post" action="dpbills.php" name="form1" onsubmit="return check1()" id="form1">
 <center>
<div class="box box-success" >
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr  >
<td align="left" width="25%">
<b>Form : </b>
<input type="text" id="fdt" name="fdt" value="<?php echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > 
</td>

<td align="left" width="25%" >
<b>To : </b>
<input type="text" id="tdt" name="tdt" value="<?php echo $sa;?>"class="form-control" placeholder="Please Enter To Date">
</td>

<td align="left"  width="25%">
<b>Company Name :</b><br>
<select name="snm" class="form-control"  id="snm"   >
<option value="">---All---</option>
<?php 
		$query="select * from main_suppl  WHERE sl>0 order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			<option value="<?php  echo $rw['sl'];?>"><?php  echo $rw['spn'];?> <?php if($rw['nm']!=""){?>( <?php  echo $rw['nm'];?> )<?php }?></option>
			<?php 
		}
	?>

</select>
</td>

<td align="left" width="25%">
<b>Branch:</b>
<select name="brncd" class="form-control" size="1" id="brncd">
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

<td>
<b>Brand:</b>
<select id="cat" name="cat" style="width:100%" class="form-control" onchange="get_scat()">
<option value="">---All---</option>
<?php 
$data12 = mysqli_query($conn,"Select * from main_catg order by sl");
while ($row12 = mysqli_fetch_array($data12))
	{
	$sl=$row12['sl'];
	$cnm=$row12['cnm'];
?>
<Option value="<?php  echo $sl;?>"><?php  echo $cnm;?></option>
<?php }?>
</select>
</td>
<td>
<b>Category:</b>
<div id="catdiv">
<select name="scat" id="scat" class="form-control" onchange="get_model()">
<option value="">---All---</option>
<?php 
$get=mysqli_query($conn,"Select * from main_scat where cat='$cat' order by sl");
while($row=mysqli_fetch_array($get))
{
	$sc_sl=$row['sl'];
	$sc_nm=$row['nm'];
	?>
	<option value="<?php echo $sc_sl;?>"><?php echo $sc_nm;?></option>
	<?php 
}
?>
</select>
</div>
</td>
<td>
<b>Model:</b>
<div id="moddiv">
<select id="prnm" name="prnm" style="width:100%" class="form-control">
<option value="">---All---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_product where typ='0' order by sl");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
?>
<Option value="<?php  echo $sl;?>"><?php echo reformat($pnm);?></option>
<?php }?>
</select>
</div>
</td>

<td>
<b>Godown:</b>
<div id="g_gwn">
<select name="godown" class="form-control" size="1" id="godown" >
<option value="">---All---</option>

<?php 
$query="Select * from main_godown";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$gnm=$R['gnm'];

?>
<option value="<?php  echo $sl;?>"><?php  echo $gnm;?></option>
<?php 
}
?>
</select>
</div>
</td>
</tr>
</thead>
<tr>

<td hidden>
<b>Purchase Type:</b>
<select name="ptyp" class="form-control" size="1" id="ptyp" >
<option value="">---All---</option>
<option value="1">App</option>
<option value="0">Web</option>
</select>
</td>
<td hidden>
<b>Verified:</b>
<select name="vstat" class="form-control" size="1" id="vstat" >
<option value="">---All---</option>
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</td>

<td align="left" width="25%">
<b>Stock  Godown : </b>
<select name="stk_godown" class="form-control" size="1" id="stk_godown" >
<option value="">---All---</option>

<?php 
$query="Select * from main_godown";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$gnm=$R['gnm'];

?>
<option value="<?php  echo $sl;?>"><?php  echo $gnm;?></option>
<?php 
}
?>
</select>
</td>
<td align="left" width="25%">
<b>Stock  Date : </b>
<input type="text" id="stk_dt" name="stk_dt" value="" class="form-control" placeholder="Please Enter  Date" > 
</td>

<td align="left" width="25%" hidden>
<b>xxxxxx Date : </b>
<input type="text" id="dt" name="dt" value=""class="form-control" placeholder="Please Enter Date">
</td>
<td align="left" width="25%" >
<b>Refno. : </b>
<input type="text" id="blno" name="blno" value=""class="form-control" placeholder="">
</td>
<td align="right" ><br/>
<input type="button" class="btn btn-info" value="Show" onclick="show1()">
<input type="button" class="btn btn-warning" value="Excel Export" onclick="xls()">

</td>
</tr>
</table>
<div style="overflow-x:auto;" id="data8">
</div>
</div>
</form><!-- /.box-body -->
<div class="box-footer clearfix no-border">
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
$('#pnm').chosen({
no_results_text: "Oops, nothing found!",
});
$('#snm').chosen({
no_results_text: "Oops, nothing found!",
});
$('#prnm').chosen({
no_results_text: "Oops, nothing found!",
});
$('#cat').chosen({
no_results_text: "Oops, nothing found!",
});
</script>
</body>
</html>