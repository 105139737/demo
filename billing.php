<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left" >
            <?
            include "left_bar.php";
            ?>
<head>
<style type="text/css"> 
th{
text-align:center;
color:#000;
border:1px solid #37880a;
}


a{
cursor:pointer;
}

select.sc {
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
	padding: 4px;
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
	left: 6%;
	top: 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 

   <link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003;
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
		  	   $("#idt").datepicker(jQueryDatePicker2Opts);
	  $("#idt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	   $("#dob").datepicker(jQueryDatePicker2Opts);
	  $("#dob").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	   $("#doa").datepicker(jQueryDatePicker2Opts);
	  $("#doa").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});	  
 
 h();
   });
   
  </script>
      <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
   
<script type="text/javascript">
function getb()
{
prnm=document.getElementById('prnm').value;
brncd=document.getElementById('brncd').value;
$("#gbet").load("getbe.php?pcd="+prnm+"&brncd="+brncd).fadeIn('fast');
$("#p").load("getp.php?pcd="+prnm+"&brncd="+brncd).fadeIn('fast');
$("#po").load("getpoint.php?pcd="+prnm).fadeIn('fast');
}

</script>

<script type="text/javascript" src="jquery.ui.widget.min.js"></script>


<script type="text/javascript">
function gtid()
{
    sid=document.getElementById('custnm').value;
    if(sid=='Add')
	{
		
		$('#cnt1').load('adcstnm.php?typ=Debtors').fadeIn("fast");
		$('#compose-modal').modal('show');
	}
	else
	{
    $.get('cname.php?cid='+sid, function(data) {
        
                var str= data;
				var stra = str.split("@@") 
                var typ = stra.shift() 
				var fstr1 = stra.shift()
				var addr = stra.shift()  
                var mob = stra.shift() 
                var mail = stra.shift()
                var pp = stra.shift()
                var bal = stra.shift()
    $('#addr').val(addr);
    $('#mob').val(mob);
    $('#mail').val(mail);
    $('#pbal').val(bal);
    
     
}); 

setTimeout(function(){ v(); }, 500);
	}
}

function addspnm()
{
	var nm=encodeURIComponent(document.getElementById('nm').value);
	var addr1=encodeURIComponent(document.getElementById('addr1').value);
	var email=encodeURIComponent(document.getElementById('email').value);
	var mob1=encodeURIComponent(document.getElementById('mob1').value);
	$('#adpnm').load("sentrysadd.php?nm="+nm+"&addr="+addr1+"&email="+email+"&mob1="+mob1).fadeIn('fast');
}


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



	
	
  	function v()
	{
		var vatt=0;
		var tt=0;
		var tam=0;
		var pbal= parseFloat(document.getElementById('pbal').value);if(document.getElementById('pbal').value==""){pbal=0;}		
		var car= parseFloat(document.form1.car.value);if(document.form1.car.value==""){car=0;}
		var vat= parseFloat(document.form1.vat.value);if(document.form1.vat.value==""){vat=0;}
		var tam= parseFloat(document.form1.tamm1.value);if(document.form1.tamm1.value==""){tam=0;}
		var dis= parseFloat(document.form1.dis.value);if(document.form1.dis.value==""){dis=0;}
		
		vatt=(tam*vat)/100;
		document.getElementById('vatamm').value=vatt;
		tt=((tam+vatt)-dis)+car;
		document.getElementById('tamm').value=tt;
		document.getElementById('pay').value=Math.round(tt+pbal);
		
		
	}
