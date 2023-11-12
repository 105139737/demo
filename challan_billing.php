<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$cr_tm=date('H:i');
$ndl_tm=strtotime("+30 minute", strtotime($cr_tm));
$dl_tm=date('H:i', $ndl_tm);
?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<head>

			

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
	left : 6%;
	top : 46%;
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
   z-index: 1003 !important;
   display: none;
}
</style>
<script type="text/javascript" src="light.js" ></script>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
   
   
<link rel="stylesheet" type="text/css" href="jquery.autocomplete1.css" />

<script type="text/javascript" src="jquery.autocomplete1.js"></script>

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
      $("#ddt").datepicker(jQueryDatePicker2Opts);
	$("#ddt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
		  	   $("#idt").datepicker(jQueryDatePicker2Opts);
	  $("#idt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
 
  $("#custnm").autocomplete("autocomplete2.php", {
		selectFirst: true
	});

 document.getElementById('cno').focus();
   });
   
      function cat(cnm)
   {
	  $('#cont').load('cont2.php?cnm='+encodeURIComponent(cnm)).fadeIn('fast');
	  $('#adr').load('adr2.php?cnm='+encodeURIComponent(cnm)).fadeIn('fast');
   }
   </script>
      <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
   
<script type="text/javascript">
function lttla(a,b,c,d,e)
{ 
    a=document.getElementById('qnty').value;
    b=document.getElementById('prc').value;
    c=document.getElementById('unt').value;
    d=document.getElementById('runt').value;
    e=document.getElementById('prid').value;
 
  
$.get("lttl.php", { pcd: e,unt:c,qnt:a,prc:b,runt:d  })

.done(function(data) { 
    
   $("#lttl").val(data);
   });

}

function get(pnm,pcd,ret,upkg,ppkg,psl,exp,bet,usl)
{
	ret1=ret*psl;
	document.getElementById('prnm').value=pnm;
	//document.getElementById('prc').value=ret1;
	document.getElementById('prid').value=pcd;
	document.getElementById('usl').value=usl;
	//document.getElementById('betno').value=bet;
	//document.getElementById('expdt').value=exp;
	
	$('.un').html('<select name="unt" id="unt" onchange="lttla()" class="sc1"><option value="'+ppkg+'">'+ppkg+'</option><option value="'+upkg+'">'+upkg+'</option></select>');
	
	$('.un1').html('<select name="runt" id="runt" onchange="lttla()" class="sc1"> <option value="'+ppkg+'">'+ppkg+'</option></select>');
	

	clr();
	getb(pcd);
	
}

function gett(pcd)
{
    
    
    $.get('sprcp.php?pcd='+pcd, function(data) {
				var str= data;
				var stra = str.split("@")
				var pnm = stra.shift()
				var pcd = stra.shift()  
                var ret = stra.shift() 
				var upkg = stra.shift() 
				var ppkg = stra.shift() 
				var psl = stra.shift() 
				var exp = stra.shift() 
				var bet = stra.shift() 
				var usl = stra.shift() 
				
	ret1=ret*psl;
	//document.getElementById('prnm').value=pnm;
	//document.getElementById('prc').value=ret1;
	document.getElementById('prid').value=pcd;
	document.getElementById('usl').value=usl;
	//document.getElementById('betno').value=bet;
	//document.getElementById('expdt').value=exp;
	
	$('.un').html('<select name="unt" id="unt" onchange="lttla()" class="sc1"><option value="'+ppkg+'">'+ppkg+'</option><option value="'+upkg+'">'+upkg+'</option></select>');
	
	$('.un1').html('<select name="runt" id="runt" onchange="lttla()" class="sc1"> <option value="'+ppkg+'">'+ppkg+'</option></select>');
	
getb(pcd);
  
}); 


}

function getb(pcd)
{
$("#gbet").load("getbe.php?pcd="+pcd).fadeIn('fast');
}
function ep(sl)
{
	
$("#p").load("getp.php?sl="+sl).fadeIn('fast');
$("#e").load("gete.php?sl="+sl).fadeIn('fast');
}



</script>

<script type="text/javascript" src="jquery.ui.widget.min.js"></script>


