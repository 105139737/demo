<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";

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
      //$("#dt").datepicker(jQueryDatePicker2Opts);
	//$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});


   });
   

   </script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<script type="text/javascript" src="prdcedt.js"></script>
<script>	
function show()
{
var brncd= document.getElementById('brncd').value;
var pnm= document.getElementById('prnm').value;
var cat= document.getElementById('cat').value;
var wzer= document.getElementById('wzer').value;
$('#sgh').load('stock_sts_inv.php?pnm='+pnm+'&brncd='+brncd+'&cat='+cat+'&wzer='+wzer).fadeIn('fast');
}

function xls()
{
var brncd= document.getElementById('brncd').value;
var pnm= document.getElementById('prnm').value;
var cat= document.getElementById('cat').value;
var wzer= document.getElementById('wzer').value;
document.location='stock_sts_inv_xls.php?pnm='+pnm+'&brncd='+brncd+'&cat='+cat+'&wzer='+wzer;
}
function prnt()
{
var brncd= document.getElementById('brncd').value;
var pnm= document.getElementById('prnm').value;
var cat= document.getElementById('cat').value;
var wzer= document.getElementById('wzer').value;
window.open('stock_sts_inv_prnt.php?pnm='+pnm+'&brncd='+brncd+'&cat='+cat+'&wzer='+wzer);
window.focus();
}

 function get_prod()
 {
scat=document.getElementById('cat').value;
cat=document.getElementById('brncd').value;
$("#prod_div").load("get_product_stk.php?scat="+scat+"&cat="+cat).fadeIn('fast');	
 }
 
function title1()
{
brncd=document.getElementById('brncd').value;	
$("#title").load("brncd_name.php?brncd="+brncd).fadeIn('fast');	
}
</script>

	</head>
 <body onload="title1();">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Stock Statement Invoice Wise
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Stock Statement Invoice Wise </li>
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
<td align="left" width="20%">
<b>Company:</b>
<select name="brncd" class="form-control" size="1" id="brncd" onchange="title1()"  >
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

<td align="left" width="20%">
<b>Category :</b><br>
<select name="cat" class="form-control" size="1" id="cat" tabindex="8" onchange="get_prod()">
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
<td align="left" width="20%">
<b>Product:</b>
<div id="prod_div">
<select name="prnm" class="form-control"  id="prnm">
<option value="">---All---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_product  where typ='0' order by pnm");
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
<td align="left" width="20%"><b>Status:</b>
<select name="wzer" class="form-control"  id="wzer">
<Option value="0">Without Zero</option>
<Option value="">With Zero</option>
</select>
</td>

<td align="left" width="20%" style="padding-top:20px;">
<input type="button" value="Show" class="btn btn-info" onclick="show()">
<input type="button" value="Excel To Export" class="btn btn-warning" onclick="xls()">
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
	$('#brncd').chosen({
  no_results_text: "Oops, nothing found!",

  });
  

</script>
</body>
</html>