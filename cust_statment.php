<?php $reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$fdt="";
$tdt="";
$brncd="";

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
 <?php     
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
var proj= encodeURIComponent(document.getElementById('proj').value);
var brncd= encodeURIComponent(document.getElementById('brncd').value);
   var sl= document.form1.cid.value;window.open('custenq.php?sl='+sl+'&fdt='+fdt+'&tdt='+tdt+'&proj='+proj+'&brncd='+brncd,'_blank');
   }
</script>
   <link href="advancedtable.css" rel="stylesheet" type="text/css" />
   <link href="style.css" rel="stylesheet" type="text/css" />
   
   <script type="text/javascript" src="js/datalist/jquery.easy-autocomplete.js"></script>
<link rel="stylesheet" href="js/datalist/easy-autocomplete.css" title="style-orange">
<link rel="stylesheet" href="js/datalist/easy-autocomplete.themes.css" title="style-orange">
   </head>
   <body  >  
   <!-- Right side column. Contains the navbar and content of the page -->      
   <aside class="right-side">      
   <!-- Content Header (Page header) --> 
   <section class="content-header">  
   <h1 align="center">    
   Customer Statement     
   </h1>                
   <ol class="breadcrumb">     
   <li>
   <a href="index.php">
   <i class="fa fa-home">
   </i> 
   Home
   </a>
   </li>    
   <li class="active">Customer Statement</li>   
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
<select name="brncd" class="form-control" size="1" id="brncd" onchange="title1()">

<?php 
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---Select---</option>
<?php 
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
<option value="<?php  echo $slb;?>" <?php if($slb==$brncd){echo 'selected';}?>><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
</td>
<td align="leftt"  style="padding-top:10px" width="25%"> <font size="3"><b>Customer Name :</b></font><br>
<input class="form-control" type="text" name="cust_nm" autocomplete="off" id="cust_nm" size="40" onkeyup="if(this.value==''){$('#cid').val('');}" onfocus="this.select()">
<input type="hidden" id="cid" name="cid">
	<input type="hidden" name="proj" id="proj" value="NA" readonly>
</td>

<td align="left" style="padding-top:10px"  width="25%"> <font size="3" ><b>From  :</b></font><br>
<input type="text" name="fdt" id="fdt" class="form-control" value="<?php  echo $fdt;?>" style="width:100%"></td>
<td align="left" style="padding-top:10px" width="25%"> <font size="3" ><b>To  :</b></font><br>
<input type="text" name="tdt" id="tdt" class="form-control" value="<?php  echo $tdt;?>" style="width:100%"></td>
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
          //  description: "manufacturer"
        }
    },

list: {
onSelectItemEvent: function() {
var value = $("#cust_nm").getSelectedItemData().id; //get the id associated with the selected value
$("#cid").val(value).trigger("change"); //copy it to the hidden field
}
      
},   
};

$("#cust_nm").easyAutocomplete(options);	
	
		</script>   
		</body>
		</html>