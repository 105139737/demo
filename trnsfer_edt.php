<?
$reqlevel = 1;
include("membersonly.inc.php");
include "function.php";
include "header.php";
$cr_tm=date('H:i');
$ndl_tm=strtotime("+30 minute", strtotime($cr_tm));
$dl_tm=date('H:i', $ndl_tm);

$blno=$_REQUEST[blno];
  $query111 = "SELECT * FROM main_trns where blno='$blno'";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{

$stat=$R111['stat'];

$tbcd=$R111['tbcd'];
$fbcd=$R111['fbcd'];
$dt=$R111['dt'];

}
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
	width: 100%;
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
cbcd('<?=$tbcd;?>');
temp();
   });
   
      function cat(cnm)
   {
	  $('#cont').load('cont2.php?cnm='+encodeURIComponent(cnm)).fadeIn('fast');
	  $('#adr').load('adr2.php?cnm='+encodeURIComponent(cnm)).fadeIn('fast');
   }
   
 function spaces(myString) 
{
document.getElementById('betno').value = myString.split(' ').join('');
}   
   </script>
      <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
   
<script type="text/javascript">
function gett()
{
getb();
  }



function getb()
{
pcd=document.getElementById('prnm').value;
fbcd=document.getElementById('bcd').value;
$("#gbet").load("getbe_trn.php?pcd="+pcd+'&fbcd='+fbcd).fadeIn('fast');
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

<script type="text/javascript" src="jquery.ui.widget.min.js"></script>


<script type="text/javascript">
			function temp()
	{
		
		blno=document.getElementById('blno').value;
		$('#wb_Text13').load("tmppr_trn_edt.php?blno="+blno).fadeIn('fast');
			
	}
		function deltpr(sl,blno)
	{
	
	$('#wb_Text13').load("deltpr_trn_edt.php?sl="+sl+"&blno="+blno).fadeIn('fast');
	
	}
	
function cbcd(tbcd)
	{
		fbcd=document.getElementById('fbcd').value;
		$('#bb').load('cbcd_edt.php?fbcd='+fbcd+'&tbcd='+tbcd).fadeIn('fast');
		gett();
	}
	
	function check()
{
if(document.form1.tbcd.value=='')
{
alert("Please Select Send Branch !");  

$('#tbcd').focus();
return false;

}
else
{

if (confirm("Are Sure To Submit ?")) 
{	
document.forms["form1"].submit();
} 
}	
	  
}
function gtt_unt()
{
prnm=document.getElementById('prnm').value;		
$("#g_unt").load("get_unt.php?prnm="+prnm).fadeIn('fast');
}	
function get_betno(betno='')
{
if(betno=='undefined' || betno=='' ){betno='';}	
prnm=document.getElementById('prnm').value;	
bcd=document.getElementById('bcd').value;	
betnoo='';	
$("#g_betno").load("get_betno_trn.php?prnm="+prnm+'&bcd='+bcd+'&betnoo='+betno).fadeIn('fast');	
}

function add()
	{
	var	prnm=document.getElementById('prnm').value;
	var	qty=document.getElementById('qnty').value;
	var	fbcd=document.getElementById('bcd').value;
	var	tbcd=document.getElementById('tbcd').value;
	var	sih=document.getElementById('sih').value;
	var	unit=document.getElementById('unit').value;
	var	usl=document.getElementById('usl').value;
	var	betno=document.getElementById('betno').value;
	var	remk=encodeURIComponent(document.getElementById('remk').value);
	var	blno=encodeURIComponent(document.getElementById('blno').value);
	var	dt=encodeURIComponent(document.getElementById('dt').value);

	$('#wb_Text13').load('adtmppr_trn_edt.php?prnm='+prnm+'&qty='+qty+'&fbcd='+fbcd+'&tbcd='+tbcd+'&sih='+sih+'&remk='+remk+'&unit='+unit+'&usl='+usl+'&betno='+betno+'&blno='+blno+'&dt='+dt).fadeIn('fast');
	}
	function reset()
	{
	document.getElementById('qnty').value="";
	document.getElementById('sih').value="";
	document.getElementById('remk').value="";
	document.getElementById('betno').value="";
	$('#prnm').empty().append('<option value="">---Select---</option>');
	document.getElementById('prnm').value="";
	$('#prnm').trigger("chosen:updated");
	$('.upd').html('<input type="button" class="btn btn-success" id="Button1" name="" value="Add" tabindex="1" onclick="add()" tabindex="9" style="padding:2px;width:100%" >');

	}
function get_data(tsl,prsl,pnm,fbcd,unt,betno,qnty,remk,usl)
{
	$('#prnm').empty().append('<option value="'+prsl+'">'+pnm+'</option>');
	document.getElementById('prnm').value=prsl;
	$('#prnm').trigger("chosen:updated");
	document.getElementById('bcd').value=fbcd;
	document.getElementById('unit').value=unt;
	document.getElementById('usl').value=usl;
	$('#unit').empty().append('<option value="sun">'+unt+'</option>');
	document.getElementById('betno').value=betno;
	document.getElementById('qnty').value=qnty;
	document.getElementById('remk').value=remk;
	$('#bcd').trigger("chosen:updated");
	$('.upd').html('<input type="button" value="Update" onclick="update('+tsl+')" style="padding:2px;width:100%" class="btn btn-warning">');
}
function update(sl)
{
	var	blno=encodeURIComponent(document.getElementById('blno').value);
	add();
	deltpr(sl,blno);


}
function godown()
{
prnm=document.getElementById('prnm').value;	
$("#g_gwn").load("get_gwn_trn.php?prnm="+prnm).fadeIn('fast');	
}

function get_scat(scat='')  
{
var cat= document.getElementById('cat1').value;
$("#scatdiv").load("get_scat_pur.php?cat="+cat+"&scat="+scat).fadeIn('fast');
}

function get_prod(psl='')
{
var scat=document.getElementById('scat1').value;
var cat=document.getElementById('cat1').value;
//$("#prod_div").load("get_product_trn.php?cat="+cat+"&scat="+scat+"&psl="+psl).fadeIn('fast');	
}
function get_prod_by_name(psl='')
{
var scat=document.getElementById('scat1').value;
var cat=document.getElementById('cat1').value;
var prnm3=encodeURIComponent(document.getElementById('prnm3').value);
if(cat=='')
{
	alert("Please Select Brand first ! ");
	return;
}
if(prnm3.length>2){
$("#prod_div").load("get_product_trn.php?cat="+cat+"&scat="+scat+"&psl="+psl+"&prnm3="+prnm3).fadeIn('fast');
}
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
              Stock Transfer
                    <small> <?echo $blno;?> </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Stock Transfer</li>
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
                          
<form method="post" target="" name="form1" id="form1"  action="transfers_edt.php">
                              
							
								

<input type="hidden" name="blno" id="blno" value="<?=$blno;?>">
        <div class="box box-success" >
<font color="#00a65a">Godown :</font>
  <table border="0" width="860px" class="table table-hover table-striped table-bordered">


<tr>
<td align="right" style="padding-top:10px"  hidden><font size="4" ><b>From :</b></font></td>
<td align="left"  hidden>
<?
$query100 = "SELECT * FROM main_trndtl where blno='$blno' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$fbcd=$R100['fbcd'];
}
if($fbcd!="")
{
	
?>
 <select name="fbcd" class="form-control" size="1" id="fbcd" style="width:300px" onchange="cbcd()" >
<?

$query="Select * from main_godown where sl='$fbcd' and stat=1";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['gnm'];
?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>
<?	
}
else
{

			?>
    <select name="fbcd" class="form-control" size="1" id="fbcd" style="width:300px" onchange="cbcd()" >
<?

$query="Select * from main_godown where stat=1";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['gnm'];
?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>
<?}?>
	</td>
 <td align="right" style="padding-top:10px" ><font size="4" ><b>To :</b></font></td>
<td align="left" >
<div id="bb">
    <select name="tbcd" class="form-control" size="1" id="tbcd"   >

<option value="">---Select---</option>

</select>
</div>
	</td>
</tr>
</table>
</div>
<input type="hidden" id="tsl" name="tsl" value="" >
<input type="hidden" id="dt" name="dt" value="<?=$dt;?>" >

 <div class="box box-success" >
 <table>
<tr>
<td>

<select name="cat1" class="form-control" size="1" id="cat1" tabindex="1" onchange="get_scat();get_prod()">
<Option value="">---Brand---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_catg where stat='0' order by cnm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['cnm'];
echo "<option value='".$sl."' >".$cnm."</option>";
}
?>
</select>
</td>
<td>
<div id="scatdiv">
<select name="scat1" class="form-control" size="1" id="scat1" tabindex="1" onchange="get_prod()">
<Option value="">---Category---</option>
<?
$data2 = mysqli_query($conn,"Select * from main_scat where stat='0' order by nm");
while ($row2 = mysqli_fetch_array($data2))
{
$ssl=$row2['sl'];
$snm=$row2['nm'];
echo "<option value='".$ssl."'>".$snm."</option>";
}
?>
</select>
</div>
</td> 

