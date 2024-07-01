<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$sa=date('d-m-Y');
$saa="01-".date('m-y');
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
function show1()
{
var snm= document.getElementById('snm').value;
var brncd= document.getElementById('brncd').value;
var sman= document.getElementById('sman').value;
var due_stat= document.getElementById('due_stat').value;
var dt= document.getElementById('dt').value;
var blno= encodeURIComponent(document.getElementById('blno').value);
var invto= document.getElementById('invto').value;
var order_by= document.getElementById('order_by').value;
var cat= document.getElementById('cat').value;
var refsl= document.getElementById('refsl').value;
var gt= document.getElementById('gt').value;
var paid= document.getElementById('paid').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var day= document.getElementById('day').value;
var x=document.getElementById("btyp");
btyp="";
for (var i = 0; i < x.options.length; i++) {
if(x.options[i].selected ==true){
if(btyp=="")
{btyp="cbill like @"+x.options[i].value+"%@"; }
else
{btyp=btyp+" or cbill like @"+x.options[i].value+"%@";} }}

$('#data8').load('due_bals.php?snm='+snm+'&brncd='+brncd+'&sman='+sman+'&btyp='+encodeURIComponent(btyp)+'&due_stat='+due_stat+'&dt='+dt+'&blno='+blno+'&invto='+invto+'&order_by='+order_by+'&cat='+cat+'&refsl='+refsl+'&gt='+gt+'&paid='+paid+'&fdt='+fdt+'&tdt='+tdt+'&day='+day).fadeIn('fast');
}

function pagnt(pno){
var snm= document.getElementById('snm').value;
var brncd= document.getElementById('brncd').value;
var sman= document.getElementById('sman').value;
var ps= document.getElementById('ps').value;
var due_stat= document.getElementById('due_stat').value;
var dt= document.getElementById('dt').value;
var blno= encodeURIComponent(document.getElementById('blno').value);
var x=document.getElementById("btyp");
var invto= document.getElementById('invto').value;
var order_by= document.getElementById('order_by').value;
var cat= document.getElementById('cat').value;

var paid= document.getElementById('paid').value;
var day= document.getElementById('day').value;
btyp="";
for (var i = 0; i < x.options.length; i++) {
if(x.options[i].selected ==true){
if(btyp=="")
{btyp="cbill like @"+x.options[i].value+"%@"; }
else
{btyp=btyp+" or cbill like @"+x.options[i].value+"%@";} }}
var refsl= document.getElementById('refsl').value;
var gt= document.getElementById('gt').value;
		
$('#data8').load('due_bals.php?snm='+snm+'&brncd='+brncd+'&sman='+sman+'&btyp='+encodeURIComponent(btyp)+'&ps='+ps+'&pno='+pno+'&due_stat='+due_stat+'&dt='+dt+'&blno='+blno+'&invto='+invto+'&order_by='+order_by+'&cat='+cat+'&refsl='+refsl+'&gt='+gt+'&paid='+paid+'&fdt='+fdt+'&tdt='+tdt+'&day='+day).fadeIn('fast');
$('#pgn').val=pno;
}

function pagnt1(pno){
pno=document.getElementById('pgn').value;
pagnt(pno);
} 

function vwdtl(blno)
{
var dt= document.getElementById('dt').value;	
$('#cnt').load('due_bals_det.php?blno='+encodeURIComponent(blno)+'&dt='+dt).fadeIn('fast');
$('#myModal').modal('show');
}


function prnt()
{
var snm= document.getElementById('snm').value;
var brncd= document.getElementById('brncd').value;
var sman= document.getElementById('sman').value;
var due_stat= document.getElementById('due_stat').value;
var dt= document.getElementById('dt').value;
var blno= encodeURIComponent(document.getElementById('blno').value);
var invto= document.getElementById('invto').value;
var order_by= document.getElementById('order_by').value;
var cat= document.getElementById('cat').value;
var x=document.getElementById("btyp");
btyp="";
for (var i = 0; i < x.options.length; i++) {
if(x.options[i].selected ==true){
if(btyp=="")
{btyp="cbill like @"+x.options[i].value+"%@"; }
else
{btyp=btyp+" or cbill like @"+x.options[i].value+"%@";} }}

var refsl= document.getElementById('refsl').value;
var day= document.getElementById('day').value;



	

if(snm!=""){
var url='due_bal_prnt.php?snm='+snm+'&brncd='+brncd+'&sman='+sman+'&btyp='+encodeURIComponent(btyp)+'&due_stat='+due_stat+'&dt='+dt+'&blno='+blno+'&invto='+invto+'&order_by='+order_by+'&cat='+cat+'&refsl='+refsl+'&fn='+fn+'&tn='+tn+'&day='+day;
window.open(url).attr('target','_blank');
}
else
{
	alert("Please select customer name.");
}



}
function xls()
{
var snm= document.getElementById('snm').value;
var brncd= document.getElementById('brncd').value;
var sman= document.getElementById('sman').value;
var due_stat= document.getElementById('due_stat').value;
var dt= document.getElementById('dt').value;
var blno= encodeURIComponent(document.getElementById('blno').value);
var invto= document.getElementById('invto').value;
var cat= document.getElementById('cat').value;
var fn= document.getElementById('fn').value;
var tn= document.getElementById('tn').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var day= document.getElementById('day').value;
var x=document.getElementById("btyp");
btyp="";
for (var i = 0; i < x.options.length; i++) {
if(x.options[i].selected ==true){
if(btyp=="")
{btyp="cbill like @"+x.options[i].value+"%@"; }
else
{btyp=btyp+" or cbill like @"+x.options[i].value+"%@";} }}
var refsl= document.getElementById('refsl').value;
url='due_bals_xls.php?snm='+snm+'&brncd='+brncd+'&sman='+sman+'&btyp='+encodeURIComponent(btyp)+'&due_stat='+due_stat+'&dt='+dt+'&val=1'+'&blno='+blno+'&invto='+invto+'&order_by='+order_by+'&cat='+cat+'&refsl='+refsl+'&fn='+fn+'&tn='+tn+'&fdt='+fdt+'&tdt='+tdt+'&day='+day;

window.open(url).attr('target','_blank');
}

