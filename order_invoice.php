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
	var vstat=encodeURIComponent(document.getElementById('vstat').value);
	
	$('#data8').load('order_invoice_list.php?cid='+cid+'&salper='+salper+'&brncd='+brncd+'&fdt='+fdt+'&tdt='+tdt+'&stat='+stat+'&vstat='+vstat).fadeIn('fast');
}

function view(blno)
{
	window.open('bill_typ.php?blno='+encodeURIComponent(blno)+'&rv=1', '_blank');
	window.focus();
}

function act(blno,val)
{
	if (confirm('Are You Verify .?')) 
	{
		$('#data8').load('verfy.php?blno='+encodeURIComponent(blno)+'&val='+val).fadeIn('fast');	
	}
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
function del(blno)
{
	
if(confirm("Are you sure to cancel !!"))
{	
$('#data8').load('order_del.php?blno='+blno).fadeIn('fast');
}
	
}
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<script type="text/javascript" src="js/datalist/jquery.easy-autocomplete.js"></script>
<link rel="stylesheet" href="js/datalist/easy-autocomplete.css" title="style-orange">
<link rel="stylesheet" href="js/datalist/easy-autocomplete.themes.css" title="style-orange">


</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">Order to Invoice</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Order to Invoice</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="sale_xls.php" name="form1"  id="form1">
<div class="box box-success" >
<table class="table table-hover table-striped table-bordered">
<thead>
<tr>
<td width="14%;"><b>Customer:</b><br>
<input type="hidden" id="cid" name="cid">
<input class="form-control" type="text" name="cust_nm" autocomplete="off" id="cust_nm" size="40" onkeyup="if(this.value==''){$('#cid').val('');}" onfocus="this.select()">
</td>
<td width="14%;"><b>Sales Person:</b><br>
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
<td width="14%;"><b>Branch:</b><br>
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
<td width="14%;"><b>Form:</b><br>
<input type="text" id="fdt" name="fdt" value="<?php echo $saa;?>" class="form-control">
</td>
<td width="14%;"><b>To:</b><br>
<input type="text" id="tdt" name="tdt" value="<?php echo $sa;?>" class="form-control">
</td>

<td width="14%;"><b>Status:</b><br>
<select name="stat" id="stat" class="form-control">
<option value="">---All---</option>
<option value="0">Pending</option>
<option value="1">Done</option>
<option value="2">Canceled</option>
</select>
</td>

<td width="14%;"><b>Verify:</b><br>
<select name="vstat" id="vstat" class="form-control">
<option value="">---All---</option>
<option value="0">No</option>
<option value="1">Yes</option>
</select>
</td>


</tr>
<tr>
<td align="right" colspan="7">
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
var options = {
    url: function(phrase) { 
        if (phrase !== "") {
			return "get_med_data.php?mnm="+encodeURIComponent(phrase);
		}
	},

    getValue: "name",

    template: {
        type: "description",
        fields: {
            description: "manufacturer"
        }
    },

list: {
onSelectItemEvent: function() {
var value = $("#cust_nm").getSelectedItemData().id; //get the id associated with the selected value
$("#cid").val(value).trigger("change"); //copy it to the hidden field
}
      
},   
};

$("#cust_nm").easyAutocomplete(options);



$('#salper').chosen({no_results_text: "Oops, nothing found!",});
  
function getv()
{
	var cat= document.getElementById('cat').value;
	var bnm= document.getElementById('bnm').value;
	$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
</script>
    </body>
</html>