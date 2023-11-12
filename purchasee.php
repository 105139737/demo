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
	var snm=encodeURIComponent(document.getElementById('snm').value);
	var pnm=encodeURIComponent(document.getElementById('pnm').value);
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
    $("#asd").hide();

  }  
  else
  {
	$("#xxx").load("getbank.php").fadeIn('fast');
   $("#asd").show(); 
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
}
  
  function add()
	{
		
		
	    prnm=document.getElementById('prnm').value;
		prc=document.getElementById('prc').value;
		qnty=document.getElementById('qnty').value;
		bsp=document.getElementById('bsp').value;
		vatamm=document.getElementById('vatamm').value;
		lttl=document.getElementById('lttl').value;
	    mrp=document.getElementById('mrp').value;
	    vat=document.getElementById('vat').value;
		document.getElementById('qnty').value='';
		document.getElementById('prc').value='';
		document.getElementById('bsp').value='';
		document.getElementById('vatamm').value='';
		document.getElementById('lttl').value='';
		document.getElementById('mrp').value='';
		
				
	 $('#wb_Text13').load("adtmppr1.php?prnm="+prnm+"&prc="+prc+"&qnty="+qnty+"&bsp="+bsp+"&vatamm="+vatamm+"&lttl="+lttl+"&mrp="+mrp+"&vat="+vat).fadeIn('fast');
	
	}
	
		function deltpr1(sl)
	{
		
	$('#wb_Text13').load("deltpr1.php?sl="+sl).fadeIn('fast');
	}
		function tmppr1()
	{
		
		$('#wb_Text13').load("tmppr1.php").fadeIn('fast');
		
	}
	function v()
	{
	var lcd=document.getElementById('lcd').value;
	var lfr=document.getElementById('lfr').value;
	var tamm1=document.getElementById('tamm1').value;
	document.getElementById('tamm').value=tamm1-lcd-lfr;
		
	}
	
	function cal()
{  
	var vat=document.getElementById('vat').value;
   var  prc=document.getElementById('prc').value;
  var qnty=document.getElementById('qnty').value;
	
	var bsp=qnty*prc;
	var vatamm=(bsp*vat)/100;
	var lttl=bsp+vatamm;
    $('#bsp').val(bsp);
	 $('#vatamm').val(vatamm);
	 
    $('#lttl').val(lttl);
 
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
 <input type="tex"  class="form-control" style="font-weight: bold;" id="addr" readonly="true" name="addr" value=""  placeholder="Customer Address">
 </td>
   <td align="right" style="padding-top:15px;"><b>Contact No. :</b></td>

<td>
<input type="text" id="mob" class="form-control" style="font-weight: bold;" readonly="true" name="mob" value="" size="35" placeholder="Customer Contact No.">
 </td>
  </tr>
  <tr>

   <td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

<td>
<input type="text" id="mail" class="form-control" style="font-weight: bold;" readonly="true" name="mail" value=""  size="35" placeholder="Customer E-Mail">
 </td>
  <td align="right" style="padding-top:15px">
<b>Godown : </b>
</td>
<td align="left" >

<select name="brncd" class="form-control"  size="1" id="brncd" onchange="getb()"  >
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
  <input type="text" class="form-control"  id="inv"  name="inv" value="" size="35" placeholder="Enter Invoice No...">
  </td>
    <td align="right" style="padding-top:15px;"> <b>Date : </b></td>
  <td>
  <input type="text" class="form-control"  id="dt"  name="dt" value="<? echo date('d-m-Y');?>" size="35" placeholder="Enter Date">
  </td>
</tr>

</table>
</div>
    <div class="box box-success" >
	  <table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td>
 <table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="30%"><b>Particulars</b></td>
<td align="center" width="10%" ><b>Price</b></td>
<td align="center" width="10%" ><b>Quantity</b></td>
<td align="center" width="10%"><b>Base Price</b></td>
<td align="center" width="10%"><b>Vat @<?=$current_vat;?><input type="hidden" id="vat" name="vat" value="<?=$current_vat;?>"></b></td>

<td align="center" width="10%" ><b>Total</b></td>
<td align="center" width="10%" ><b>MRP</b></td>
<td align="center" width="10%"><b>Action</b></td>


</tr>

<tr>
<td > 


<select id="prnm" name="prnm" class="form-control" >
		<option value="">---Select---</option>
		<?
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
			<option value="<?=$row['sl'];?>"><?=$pnm;?> - <?=$cnm;?> - <?=$brand;?> - <?=$mnm;?></option>
				<?
				}
				?>
			</select>


