<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$cr_tm=date('H:i');
$ndl_tm=strtotime("+30 minute", strtotime($cr_tm));
$dl_tm=date('H:i', $ndl_tm);
$blno=rawurldecode($_REQUEST['blno']);




$blno1="";
 $query100 = "SELECT * FROM main_order where blno='$blno' ";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
	
$blno1=$R100['blno'];
$cid=$R100['cid'];
$paid=$R100['paid'];
$dt=$R100['dt'];
$bcd=$R100['bcd'];

}



$query7="Select * from main_slt where  eby='$user_currently_loged'";
$result7 = mysqli_query($conn,$query7);
$rowcount=mysqli_num_rows($result7);
if($rowcount==0)
{

 $query100 = "SELECT * FROM main_orderdtl where blno='$blno'";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
	
$tsl=$R100['sl'];
$prsl=$R100['prsl'];
$prnm=$R100['prnm'];
$qnt=$R100['qty'];
$blno=$R100['blno'];
$rmk=$R100['rmk'];


$query21 = "INSERT INTO main_slt (prsl,prnm,qty,eby,rmk) VALUES ('$prsl','$prnm','$qnt','$user_currently_loged','$rmk')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}?>

<script>
temp();
</script>
<?php 
}
?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<head>
<style type="text/css"> 
th{
text-align:center;
color:#000;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
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
				var stra = str.split("@")
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
	var nm=encodeURIComponent(document.getElementById('nm').value);
	var addr1=encodeURIComponent(document.getElementById('addr1').value);
	var email=encodeURIComponent(document.getElementById('email').value);
	var mob1=encodeURIComponent(document.getElementById('mob1').value);
	var dob=encodeURIComponent(document.getElementById('dob').value);
	var doa=encodeURIComponent(document.getElementById('doa').value);
	
	$('#adpnm').load("sentrysadd.php?nm="+nm+"&addr="+addr1+"&email="+email+"&mob1="+mob1+"&dob="+dob+"&doa="+doa).fadeIn('fast');
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

	function add()
	{
		
		prnm=document.getElementById('prnm').value;
		qty=document.getElementById('qnty').value;
		prc=document.getElementById('prc').value;
		pslno=document.getElementById('pslno').value;
		lttl=document.getElementById('lttl').value;
		brncd=document.getElementById('brncd').value;
		document.getElementById('qnty').value='';
		document.getElementById('prc').value='';
		document.getElementById('lttl').value='';
		document.getElementById('sih').value='';
		document.getElementById('pslno').value='';
	
		
		$('#wb_Text13').load("adtmppr.php?prnm="+prnm+"&qty="+qty+"&prc="+prc+"&pslno="+pslno+"&brncd="+brncd).fadeIn('fast');
	
	

	}
			function temp()
	{
		
		$('#wb_Text13').load("ord_tmppr.php").fadeIn('fast');
			
	}
		function deltpr(un,sl)
	{
	
	$('#wb_Text13').load("deltpr.php?sl="+sl+"&tsl="+un).fadeIn('fast');
	
	}
	
	function t()
{

	$('#pay').load('stotal.php').fadeIn('fast');

}
  	function v()
	{
		var vatt=0;
		var tt=0;
		var tam=0;
		var car= parseFloat(document.form1.car.value);if(document.form1.car.value==""){car=0;}
		var vat= parseFloat(document.form1.vat.value);if(document.form1.vat.value==""){vat=0;}
		var tam= parseFloat(document.form1.tamm1.value);if(document.form1.tamm1.value==""){tam=0;}
		var dis= parseFloat(document.form1.dis.value);if(document.form1.dis.value==""){dis=0;}
		
		vatt=(tam*vat)/100;
		document.getElementById('vatamm').value=vatt;
		tt=tam+vatt-dis;
		document.getElementById('tamm').value=tt+car;
		
		
	}
	function chk_dt(cdt)
{
 ddt=document.getElementById('ddt').value;
    
    $.get('set_date_limit_chk.php?dt='+ddt, function(data) {
		if(data=='0')
		{
			
		document.getElementById('ddt').value=cdt;	
		alert('You Have No Permission For Entry Date.');
		}
  
}); 
}

function cal()
{
var  qnty=document.getElementById('qnty').value;	
var  prc=document.getElementById('prc').value;	
document.getElementById('lttl').value=qnty*prc;
}

</script>
</head>
<body onload="temp()" >
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Sale 
                    <small> Invoice</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Sale Invoice</li>
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
                          
<form method="post" target="" name="form1" id="form1"  action="ord_billings.php">
                              
							
								


        <div class="box box-success" >
		<b>Invoice Details : </b>
  <center>
 <table border="0" width="860px" class="table table-hover table-striped table-bordered">
  <tr>
  <td align="right" style="padding-top:15px;"><b>Customer Name :</b>
  </td>
  <td colspan="3" > 
  <input type="text" name="blno" id="blno" readonly value="<?php  echo $blno1;?>">
  <select id="custnm" name="custnm" tabindex="1"  class="form-control" onchange="gtid()" >
	<option value="">---Select---</option>
	<option value="Add">---Add New Customer---</option>
	<?php 
		$query="select * from main_cust  WHERE sl>0 order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			
			<option value="<?php  echo $rw['sl'];?>"  <?php  echo $rw['sl'] == $cid ? 'selected' : '' ?>   ><?php  echo $rw['nm'];?> <?php if($rw['cont']!=""){?>( <?php  echo $rw['cont'];?> )<?php }?></option>
			<?php 
		}
	?>
	</select>
	
  </td>

  </tr>
  <tr>
   <td align="right" style="padding-top:15px;"><b>Address : </b></td>