</tr>
</table>
 
	  <table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td>
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="25%"><b>Model &nbsp; <input type="box" id="prnm3" onkeyup="get_prod_by_name()" name="prnm3" placeholder="Min 3 Digit Model Name "></b></td>
<td  align="left" width="18%"><b>Godown</b></td>
<td  align="left" width="8%"><b>Unit</b></td>
<td align="center" hidden width="15%"><b>Stock In Hand</b></td>
<td align="center" width="23%" ><b>Serial No.</b></td>
<td align="center" width="7%" ><b>Quantity</b></td>
<td align="center" width="12%" ><b>Remark</b></td>
<td align="center" width="5%"><b>Action</b></td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table border="0" width="100%" class="advancedtable">
<tr>
<td width="25%"> 
<div id="prod_div">
	<select id="prnm" name="prnm" class="sc1"  tabindex="1" >
	<option value="">---Select---</option>

	</select>
	</div>
</td>
<td align="left" width="18%" >
<div id="g_gwn">
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" onchange="gtt_unt();getb();get_betno();">
<?
$query="Select * from main_godown where stat=1";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$gnm=$R['gnm'];
?>
<option value="<? echo $sl;?>"><? echo $gnm;?></option>
<?
}
?>
</select>
</div>
</td>
<td width="8%"> 
<div id="g_unt">
<select id="unit" name="unit" class="sc" tabindex="1" style="padding:3px;width:100%">
<option value="">---Select---</option>
</select>
</div>
</td>

