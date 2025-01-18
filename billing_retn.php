<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$cr_tm=date('H:i');
$ndl_tm=strtotime("+30 minute", strtotime($cr_tm));
$dl_tm=date('H:i', $ndl_tm);

$blno=rawurldecode($_REQUEST['blno'] ?? "");
?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left" >
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
    $('#addr').val(addr);
    $('#mob').val(mob);
    $('#mail').val(mail);
    $('#typ').val(typ);
     
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
	var typ=encodeURIComponent(document.getElementById('typ').value);
	
	$('#adpnm').load("sentrysadd.php?nm="+nm+"&addr="+addr1+"&email="+email+"&mob1="+mob1+"&dob="+dob+"&doa="+doa+"&typ="+typ).fadeIn('fast');
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

	function add1()
	{
		var prnm=document.getElementById('prnm').value;
		var qty=document.getElementById('qnty').value;
		var prc=document.getElementById('prc').value;
		var pdis=document.getElementById('pdis').value;
		var fprc=document.getElementById('fprc').value;
		var point=document.getElementById('point').value;
		var lttl=document.getElementById('lttl').value;
		var fprnm=document.getElementById('fprnm').value;
		var brncd=document.getElementById('brncd').value;
		var fqnty=document.getElementById('fqnty').value;		
		document.getElementById('qnty').value='';
		document.getElementById('prc').value='';
		document.getElementById('fprc').value='';
		document.getElementById('point').value='';
		document.getElementById('lttl').value='';
		document.getElementById('sih').value='';
		$("#fprnm").val('');
		$("#pdis").val('0');
		document.getElementById('fqnty').value='0';
		
		//$('#wb_Text13').load('adtmppr.php?prnm='+prnm+'&qty='+qty+'&prc='+prc+'&pdis='+pdis+'&fprc='+fprc+'&point='+point+'&lttl='+lttl+'&fprnm='+fprnm+'&brncd='+brncd+'&fqnty='+fqnty).fadeIn('fast');
		

	}
			function temp()
	{
		var blno=encodeURIComponent(document.getElementById('blno').value);
		$('#wb_Text13').load("tmppr_retn.php?blno="+blno).fadeIn('fast');
			
	}
		function deltpr(un,sl)
	{
	
	//$('#wb_Text13').load("deltpr.php?sl="+sl+"&tsl="+un).fadeIn('fast');
	
	}
	
	function t()
{
	var blno=encodeURIComponent(document.getElementById('blno').value);
	$('#pay').load("stotal_retn.php?blno="+blno).fadeIn('fast');
	$('#poi').load("stotal_poi_retn.php?blno="+blno).fadeIn('fast');

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
	
var qnty=document.getElementById('qnty').value;	
var prc=document.getElementById('prc').value;	
var pdis=document.getElementById('pdis').value;	
var point=document.getElementById('point').value;	
var fprc1=(prc*pdis)/100;
var fprc=prc-fprc1;
document.getElementById('fprc').value=fprc;
document.getElementById('lttl').value=qnty*fprc;
document.getElementById('plttl').value=qnty*point;
}

</script>
</head>
<body onload="temp()" >
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Sale Return
                    <small> Invoice</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Sale Return Invoice </li>
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
							
	<?php 
	$data1= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

//$blno=$row1['blno'];
$edt=$row1['edt'];
$edt1=$row1['edt'];
$vat=$row1['vat'];
$car=$row1['car'];
$sid=$row1['cid'];
$fid=$row1['fid'];
$dt1=$row1['dt'];
$bcd=$row1['bcd'];
$dis=$row1['dis'];
$amm=$row1['amm'];
$tpoint=$row1['tpoint'];
$paid=$row1['paid'];
$due=$row1['due'];
$crdtp=$row1['crdtp'];
$cbnm=$row1['cbnm'];
$pdts=$row1['pdts'];
$vatamm=$row1['vatamm'];




$dt=date('d-m-Y', strtotime($dt1));
$edt=date('d-m-Y', strtotime($edt));
}
$datad= mysqli_query($conn,"select * from  main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$spn=$rowd['nm'];
$addr=$rowd['addr'];
$mob1=$rowd['cont'];
$typ=$rowd['typ'];
$mail=$rowd['mail'];

}
?>						
							
                          
<form method="post" target="" name="form1" id="form1"  action="billing_retns.php">
                              
<input type="hidden" id="blno" class="form-control" readonly name="blno" value="<?php  echo $blno;?>">
						
								


        <div class="box box-success" >
		<b>Invoice Details : </b>
  <center>
 <table border="0" width="860px" class="table table-hover table-striped table-bordered">
  <tr>
  <td align="right" style="padding-top:15px;" width="15%"><b>Customer Name :</b>
  </td>
  <td colspan="3" > 
  
  <select id="custnm" name="custnm" tabindex="1"  class="form-control" onchange="gtid()" >

	<?php 
		$query="select * from main_cust  WHERE sl='$sid' order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			<option value="<?php  echo $rw['sl'];?>"<?php  echo $rw['sl'] == $sid ? 'selected' : '' ?>><?php  echo $rw['nm'];?> <?php if($rw['cont']!=""){?>( <?php  echo $rw['cont'];?> )<?php }?> <?php  echo $rw['typ'];?></option>
			<?php 
		}
	?>
	</select>
	
  </td>

  </tr>
  <tr>
     <td align="right" style="padding-top:15px;" width="15%"><b>Customer Type :</b></td>