function count()
{
var snm= document.getElementById('snm').value;
var brncd= document.getElementById('brncd').value;
var sman= document.getElementById('sman').value;
var due_stat= document.getElementById('due_stat').value;
var dt= document.getElementById('dt').value;
var blno= encodeURIComponent(document.getElementById('blno').value);
var invto= document.getElementById('invto').value;
var order_by= document.getElementById('order_by').value;
var cat= document.getElementById('cat').value;
var refsl= document.getElementById('refsl').value;
var gt= document.getElementById('gt').value;
var day= document.getElementById('day').value;


var x=document.getElementById("btyp");
btyp="";
for (var i = 0; i < x.options.length; i++) {
if(x.options[i].selected ==true){
if(btyp=="")
{btyp="cbill like @"+x.options[i].value+"%@"; }
else
{btyp=btyp+" or cbill like @"+x.options[i].value+"%@";} }}

$('#count_div').load('due_bal_count.php?snm='+snm+'&brncd='+brncd+'&sman='+sman+'&btyp='+encodeURIComponent(btyp)+'&due_stat='+due_stat+'&dt='+dt+'&blno='+blno+'&invto='+invto+'&order_by='+order_by+'&cat='+cat+'&refsl='+refsl+'&gt='+gt+'&day='+day).fadeIn('fast');
}

function get_days()
{
    var sman=encodeURIComponent(document.getElementById('sman').value);
    $('#days').load('get_days.php?sman='+sman).fadeIn('fast');
   
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

$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

$("#dt").datepicker(jQueryDatePicker2Opts);
$("#tdt").datepicker(jQueryDatePicker2Opts);
$("#fdt").datepicker(jQueryDatePicker2Opts);
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
             Due List
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Due List</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">	

<form method="post" action="due_bals_xls.php" name="form1"  id="form1">
<input type="hidden" class="form-control" name="val" id="val" value="1">    
<div class="box box-success" >
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr>
<td align="left" width="16%" ><b>Bill Type :</b><br>
<select name="btyp[]" class="form-control" size="1" id="btyp"  multiple >

<?
$btyp=array();
$query="Select * from bills_receivable ";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$Ref_No=$R['Ref_No'];
$btyp1[]=preg_replace('/[0-9]+/', '',substr($Ref_No,0,7));
}
$query="Select * from main_billtype where inv_typ='0' group by als";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$btyp1[]=$R['als'];

}

$btyp=array_unique($btyp1);
$btyp = array_values($btyp);
for($i=0;$i<count($btyp);$i++)
{
$words =$btyp[$i];
if($words=="")
{
$words=$btyp[$i];
}	
?>
<option value="<? echo $words;?>"><? echo $words;?></option>
<?
}
?>
</select>
</td>

<td align="left" width="16%" ><b>SALES PERSON:</b><br>
<select name="sman" class="form-control" size="1" id="sman" onchange="get_days()"  >
<?
if($user_current_level<0)
{
$query="Select * from main_sale_per";
?>
<option value="">---All---</option>
<?
}
else
{
$query="Select * from main_sale_per where spid='$spid'";
}
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$spid=$R['spid'];
$bnm=$R['bnm'];
?>
<option value="<? echo $spid;?>"><? echo $spid;?></option>
<?
}
?>
</select>
</td>
<td align="left"  width="16%" ><b>Ledger:</b><br>
<input class="form-control" type="text" name="cust_nm" autocomplete="off" id="cust_nm" size="40" onkeyup="if(this.value==''){$('#snm').val('');}" onfocus="this.select()">
<input type="hidden" id="snm" name="snm">

</td>
<td align="left" width="16%" ><b>Branch:</b><br>
<select name="brncd" class="form-control" size="1" id="brncd"   >
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
<td align="left" width="16%" ><b>Status :</b><br>
<select name="due_stat" class="form-control" size="1" id="due_stat"   >
<option value="1">Without 0</option>
<option value="0">All</option>

