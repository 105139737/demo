<?
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";

include "header.php";
$cy=date('Y');
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
border:1px solid #37880a;
}
input:focus{
background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
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
$("#fdt").datepicker(jQueryDatePicker2Opts);
$("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#tdt").datepicker(jQueryDatePicker2Opts);
$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
});
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="prdcedt.js"></script>
<script>	
 function show(xls)
 {
	var typ= document.getElementById('typ').value;
	if(typ==0)
	{
	var pg="stock_st_day_mrp";	
	}
	if(typ==1)
	{
	var pg="stock_st_day_bgr";	
	}
	if(typ==2)
	{
	var pg="stock_st_day_pcs";	
	}
	
	var fdt= document.getElementById('fdt').value;
    var tdt= document.getElementById('tdt').value;
	var brncd= document.getElementById('brncd').value;
	var scat= document.getElementById('scat').value;
	var pnm= document.getElementById('prnm').value;
	$('#sgh').load(pg+'.php?pnm='+pnm+'&fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd+'&scat='+scat+'&xls='+xls).fadeIn('fast');
 /*$('#sgh').load('stock_sts_day.php?pnm='+pnm+'&fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd+'&scat='+scat).fadeIn('fast');*/
}
function xls(xls)
{
var typ= document.getElementById('typ').value;
	if(typ==0)
	{
	var pg="stock_st_day_mrp_xls";	
	}
	if(typ==1)
	{
	var pg="stock_st_day_bgr_xls";	
	}
	if(typ==2)
	{
	var pg="stock_st_day_pcs_xls";	
	}
	
	var fdt= document.getElementById('fdt').value;
    var tdt= document.getElementById('tdt').value;
	var brncd= document.getElementById('brncd').value;
	var scat= document.getElementById('scat').value;
	var pnm= document.getElementById('prnm').value;
	document.location=pg+'.php?pnm='+pnm+'&fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd+'&scat='+scat+'&xls='+xls;
	/*
	var typ= document.getElementById('typ').value;
	if(typ==0)
	{
	var pg="stock_st_day_mrp_xls";	
	}
	if(typ==1)
	{
	var pg="stock_st_day_lrt_xls";	
	}
	if(typ==2)
	{
	var pg="stock_st_day_pcs_xls";	
	}
	var fdt= document.getElementById('fdt').value;
    var tdt= document.getElementById('tdt').value;
	var brncd= document.getElementById('brncd').value;
	var scat= document.getElementById('scat').value;
	var pnm= document.getElementById('prnm').value;
document.location=pg+'.php?pnm='+pnm+'&fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd+'&scat='+scat;
/*document.location='stock_sts_xls_day.php?pnm='+pnm+'&fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd+'&scat='+scat;*/

}

	function gcat()
	{
	var sect= document.getElementById('sect').value;
	$('#gcat').load('get_cat_saler.php?sect='+sect).fadeIn('fast');
	}

 function get_prod()
 {
scat=document.getElementById('scat').value;
cat=document.getElementById('brncd').value;
$("#prod_div").load("get_product_stk.php?scat="+scat+"&cat="+cat).fadeIn('fast');	
 }
 


 function prnt()
 {
	var typ= document.getElementById('typ').value;
	if(typ==0)
	{
	var pg="stock_st_day_mrp_prnt";	
	}
	if(typ==1)
	{
	var pg="stock_st_day_lrt_prnt";	
	}
	if(typ==2)
	{
	var pg="stock_st_day_pcs_prnt";	
	}
	
	var fdt= document.getElementById('fdt').value;
    var tdt= document.getElementById('tdt').value;
	var brncd= document.getElementById('brncd').value;
	var scat= document.getElementById('scat').value;
	var pnm= document.getElementById('prnm').value;
	window.open(pg+'.php?pnm='+pnm+'&fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd+'&scat='+scat);
	window.focus();

}
</script>

	</head>
 <body onload="title1()">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Stock Statement Day
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Stock Statement Day </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                            <!-- TO DO List -->
 	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">
                              
							
								


<input type="hidden">
  <center>
        <div class="box box-success" >
      <table border="0" width="860px" class="table table-hover table-striped table-bordered">

<tr>
<td align="left" width="16%">
<b>Type:</b>
<select name="typ" class="form-control"  id="typ" >
<option value="0">Rate Wise</option>
<option value="1">Before GST Rate</option>
<option value="2">PCS Wise</option>
</select>
</td>

<td align="left" width="16%">
<b>From Date : </b>
<input type="text" id="fdt" name="fdt" value="<?=date('01-m-Y');?>" class="form-control" >

</td>
<td align="left" width="16%">
<b>To Date : </b>
<input type="text" id="tdt" name="tdt" value="<?=date('d-m-Y');?>" class="form-control" >

</td>
<td align="left" width="16%" >
<b>Godown:</b>
<select name="brncd" class="form-control" size="1" id="brncd" onchange="get_prod()"  >
<option value="">---Select---</option>
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
<td  align="left" width="16%">
<b>Category :</b><br>
<select name="scat" class="form-control" size="1" id="scat" tabindex="8" onchange="get_prod()">
<Option value="">---All---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_scat order by nm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['nm'];
echo "<option value='".$sl."'>".$cnm."</option>";
}
?>
</select>
</td> 
<td align="left" width="16%">
<b>Product:</b>
<div id="prod_div">
<select name="prnm" class="form-control"  id="prnm"   >
<option value="">---All---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_product where typ='0' order by pnm");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
?>
<Option value="<?=$sl;?>"><?=reformat($pnm);?></option>
<?}?>
</select>
</div>
</td>


</tr>
<tr>
<td colspan="6" align="right" style="padding-right:80px">

<input type="button" value=" Show " class="btn btn-info" onclick="show()">
<input type="button" value=" Excel Export " class="btn btn-warning" onclick="xls()">
</td>
</tr>


</tbody>
</table>
<div id="sgh">
</div>
	

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

	
		  $('#prnm').chosen({
  no_results_text: "Oops, nothing found!",

  });

  	  $('#cat').chosen({
  no_results_text: "Oops, nothing found!",

  });
 
</script>
     

    </body>
</html>