<td width="35%">
<input type="text" id="typ" class="form-control" style="font-weight: bold;"  readonly="true" name="typ" value="<?php  echo $typ;?>"  tabindex="4"  placeholder="Customer Type">
 </td>
   <td align="right" style="padding-top:15px;" width="10%"><b>Address : </b></td>

<td colspan="" width="40%">
 <input type="tex"  class="form-control" style="font-weight: bold;" value="<?php  echo $addr;?>" id="addr" readonly="true" name="addr"  tabindex="4" placeholder="Customer Address">
 </td>

  </tr>
  <tr>
   <td align="right" style="padding-top:15px;"><b>Contact No. :</b></td>

<td>
<input type="text" id="mob" class="form-control" style="font-weight: bold;" readonly="true" name="mob" value="<?php  echo $mob1;?>"  tabindex="4"  placeholder="Customer Contact No.">
 </td>
   <td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

<td>
<input type="text" id="mail" class="form-control" style="font-weight: bold;" readonly="true" name="mail" value="<?php  echo $mail;?>" tabindex="4"  placeholder="Customer E-Mail">
 </td>


</tr>
  <tr>
  <td align="right" style="padding-top:15px">
<b>Branch : </b>
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
<option value="<?php  echo $sl;?>" <?php  echo $sl == $bcd ? 'selected' : '' ?>><?php  echo $bnm;?></option>
<?php 
}
?>
</select>

</td>
    <td align="right" style="padding-top:15px;"> <b>Date : </b></td>
  <td>
  <input type="text" class="form-control"  id="dt"  name="dt" value="<?php  echo $dt;?>" tabindex="3" size="35" readonly placeholder="Enter Date">
  </td>
</tr>

</table>
</div>
<input type="hidden" id="usl" name="usl" value="" >

 <div class="box box-success" >
 <b>Product Details :</b>
	  <table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td  colspan="12">
 <table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="20%"><b>Particulars</b></td>
<td align="center" width="9%"><b>Stock In Hand</b></td>
<td align="center" width="6%" ><b>Quantity</b></td>
<td align="center" width="8%" ><b>Sale Rate</b></td>
<td align="center" width="8%" ><b>Discount@%</b></td>
<td align="center" width="8%" ><b>Rate</b></td>
<td align="center" width="6%" ><b>Point</b></td>
<td align="center" width="8%" ><b>Point Total</b></td>
<td align="center" width="8%"><b>Line Total</b></td>
<td align="center" width="8%"><b>Free Product</b></td>
<td align="center" width="6%"><b>Quantity</b></td>
<td align="center" width="6%"><b>Action</b></td>
</tr>
</table>
   </td>
	   </tr>
	       <tr height="230px">
	   <td colspan="12">
	<div id="wb_Text13" >

		</div>
	  	</td>
	   </tr>



<tr >
<td align="left" ><b>Discount :</b><br>
<input type="text" name="dis" id="dis"   onblur="v()" value="<?php  echo $dis;?>" class="form-control" readonly style="text-align:right">
</td>
<td align="left" ><b>Freight :</b><br>
<input type="text" name="car" id="car"   onblur="v()" value="<?php  echo $car;?>" class="form-control" readonly  style="text-align:right">
</td>
<td align="left" ><b>Vat.(%) :</b><br>
<input type="text" name="vat" id="vat" onblur="v()" value="<?php  echo $vat;?>" class="form-control" readonly style="text-align:right" >
</td>
<td align="left" ><b>Vat Amount :</b><br>
<input type="text" name="vatamm" id="vatamm" value="<?php  echo $vatamm;?>" class="form-control" style="background-color:#f3f4f5;text-align:right" readonly="true" >
</td>
<td align="left" ><b>Pay Amount :</b><br>
<font ><b>
<div id="pay">
<input type="text" name="tamm" id="tamm" value="<?php  echo $amm;?>" class="form-control" style="background-color:#f3f4f5;" readonly="true"> 
</div>
</b></font>
</td>
<td align="left" ><b>Point :</b><br>
<font ><b>
<div id="poi">
<input type="text" name="tpoint" id="tpoint" value="<?php  echo $tpoint;?>" class="form-control" style="background-color:#f3f4f5;" readonly="true"> 
</div>
</b></font>
</td>

</tr>

</table>
</div>
<div class="box box-success" >
  <table border="0" width="860px" class="table table-hover table-striped table-bordered">
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