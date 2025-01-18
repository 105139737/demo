<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$sa=date('d-m-Y');
$saa=date('d-m-Y');
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
	var cat= document.getElementById('cat').value;
	var bnm= document.getElementById('bnm').value;
	$('#gpro').load('get_pro.php?bnm='+bnm+'&cat='+cat).fadeIn('fast');
}
function show1()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var snm= document.getElementById('snm').value;
var brncd= document.getElementById('brncd').value;
var prnm= document.getElementById('prnm').value;
var tp1= document.getElementById('tp1').value;
var gstin= document.getElementById('gstin').value;
var godown= document.getElementById('godown').value;
var stat= document.getElementById('stat').value;
var scat= document.getElementById('scat').value;
var cat= document.getElementById('cat').value;
var sale_per= document.getElementById('sale_per').value;
var delv= document.getElementById('delv').value;
var refsl= document.getElementById('refsl').value;
var ddt= document.getElementById('ddt').value;

$('#data8').load('sale_list_profit_copy.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd+'&prnm='+prnm+'&tp1='+tp1+'&gstin='+gstin+'&godown='+godown+'&stat='+stat+'&scat='+scat+'&cat='+cat+'&sale_per='+sale_per+'&delv='+delv+'&refsl='+refsl+'&ddt='+ddt).fadeIn('fast');
}
function view(blno)
{
var ddt= document.getElementById('ddt').value;
window.open('bill_new_gst.php?blno='+encodeURIComponent(blno)+'&ddt='+ddt, '_blank');
window.focus();
}
function view1(blno)
{
var ddt= document.getElementById('ddt').value;
window.open('bill_new_gst.php?blno='+encodeURIComponent(blno)+'&ddt='+ddt+'&typ=1', '_blank');
window.focus();
}
function cancelc(billno)
{
	
if(confirm("Are you sure to cancel !!"))
{
$('#can88').load('cancel_sale_invc.php?billno='+encodeURIComponent(billno)).fadeIn('fast');
}

}
function delvr(billno)
{
	
if(confirm("Are you sure to Deliver ??"))
{
$('#can99').load('deliver_sale_invc.php?billno='+encodeURIComponent(billno)).fadeIn('fast');
}

}

function edit(blno)
{
window.open('billing_edit.php?blno='+blno, '_blank');
window.focus();
}
/*function dlt(blno)
{
$('#data8').load('sale_dlt.php?blno='+blno).fadeIn('fast');
}*/


function get_scat(brnd)  
{
$("#catdiv").load("get_sub_cat.php?cat="+brnd).fadeIn('fast');
}
function get_igst()  
{
scat=document.getElementById('scat').value;
$("#igdiv").load("get_igst.php?scat="+scat).fadeIn('fast');
}
function get_hsn(scat)  
{
$("#hsndiv").load("get_hsn.php?scat="+scat).fadeIn('fast');
}
function revert(blno)
{
$('#can88').load('sale_revert.php?blno='+blno).fadeIn('fast');	
}

function get_cat()
{
var cat= document.getElementById('cat').value;
$('#gcat').load('get_cat_pur.php?cat='+cat).fadeIn('fast');
}

function get_prod()
{
var scat=document.getElementById('scat').value;
var cat=document.getElementById('cat').value;
$("#prod_div").load("get_product_stk.php?scat="+scat+"&cat="+cat).fadeIn('fast');	
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
$("#ddt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

$("#fdt").datepicker(jQueryDatePicker2Opts);
$("#tdt").datepicker(jQueryDatePicker2Opts);
$("#ddt").datepicker(jQueryDatePicker2Opts);
});
function update_vno(val,sl)
{
$('#vvno').load('update_vno.php?val='+val+'&sl='+sl).fadeIn("fast");

}

function show_xml()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
window.open('lg_sale_xml.php?fdt='+fdt+'&tdt='+tdt, '_blank');    
}

function stk_xml()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
window.open('lg_stock_xml.php?fdt='+fdt+'&tdt='+tdt, '_blank');    
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
                    <h1 align="center">
            Profit
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Sale</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="GET" action="sale_list_profit_copy.php" name="form1"  id="form1">
<div class="box box-success" >
<div id="vvno" >
<input type="hidden" id="xls" name="xls" value="1">
</div>

<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr>
<td align="left" width="25%"><b>Form:</b><br>


