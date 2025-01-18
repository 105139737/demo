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
var tp1= document.getElementById('tp1').value;
var gstin= document.getElementById('gstin').value;
var stat= document.getElementById('stat').value;
var sale_per= document.getElementById('sale_per').value;

var x=document.getElementById("btyp");
btyp="";
for (var i = 0; i < x.options.length; i++) {
if(x.options[i].selected ==true){
if(btyp=="")
{btyp=" als like @"+x.options[i].value+"%@"; }
else
{btyp=btyp+" or als like @"+x.options[i].value+"%@";} }}

$('#data8').load('sale_summarys.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd+'&tp1='+tp1+'&gstin='+gstin+'&stat='+stat+'&sale_per='+sale_per+'&btyp='+encodeURIComponent(btyp)).fadeIn('fast');
}

function view(blno)
{
window.open('bill_new_gst.php?blno='+encodeURIComponent(blno), '_blank');
window.focus();
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
function xls()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var snm= document.getElementById('snm').value;
var brncd= document.getElementById('brncd').value;
var tp1= document.getElementById('tp1').value;
var gstin= document.getElementById('gstin').value;
var stat= document.getElementById('stat').value;
var sale_per= document.getElementById('sale_per').value;

var x=document.getElementById("btyp");
btyp="";
for (var i = 0; i < x.options.length; i++) {
if(x.options[i].selected ==true){
if(btyp=="")
{btyp=" als like @"+x.options[i].value+"%@"; }
else
{btyp=btyp+" or als like @"+x.options[i].value+"%@";} }}
val=1;
window.open('sale_summarys.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd+'&tp1='+tp1+'&gstin='+gstin+'&stat='+stat+'&sale_per='+sale_per+'&btyp='+encodeURIComponent(btyp)+'&val=1', '_blank');
window.focus();
}

function edit(blno)
{
window.open('billing_edit.php?blno='+blno, '_blank');
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
              Sale Summary
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Sale Summary</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="#" name="form1"  id="form1">
<div class="box box-success" >
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr>
<td align="left" width="25%"><b>Form:</b><br>
<input type="text" id="fdt" name="fdt" size="13" value="<?php echo $sa;?>" class="form-control" placeholder="Please Enter From Date" > </td>
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
	<td  align="left" style="padding-top:17px" ><b>GST Type :</b>
<select name="gstin" id="gstin" class="form-control">
<option value="">---ALL---</option>		
<option value="1">GST</option>		
<option value="2">Non-GST</option>		
</select>
	</td>
       
	<td  align="left" style="padding-top:17px" >
	<b>Status:</b>
<select name="stat" class="form-control" size="1" id="stat" >
<Option value="">All</option>
<Option value="0" selected>Bill</option>
<Option value="1">Canceled</option>
</select>
	</div>
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
<option value="<?php  echo $spid;?>" ><?php  echo $spid?> <?php  echo $spnm;?> <?php if($rwss['mob']!=""){?>( <?php  echo $rwss['mob'];?> )<?php }?></option>
<?php 
}
?>
</select>
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
<td>
<b>ALS :</b>
<select name="btyp[]" class="form-control" size="1" id="btyp"  multiple >

<?php 
$btyp=array();
$query="Select * from main_billtype where inv_typ='0' group by als";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$als=$R['als'];

?>
<option value="<?php  echo $als;?>"><?php  echo $als;?></option>
<?php 
}
?>
</select>
</td>
<td align="right" colspan="3">
<input type="button" class="btn btn-info" value="Show" onclick="show1()">
<input type="button" class="btn btn-warning" value="Excel Export"  onclick="xls()">
</td>
</tr>
</thead>



</table>
<div id="data8" style="overflow-x:auto;">
</div>
<div id="can88"></div>
	 
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
//$('#snm').chosen({no_results_text: "Oops, nothing found!",});
$('#cat').chosen({no_results_text: "Oops, nothing found!",});
$('#bnm').chosen({no_results_text: "Oops, nothing found!",});
$('#prnm').chosen({no_results_text: "Oops, nothing found!",});
$('#sale_per').chosen({no_results_text: "Oops, nothing found!",});
$('#scat').chosen({no_results_text: "Oops, nothing found!",});
$('#btyp').chosen({no_results_text: "Oops, nothing found!",});
  
function getv()
{
var cat= document.getElementById('cat').value;
var bnm= document.getElementById('bnm').value;
$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
</script>
    </body>
</html>