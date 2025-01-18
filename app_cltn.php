<?php 
$reqlevel=3;
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


function gpro()
{
	var cat=document.getElementById('cat').value;
	var bnm=document.getElementById('bnm').value;
	$('#gpro').load('get_pro.php?bnm='+bnm+'&cat='+cat).fadeIn('fast');
}

function show1()
{
	var cid=encodeURIComponent(document.getElementById('cid').value);
	var salper=encodeURIComponent(document.getElementById('salper').value);
	var brncd=encodeURIComponent(document.getElementById('brncd').value);
	var fdt=encodeURIComponent(document.getElementById('fdt').value);
	var tdt=encodeURIComponent(document.getElementById('tdt').value);
	var stat=encodeURIComponent(document.getElementById('stat').value);
	
	var ledg=document.getElementById('ledg').value;
	var mdt=document.getElementById('mdt').value;
	
	$('#data8').load('app_cltns.php?cid='+cid+'&salper='+salper+'&brncd='+brncd+'&fdt='+fdt+'&tdt='+tdt+'&stat='+stat+'&ledg='+ledg+'&mdt='+mdt).fadeIn('fast');
}

function view(blno)
{
	window.open('bill_typ.php?blno='+encodeURIComponent(blno), '_blank');
	window.focus();
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
function can(sl)
{
$('#data8').load('app_coll_can.php?sl='+sl).fadeIn('fast');
}
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
                    <h1 align="center">App Collection</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">App Collection</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="sale_xls.php" name="form1"  id="form1">
<div class="box box-success" >
<table class="table table-hover table-striped table-bordered">
<thead>
<tr>
<td width="25%;"><b>Customer:</b><br>
	<select id="cid" name="cid" class="form-control">
	<option value="">--- All ---</option>
	<?php 
	$get=mysqli_query($conn,"SELECT * FROM main_cust ORDER BY nm");
	while($row=mysqli_fetch_array($get))
	{
		$csl=$row['sl'];
		$pnm=$row['nm'];
		
		?>
		<Option value="<?php  echo $csl;?>"><?php  echo $pnm;?></option>
		<?php 
	}
	?>
	</select>
</td>
<td width="25%;"><b>Sales Person:</b><br>
	<select name="salper" id="salper" class="form-control">
	<option value="">---All---</option>
	<?php 
	$get=mysqli_query($conn,"SELECT * FROM main_sale_per ORDER BY nm");
	while($row=mysqli_fetch_array($get))
	{
		$sid=$row['spid'];
		$spid=$row['spid'];
		?>
		<option value="<?php  echo $sid;?>"><?php  echo $spid;?></option>
		<?php 
	}
	?>
	</select>
</td>
<td width="25%;"><b>Form:</b><br>
<input type="text" id="fdt" name="fdt" value="<?php echo $saa;?>" class="form-control">
</td>
<td width="25%;"><b>To:</b><br>
<input type="text" id="tdt" name="tdt" value="<?php echo $sa;?>" class="form-control">
</td>

</tr>
<tr>
<td align="left" ><b>Ledger :</b>
<select id="ledg" name="ledg" class="form-control" >
<option value="">-- All --</option>
<?php  
$get = mysqli_query($conn,"SELECT * FROM main_ledg order by nm") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?php  echo $row['sl']?>"><?php  echo $row['nm']?></option>
<?php  
} 
?>
</select>
</td>
<td> 
<label><b>Payment Mode :</b></label>
<select name="mdt" id="mdt"  onchange="pmod(this.value)" class="form-control">
<option value="">-- All --</option>
<?php 
$data2 = mysqli_query($conn,"select * from ac_paymtd");

while ($row2 = mysqli_fetch_array($data2))
{
$mtd = $row2['mtd'];
$msl = $row2['sl'];
?>
<option value="<?php  echo $msl;?>"><?php  echo $mtd;?></option>
<?php 
}
?>
</select>
</td>
<td ><b>Branch:</b><br>
	<select name="brncd" id="brncd" class="form-control">
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
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$bsl=$R['sl'];
		$bnm=$R['bnm'];

		?>
		<option value="<?php  echo $bsl;?>"><?php  echo $bnm;?></option>
		<?php 
	}
	?>
	</select>
</td>

<td width="25%;"><b>Status:</b><br>
<select name="stat" id="stat" class="form-control">
<option value="">---All---</option>
<option value="0">Pending</option>
<option value="1">Done</option>
<option value="2">Canceled</option>
</select>
</td>
</tr>
<tr>
<td align="right" colspan="6">
<input type="button" class="btn btn-info" value="Show" onclick="show1()">
</td>
</tr>
</thead>
</table>
<div id="data8" style="overflow-x:auto;"></div>
<div id="can88"></div>
	 
                                </div>
</form>
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
$('#cid').chosen({no_results_text: "Oops, nothing found!",});
$('#salper').chosen({no_results_text: "Oops, nothing found!",});
$('#ledg').chosen({no_results_text: "Oops, nothing found!",});
  
function getv()
{
	var cat= document.getElementById('cat').value;
	var bnm= document.getElementById('bnm').value;
	$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
</script>
    </body>
</html>