function cal()
{
var prc=document.getElementById('prc').value;	
if(prc==''){prc=0;}
var kg=document.getElementById('kg').value;	
if(kg==''){kg=0;}
var grm=document.getElementById('grm').value;
if(grm==''){grm=0;}	
var pcs=document.getElementById('pcs').value;	
if(pcs==''){pcs=0;}	
var scat_unit=document.getElementById('scat_unit').value;	
if(scat_unit=='1')
{
var qty=kg+'.'+grm;
document.getElementById('lttl').value=(qty*prc).toFixed(2);
}
else if(scat_unit=='2' || scat_unit=='3')
{
document.getElementById('lttl').value=(pcs*prc).toFixed(2);	
}
	

}

 function get_cat()  
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;
$("#scat_div").load("get_cat_pur.php?cat="+cat).fadeIn('fast');
$("#prod_div").load("get_product_bill.php?cat="+cat+"&scat="+scat).fadeIn('fast');
 }
 function get_prod()
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;	 
$("#prod_div").load("get_product_bill.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
get_stock();
 }
function get_stock()
{
prnm=document.getElementById('prnm').value;
scat=document.getElementById('scat').value;
brncd=document.getElementById('brncd').value;
$("#gbet").load("getbe.php?pcd="+prnm+"&brncd="+brncd+"&scat="+scat).fadeIn('fast');
$("#p").load("getp.php?pcd="+prnm).fadeIn('fast');
}
function get_unit()
{
scat_unit=document.getElementById('scat_unit').value;
if(scat_unit=='1')	
{
document.getElementById("grm").readOnly = false;
document.getElementById("kg").readOnly = false;
document.getElementById("pcs").readOnly = true;
document.getElementById('pcs').value='';
}
else if(scat_unit=='2' || scat_unit=='3')
{
document.getElementById("grm").readOnly = true;
document.getElementById("kg").readOnly = true;	
document.getElementById('kg').value='';
document.getElementById('grm').value='';
document.getElementById("pcs").readOnly = false;	
}
}

	function add1()
	{
		var scat=document.getElementById('scat').value;
		var prnm=document.getElementById('prnm').value;
		var kg=document.getElementById('kg').value;
		var grm=document.getElementById('grm').value;
		var pcs=document.getElementById('pcs').value;
		var prc=document.getElementById('prc').value;
		var lttl=document.getElementById('lttl').value;
		var brncd=document.getElementById('brncd').value;
		if(scat=='')
		{
		alert("Sub-Category Can't be blank");
		}
		else if(prnm=='')
		{
		alert("Product Can't be blank");
		}
		else if(lttl=='')
		{
		alert("Amount Can't be blank");	
		}
		else
		{
		
	$('#wb_Text13').load('adtmppr.php?scat='+scat+'&prnm='+prnm+'&kg='+kg+'&grm='+grm+'&pcs='+pcs+'&prc='+prc+'&lttl='+lttl+'&brncd='+brncd).fadeIn('fast');
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
		document.getElementById('kg').value='';
		document.getElementById('grm').value='';
		document.getElementById('pcs').value='';
		document.getElementById('prc').value='';
		document.getElementById('lttl').value='';
		document.getElementById('sih').value='';
	}
function temp()
	{
$('#wb_Text13').load("tmppr.php").fadeIn('fast');
}
function deltpr(un,sl)
{
$('#wb_Text13').load("deltpr.php?sl="+sl+"&tsl="+un).fadeIn('fast');
}
function t()
	{

	$('#billamm').load('stotal.php').fadeIn('fast');

	}
	function isNumber(evt) 
 {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if(iKeyCode < 48 || iKeyCode > 57)
		{
            return false;
        }
        return true;
 }
</script>
</head>
<body onload="temp()" >
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
              

                <!-- Main content -->
                <section class="content">
                   

                   

                    <!-- Main row -->
                    
                        <!-- Left col -->
                       
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        
                           

                            <!-- Chat box -->
					
                     <!-- /.box (chat box) -->

                            <!-- TO DO List -->
                          
<form method="post" target="" name="form1" id="form1"  action="billings.php">
                              
							
								


<div class="box box-success" >
<b>Invoice Details : </b>
  <center>
 <table border="0" width="860px" class="table table-hover table-striped table-bordered">
  <tr>
  <td align="right" style="padding-top:15px;" width="15%"><b>Customer Name :</b>
  </td>
  <td colspan="" width="35%"> 

  
  
  <select id="custnm" name="custnm" tabindex="1"  class="form-control"  onchange="gtid()" >
	<option value="">---Select---</option>
	<option value="Add">---Add New Customer---</option>
	<?
		$query="select * from main_cust  WHERE sl>0 order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			<option value="<?=$rw['sl'];?>"><?=$rw['nm'];?> <?if($rw['cont']!=""){?>( <?=$rw['cont'];?> )<?}?> <?=$rw['typ'];?></option>
			<?
		}
	?>
	</select>

  </td>
     <td align="right" style="padding-top:15px;" width="13%"><b>Contact No. :</b></td>