</td>
<td>
<input type="text" id="prc" class="sc" autocomplete="off" style="text-align:right"  name="prc" value="" onblur="cal()"  >
 </td>
<td>
<input type="text" id="qnty" class="sc" autocomplete="off" style="text-align:center" name="qnty" value="" onblur="cal()"  >
 </td>

<td> 
<input type="text" class="sc" id="bsp" autocomplete="off" style="text-align:right"  name="bsp" value=""  >

</td>
<td>
<input type="text" class="sc" id="vatamm" autocomplete="off" style="text-align:center" name="vatamm" value=""  >
</td>


<td>
<input type="text" class="sc" id="lttl" name="lttl" value=""  autocomplete="off"   style="text-align:right" size="15"  >
</td>
<td>
<input type="text" class="sc" id="mrp" autocomplete="off" name="mrp" value="" style="text-align:right"   >
</td>

<td><input type="button" class="btn btn-primary btn-xs" id="Button1" name="" value="Add"  onclick="add()" style="width:100%" >
</td>
</tr>
</table>
   </td>
	   </tr>
	       <tr height="230px">
	   <td>
	<div id="wb_Text13" >

		</div>
	  	</td>
	   </tr>


  <tr >
	   <td>
<table width="100%" class="advancedtable" >
<tr>
<td align="right" width="30%"  >
Less Cash Discount :
</td>
<td align="left" width="15%"  >

<input type="text" name="lcd" id="lcd"   class="sc" style="text-align:right"  value="" onblur="v()">
</td>
<td align="right" width="10%" >
Less Fright :
</td>
<td align="left" width="15%">
<input type="text" name="lfr" style="width:70%" id="lfr" class="sc" style="text-align:right" onblur="v()" >

</td>
<td  align="right" width="10%" >
<b>Pay Amount :</b>
</td>
<td align="center" width="15%">
<font size="3">
<b>
<div id="pay">
<input type="text" name="tamm" id="tamm" class="sc" style="background-color:#f3f4f5;" readonly="true"> 
</div>
</b>
</font>
</td>
</tr>
</table>
</td>
</tr>
	   </table>
</div>


<div class="box box-success" >

  <table border="0" width="860px" class="table table-hover table-striped table-bordered">

<tr>
    <td align="right" ><font color="red">*</font>Cash Or Bank Ac. :</td>
    <td align="left" >
	 <select  name="dldgr" id="dldgr" style="width:280px"  class="sc1">
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
<td align="right" style="padding-top:15px;"> Payment Mode: </td>
<td><select name="mdt" size="1" id="mdt" tabindex="10" onchange="pmod(this.value)" class="sc1">

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
<td align="right" style="padding-top:15px;">Payment Amount: </td>
<td><input type="text" class="form-control" id="pamm" name="pamm" value="" placeholder ="Enter Payment Amount" size="25"></td>

 
<td align="right"> 
<input type="submit" class="btn btn-primary" id="Button2" name="" value="Submit" >
</td>
</tr>

<tr >
<td colspan="7">
<div id="asd" >
<table class="table table-hover table-striped table-bordered">
<tr>
<tr>
<td align="right" style="padding-top:15px">
Reference No: 
</td>
<td>
<input type="text" class="form-control" id="crfno"  name="crfno" value="" >
</td>
<td align="right" style="padding-top:15px">
Date: 
</td>
<td>
<input type="text" class="form-control" id="idt" name="idt" value="" >
</td>
<td align="right" style="padding-top:15px">
Issued By:
</td>
<td>
<input type="text" class="form-control" id="cbnm"  name="cbnm" value="" >
</td>

</tr>

</tr>
</table>
</div>
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

  });		  $('#sup').chosen({
  no_results_text: "Oops, nothing found!",

  });
  
</script>
</html>