<script type="text/javascript">
function gtid(cid)
{
    
    
    $.get('cname.php?cid='+cid, function(data) {
        
        if(data=='Wrong Customer ID'){
            alert(data);
        }
        else
        {
                var str= data;
				var stra = str.split("@")
				var fstr1 = stra.shift()
				var fstr2 = stra.shift()  
                var fstr3 = stra.shift() 
    $('#custnm').val(fstr1);
    $('#addr').val(fstr2);
    $('#mob').val(fstr3);
    document.getElementById('custid').style.border='none';
    }
}); 


}
function chunt(unt)
{
  $('#unt option').each(function() {
        $(this).remove();
}); 
  $('#runt option').each(function() {
        $(this).remove();
}); 
var untsp=unt.split(",");
var untb=untsp.shift();
var unts=untsp.shift();
//$("#unt").append('<option value="'+untb+'">'+untb+'</option>');
//$("#unt").append('<option value="'+unts+'">'+unts+'</option>'); 
//$("#runt").append('<option value="'+untb+'">'+untb+'</option>');
//$("#runt").append('<option value="'+unts+'">'+unts+'</option>'); 
}
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

	function add()
	{
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pid=document.getElementById('prid').value;
		prnm=document.getElementById('prnm').value;
		qty=document.getElementById('qnty').value;
		prc=document.getElementById('prc').value;
		unt=document.getElementById('unt').value;
		runt=document.getElementById('runt').value;
		betno=document.getElementById('betno').value;
		expdt=document.getElementById('expdt').value;
		lttl=document.getElementById('lttl').value;
		usl=document.getElementById('usl').value;
		//document.getElementById('betno').value='';
		document.getElementById('expdt').value='';
		document.getElementById('qnty').value='';
		document.getElementById('prc').value='';
		document.getElementById('lttl').value='';
	
		
		$('#wb_Text13').load("adtmppr.php?pid="+pid+"&qty="+qty+"&unt="+unt+"&prc="+prc+"&runt="+runt+"&betno="+betno+"&expdt="+expdt+"&prnm="+prnm+"&lttl="+lttl+"&usl="+usl).fadeIn('fast');
		
		$('#betno option').each(function() {
        $(this).remove();
}); 

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
		
		vatt=(tam*vat)/100;
		document.getElementById('vatamm').value=vatt;
		tt=tam+vatt;
		document.getElementById('tamm').value=tt+car;
		
		
	}
</script>

	<script type="text/javascript" src="atosgps.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<link rel="stylesheet" href="atosgps.css" type="text/css" media="screen" charset="utf-8" />	


	</head>
<body onload="temp()" >
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
              Road Challan To Sale Invoice
               
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Road Challan To Sale Invoice</li>
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
                          
<form method="post" target="" name="form1" id="form1"  action="billings.php">
                              
							
								


        <div class="box box-success" >
  <center>
  <table border="0" width="860px" class="table table-hover table-striped table-bordered">
  <tr>
  <td  style="padding-top:15px;">Car No. 
  </td>
  <td> 

	<input type="text"  list="browsers" id="cno" class="form-control" autocomplete="off" onblur="ddet()"   name="cno" value="" size="20" tabindex="1" placeholder="Car No.">
	    
  <datalist id="browsers">
	<?
	$data1= mysqli_query($conn,"select * from main_dirver group by cno")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
	$cno=$row1['cno'];
	?>
  <option value="<?=$cno;?>"/>
<?
}
?>

  </datalist>
  </td>
 <td  style="padding-top:15px;">
Car Details 
 </td>
<td>
<input type="text" class="form-control" id="cdet"  tabindex="2" name="cdet" value="" placeholder="Please Enter Car Details">
</td>
  <td  style="padding-top:15px;"> 
  Date 
  </td>
  <td> <input type="text" class="form-control" id="dt"  name="dt" value="<? echo date('d-m-Y');?>" tabindex="3" placeholder="Enter Date"></td>
  </tr>
  <tr>
<td  style="padding-top:15px;">
Driver Name 
</td>
<td>
<div id="dirver">
<input type="text" class="form-control" id="dnm" tabindex="4" name="dnm" value="" placeholder="Please Enter Driver Name" >
</div>
</td>
<td style="padding-top:15px;">
Address </td>
<td >
<input type="text" class="form-control" id="addr" tabindex="5"  name="addr" value="" placeholder="Please Enter Address" >
</td>
<td  style="padding-top:15px;">Contact No.</td>

<td>
<div id="cont">
<input type="text" class="form-control" id="mob1" name="mob1" value="" placeholder="Please Enter Mobile No."  tabindex="6" maxlength="11" onkeypress="return isNumber(event)">
</div>
 </td>
</tr>
<tr>
<td   style="padding-top:15px;">
Driving license No. </td>
<td>
<input type="text" class="form-control" id="lno" name="lno" value="" tabindex="7" placeholder="Please Enter Driving license No." >
</td>
<td   style="padding-top:15px;">
License Type 
</td>

