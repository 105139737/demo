<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$fdt=date('d-m-Y');
$tdt=date('d-m-Y');
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
function checkall(val)
{

	
var j3='';
	var chk = document.getElementsByName('chk[]');
	//alert(chk.length);
	frmlen = chk.length;
	for(i=0;i<frmlen;i++)
	{
		chk[i].checked = val;
		if(i==0)
		{
		j3=chk[i].value;
		}
		else
		{
		 j3=j3+','+chk[i].value;
		
	}

	}
	
	if(!val)
    {
        document.getElementById('abc').value ="";
    }
    else
    {
		 document.getElementById('abc').value =j3;
         }
}

	function ch1()
{

var j3='';
	var chk = document.getElementsByName('chk[]');
	frmlen = chk.length;
	for(i=0;i<frmlen;i++)
	{
		
		if(i==0)
		{
			if(chk[i].checked){
		j3=chk[i].value;
			}
		}
		else
		{
			if(chk[i].checked){
		 j3=j3+','+chk[i].value;
			}
	}

	}
	document.getElementById('abc').value =j3;
	
	
} 
function show1()
{
 var fdt= document.getElementById('fdt').value;
 var tdt= document.getElementById('tdt').value;
 var bcd= document.getElementById('bcd').value;
 $('#data8').load('bill_chln_list.php?fdt='+fdt+'&tdt='+tdt+'&bcd='+bcd).fadeIn('fast');
}
function del(sl)
{
 $('#data8').load('bill_chln_del.php?sl='+sl).fadeIn('fast');    
}
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>


	</head>
 <body >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
            Bill To Challan 
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Bill To Challan </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">			
	<form method="post" action="bill_chlns.php" name="form1"  id="form1">
   <input type="hidden" id="abc" name="abc" value="" size="150">                           
<div class="box box-success" >
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr  >
<td align="left" width="16%" >
<b>Form:</b><br>

<input type="text" id="fdt" name="fdt" size="13" value="<?php echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td>

<td align="left" width="16%"  >
<b>To:</b>
<br>
<input type="text" id="tdt" name="tdt" size="13" value="<?php echo $tdt;?>" class="form-control" placeholder="Please Enter To Date">
</td>

<td align="left" width="16%"  >
<b>To Godown :</b>
<br>
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" required>
<?php 
$geti=mysqli_query($conn,"select * from main_godown order by gnm") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$sl=$rowi['sl'];
$gnm=$rowi['gnm'];

$datag= mysqli_query($conn,"SELECT * FROM main_a_sale_chln where sl>0  and  FIND_IN_SET('$sl', bill_godown)>0 ") or die(mysqli_error($conn));
$count=mysqli_num_rows($datag);
if($count>0)
{
?>
<option value="<?php  echo $sl;?>"><?php  echo $gnm;?> </option>
<?php 
}

}
?>
</select>
</td>

</td>
<td align="" width="10%"><br>
<input type="button" class="btn btn-primary" value="Show" onclick="show1()">
<input type="submit" class="btn btn-success" value="Create Now">
</td>
</tr>
</thead>



</table>
<div id="data8" >
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

	
$('#pnm').chosen({no_results_text: "Oops, nothing found!",});
$('#snm').chosen({no_results_text: "Oops, nothing found!",});
$('#cat').chosen({no_results_text: "Oops, nothing found!",});
$('#bnm').chosen({no_results_text: "Oops, nothing found!",});
$('.czn').chosen({no_results_text: "Oops, nothing found!",});
  
function getv()
{
var cat= document.getElementById('cat').value;
var bnm= document.getElementById('bnm').value;
$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
</script>
    </body>
</html>