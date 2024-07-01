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
             Product History
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Product History</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="sale_xls.php" name="form1"  id="form1">
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>

<td align="left" width="20%" >
<b>Godown:</b>
<select name="brncd" class="form-control" size="1" id="brncd">
<option value="">---Select---</option>
<?
$query="Select * from main_godown";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
$gnm=$R['gnm'];


?>
<option value="<? echo $sl;?>"><? echo $gnm;?></option>
<?
}
?>
</select>
</td>

<td  align="left" width="20%">
<b>Brand :</b><br>
<select name="cat" class="form-control" size="1" id="cat" tabindex="8" onchange="get_cat()">
<Option value="">---All---</option>
<?
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
<td  align="left" width="20%">
<b>Category :</b><br>
<div id="gcat">
<select name="scat" class="form-control" size="1" id="scat" tabindex="8" onchange="get_prod()">
<Option value="">---All---</option>
<?/*
$data1 = mysqli_query($conn,"Select * from main_scat order by nm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['nm'];
echo "<option value='".$sl."'>".$cnm."</option>";
}*/
?>
</select>
</div>
</td>
 
<td align="left" width="20%">
<b>Model:  &nbsp; <input type="box" id="prnm3" onkeyup="get_prod_by_name()" name="prnm3" placeholder="Min 3 Digit Model Name "></b>
<div id="prod_div">
<select name="prnm" class="form-control"  id="prnm"   >
<option value="">---All---</option>
<?/*
$data1 = mysqli_query($conn,"Select * from main_product where typ='0' order by pnm");
while ($row1 = mysqli_fetch_array($data1))
{
$msl=$row1['sl'];
$pnm=$row1['pnm'];
$pcd=$row1['pcd'];
?>
<Option value="<?=$msl;?>"><?=reformat($pcd." ".$pnm);?></option>
<?
}*/
?>
</select>
</div>
</td>
<td align="left" width="20%">
<b>Serial No :</b>
<input type="text" id="betno" name="betno" class="form-control" >
</td>
</tr>
<tr>
<td colspan="5" align="right" style="padding-right:80px">
<input type="button" value=" Show " class="btn btn-info" onclick="show()">

</td>
</tr>


</tbody>
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
  
function get_cat()
{
var cat= document.getElementById('cat').value;
$('#gcat').load('get_cat_pur.php?cat='+cat).fadeIn('fast');
}

function get_prod()
{
var scat=document.getElementById('scat').value;
var cat=document.getElementById('cat').value;
//$("#prod_div").load("get_product_stk.php?scat="+scat+"&cat="+cat).fadeIn('fast');	
}
function get_prod_by_name(psl='')
{
var scat=document.getElementById('scat').value;
var cat=document.getElementById('cat').value;
var prnm3=encodeURIComponent(document.getElementById('prnm3').value);
if(cat=='')
{
	alert("Please Select Brand first ! ");
	return;
}
if(prnm3.length>2){
$("#prod_div").load("get_product_stk.php?cat="+cat+"&scat="+scat+"&psl="+psl+"&prnm3="+prnm3).fadeIn('fast');
}
}

function show()
{
var brncd= document.getElementById('brncd').value;
var cat= document.getElementById('cat').value;
var scat= document.getElementById('scat').value;
var pnm= document.getElementById('prnm').value;
var betno=encodeURIComponent(document.getElementById('betno').value);

$('#data8').load('product_history_list.php?pnm='+pnm+'&brncd='+brncd+'&scat='+scat+'&cat='+cat+'&betno='+betno).fadeIn('fast');
}
</script>
    </body>
</html>