<td>
<input type="text" class="form-control" id="ltyp" name="ltyp" value="" tabindex="8" placeholder="Please Enter License Type " onblur="fucs()"  >
</td>
<td>
</td>
<td>
</td>
</tr>
</table>
</div>
<input type="hidden" id="usl" name="usl" value="" >

 <div class="box box-success" >
	  <table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td>
 <table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="20%"><b>Particulars</b></td>
<td align="center" width="13%"><b>Batch No.</b></td>
<td align="center" width="10%"><b>Expiry Date</b></td>

<td align="center" width="10%" ><b>Quantity</b></td>
<td align="center" width="10%" ><b>Unit</b></td>
<td align="center" width="10%" ><b>Sale Rate</b></td>
<td align="center" width="10%" ><b>Unit</b></td>

<td align="center" width="10%"><b>Line Total</b></td>
<td align="center" width="7%"><b>Action</b></td>


</tr>

<tr>
<td > 

<select id="prnm" name="prnm" class="sc1"  tabindex="2" style="width:230px"  onchange="gett(this.value)" >
		<option value="">---Select---</option>
		<?
			$query6="select * from  ".$DBprefix."product ";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
				?>
			<option value="<?=$row['sl'];?>"><?=$row['pname'];?></option>
				<?
				}
				?>
			</select>
			


</td>

<td> 
<div id="gbet">
<select name="betno" size="1" id="betno" class="sc1">
<option selected value="">---Select---</option>
</select>
</div>
</td>
<td>
<div id="e">
<input type="text" class="sc" id="expdt"  name="expdt" value=""  size="12">
</div>
</td>


<td>
<input type="text" id="qnty" class="sc" autocomplete="off"  name="qnty" value="" onkeyup="lttla('','')" tabindex="7" size="15" >
 </td>
<td>
<div class="un">
<select name="unt" size="1" id="unt" onchange="lttla()" class="sc1" style="width:120px">
<option selected value="0">---Select---</option>
</select>
</div>
</td>
<td>
<div id="p">
<input type="text" class="sc" autocomplete="off" id="prc" name="prc" value="" onkeyup="lttla('','')" tabindex="8" size="15"  >
</div>
</td>

<td> 
<div class="un1">
<select name="runt" size="1" id="runt" onchange="" class="sc1" style="width:120px" >
<option selected value="0">Select</option>
</select>
</div>
</td>


<td> 
<input type="text" class="sc" id="lttl"  name="lttl" value="" readonly="true" size="15">
</td>
<td>
<input type="button" class="btn btn-primary" id="Button1" name="" value="Add"  onclick="add()" tabindex="9" style="width:100px;padding:3px" >
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

<td align="right" width="20%" >
Add Freight :
</td>
<td align="left" >
<input type="text" name="car" id="car"   onblur="v()" value="" class="sc"  style="text-align:right">
</td>

<td align="right" >
Vat.(%) :
</td>
<td align="left" >
<input type="text" name="vat" id="vat" onblur="v()" class="sc"  style="text-align:right" >

</td>
<td align="right" >
Vat Amount :
</td>
<td align="left" >
<input type="text" name="vatamm" id="vatamm" class="sc" style="background-color:#f3f4f5;text-align:right" readonly="true" >

</td>
<td  align="right"  >
<b>Pay Amount :</b>
</td>
<td align="center" >
<font >
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
								<option value="<?=$row['sl']?>" <?=$row['sl'] == '3' ? 'selected' : '' ?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select>
	</td>
<td align="right" style="padding-top:15px;"> Payment Mode: </td>
<td><select name="Combobox2" size="1" id="Combobox2" tabindex="10" onchange="pmod(this.value)" class="sc1">
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
<table>
<tr>
<td >Deposit On: </td>
 <td>

<select name="bnm" size="1" id="bnm" tabindex="12" class="sc1">
<?
$data1 = mysqli_query($conn,"select * from main_ledg where gcd='16'");
echo "<option value=''>Select</option>";
		while ($row1 = mysqli_fetch_array($data1))
	{
	$bn = $row1['nm'];
	$bnsl = $row1['sl'];
	echo "<option value='".$bnsl."'>".$bn."</option>";
	}
	
 

?>
</select>
</td>
<td >
Reference No: 
</td>
<td>
<input type="text" class="form-control" id="crfno"  name="crfno" value="" >
</td>
<td >
Date: 
</td>
<td>
<input type="text" class="form-control" id="idt" name="idt" value="" >
</td>
<td >Issued By:
</td>
<td>
<input type="text" class="form-control" id="cbnm"  name="cbnm" value="" >
</td>

</tr>
</table>
</div>
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
  
</script>

    </body>
</html>