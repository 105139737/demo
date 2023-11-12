<?
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
function gpro()
{
	var cat= document.getElementById('cat').value;
	var scat= document.getElementById('scat').value;
	$('#gpro').load('get_product_stk.php?cat='+cat+'&scat='+scat).fadeIn('fast');
}
function show1()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var prnm= document.getElementById('prnm').value;
var gstin= document.getElementById('gstin').value;
var godown= document.getElementById('godown').value;
var scat= document.getElementById('scat').value;
var cat= document.getElementById('cat').value;

$('#data8').load('product_wise_stocks.php?fdt='+fdt+'&tdt='+tdt+'&prnm='+prnm+'&gstin='+gstin+'&godown='+godown+'&scat='+scat+'&cat='+cat).fadeIn('fast');
}

function get_scat()  
{
var brnd= document.getElementById('cat').value;	
$("#catdiv").load("get_sub_cat.php?cat="+brnd).fadeIn('fast');
}

function hist(pcd,betno)
{
$('#cnt1').load('hist.php?pcd='+pcd+'&betno='+betno).fadeIn("fast");
$('#compose-modal').modal('show');
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


	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
              Serial no. wise stock
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Serial no. wise stock</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="sale_xls.php" name="form1"  id="form1">
<div class="box box-success" >
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr>
<td align="left" width="16%"><b>Form:</b><br>
<input type="text" id="fdt" name="fdt" size="13" value="<?echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td>
<td align="left" width="16%"><b>To:</b><br>
<input type="text" id="tdt" name="tdt" size="13" value="<?echo $sa;?>" class="form-control" placeholder="Please Enter To Date">
</td>
<td align="left" width="16%"><b>Godown:</b>
<select name="godown" class="form-control" size="1" id="godown" >
<Option value="">---Select---</option>

<?
$query="Select * from main_godown";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$gnm=$R['gnm'];

?>
<option value="<? echo $sl;?>"><? echo $gnm;?></option>
<?
}
?>
</select>
</td>
</tr>
<tr>
<td  align="left" width="16%"><font color="red">*</font><b>Brand :</b>
<select name="cat" class="form-control" size="1" id="cat" tabindex="8" onchange="get_scat();gpro()"  >
<Option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_catg order by cnm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['cnm'];
echo "<option value='".$sl."'>".$cnm."</option>";
}
?>
</select>
</td>
      
	<td  align="left" width="16%"><b>Category :</b>
	<div id="catdiv">
	<select name="scat" class="form-control" size="1" id="scat" tabindex="8" onchange="gpro()">
	<Option value="">---Select---</option>
	<?
	$data1=mysqli_query($conn,"Select * from main_scat order by nm");
	while($row1=mysqli_fetch_array($data1))
	{
		$sc_sl=$row1['sl'];
		$sc_nm=$row1['nm'];
		?>
		<Option value="<?=$sc_sl;?>"><?=$sc_nm;?></option>
		<?
	}
	?>
	</select>
	</div>
	</td>
<td align="left" width="16%"><b>Model:</b><br>
<div id="gpro">
<select id="prnm" name="prnm" style="width:100%" class="form-control">
<option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_product where typ='0' order by pnm");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
	$pcd=$row1['pcd'];
?>
<Option value="<?=$sl;?>"><?=reformat($pcd." ".$pnm);?></option>
<?}?>
</select>
</div>
</td>

<td  align="left" style="display:none" width="16%">
<b>GST Type :</b>
<select name="gstin" id="gstin" class="form-control">
<option value="">---ALL---</option>		
<option value="1">GST</option>		
<option value="2">Non-GST</option>		
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
<div id="data8" style="overflow-x:auto;">
</div>
<div id="can88"></div>
	 
                                </div>
								</form><!-- /.box-body -->
								
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog" style="width:100%;">
		<div class="modal-content" >
			<div class="modal-body" id="cnt1">
			</div>
        </div>
    </div>
</div>								
								
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
$('#godown').chosen({no_results_text: "Oops, nothing found!",});
  
function getv()
{
var cat= document.getElementById('cat').value;
var bnm= document.getElementById('bnm').value;
$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
</script>
    </body>
</html>