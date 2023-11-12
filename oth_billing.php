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
                var b = stra.shift() 
                var csl = stra.shift() 
    $('#typ').val(typ);
    $('#addr').val(addr);
    $('#mob').val(mob);
    $('#mail').val(mail);
    $('#csl').val(csl);
	$('#pp').val(pp);
     
}); 

	}
}



function gtids()
{
    sid=document.getElementById('csl').value;

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
                var csl = stra.shift()
    $('#addr').val(addr);
    $('#mob').val(mob);
    $('#mail').val(mail);
    $('#typ').val(typ);
    $('#pp').val(pp);
    //$('#ppnt').val(pp);
    //$('#pbal').val(bal);
   	document.getElementById('custnm').value=csl;
	    $('#custnm').trigger('chosen:updated');
     
}); 
v();
	
}











function addspnm()
{
	var nm=encodeURIComponent(document.getElementById('nm').value);
	var addr1=encodeURIComponent(document.getElementById('addr1').value);
	var email=encodeURIComponent(document.getElementById('email').value);
	var mob1=encodeURIComponent(document.getElementById('mob1').value);
	var dob=encodeURIComponent(document.getElementById('dob').value);
	var doa=encodeURIComponent(document.getElementById('doa').value);
	var typ=encodeURIComponent(document.getElementById('typ6').value);
	
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

	function add()
	{
		var prnm=document.getElementById('prnm').value;
		var qty=document.getElementById('qnty').value;
		var prc=document.getElementById('prc').value;
		var point=document.getElementById('point').value;
		var lttl=document.getElementById('lttl').value;
		$('#wb_Text13').load('oth_adtmppr.php?prnm='+encodeURI(prnm)+'&qty='+qty+'&prc='+prc+'&point='+point+'&lttl='+lttl).fadeIn('fast');
		document.getElementById('qnty').value='';
		document.getElementById('prc').value='';
		document.getElementById('lttl').value='';
		document.getElementById('prnm').value='';
		document.getElementById('point').value='';
	}
			function temp()
	{
		
		$('#wb_Text13').load("oth_tmppr.php").fadeIn('fast');
			
	}
		function deltpr(un,sl)
	{
	
	$('#wb_Text13').load("deltpr_oth.php?sl="+sl+"&tsl="+un).fadeIn('fast');
	
	}
	
	function t()
{
	var pp=parseFloat(document.getElementById('pp').value);if(document.getElementById('pp').value==""){pp=0;}

//$('#pay').load('oth_stotal.php').fadeIn('fast');
$.get('oth_stotal.php', function(data) {
        
                var str= data;
				var stra = str.split("@")
				var ttamnt = stra.shift()
				var ttpoint = stra.shift()  
				var ttpoint = parseFloat(ttpoint);
			if(ttpoint==""){ttpoint=0;}
				
				var tpp=ttpoint+pp;
			
				
    $('#ttamnt').val(ttamnt);
    $('#ttpoint').val(tpp);
}); 

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
/*var pdis=document.getElementById('pdis').value;
var fprc1=(prc*pdis)/100;
var fprc=prc-fprc1;
document.getElementById('fprc').value=fprc;*/
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
                Other Sale 
                    <small> Invoice</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Other Sale Invoice</li>
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
                          
<form method="post" target="" name="form1" id="form1"  action="oth_billings.php">
                              
							
								


        <div class="box box-success" >
		<b>Invoice Details : </b>
  <center>
 <table border="0" width="860px" class="table table-hover table-striped table-bordered">
  <tr>
  <td align="right" style="padding-top:15px;"><b>Customer Name :</b>
  </td>
  <td colspan="" > 
  
  <select id="custnm" name="custnm" tabindex="1"  class="form-control" onchange="gtid()" >
	<option value="">---Select---</option>
	<option value="Add">---Add New Customer---</option>
	<?
		$query="select * from main_cust  WHERE sl>0 order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			<option value="<?=$rw['sl'];?>"><?=$rw['nm'];?> <?if($rw['cont']!=""){?>( <?=$rw['cont'];?> )<?}?></option>
			<?
		}
	?>
	</select>
		</td>
		  <td align="right" style="padding-top:15px;"><b>Customer SL :</b>
  </td>
  <td>
<input type="text" class="form-control" id="csl"  name="csl" value=""  size="14" onblur="gtids()" placeholder="Customer SL"></td>
	


  </tr>
  <tr>
     <td align="right" style="padding-top:15px;"><b>Customer Type :</b></td>

<td>
<input type="text" id="typ" class="form-control" style="font-weight: bold;" readonly="true" name="typ" value=""  tabindex="4" size="35" placeholder="Customer Type">
 </td>
 
   <td align="right" style="padding-top:15px;"><b>Address : </b></td>

<td colspan="">
 <input type="tex"  class="form-control" style="font-weight: bold;" id="addr" readonly="true" name="addr" value="" tabindex="4" placeholder="Customer Address">
 </td>

  </tr>
  <tr>
   <td align="right" style="padding-top:15px;"><b>Contact No. :</b></td>

<td>
<input type="text" id="mob" class="form-control" style="font-weight: bold;" readonly="true" name="mob" value=""  tabindex="4" size="35" placeholder="Customer Contact No.">
 </td>
   <td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

<td>
<input type="text" id="mail" class="form-control" style="font-weight: bold;" readonly="true" name="mail" value="" tabindex="4" size="35" placeholder="Customer E-Mail">
 </td>


</tr>
  <tr>
  <td align="right" style="padding-top:15px">
<b>Branch : </b>
</td>
<td align="left" >

<select name="brncd" class="form-control" tabindex="2" size="1" id="brncd" onchange="getb()"  >
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
  <input type="text" class="form-control"  id="dt"  name="dt" value="<? echo date('d-m-Y');?>" tabindex="3" size="35" placeholder="Enter Date">
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
<td align="center" width="15%" ><b>Quantity</b></td>
<td align="center" width="15%" ><b>Sale Rate</b></td>
<td align="center" width="15%" ><b>Point</b></td>
<td align="center" width="15%"><b>Line Total</b></td>
<td align="center" width="10%"><b>Action</b></td>
</tr>

<tr>
<td > 
<input type="text" id="prnm" name="prnm" class="sc" list="browsers" tabindex="4">
<datalist id="browsers">
<?
 $query3="Select * from ".$DBprefix."bildtls_oth group by prnm";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$prnm=$R3['prnm'];
echo "<option value=\"$prnm\"/>";
}
?>
  </datalist>

