<?$reqlevel = 3;
include("membersonly.inc.php");
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
  }
  if($tdt=="")
  {   
 $tdt=date('Y-m-d');}
  $fdt=date('Y-m-01');
 ?>
 <html>
 <head>  
 <div class="wrapper row-offcanvas row-offcanvas-left">    
 <?    
 include "left_bar.php";  
 ?>
 <style type="text/css"> 
 th{text-align:center;font-weight: 900;
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
 .ui-datepicker{ 
 font-family: Arial;  
 font-size: 13px;  
 z-index: 1003 !important; 
 display: none;
 }
 </style>
 <script type="text/javascript" src="prdcedt.js"></script> 	
 <script>	 
 $(document).ready(function()
 {  
 var jQueryDatePicker2Opts =   {  
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
   var cid= document.getElementById('cid').value;
   window.open('supp_statments.php?fdt='+fdt+'&tdt='+tdt+'&cid='+cid,'_blank');
   }
</script>
   <link href="advancedtable.css" rel="stylesheet" type="text/css" />
   <link href="style.css" rel="stylesheet" type="text/css" />
   </head>
   <body  >  
   <!-- Right side column. Contains the navbar and content of the page -->      
   <aside class="right-side">      
   <!-- Content Header (Page header) --> 
   <section class="content-header">  
   <h1 align="center">    
   Supplier Statement     
   </h1>                
   <ol class="breadcrumb">     
   <li>
   <a href="index.php">
   <i class="fa fa-home">
   </i> 
   Home
   </a>
   </li>    
   <li class="active">Supplier Statement</li>   
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
   <center>   
   <div class="box box-success" > 
   <table border="0" width="860px" class="table table-hover table-striped table-bordered">
   
<tr>
<td align="left" width="25%"><font color="red">*</font><font size="3"><b>Branch:</b></font><br>
<select name="brncd" class="form-control" size="1" id="brncd" >
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
$slb=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $slb;?>" <?if($slb==$brncd){echo 'selected';}?>><? echo $bnm;?></option>
<?
}
?>
</select>
</td>

<td align="left" width="25%"> <font size="3"><b>Supplier Name :</b></font><br>
<select id="cid"  name="cid"  tabindex="2" class="sc">	
	<option value="">---Select---</option>		
	<?		
	$query6="select * from  main_suppl order by sl";		
	$result5 = mysqli_query($conn,$query6);		
	while($row=mysqli_fetch_array($result5))		
		{			
	?>		
	<option value="<?=$row['sl'];?>"<?=$sto==$row['sl'] ? 'selected' : ''?>><?=$row['spn'];?></option>	
	<?}?>		
	</select>
	<input type="hidden" name="proj" id="proj" value="NA" readonly>
</td>

<td align="left" width="25%"> <font size="3" ><b>From  :</b></font>
<input type="text" name="fdt" id="fdt" class="sc" value="<?=$fdt;?>"></td>
<td align="left" width="25%"> <font size="3" ><b>To  :</b></font>
<input type="text" name="tdt" id="tdt" class="sc" value="<?=$tdt;?>" ></td>
</tr>
<tr>
<td colspan="6" align="right" style="padding-right:80px">
<input type="button" value=" Show " class="btn btn-primary" onclick="stat()">
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
		<script type="text/javascript">   
		$('#cid').chosen({  no_results_text: "Oops, nothing found!",    }); 
		</script>   
		</body>
		</html>