<td colspan="3">
 <input type="tex"  class="form-control" style="font-weight: bold;" id="addr" readonly="true" name="addr" value="" tabindex="4" placeholder="Customer Address">
 </td>

  </tr>
  <tr>
   <td align="right" style="padding-top:15px;"><b>Contact No. :</b></td>

<td>
<input type="text" id="mob" class="form-control" style="font-weight: bold;" readonly="true" name="mob" value="" tabindex="4" size="35" placeholder="Customer Contact No.">
 </td>
   <td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

<td>
<input type="text" id="mail" class="form-control" style="font-weight: bold;" readonly="true" name="mail" value="" tabindex="4" size="35" placeholder="Customer E-Mail">
 </td>


</tr>
  <tr>
  <td align="right" style="padding-top:15px">
<b>Godown : </b>
</td>
<td align="left" >

<select name="brncd" class="form-control" tabindex="2" size="1" id="brncd" onchange="getb()"  >
<?php 
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
    <td align="right" style="padding-top:15px;"> <b>Date : </b></td>
  <td>
  <input type="text" class="form-control"  id="dt"  name="dt" value="<?php  echo date('d-m-Y');?>" tabindex="3" size="35" placeholder="Enter Date">
  </td>
</tr>

</table>
</div>
<input type="hidden" id="usl" name="usl" value="" >

 <div class="box box-success" >
 <b>Product Details :</b>
	  <table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td  colspan="10">
 <table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="30%"><b>Particulars</b></td>
<td align="center" width="10%"><b>Stock In Hand</b></td>
<td align="center" width="15%" ><b>Serial No.</b></td>
<td align="center" width="10%" ><b>Quantity</b></td>
<td align="center" width="10%" ><b>Sale Rate</b></td>
<td align="center" width="15%"><b>Line Total</b></td>
<td align="center" width="10%"><b>Action</b></td>
</tr>

<tr>
<td > 

<select id="prnm" name="prnm" class="sc"  tabindex="4"   onchange="getb()" >
		<option value="">---Select---</option>
		<?php 
			$query6="select * from  ".$DBprefix."product order by pnm";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
					$pnm=$row['pnm'];
					$cat=$row['cat'];
					$bnm=$row['bnm'];
					$mnm=$row['mnm'];
$cnm="";				
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}
				?>
			<option value="<?php  echo $row['sl'];?>"><?php  echo $pnm;?> - <?php  echo $cnm;?> - <?php  echo $brand;?> - <?php  echo $mnm;?></option>
				<?php 
				}
				?>
			</select>
			
			