<td width="15%" hidden> 
<div id="gbet">
<input type="text" class="sc" id="sih"  name="sih" tabindex="1">
</div>
</td>
<td width="23%">
<div id="g_betno">
<input type="text" id="betno" class="sc" autocomplete="off"  name="betno" onblur="spaces(this.value)" tabindex="1">
</div>
</td>
<td width="7%">
<input type="text" id="qnty" class="sc" autocomplete="off"  name="qnty" tabindex="1" onkeypress="return isNumber(event)">
</td>
<td width="12%">
<input type="text" id="remk" class="sc" autocomplete="off"  name="remk" tabindex="1">
</td>

<td width="5%">
<span class="upd">
<input type="button" class="btn btn-success" id="Button1" name="" value="Add" tabindex="1" onclick="add()" tabindex="9" style="padding:2px;width:100%" >
</sapn>
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



	   </table>



  <table border="0" width="860px" class="table table-hover table-striped table-bordered">
<td align="right"> 
<input type="button" class="btn btn btn-success" id="Button2" name="" onclick="check()" value="Submit" >
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
 $('#cat1').chosen({
no_results_text: "Oops, nothing found!",
});
$('#scat1').chosen({
no_results_text: "Oops, nothing found!",
});
$('#bcd').chosen({
no_results_text: "Oops, nothing found!",
});	 
</script>

    </body>
</html>