</select>
</td>
<td align="left" width="16%"><b>Date :</b><br>
<input type="text" id="dt" name="dt" size="13" value="<?echo $sa;?>" class="form-control" placeholder="Please Enter To Date">
</td>
</tr>
<tr>
<td align="left" width="16%"><b>Bill No. :</b><br>
<input type="text" id="blno" name="blno" size="13" value="" class="form-control" placeholder="Please Enter To Date">
</td>
<td align="left"  width="16%" ><b>Customer:</b><br>
<input class="form-control" type="text" name="invto_get" autocomplete="off" id="invto_get" size="40" onkeyup="if(this.value==''){$('#invto').val('');}" onfocus="this.select()">
<input type="hidden" id="invto" name="invto">


</td>
<td align="left"  width="16%" ><b>Order by :</b><br>
<select name="order_by" class="form-control"  id="order_by">
<option value="">---All---</option>
<option value="cid">Customer</option>
</select>
</td>
<td>
<b>Brand</b>
<select name="cat" class="form-control" size="1" id="cat" tabindex="1">
<Option value="">---All---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_catg where stat='0' order by cnm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['cnm'];
echo "<option value='".$sl."'>".$cnm."</option>";
}
?>
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
<option value="<?php echo $refsl;?>"><?php echo $refnm;?></option>

<?php }?>
</select>
</td>
<td align="left"><b>Grand Total  :</b><br>
<select name="gt" class="form-control"  id="gt">
<option value="0">No</option>
<option value="1">YES</option>
</select>
</td>
</tr>
<tr>
<td align="left"><b>Limit  :</b><br>
 <input type="text" id="fn" name="fn" size="13" class="form-control" value="0"  placeholder="limit">
</td>
<td align="left"><b>No. Of Data Show :</b><br>
<input type="text" id="tn" name="tn" size="13" class="form-control" value="500" placeholder="No. Of Data Show">
</td>
<td align="left"><b>Bill Details  :</b><br>
<select name="paid" class="form-control"  id="paid">
<option value="0">Due Bill</option>
<option value="1">All Bill</option>
</select>
</td>
<td align="left"><b>From Date :</b><br>
<input type="text" id="fdt" name="fdt" size="13" value="" class="form-control" placeholder="Please Enter From Date">
</td>
<td align="left"><b>To Date :</b><br>
<input type="text" id="tdt" name="tdt" size="13" value="" class="form-control" placeholder="Please Enter To Date">
</td>
</tr>

<tr>
<td  align="left" >
<div id="days">
<select id="day" name="day" class="form-control" > 
<option value="">----Day----</option>       
<option value="sunday">Sunday</option>       
<option value="monday">Monday</option>       
<option value="tuesday">Tuesday</option>       
<option value="wednesday">Wednesday</option>       
<option value="thursday">Thursday</option>       
<option value="friday">Friday</option>       
<option value="saturday">Saturday</option>       
</select>
</select>
</div>
</td>
<td align="right" colspan="5">
    <span id="count_div" style="float:left"></span>

    <input type="button" class="btn btn-success" value="Total Bill Count  " onclick="count()">
<input type="button" class="btn btn-info" value="Show" onclick="show1()">
<input type="button" class="btn btn-info" value="Print" onclick="prnt()">
<input type="button" class="btn btn-warning" onclick="xls()" value="Excel Export" >
</td>
</tr>
</thead>



</table>
<div id="data8" style="overflow-x:auto;">
</div>
	 
                                </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                       
							</div>



<!-- Modal Box Start-->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md" style="width:60%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h4>Bill Details</h4>
			</div>
			<div class="page" id="cnt" style="overflow: auto;"></div>
		</div>
	</div>
</div>
<!-- Modal Box End -->							
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

$('#cat').chosen({no_results_text: "Oops, nothing found!",});
$('#bnm').chosen({no_results_text: "Oops, nothing found!",});
$('#prnm').chosen({no_results_text: "Oops, nothing found!",});
$('#sman').chosen({no_results_text: "Oops, nothing found!",});
$('#btyp').chosen({no_results_text: "Oops, nothing found!",});

  
function getv()
{
var cat= document.getElementById('cat').value;
var bnm= document.getElementById('bnm').value;
$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
var options = {
    url: function(phrase) { 
        if (phrase !== "") {
			return "get_med_data.php?mnm="+encodeURIComponent(phrase);
		}
	},

    getValue: "name",

    template: {
       // type: "description",
        fields: {
            //description: "manufacturer"
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



var options = {
    url: function(phrase) { 
        if (phrase !== "") {
			return "get_med_data.php?mnm="+encodeURIComponent(phrase);
		}
	},

    getValue: "name",

    template: {
      //  type: "description",
        fields: {
          //  description: "manufacturer"
        }
    },

list: {
onSelectItemEvent: function() {
var value = $("#invto_get").getSelectedItemData().id; //get the id associated with the selected value
$("#invto").val(value).trigger("change"); //copy it to the hidden field
}
      
},   
};

$("#invto_get").easyAutocomplete(options);

</script>
    </body>
</html>