<td width="37%" >
<input type="text" id="mob" class="form-control" style="font-weight: bold;" readonly="true" name="mob" value=""  tabindex="2" size="35" placeholder="Customer Contact No.">

</td>
  </tr>
  <tr>
     <td align="right" style="padding-top:15px;"><b>Address : </b></td>

<td>
 <input type="tex"  class="form-control" style="font-weight: bold;" id="addr" readonly="true" name="addr" value="" tabindex="3" placeholder="Customer Address">
 
 </td>
   <td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

<td colspan="">
<input type="text" id="mail" class="form-control" style="font-weight: bold;" readonly="true" name="mail" value="" tabindex="4" size="35" placeholder="Customer E-Mail">
 
</td>

  </tr>

  <tr>
  <td align="right" style="padding-top:15px">
<b>Branch : </b>
</td>
<td align="left" >

<select name="brncd" class="form-control" tabindex="5" size="1" id="brncd" onchange="getb()"  >
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
    <td align="right" style="padding-top:15px;"> <b>Date : </b></td>
  <td>
  <input type="text" class="form-control"  id="dt"  name="dt" value="<? echo date('d-m-Y');?>" tabindex="6" size="35" placeholder="Enter Date">
  </td>
</tr>

</table>
</div>
<input type="hidden" id="usl" name="usl" value="" >

 <div class="box box-success" >
 <b>Product Details :</b>
	  <table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td  colspan="7">
 <table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="16%"><b>Category</b></td>
<td  align="left" width="16%"><b>Sub-Category</b></td>
<td  align="left" width="16%"><b>Product</b></td>
<td align="center" width="10%"><b>Stock In Hand</b></td>
<td align="center" width="6%" ><b>Kg</b></td>
<td align="center" width="6%" ><b>Gram</b></td>
<td align="center" width="6%" ><b>Pcs</b></td>
<td align="center" width="8%" ><b>Sale Rate</b></td>
<td align="center" width="10%"><b>Amount</b></td>
<td align="center" width="6%"><b>Action</b></td>
</tr>
<tr>
<td > 
<select id="cat" name="cat" class="form-control"  tabindex="7" onchange="get_cat()">
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

<td> 
<div id="scat_div">
<select id="scat" name="scat" class="form-control"  tabindex="8" onchange="get_prod()">
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
<td>
<div id="prod_div">
<select id="prnm" name="prnm" class="form-control"  tabindex="9" onchange="get_stock()">
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
<div id="gbet">
<input type="text" class="sc" autocomplete="off" id="sih" readonly name="sih" style="text-align:center"  value="" tabindex="10" size="15"  >
</div>
</td>
<td>
<input type="text" class="sc" autocomplete="off" id="kg" name="kg" readonly style="text-align:center" onchange="cal()"  value="" tabindex="11" size="15"  >
</td>
<td>
<input type="text" id="grm" class="sc" autocomplete="off"  name="grm" readonly value="" style="text-align:center" onchange="cal()" tabindex="12" size="15" >
</td>
<td>
<input type="text" id="pcs" class="sc" autocomplete="off"  name="pcs" readonly value=""  style="text-align:center" onchange="cal()" tabindex="13"  >
</td>
<td> 
<div id="p">
<input type="text" class="sc" id="prc"  name="prc" value=""  style="text-align:right" onchange="cal()" tabindex="14">
</div>
</td>
<td> 
<input type="text" class="sc" id="lttl"  name="lttl" value="" readonly="true"  style="text-align:right" tabindex="15">
</td>
<td>
<input type="button" class="btn btn-primary" id="Button1" name="" value="Add"  onclick="add1()" tabindex="16" style="width:100%;padding:2px" >
</td>
</tr>
</table>
   </td>
	   </tr>
	       <tr height="180px">
	   <td colspan="7">
	<div id="wb_Text13" >

		</div>
	  	</td>
	   </tr>


