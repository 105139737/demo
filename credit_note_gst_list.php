<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$tdt = date('d-m-Y');
$fdt3 = date('Y');
$m = date('m');
$fdt="01-04-".$fdt3;
$saa="01-".date('m-Y');
if($m<4)
{
$fdt1=$fdt3-1;	
}
else
{
$fdt1=$fdt3;

}
//echo $fdt1;

$fdt="01-04-".$fdt1;
?>
<html>
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<head>
       
<style type="text/css"> 


input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
color:red;
}
#boxpopup{

left:100%;
position:fixed;
}

select.sc {
	width: 450px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 5px;
}
select.rf {
	width: 100px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}


</style> 


<script type="text/javascript" src="ajax.js"></script>


<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

   
      <link rel="stylesheet" href="dark-hive/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
/* Show in default resolution screen*/
#container2 {
width: 960px;
position: relative;
margin:0 auto;
line-height: 1.4em;
}

/* If in mobile screen with maximum width 479px. The iPhone screen resolution is 320x480 px (except iPhone4, 640x960) */    
@media only screen and (max-width: 479px){
    #container2 { width: 90%; }
}
</style>



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
   
   $("#fdt").datepicker(jQueryDatePicker2Opts);
   $("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
   $("#tdt").datepicker(jQueryDatePicker2Opts);
   $("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
     $("#dt").datepicker(jQueryDatePicker2Opts);
   $("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
      	
   });
function show()
{
	
var	typp=document.getElementById('typ');
var sup=document.getElementById('sup').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var gstin= document.getElementById('gstin').value;
var note_typ= document.getElementById('note_typ').value;
	test="";
	for (var i = 0; i < typp.options.length; i++)
	{
		if(typp.options[i].selected ==true)
		{
			if(test=="")
			{
				test=typp.options[i].value 
			}
			else
			{
				test=test+","+typp.options[i].value
			}
		}
	}
	typ=test;
$('#show').load('credit_note_gst_lists.php?fdt='+fdt+'&tdt='+tdt+'&sup='+sup+'&typ='+typ+'&gstin='+gstin+'&note_typ='+note_typ).fadeIn('fast');
}


function exls()
{
	var	typp=document.getElementById('typ');

var sup=document.getElementById('sup').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var gstin= document.getElementById('gstin').value;
var note_typ= document.getElementById('note_typ').value;
	test="";
	for (var i = 0; i < typp.options.length; i++)
	{
		if(typp.options[i].selected ==true)
		{
			if(test=="")
			{
				test=typp.options[i].value 
			}
			else
			{
				test=test+","+typp.options[i].value
			}
		}
	}
	typ=test;
document.location='credit_note_gst_lists_xls.php?fdt='+fdt+'&tdt='+tdt+'&sup='+sup+'&typ='+typ+'&gstin='+gstin+'&note_typ='+note_typ;
}
function prnt()
{
var	typp=document.getElementById('typ');
var sup=document.getElementById('sup').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var gstin= document.getElementById('gstin').value;
var note_typ= document.getElementById('note_typ').value;
	test="";
	for (var i = 0; i < typp.options.length; i++)
	{
		if(typp.options[i].selected ==true)
		{
			if(test=="")
			{
				test=typp.options[i].value 
			}
			else
			{
				test=test+","+typp.options[i].value
			}
		}
	}
	typ=test;
window.open('credit_note_gst_lists_prnt.php?fdt='+fdt+'&tdt='+tdt+'&sup='+sup+'&typ='+typ+'&gstin='+gstin+'&note_typ='+note_typ);
window.focus();
}


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
function get_gst()
{
sup=document.getElementById('sup').value;	
$('#gst_div').load('get_gst_comp.php?sup='+sup).fadeIn('fast');
}
   </script>
   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="chosen.css">
	</head>
 <body  >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 SUPPLIER CN DN WITH GST
                        
                    </h1>
					
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">SUPPLIER CN DN WITH GST</li>
                    </ol>
                </section>
                 <section class="content">
 					
					
					
<form name="form1" id="form1" method="post" action="credit_note_gsts.php" onsubmit="return check()">
<input type="hidden" id="abc" name="abc" value=""size="150">
        <div class="box box-success" >

<table class="table table-hover table-striped table-bordered" >	
<tr >
<td align="left" width="16%">
<b>GSTIN :</b>
<br>
<select id="gstin" name="gstin"  class="form-control" style="width:100%">
<option value="">---All---</option>
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</td>
<td align="left" width="16%">
<b>Supplier :</b>
<br>
<select id="sup" data-placeholder="Choose Your Supplier" name="sup"  class="form-control" tabindex="2" style="width:100%" onchange="get_gst()">
<option value="">---Select---</option>
<?
$sql1="SELECT * FROM main_suppl  ORDER BY spn";
$result1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($result1))
{

?>
<option value="<?=$row1['sl'];?>"><?=$row1['spn'];?></option>
<?}?>
</select>
</td>
<td align="left" width="16%">
<b>From  :</b>
<input type="text" name="fdt" id="fdt" class="form-control" value="<?=$saa;?>" >
</td>

<td align="left" width="16%">
<b>To  :</b>
<input type="text" name="tdt" id="tdt" class="form-control" value="<?=$tdt;?>" >
</td>
<td align="left" width="16%" >
<b>Type :</b>
<select id="typ" name="typ[]"  class="form-control" tabindex="2" multiple>
<option value="Cash-Discount">Cash-Discount</option>
<option value="Rate-Difference">Rate-Difference</option>
<option value="Scheme">Scheme</option>
<option value="Breakage">Breakage</option>
<option value="Shortage">Shortage</option>
</select>
</td>
<td  width="16%">
<b>Note Type  :</b>
<select name="note_typ"  id="note_typ"  class="form-control"  >
<option value="" >---ALL---</option>
<option value="C">Credit</option>
<option value="D">Debit</option>
</select>
</td>
</tr>
<tr>
<td colspan="6" align="right">
<input type="button" value="Show" class="btn btn-info" onclick="show()">
<input type="button" value="Export To Excel" class="btn btn-warning" onclick="exls()">
</td>
</tr>		  
</table>
</div> 
</form>
  <div class="box box-success" id="show" >
 
  
  </div>

  
       



	 
                               
						
							
                               
                  
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->
 </section><!-- /.content -->
                
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     

    </body>
	
	  <script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>
	<script>


function del_cdnr(refno,typ)
{
if( !confirm('Are you sure?')) {
return false;
}
else{
//alert(refno+typ);
$('#show').load("del_cdnr.php?refno="+refno+"&typ="+typ).fadeIn("slow");
}
}



 $('#sup').chosen({
  no_results_text: "Oops, nothing found!",
   });
    $('#dldgr').chosen({
  no_results_text: "Oops, nothing found!",
   });
 	$('#typ').chosen({no_results_text: "Oops, nothing found!",});
   </script>
<script>


	 </div>
</html>