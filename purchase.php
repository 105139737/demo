<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
			

<script type="text/javascript" src="atosg_2.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<link rel="stylesheet" href="atosg_2.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="popup_sedtunt.js"></script>

<style type="text/css"> 
th{
text-align:center;
color:#FFF;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
select.sc {
	width: 340px;
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
select.sc1 {
	width: 150px;
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

select.lig {
	width: 280px;
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
select.lig1 {
	width: 150px;
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
#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 

<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

   
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
  $('#overlay').fadeOut('fast');
   $("#expdt").datepicker(jQueryDatePicker2Opts);
      $("#expdt1").datepicker(jQueryDatePicker2Opts);
	  $("#expdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	   $("#ddt").datepicker(jQueryDatePicker2Opts);
	  $("#ddt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	  	   $("#idt").datepicker(jQueryDatePicker2Opts);
	  $("#idt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	  

 h();
   });
   
  </script>
   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>


<script>
function gtid()
{
    sid=document.getElementById('sup').value;

    if(sid=='Add')
	{
		
		$('#cnt1').load('adsup.php?typ=Debtors').fadeIn("fast");
		$('#compose-modal').modal('show');
	}
	else
	{
    $.get('suname.php?cid='+sid, function(data) {
        
                var str= data;
				var stra = str.split("@@")
				var fstr1 = stra.shift()
				var addr = stra.shift()  
                var mob = stra.shift() 
                var mail = stra.shift() 
    $('#addr').val(addr);
    $('#mob').val(mob);
    $('#mail').val(mail);
     
}); 

	}
}
function addspnm()
{
	var snm=encodeURIComponent(document.getElementById('snm').value);
	var pnm=encodeURIComponent(document.getElementById('cpnm').value);
	var addr=encodeURIComponent(document.getElementById('addr1').value);
	var email=encodeURIComponent(document.getElementById('email').value);
	var mob1=encodeURIComponent(document.getElementById('mob1').value);
	var mob2=encodeURIComponent(document.getElementById('mob2').value);

	
	$('#adpnm').load("adsups.php?snm="+snm+"&pnm="+pnm+"&addr="+addr+"&email="+email+"&mob2="+mob2+"&mob1="+mob1).fadeIn('fast');

}

</script>
<script type="text/javascript">





</script>
<link rel="stylesheet" type="text/css" href="style_sedt.css" />

<script type="text/javascript">

function h()
{
$("#asd").hide();
}




function pmod(a)
{
	if(a=="1")
	{ 
		document.getElementById('gtdl1').style.display='none';
		document.getElementById('crfno').value='';
		document.getElementById('idt').value='';
		document.getElementById('cbnm').value='';
    }
	else
	{
	  document.getElementById('gtdl1').style.display='table-row';
	  $("#xxx").load("getbank.php").fadeIn('fast');
	}

}








</script>

<script type="text/javascript" src="shortcut.js"></script>

<script type="text/javascript" src="ajax.js"></script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />

<script>
	

function t()
{

	$('#pay').load('total.php').fadeIn('fast');
	$('#subt').load('subt1.php').fadeIn('fast');
}
  
	function v()
	{
	var vat=document.getElementById('vat').value;
	var lcd=document.getElementById('lcd').value;
	var lfr=document.getElementById('lfr').value;
	var tamm1=parseFloat(document.getElementById('tamm1').value);
	var vatamm=(tamm1*vat)/100;
	document.getElementById('vatamm').value=vatamm;
	document.getElementById('tamm').value=tamm1+vatamm-lcd-lfr;
		
	}
	
	function cal()
{  
   var prc=document.getElementById('mrp').value;
  var qnty=document.getElementById('qnty').value;
	if(prc<0 || prc==''){prc=0;}
	if(qnty<0 || qnty==''){qnty=0;}
	var bsp=qnty*prc;
	var lttl=bsp;
    $('#lttl').val(lttl);
 
}
function cal_back()
{
var qnty=document.getElementById('qnty').value;
var lttl=document.getElementById('lttl').value;	
	if(lttl<0 || lttl==''){lttl=0;}
	if(qnty<0 || qnty==''){qnty=0;}
var  mrp=lttl/qnty; 
    $('#mrp').val(mrp);
}
function cal1()
{
	var  sttl=document.getElementById('sttl').value;
	var  sdis=document.getElementById('sdis').value;
	
	var vatamm=(sttl*sdis)/100;
	document.getElementById('tamm').value=sttl-vatamm;
	document.getElementById('tamm1').value=sttl-vatamm;
	v();
}

 function get_cat()  
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;
$("#scat_div").load("get_cat_pur.php?cat="+cat).fadeIn('fast');
$("#prod_div").load("get_product.php?cat="+cat+"&scat="+scat).fadeIn('fast');
 }
 function get_prod()
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;	 
$("#prod_div").load("get_product.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
$("#unit_div").load("get_unit.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
 }
  function get_box()
 {
unit=document.getElementById('unit').value;
if(unit=='2')
{
document.getElementById("pck").readOnly = false;
}
else
{
document.getElementById("pck").readOnly = true;	
}
}
function add()
{
		scat=document.getElementById('scat').value;
		prnm=document.getElementById('prnm').value;
		unit=document.getElementById('unit').value;
		pck=document.getElementById('pck').value;
		qnty=document.getElementById('qnty').value;
		 mrp=document.getElementById('mrp').value;
		 lttl=document.getElementById('lttl').value;
	  if(scat=='')
	  {
	alert("Sub-Category Can't be blank");
	  }
	  else if(unit=='')
	  {
		alert("Unit Can't be blank");  
		document.getElementById('unit').focus();
	  }
	   else if(unit=='')
	  {
		alert("Unit Can't be blank");  
	  }
	  else if(unit=='2' && pck<1 )
	  {
		
		alert("Pcs/Box Can't be blank");  
		document.getElementById('pck').focus();
		  
	  }
	  else if(qnty<1)
	  {
		alert("Quantity Can't be blank");   
		document.getElementById('qnty').focus();
	  }
	  else if(mrp=='')
	  {
		alert("Rate Can't be blank");   
		document.getElementById('mrp').focus();
	  }
	  else
	  {
	 $('#wb_Text13').load("adtmppr1.php?scat="+scat+"&prnm="+prnm+"&unit="+unit+"&pck="+pck+"&qnty="+qnty+"&lttl="+lttl+"&mrp="+mrp).fadeIn('fast');
	  }
	}
	function reset()
	{
		document.getElementById('cat').value='';
		$('#cat').trigger('chosen:updated');
		document.getElementById('scat').value='';
		$('#scat').trigger('chosen:updated');
		document.getElementById('prnm').value='';
		$('#prnm').trigger('chosen:updated');	
		document.getElementById('unit').value='';
		document.getElementById('pck').value='';
		document.getElementById('qnty').value='';
		document.getElementById('mrp').value='';	
		document.getElementById('lttl').value='';
	}
	function tmppr1()
	{
	$('#wb_Text13').load("tmppr1.php").fadeIn('fast');
	}
	function deltpr1(sl)
	{
	$('#wb_Text13').load("deltpr1.php?sl="+sl).fadeIn('fast');
	}

</script>




	</head>
<body onload="tmppr1()" >
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Purchase
                     
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Purchase</li>
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
                          
					<form method="post" name="form1" id="form1" action="purchases.php">
                              
							
								


        <div class="box box-success" >
  
  <table border="0" width="860px" class="table table-hover table-striped table-bordered">
  <tr>
  <td align="right" style="padding-top:15px;"><b>Company Name :</b>
  </td>
  <td colspan="3" > 
  
  <select id="sup" name="sup" tabindex="1"  class="form-control" onchange="gtid()" >
	<option value="">---Select---</option>
	<option value="Add">---Add New---</option>
	<?
		$query="select * from main_suppl  WHERE sl>0 order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			<option value="<?=$rw['sl'];?>"><?=$rw['spn'];?> <?if($rw['nm']!=""){?>( <?=$rw['nm'];?> )<?}?></option>
			<?
		}
	?>
	</select>
	
  </td>

  </tr>
  <tr>
   <td align="right" style="padding-top:15px;"><b>Address : </b></td>

<td >
 <input type="tex"  class="form-control" tabindex="2"  style="font-weight: bold;" id="addr" readonly="true" name="addr" value=""  placeholder="Customer Address">
 </td>
   <td align="right" style="padding-top:15px;"><b>Contact No. :</b></td>

<td>
<input type="text" id="mob" class="form-control" tabindex="3"  style="font-weight: bold;" readonly="true" name="mob" value="" size="35" placeholder="Customer Contact No.">
 </td>
  </tr>
  <tr>

   <td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

<td>
<input type="text" id="mail" class="form-control" tabindex="4"  style="font-weight: bold;" readonly="true" name="mail" value=""  size="35" placeholder="Customer E-Mail">
 </td>
  <td align="right" style="padding-top:15px">
<b>Branch : </b>
</td>
<td align="left" >

<select name="brncd" class="form-control" tabindex="5"  size="1" id="brncd" >
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

</tr>
  <tr>
    <td align="right" style="padding-top:15px;"> <b>Invoice No. : </b></td>
  <td>
  <input type="text" class="form-control" tabindex="6"  id="inv"  name="inv" value="" size="35" placeholder="Enter Invoice No...">
  </td>
    <td align="right" style="padding-top:15px;"> <b>Date : </b></td>
  <td>
  <input type="text" class="form-control"  id="dt" tabindex="7"  name="dt" value="<? echo date('d-m-Y');?>" size="35" placeholder="Enter Date">
  </td>
</tr>

</table>
</div>
    <div class="box box-success" >
	  <table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td  colspan="10">
 <table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="19%"><b>Category</b></td>
<td align="center" width="19%" ><b>Sub-Category</b></td>
<td align="center" width="19%" ><b>Product</b></td>
<td align="center" width="7%" ><b>Unit</b></td>
<td align="center" width="7%" ><b>Pcs/Box</b></td>
<td align="center" width="7%" ><b>Quantity</b></td>
<td align="center" width="7%" ><b>Rate</b></td>
<td align="center" width="8%" ><b>Amount</b></td>
<td align="center" width="7%"><b>Action</b></td>
</tr>
<tr>
<td > 
<select id="cat" name="cat" class="form-control" tabindex="8"  onchange="get_cat()">
<option value="">---Select---</option>
<?

$data1 = mysqli_query($conn,"Select * from main_catg order by cnm");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$cnm=$row1['cnm'];
?>
<option value="<?=$sl;?>"><?=$cnm;?></option>
	<?}?>
</select>
</td>
<td > 
<div id="scat_div">
<select id="scat" name="scat" class="form-control" tabindex="9"  onchange="get_prod()">
<option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_scat order by nm");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$nm=$row1['nm'];
?>
<Option value="<?=$sl;?>"><?=$nm;?></option>
	<?}?>
</select>
</div>
</td>
<td > 
<div id="prod_div">
<select id="prnm" name="prnm" tabindex="10"  class="form-control">
<option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_product order by pnm");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
?>
<Option value="<?=$sl;?>"><?=$pnm;?></option>
<?}?>
</select>
</div>
</td>
<td> 
<div id="unit_div">
<select id="unit" name="unit" class="sc" tabindex="11"  style="padding:3px;width:100%" onchange="get_box()">
<option value="">---Select---</option>
<option value="1">Kg</option>
<option value="2">Box</option>
<option value="3">Pcs</option>
</select>
</div>
</td>
<td>
<input type="text" class="sc" tabindex="12"  id="pck" autocomplete="off" name="pck" value="" readonly style="text-align:left" >
</td>
<td>
<input type="text" id="qnty" class="sc" tabindex="13"  autocomplete="off" style="text-align:center" name="qnty" value="" onblur="cal()"  >
</td>
<td>
<input type="text" class="sc" id="mrp" tabindex="14"  autocomplete="off" name="mrp" value="" style="text-align:right" onblur="cal()">
</td>

<td>
<input type="text" class="sc" id="lttl" name="lttl" value="" tabindex="16"   autocomplete="off"  style="text-align:right" size="15" onblur="cal_back()" >
</td>
<td>
<input type="button" class="btn btn-primary btn-xs" id="Button1" tabindex="17"  name="" value="Add"  onclick="add()" style="width:100%" >
</td>
</tr>
</table>
   </td>
	   </tr>
	       <tr height="230px">
	   <td colspan="10">
	<div id="wb_Text13" >

		</div>
	  	</td>
	   </tr>
	   	   
<tr>
<td align="left"  >
<b>
Less Cash Discount :</b>

<input type="text" name="lcd" id="lcd" tabindex="18"   class="form-control" style="text-align:right"  value="" onblur="v()">

</td>

<td align="left" >
<b>
Less Fright :</b>
<input type="text" name="lfr" id="lfr" tabindex="19"  class="form-control" style="text-align:right" onblur="v()" >

</td>


<td align="left"  >
<b>
<font size="3" color="blue">Sub Total :</font></b>
<div id="subt">
<input type="text" name="sttl" id="sttl" tabindex="20"  class="form-control" style="text-align:right;font-size:14pt"  value="" >
</div>
</td>

<td align="left"  >
<b>
<font size="3" color="blue">Discount@% :</font></b>
<input type="text" name="sdis" id="sdis" tabindex="21"  class="form-control" style="text-align:right;font-size:14pt"  value="0" onblur="cal1()">
</td>


<td align="left" >
<b><font size="3" color="blue">Pay Amount :</font></b>
<font size="3">
<b>
<div id="pay">
<input type="text" name="tamm" id="tamm" tabindex="22"  class="form-control" style="background-color:#f3f4f5;" > 
</div>
</b>
</font>
</td>


</tr>
<tr>

<td align="left"  >
<b>
VAT :</b>
<input type="text" name="vat" id="vat" tabindex="23"  class="form-control" style="text-align:right"  value="" onblur="v()">
</td>

<td align="left"  >
<b>
VAT Amount :</b>
<input type="text" name="vatamm" id="vatamm" tabindex="24"  class="form-control" style="text-align:right"  value="" >
</td>
	<td align="left" >
	<font color="red">*</font><b>Cash Or Bank Ac. :</b>
	 <select  name="dldgr" id="dldgr" tabindex="25"  class="form-control">
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>"<?=$row['sl'] == '3' ? 'selected' : '' ?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select>
	</td>

<td>
<b>Payment Mode: </b>
<select name="mdt" size="1" id="mdt" tabindex="26" onchange="pmod(this.value)" class="form-control">

<?
$data2 = mysqli_query($conn,"select * from ac_paymtd ");

		while ($row2 = mysqli_fetch_array($data2))
	{
	$mtd = $row2['mtd'];
	$msl = $row2['sl'];
	echo "<option value='".$msl."'>".$mtd."</option>";
	}
	?>
</select>
 </td>

 <td  >
 <b>Payment Amount:</b>
 <input type="text" class="form-control" id="pamm" tabindex="27"  name="pamm" value="" placeholder ="Enter Payment Amount" size="25">
 </td>

 

</tr>
<tr id="gtdl1" style="display:none">
<td>
<b>Reference No: </b>
<input type="text" class="form-control" id="crfno"  tabindex="28"  name="crfno" value="" >
</td>

<td>
 <b>Date: </b>
<input type="text" class="form-control" id="idt" name="idt" tabindex="29"  value="" readonly >
</td>

<td>
 <b>Issued By:</b>
<input type="text" class="form-control" id="cbnm" tabindex="30"  name="cbnm" value="" >
</td>

</tr>

 <tr class="odd" >
<td colspan="10" align="right">

<input type="submit" class="btn btn-success btn-sm" id="Button2" tabindex="31"  onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="15" value="Submit"  >
</td>
</tr>
</table>




 
<input type="hidden" id="prid"  name="prid" value="<? echo $cid;?>">
<input type="hidden" id="stk" >
<input type="hidden" id="fls" >
<div id="ps">
</div>
</form>







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

     

<div id="adpnm"></div>
	<!-- Light Box -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog"  style="width:700px;;">
		<div class="modal-content">
		
			<div class="modal-body" id="cnt1">
			
			
			</div>
        </div>
    </div>
</div>
<!-- End -->





    </body>
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
$('#scat').chosen({
no_results_text: "Oops, nothing found!",
});	 
 $('#sup').chosen({
  no_results_text: "Oops, nothing found!",

  });
  
</script>
</html>