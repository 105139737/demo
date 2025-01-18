<?php $reqlevel = 1;
include("membersonly.inc.php");
$fdt="";
$tdt="";
$branch_nm="Supplier Summary";
include "header.php";
if($fdt=="")
{    
if(date('m')>3)
{        
$fdt=date('Y')."-04-01";   
}    
else    
{       
$fdt=(date('Y')-1)."-04-01";   
}    
}if($tdt=="")
{    
$tdt=date('Y-m-d');
}?>
<html>
<head>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php             
include "left_bar.php";
?>
<style type="text/css">
 th{text-align:center;
 font-weight: 900;
 border:1px solid #37880a; 
 }
 input:focus
 {
	 background-color:Aqua;
 }
a
{
cursor:pointer;
}
</style>      
<link rel="stylesheet" href="dark-hive/jquery.ui.all.css" type="text/css">
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>   
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>   
<style type="text/css">
.ui-datepicker
{   
font-family: Arial;   
font-size: 13px;   
z-index: 1003 !important;  
 display: none;
}
</style>
<script type="text/javascript" src="prdcedt.js"></script> 	
<script>	   
$(document).ready(function()
{   var jQueryDatePicker2Opts =   
{      
dateFormat: 'yy-mm-dd',      
changeMonth: true,      
changeYear: true,     
showButtonPanel: false,      
showAnim: 'show'   
};      
$("#fdt").datepicker(jQueryDatePicker2Opts);   
$("#fdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});   
$("#tdt").datepicker(jQueryDatePicker2Opts);   
$("#tdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});      	   
});

function stat()
{ 
var fdt= encodeURIComponent(document.getElementById('fdt').value);
var tdt= encodeURIComponent(document.getElementById('tdt').value);
var proj= encodeURIComponent(document.getElementById('proj').value);
var amm= encodeURIComponent(document.getElementById('amm').value);
var brncd= encodeURIComponent(document.getElementById('brncd').value);
window.open('supp_statements.php?fdt='+fdt+'&tdt='+tdt+'&proj='+proj+'&amm='+amm+'&brncd='+brncd,'_blank');
}
</script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head> 
<body>            
<!-- Right side column. Contains the navbar and content of the page -->  
   <aside class="right-side">                <!-- Content Header (Page header) -->          
   <section class="content-header">                 
   <h1 align="center">           
   Supplier Summary             
   </h1>                
   <ol class="breadcrumb">  
   <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li> 
   <li class="active">Supplier Summary</li>   
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
   <form method="post" action="brnchs.php" id="form1" name="form1">
   <input type="hidden">
   
   <div class="box box-success" >    
	<table border="0" width="860px" class="table table-hover table-striped table-bordered">
	<tr>
	<input type="hidden" value="1" name="proj" id="proj">

<td align="right" style="padding-top:10px">
<font size="3" ><b>Branch:</b></font>
<select name="brncd" size="1" id="brncd"  class="sc" style="width:100px">
<?php 
if($user_current_level<0)
{
	?>
	<option value="">---ALL---</option>
	<?php 
}
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
<option value="<?php  echo $sl;?>"><?php  echo $bnm;?></option>
<?php 
}
?>
</select>

</td>
<td align="right" style="padding-top:10px"> <font size="3" ><b>From  :</b></font><input type="text" name="fdt" id="fdt" class="sc" value="<?php  echo $fdt;?>" style="width:100px"></td>
<td align="right" style="padding-top:10px"> <font size="3" ><b>To  :</b></font><input type="text" name="tdt" id="tdt" class="sc" value="<?php  echo $tdt;?>" style="width:100px"></td>
<td align="left"><font size="3" ><b>Due / Advance  >= </b>Rs. </font>
<input type="text" name="amm" id="amm" class="sc" value="0" style="width:100px">
</td>
<td align="left"><input type="button" value=" Show " class="btn btn-primary" onclick="stat()"></td>
</tr>
</table>

<div id="sgh"></div>	
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
 <script type="text/javascript">    $('#cid').chosen({  no_results_text: "Oops, nothing found!",    });  </script>    </body></html>