<input type="text" id="fdt" name="fdt" size="13" value="<?php echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td>
<td align="left" width="25%"><b>To:</b><br>
<input type="text" id="tdt" name="tdt" size="13" value="<?php echo $sa;?>" class="form-control" placeholder="Please Enter To Date">
</td>
<td align="left"  width="25%" ><b>Customer:</b><br>
<input class="form-control" type="text" name="cust_nm" autocomplete="off" id="cust_nm" size="40" onkeyup="if(this.value==''){$('#snm').val('');}" onfocus="this.select()">
<input type="hidden" id="snm" name="snm">

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
<select name="cat" class="form-control" size="1" id="cat" tabindex="8" onchange="get_cat()">
<Option value="">---All---</option>
<?php 
$data11 = mysqli_query($conn,"Select * from main_catg order by sl");
while ($row11 = mysqli_fetch_array($data11))
{
$bsl=$row11['sl'];
$brnm=$row11['cnm'];
echo "<option value='".$bsl."'>".$brnm."</option>";
}
?>
</select>
	</td>
       
	<td  align="left" style="padding-top:17px" ><b>Category :</b>
<div id="gcat">
<select name="scat" class="form-control" size="1" id="scat" tabindex="8" onchange="get_prod()">
<Option value="">---All---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_scat order by nm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['nm'];
echo "<option value='".$sl."'>".$cnm."</option>";
}
?>
</select>
</div>
	</td>
<td align="left"><b>Model:</b><br>
<div id="prod_div">
<select name="prnm" class="form-control"  id="prnm"   >
<option value="">---All---</option>

</select>
</div>
</td>

<td  align="left">
<b>Customer Type :</b>
<select name="tp1" id="tp1" class="form-control">
<option value="">---ALL---</option>		
<option value="1">Retail</option>		
<option value="2">Wholesale</option>		
</select>
</td>
</tr>
<tr>
<td  align="left">
<b>GST Type :</b>
<select name="gstin" id="gstin" class="form-control">
<option value="">---ALL---</option>		
<option value="1">GST</option>		
<option value="2">Non-GST</option>		
</select>
</td>
<td align="left"><b>Godown:</b>
<select name="godown" class="form-control" size="1" id="godown" >
<Option value="">---Select---</option>

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
<td align="left"><b>Status:</b>
<select name="stat" class="form-control" size="1" id="stat" >
<Option value="">All</option>
<Option value="0" selected>Bill</option>
<Option value="1">Canceled</option>
</select>
</td>
<td align="left"><b>Sales Person :</b>
<select id="sale_per" name="sale_per" tabindex="1"  class="form-control">
<option value="">---Select---</option>
<?php 
$queryss="select * from main_sale_per  WHERE sl>0 order by spid";
$resultss=mysqli_query($conn,$queryss);
while($rwss=mysqli_fetch_array($resultss))
{
$spid=$rwss['spid'];
$spnm=$rwss['nm'];
?>
<option value="<?php  echo $spid;?>" ><?php  echo $spid?></option>
<?php 
}
?>
</select>

</td>
</tr>
<tr>
<td  align="left">
<b>Delivery Status :</b>
<select name="delv" id="delv" class="form-control">
<option value="">---ALL---</option>		
<option value="1" >Delivered</option>		
<option value="0" >Undelivered</option>		
</select>
</td>
<td>
<b>Reference :</b>
<select name="refsl" id="refsl" class="form-control">
<option value="">---ALL---</option>	
<?php  
$geti12=mysqli_query($conn,"select * from main_reference order by sl") or die(mysqli_error($conn));
while($rowi12=mysqli_fetch_array($geti12))
{
	$refsl=$rowi12['sl'];
	$refnm=$rowi12['nm'];
?>
<option value="<?php  echo $refsl;?>"><?php  echo $refnm;?></option>

<?php  }?>
</select>
</td>
<?php 
if($user_current_level<0)
{
?>
<td align="left" width="25%"><b>Print Date:</b><br>

<input type="text" id="ddt" name="ddt" size="13" value="" class="form-control" placeholder="Please Enter Date" > 
</td>
<?php 
}
else
{
?>
<td align="left" width="25%"><b></b><br>

<input type="hidden" id="ddt" name="ddt" size="13" value="" class="form-control" placeholder="Please Enter Date" > 
</td>
<?php 	
}
?>
<td align="right">
</td>
</tr>
<tr>
<td align="right" colspan="4">
<!--<input type="button" class="btn btn-info" value="Show" onclick="show1()"> -->
<input type="submit" class="btn btn-warning" value="Excel Export" >

</td>
    </tr>
</thead>



</table>
<div id="data8" style="overflow-x:auto;">
</div>
<div id="can88"></div>
<div id="can99"></div>

<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="cnt1">
			</div>
        </div>
    </div>
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
$("#snm").val(value).trigger("change"); //copy it to the hidden field
}
      
},   
};

$("#cust_nm").easyAutocomplete(options);

</script>
     
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
$('#pnm').chosen({no_results_text: "Oops, nothing found!",});
//$('#snm1').chosen({no_results_text: "Oops, nothing found!",});
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