</td>

<td>
<input type="text" id="qnty" class="sc" autocomplete="off"  name="qnty" value="" style="text-align:center" onblur="cal()" tabindex="5" size="15" >
</td>
<td>
<div id="p">
<input type="text" class="sc" autocomplete="off" id="prc" name="prc" style="text-align:right" onblur="cal()" value="" tabindex="6" size="15"  >
</div>
</td>
<td>
<div id="po">
<input type="text" id="point" class="sc" autocomplete="off"  name="point" value="" style="text-align:center" tabindex="9"  >
</div>
</td>

<td> 
<input type="text" class="sc" id="lttl"  name="lttl" value="" readonly="true"  style="text-align:right" tabindex="10">
</td>
<td>
<input type="button" class="btn btn-primary" id="Button1" name="" value="Add"  onclick="add()" tabindex="11" style="width:100%;padding:2px" >
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
<tr class="odd" >
<td align="right"><b>Previou Point :</b></td>
<td align="left"><input type="text" class="sc" id="pp" name="pp" readonly></td>
<td align="right"><b>Total Point :</b></td>
<td align="left"><input type="text" class="sc" id="ttpoint" name="ttpoint" readonly></td>
<td align="right"><b>Total Ammount :</b></td>
<td align="left"><input type="text" class="sc" id="ttamnt" name="ttamnt" readonly></td>
<td colspan="6" align="right">
<input type="submit" class="btn btn-success btn-sm" id="Button2" onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="15" value="Submit"  >
</td>
</tr>
	   
	   </table>
</div>
</form>

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
     $('#custnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>

    </body>
</html>