</td>

<td> 
<div id="gbet">
<input type="text" class="sc" id="sin" readonly name="sin" value=""  size="12">
</div>
</td>

<td>
<input type="text" id="pslno" class="sc"   name="pslno" value=""  tabindex="5" size="15" >
 </td>

<td>
<input type="text" id="qnty" class="sc" autocomplete="off"  name="qnty" value="" style="text-align:center" onblur="cal()" tabindex="5" size="15" >
 </td>

<td>
<div id="p">
<input type="text" class="sc" autocomplete="off" id="prc" name="prc" onblur="cal()" value="" tabindex="6" size="15"  >
</div>
</td>



<td> 
<input type="text" class="sc" id="lttl"  name="lttl" value="" readonly="true"  style="text-align:right" size="15">
</td>
<td>
<input type="button" class="btn btn-primary" id="Button1" name="" value="Add"  onclick="add()" tabindex="7" style="width:100%;padding:3px" >
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


  <tr >

<td align="right" width="10%" style="padding-top:15px">
<b>Add Discount :</b>
</td>
<td align="left" width="10%">

<input type="text" name="dis" id="dis"   onblur="v()" value="" class="form-control"  style="text-align:right">

</td>


<td align="right"  width="10%" style="padding-top:15px">
<b>Add Freight :</b>
</td>
<td align="left" width="10%">
<input type="text" name="car" id="car"   onblur="v()" value="" class="form-control"  style="text-align:right">
</td>

<td align="right" width="10%" style="padding-top:15px">
<b>Vat.(%) :</b>
</td>
<td align="left" width="10%">
<input type="text" name="vat" id="vat" onblur="v()" class="form-control"  style="text-align:right" >

</td>
<td align="right" width="10%" style="padding-top:15px">
<b>Vat Amount :</b>
</td>
<td align="left" width="10%">
<input type="text" name="vatamm" id="vatamm" class="form-control" style="background-color:#f3f4f5;text-align:right" readonly="true" >

</td>
<td  align="right" width="10%" style="padding-top:15px" >
<b>Pay Amount :</b>
</td>
<td align="left"width="10%" >
<font >
<b>
<div id="pay">
<input type="text" name="tamm" id="tamm" class="form-control" style="background-color:#f3f4f5;" readonly="true"> 
</div>
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

	
    <td align="right" style="padding-top:15px"><font color="red">*</font><b>Cash Or Bank Ac. :</b></td>
    <td align="left" >
	 <select  name="dldgr" id="dldgr"   class="form-control">
							<?php  
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?php  echo $row['sl']?>"<?php  echo $row['sl'] == '3' ? 'selected' : '' ?>><?php  echo $row['nm']?></option>
							<?php  
							} 
							?>
						</select>
	</td>
<td align="right" style="padding-top:15px;"> <b>Payment Mode: </b></td>
<td><select name="mdt" size="1" id="mdt" tabindex="10" onchange="pmod(this.value)" class="form-control">

<?php 
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
<td align="right" style="padding-top:15px;"><b>Payment Amount:</b> </td>
 <td><input type="text" class="form-control" id="pamm" name="pamm" value="" placeholder ="Enter Payment Amount" size="25"></td>

 

</tr>
<tr id="gtdl1" style="display:none">
<td align="right" style="padding-top:15px;"> <b>Reference No: </b></td>
<td>
<input type="text" class="form-control" id="crfno"  name="crfno" value="" >
</td>
<td align="right" style="padding-top:15px;"> <b>Date: </b></td>
<td>
<input type="text" class="form-control" id="idt" name="idt" value="" readonly >
</td>
<td align="right" style="padding-top:15px;"> <b>Issued By:</b></td>
<td>
<input type="text" class="form-control" id="cbnm"  name="cbnm" value="" >
</td>

</tr>

 <tr class="odd" >
<td colspan="6" align="right">

<input type="submit" class="btn btn-success btn-sm" id="Button2" onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="15" value="Submit"  >
</td>
</tr>
</table>

<input type="hidden" id="prid"  name="prid" value="<?php  echo $cid;?>">
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
     $('#custnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>

    </body>
</html>