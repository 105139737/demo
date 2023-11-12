<?php 
$reqlevel=3;
include("membersonly.inc.php");
include "header.php";
include "function.php";
//$saa="01-".date('m-Y');

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
      $("#dt").datepicker(jQueryDatePicker2Opts);
	$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});


   });
   

   </script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<script type="text/javascript" src="prdcedt.js"></script>
<script>	
function show()
{
	var dt=document.getElementById('dt').value;
	var cat=document.getElementById('cat').value;
	var scat=document.getElementById('scat').value;
	var pnm=document.getElementById('prnm').value;
if(pnm!=""){
	$('#sgh').load('prod_wise_stk_news.php?pnm='+pnm+'&scat='+scat+'&cat='+cat+'&dt='+dt).fadeIn('fast');
}
else
{
alert("You have to excel export if you want to see data of more then 1 model");
}
}
function pagnt(pno)
{
	var ps=document.getElementById('ps').value;
	var dt=document.getElementById('dt').value;
	var cat=document.getElementById('cat').value;
	var scat=document.getElementById('scat').value;
	var pnm=document.getElementById('prnm').value;

	$('#sgh').load("prod_wise_stk_news.php?ps="+ps+"&pno="+pno+"&pnm="+pnm+"&scat="+scat+"&cat="+cat+'&dt='+dt).fadeIn('fast');
	$('#pgn').val=pno;
}

function pagnt1(pno)
{
pno=document.getElementById('pgn').value;
pagnt(pno);
}


function prnt()
{
	 var brncd= document.getElementById('brncd').value;
	 var scat= document.getElementById('scat').value;
	 var pnm= document.getElementById('prnm').value;

	window.open('prod_wise_stks_prnt.php?pnm='+pnm+'&brncd='+brncd+'&scat='+scat);
	window.focus();
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

	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Model Wise Stock Statement 
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Model Wise Stock Statement </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                   

                   

                    <!-- Main row -->
                    
                        <!-- Left col -->
                       
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        
                           

                            <!-- Chat box -->
					
                     <!-- /.box (chat box) -->

                            <!-- TO DO List -->
<form method="GET" action="prod_wise_stk_news_xls.php" id="form1" onSubmit="return check1()" name="form1">
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="left" width="10%">
<b>Date : </b>
<input type="text" id="dt" name="dt" value="<?echo date('d-m-Y');?>" class="form-control" placeholder="Please Enter From Date" > 
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
</div>
</td>
 
<td align="left" width="20%">
<b>Model:</b>
<div id="prod_div">
<select name="prnm" class="form-control"  id="prnm">
<option value="">---All---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_product where typ='0' and stat='0' order by pnm");
while ($row1 = mysqli_fetch_array($data1))
{
$msl=$row1['sl'];
$pnm=$row1['pnm'];
?>
<Option value="<?=$msl;?>"><?=reformat($pnm);?></option>
<?
}
?>
</select>
</div>
</td>
</tr>
<tr>
<td colspan="6" align="right" style="padding-right:80px">
<input type="button" value=" Show " class="btn btn-info" onclick="show()">
<input type="submit" value=" Export To Excel " class="btn btn-warning">
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