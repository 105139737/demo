<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$cr_tm=date('H:i');
$ndl_tm=strtotime("+30 minute", strtotime($cr_tm));
$dl_tm=date('H:i', $ndl_tm);
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
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
<script type="text/javascript" src="light2.js" ></script>
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
  $('#overlay').fadeOut('fast');
   $("#expdt").datepicker(jQueryDatePicker2Opts);
      $("#expdt1").datepicker(jQueryDatePicker2Opts);
	  $("#expdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	   $("#ddt").datepicker(jQueryDatePicker2Opts);
	  $("#ddt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	  	   $("#idt").datepicker(jQueryDatePicker2Opts);
	  $("#idt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	  
	   $("#spnm").autocomplete("autocomplete1.php", {
		selectFirst: true
	});
 
   });
   
   function cat(cnm)
   {
	  $('#cont').load('cont1.php?cnm='+encodeURIComponent(cnm)).fadeIn('fast');
	  $('#adr').load('adr1.php?cnm='+encodeURIComponent(cnm)).fadeIn('fast');
   }

 
   </script>
   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>


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



</script>
<link rel="stylesheet" type="text/css" href="style_sedt.css" />

<script type="text/javascript">
function gtid(cid)
{
    
    
    $.get('cname1.php?cid='+cid, function(data) {
        
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
	
	$('.un1').html('<select name="runt" id="runt" onchange="lttla()" class="sc1"> <option value="'+ppkg+'">'+ppkg+'</option><option value="'+upkg+'">'+upkg+'</option></select>');
	

	clr();
	
	

}

function openOfferslDialog() {

		
		$('#contentl').load('product.php').fadeIn("slow");
		

	$('#overlay').fadeIn('fast', function() {
		
		$('#boxpopupl').css('display','block');
		$('.boxopen').animate({'opacity': '1'});
        $('#boxpopupl').animate({'left':'20%'},600);
    });
}


function closeOfferslDialog(prospectElementID) {
	$('#overlay').fadeOut('fast', function() {
		
		$('#boxpopupl').css('display','block');
        $('#boxpopupl').animate({'left':'100%'},500);
		$('.boxopen').animate({'opacity': '1'});
    });
	
}

function np()
{
	cat=encodeURIComponent(document.getElementById('cat1').value);
	pnm=encodeURIComponent(document.getElementById('pnm1').value);
	tech=encodeURIComponent(document.getElementById('tech1').value);
	co=encodeURIComponent(document.getElementById('co1').value);
	ops=encodeURIComponent(document.getElementById('ops1').value);
	Combobox1=encodeURIComponent(document.getElementById('uni').value);
	reo=encodeURIComponent(document.getElementById('reo1').value);
	ret=encodeURIComponent(document.getElementById('ret1').value);
	betno=encodeURIComponent(document.getElementById('betno1').value);
	expdt=encodeURIComponent(document.getElementById('expdt1').value);
	

$('#ps').load('npents.php?cat='+cat+'&pnm='+pnm+'&tech='+tech+'&co='+co+'&ops='+ops+'&Combobox1='+Combobox1+'&reo='+reo+'&ret='+ret+'&betno='+betno+'&expdt='+expdt).fadeIn('fast');
	document.getElementById('cat1').value='';
	document.getElementById('pnm1').value='';
	document.getElementById('tech1').value='';
	document.getElementById('co1').value='';
	document.getElementById('ops1').value='';

	document.getElementById('reo1').value='';
	document.getElementById('ret1').value='';
	document.getElementById('betno1').value='';
	closeOfferslDialog('boxpopupl');
//document.getElementById('expdt1').value='';
	}
	function pay1()
	{
		vat=document.getElementById('vat').value;
		$('#pay').load('vat.php?vat='+vat).fadeIn('fast');

	}

</script>
<script type="text/javascript" src="shortcut.js"></script>
<script>
    shortcut.add("alt+p", function() {
        openOfferslDialog('','');
    });
  
</script>

	<script type="text/javascript" src="atosgps.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<link rel="stylesheet" href="atosgps.css" type="text/css" media="screen" charset="utf-8" />	




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
                          
					<form method="post" action="purchases.php">
                              
							
								


        <div class="box box-success" >
  <center>
  <table border="0" width="860px" class="table table-hover table-striped table-bordered">
  <tr>
    <td align="right">INVOICE No.:</td>
 <td >      

 <input type="text" id="inv" class="form-control"  name="inv" value=""  tabindex="3"  placeholder ="INVOICE No.">
</td>
 
  <td align="right"> Date: </td>
  <td> <input type="text" class="form-control" id="ddt"  name="ddt" value="<?php  echo date('d-m-Y');?>" tabindex="1"  placeholder="Enter Date"></td>
  
  <td align="right">Delivery: </td>
  <td>
  <select name="Combobox1"  id="Combobox1" class="sc">
<option selected value="0">Booking</option>
<option value="1">Transport</option>
<option selected value="2">Direct</option>

</select>
  </td>
  </tr>
  <tr>
 <td align="right">Company Name:
  </td>
  <td colspan="3"> 
  <input type="text" class="form-control" id="spnm" name="spnm" value="" size="94"  placeholder ="Enter Company Name">
  </td>
<td align="right">Contact No:</td>

<td>
<div id="cont">
<input type="text" id="mob" class="form-control" name="mob" value="" tabindex="4" size="35" placeholder ="Enter Supplier Contact No">
</div>
 </td>
</tr>
<tr>
<td align="right">Address:</td>
<td colspan="5"> 
<div id="adr">
<input type="tex" class="form-control" id="addr" name="addr" value="" tabindex="4" size="158" placeholder ="Enter Supplier Address">
</div>
</td>
</tr>
</table>
</div>
    <div class="box box-success" >
	<input type="hidden" id="usl" name="usl" value="" >
 <table border="0" width="860px" class="table table-hover table-striped table-bordered">
 <thead>
<tr style="background-color:#2396d6;">
<th colspan="10" align="center">Product List</th>
</tr>
<tr>
<td  align="center"><b>Particulars</b></td>
<td align="center"><b>Batch No.</b></td>
<td align="center"><b>Expiry Date</b></td>

<td align="center" colspan="2"><b>Quantity/Unit</b></td>
<td align="center" ><b>Purchase Rs.</b></td>
<td align="center" colspan="2" ><b>MRP Rs./Unit</b></td>

<td align="center"><b>Line Total</b></td>
<td align="center"><b>Action</b></td>


</tr>
</thead>
<tr>
<td align="center"> 
<input type="text" class="form-control" id="prnm" autocomplete="off" name="prnm" value="<?php  echo $b;?>" tabindex="6" size="25" onkeyup="sfdtl(event)" placeholder ="Enter Particulars Name">
<a onclick="openOfferslDialog('','');"> New Product</a>
</td>

<td> 
<input type="text" class="form-control" id="betno"  name="betno" value=""  size="15">

</td>
<td>
<input type="text" class="form-control" id="expdt"  name="expdt" value=""  size="12">
</td>


<td><input type="text" id="qnty" class="form-control" autocomplete="off"  name="qnty" value="" onkeyup="lttla('','')" tabindex="7" size="15" placeholder ="Enter Quantity"> </td>
<td>
<div class="un">
<select name="unt" size="1" id="unt" onchange="lttla()" class="sc1">
<option selected value="0">Select</option>
</select>
</div>
</td>
<td><input type="text" class="form-control" id="pprc" name="pprc" value=""  tabindex="8" size="15"  ></td>
<td><input type="text" class="form-control" id="prc" autocomplete="off" name="prc" value="" onkeyup="lttla('','')" tabindex="8" size="15"  ></td>
<td> 
<div class="un1">
<select name="runt" size="1" id="runt" onchange="lttla()" class="sc1">
<option selected value="0">Select</option>
</select>
</div>
</td>


<td> <input type="text" class="form-control" id="lttl"  name="lttl" value="" readonly="true" size="15">
</td>
<td><input type="button" class="btn btn-primary" id="Button1" name="" value="Add"  onclick="adtmppr1()" tabindex="9" style="width:100px;" >
</td>
</tr>
</table>
<div id="wb_Text13" >
</div>

<table width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" width="75%">
Vat.(%)
</td>
<td align="left" width="8%">
<input type="text" name="vat" id="vat" style="text-align:center" onkeyup="pay1()" value="0" size="8">
</td>
<td  align="right"  >
<b>Pay Amount :</b>
</td>
<td align="center" ><font size="3"><b><div id="pay">0.00</div></b></font></td>




</tr>
</table>

<div id='sfdtl' align='center'>
Loding.....<br>
<img src="images/loading.gif">
</div> 

</div>


<div class="box box-success" >
 <table border="0" width="860px" class="table table-hover table-striped table-bordered">

<tr>
<td>Payment Amount: </td>
<td><input type="text" class="form-control" id="pamm" name="pamm" value="" placeholder ="Enter Payment Amount"></td>
<td> Payment Mode: </td>
<td><select name="Combobox2" size="1" class="sc1" id="Combobox2" tabindex="10" onchange="pmod(this.value)">

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
 <td>Deposit On: </td>
 <td>
 <div id="xxx">
<select name="bnm" size="1" id="bnm" tabindex="12" class="sc1">
<?php 
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
</div>
</td>
<td align="right"> 
<input type="submit"  class="btn btn-primary" id="Button2" name="" value="Submit" >
</td>
</tr>

<tr >
<td colspan="7">
<div id="asd" >
<table>
<tr>
<td>
Reference No: 
</td>
<td>
<input type="text" class="form-control" id="crfno"  name="crfno" value="" >
</td>
<td>
Date: 
</td>
<td>
<input type="text" class="form-control" id="idt" name="idt" value="" >
</td>
<td>Issued By:
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
<input type="hidden" id="prid"  name="prid" value="<?php  echo $cid;?>">
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

     
<div id="wrapperl">
<div id="overlay" class="overlay"></div>
<div id="boxpopupl" class="boxl">
	
	<div class="topb">
     <div id="bnm" class="bnm"><h3><font color="#FFF"><b>New Product</b></font></h3></div>
    <div class="top_leftb" id="news_ttl">
      </div>
     
  </div>
	   <hr />
	
	<div id="contentl">


	</div>
</div>
</div> 

    </body>
</html>