<tr >


<td align="left" ><b>Discount :</b><br>
<input type="text" name="dis" id="dis"  readOnly onblur="v()" value=""  tabindex="17" class="form-control"  style="text-align:right">
</td>

<td align="left" ><b>Freight :</b><br>
<input type="text" name="car" id="car"  readOnly onblur="v()" value=""  tabindex="18" class="form-control"  style="text-align:right">
</td>


<td align="left" ><b>Vat.(%) :</b><br>
<font >
<b>
<input type="text" name="vat" id="vat" onblur="v()" class="form-control"  tabindex="19" style="text-align:right" >
</b>
</font>
</td>

<td align="left" ><b>Vat Amount :</b><br>
<font >
<b>
<input type="text" name="vatamm" id="vatamm" class="form-control"  tabindex="20" style="background-color:#f3f4f5;text-align:right" readonly="true" >

</b>
</font>
</td>

<td align="left" ><b>Bill Amount :</b><br>
<font >
<b>
<div id="billamm">
<input type="text" name="tamm" id="tamm" class="form-control"  tabindex="21" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 
</div>
</b>
</font>
</td>
<td align="left" ><b>Previou Balance :</b><br>
<font >
<b>

<input type="text" name="pbal" id="pbal" class="form-control"  tabindex="22" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 

</b>
</font>
</td>
<td align="left" ><b>Pay Amount :</b><br>
<font >
<b>

<input type="text" name="pay" id="pay" class="form-control"  tabindex="23" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 

</b>
</font>
</td>
</tr>

	   </table>
</div>
 <div class="box box-success" >

<b>Payment Details :</b>
  <table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>

    <td align="left" >
	<font color="red">*</font><b>Cash Or Bank Ac. :</b>
	 <select  name="dldgr" id="dldgr"   class="form-control"  tabindex="24">
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
<select name="mdt" size="1" id="mdt" tabindex="25" onchange="pmod(this.value)" class="form-control">

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

 <td>
 <b>Payment Amount:</b> 
 <input type="text" class="form-control" id="pamm" name="pamm" value=""  tabindex="26" placeholder ="Enter Payment Amount" style="text-align:right" size="25">
 </td>

 

</tr>
<tr id="gtdl1" style="display:none">
<td>
<b>Reference No: </b>
<input type="text" class="form-control" id="crfno"  name="crfno"  tabindex="27" value="" >
</td>
<td>
<b>Date: </b>
<input type="text" class="form-control" id="idt" name="idt" value=""  tabindex="28" readonly >
</td>

<td>
<b>Issued By:</b>
<input type="text" class="form-control" id="cbnm"  name="cbnm" value=""  tabindex="29" >
</td>

</tr>

 <tr class="odd" >
<td colspan="6" align="right">

<input type="submit" class="btn btn-success btn-sm" id="Button2" onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="30" value="Submit"  >
</td>
</tr>
</table>

<input type="hidden" id="prid"  name="prid" value="<? echo $cid;?>">
<input type="hidden" id="stk" >
<input type="hidden" id="fls" >
</form>






</div>
                                <div class="box-footer clearfix no-border">
                                
                                </div>
<div id="adpnm"></div>
	<!-- Light Box -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="cnt1">
			</div>
        </div>
    </div>
</div>
<!-- End -->		
								
								
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
$('#scat').chosen({
no_results_text: "Oops, nothing found!",
});	

     $('#custnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>

    </body>

</html>