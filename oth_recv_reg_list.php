<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$brncd=$_REQUEST['brncd'] ?? "";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
<style type="text/css">
#sfdtl
{
	border : none;
	border-radius: 15px;
	background-image: url(images/bg1.png);
	width : 850px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 350px;
	top : 250px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
}
#underlay{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background-color:#000;
    -moz-opacity:0.5;
    opacity:.50;
    filter:alpha(opacity=50);
}
</style>


<style type="text/css"> 
a
{
   color: black;
   outline: none;
   text-decoration: none;
}

</style>
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css"> 

#jQueryDatePicker1
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}

</style>


<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<link rel="stylesheet" href="wb.validation.css" type="text/css">
<script type="text/javascript" src="wb.validation.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function()
{

   var jQueryDatePicker1Opts =
   {
      dateFormat: 'dd-M-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   $("#fdt").datepicker(jQueryDatePicker1Opts);
   $("#tdt").datepicker(jQueryDatePicker1Opts);
});

	
function sh(val)
	{
	var proj = document.getElementById('proj').value;
	var brncd= document.getElementById('bcd').value;
	var custid= document.getElementById('custid').value;
	var fdt= document.getElementById('fdt').value;
	var tdt= document.getElementById('tdt').value;
	var slp= encodeURIComponent(document.getElementById('slp').value);
	if(val=='0')
	{
	$('#show').load('oth_recv_reg_lists.php?pno1='+proj+'&brncd='+brncd+'&custid='+custid+'&fdt='+fdt+'&tdt='+tdt+'&slp='+slp+'&val='+val).fadeIn('fast');
	}
	else if(val=='1')
	{
	document.location='oth_recv_reg_lists.php?pno1='+proj+'&brncd='+brncd+'&custid='+custid+'&fdt='+fdt+'&tdt='+tdt+'&slp='+slp+'&val='+val;
	}
	}
			
	function pagnt(pnog)
	{
	var proj = document.getElementById('proj').value;
	var ps=document.getElementById('ps').value;
    var brncd= document.getElementById('bcd').value;
	var custid= document.getElementById('custid').value;
	var fdt= document.getElementById('fdt').value;
	var tdt= document.getElementById('tdt').value;
	var slp= encodeURIComponent(document.getElementById('slp').value);
	
    $('#show').load("oth_recv_reg_lists.php?ps="+ps+"&pnog="+pnog+"&pno1="+proj+'&brncd='+brncd+'&custid='+custid+'&fdt='+fdt+'&tdt='+tdt+'&slp='+slp).fadeIn('fast');
	$('#pgn').val=pnog;
	}
	function pagnt1(pnog){
	pnog=document.getElementById('pgn').value;
	pagnt(pnog);

	}
	
	function editt(ssl)
	{
		document.location="recv_det_new.php?sl="+ssl;
	}
	function cancell(ssl)
	{
		if(confirm("Are You Sure??"))
		{
		$('#show').load("cancel_clctn_rprt.php?sl="+ssl).fadeIn('fast');
		}
	}
	
	

</script>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>

<body onload="sh()">
 <aside class="right-side">
  <section class="content-header">
                    <h1 align="center">
                 Collection
                        <small> Report</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Collection Report</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="jrnl_forms.php" id="Form1" >
<input type="hidden" name="proj" id="proj" value="NA" readonly>
<input type="hidden" name="it" id="it" value="NA" readonly >

<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="left" width="20%">
<font size="3"><b>Branch :</b></font><br>
<select name="bcd" class="form-control" size="1" id="bcd" >
<option value="">---ALL---</option>
<?php 
if($user_current_level<0)
{
$query1="Select * from main_branch";
}
else
{
$query1="Select * from main_branch where sl='$brncd'";
}
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$slb1=$R1['sl'];
$bnm1=$R1['bnm'];
?>
<option value="<?php  echo $slb1;?>"><?php  echo $bnm1;?></option>
<?php 
}
?>
</select>
</td>


<td align="left" width="20%">
<font size="3"><b>Customer :</b></font><br>
<select id="custid" name="custid" tabindex="1"  class="form-control" >
	<option value="">---ALL---</option>
	<?php 
		$query2="select * from main_cust WHERE sl>0 order by nm";
		$result2=mysqli_query($conn,$query2);
		while($rw2=mysqli_fetch_array($result2))
		{
			?>
			<option value="<?php  echo $rw2['sl'];?>"><?php  echo $rw2['nm'];?> --  <?php  echo $rw2['cont'];?></option>
			<?php 
		}
	?>
</select>
</td>
<td align="left" width="10%">
<font size="3"><b>From Date : </b></font>
<input type="text" id="fdt" name="fdt" value="<?php echo date('01-M-Y');?>" class="form-control" >
</td>
<td align="left" width="10%">
<font size="3"><b>To Date : </b></font>
<input type="text" id="tdt" name="tdt" value="<?php echo date('d-M-Y');?>" class="form-control" >
</td>
<td align="left" width="20%">
<font size="3"><b>Sales Person : </b></font>
	<select id="slp" name="slp" tabindex="1"  class="form-control">
	<option value="">---ALL---</option>
	<?php 
		$queryss="select * from main_sale_per  WHERE sl>0 order by spid";
		$resultss=mysqli_query($conn,$queryss);
		while($rwss=mysqli_fetch_array($resultss))
		{
			$spid=$rwss['spid'];
			$spnm=$rwss['nm'];
		?>
			<option value="<?php  echo $spid;?>"><?php  echo $spid;?></option>
			<?php 
		}
	?>
	</select>
</td>
<td align="left" width="20%"><br>
<input type="button" value=" Show " class="btn btn-info" onclick="sh('0')">
<input type="button" value=" Excel Export " class="btn btn-warning" onclick="sh('1')">
</td>
</tr>
</tbody>
</table>
</div>



<div class="box box-success" >
<div id="show">

</div>
</div>


											         <!-- COMPOSE MESSAGE MODAL -->
 
<!-- Modal Box Start-->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h4>Received Register Update</h4>
			</div>
			<div class="page" id="cnt" style="overflow: auto;"></div>
		</div>
	</div>
</div>
<!-- Modal Box End -->
</form>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->

</body>


<script type="text/javascript">
  $('#cid').chosen({no_results_text: "Oops, nothing found!",});
  $('#custid').chosen({no_results_text: "Oops, nothing found!",});
  $('#slp').chosen({no_results_text: "Oops, nothing found!",});
  $('#sman').chosen({no_results_text: "Oops, nothing found!",});
   $('#blno').chosen({
  no_results_text: "Oops, nothing found!",
  
  });

</script>

</div>
</html>