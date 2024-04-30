<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$blno=$_REQUEST['blno'];

$result2 = mysqli_query($conn,"DELETE FROM main_billdtls_edt WHERE blno='$blno'");

$query214 = "insert into main_billdtls_edt (cat,scat,prsl,imei,unit,kg,grm,pcs,srt,adp,prc,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,refno,usl,uval,total,disp,disa,dt,betno,bcd,eby,tamm,rate,stk_rate,cust,bill_typ,tstat,fbcd,tbcd)
select cat,scat,prsl,imei,unit,kg,grm,pcs,srt,adp,prc,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,refno,usl,uval,total,disp,disa,dt,betno,bcd,'$user_currently_loged',tamm,rate,stk_rate,cust,bill_typ,tstat,fbcd,tbcd
from main_billdtls where blno = '$blno'";
$result214 = mysqli_query($conn,$query214)or die (mysqli_error($conn)); 


$data1= mysqli_query($conn,"select * from main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$brncd=$row1['bcd'];
$dt=date('d-m-Y',strtotime($row1['dt']));
$fst=$row1['fst'];
$tst=$row1['tst'];
$cid=$row1['cid'];
$amm=$row1['amm'];
$tamm=$row1['tamm'];
$gstam=$row1['gstam'];
$payam=$row1['payam'];
$inv=$row1['inv'];
$nrtn=$row1['nrtn'];
$invto=$row1['invto'];


$tmod=$row1['tmod'];
$psup=$row1['psup'];
$vno=$row1['vno'];
$lpd=$row1['lpd'];
$no_servc=$row1['no_servc'];
$dur_mnth=$row1['dur_mnth'];
$cust_typ=$row1['cust_typ'];

$sale_per=$row1['sale_per'];
$cbnm=$row1['cbnm'];
$paid=$row1['paid'];
$crdtp=$row1['crdtp'];
$remk=$row1['remk'];
$adl=$row1['adl'];
$roff=$row1['roff'];

$sfno=$row1['sfno'];
$dpay=$row1['dpay'];
$finam=$row1['finam'];
$emiam=$row1['emiam'];
$emi_mnth=$row1['emi_mnth'];
$bill_typ=$row1['bill_typ'];
$dldgr=$row1['dldgr'];
$disl=$row1['disl'];
$remk=$row1['remk'];
$damm=$row1['damm'];
$refsl=$row1['refsl'];
$vat=$row1['vat'];
$mr=$row1['mr'];
$tcs=$row1['tcs'];
$tcsam=$row1['tcsam'];
$ship_addr=$row1['ship_addr'];
$ship_mob=$row1['ship_mob'];
$datad= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$caddr=$rowd['addr'];
}

$datad1= mysqli_query($conn,"select * from main_reference where sl='$refsl'")or die(mysqli_error($conn));
while ($rowd1 = mysqli_fetch_array($datad1))
{
$refnm1=$rowd1['nm'];
}

}
$rult21 = mysqli_query($conn,"SELECT * FROM ".$DBprefix."drcr where cbill='$blno' and nrtn='Payment' and cid='$cid'")or die (mysqli_error($conn));
while($R0=mysqli_fetch_array($rult21))
{
$idt=date('d-m-Y',strtotime($R0['idt']));
$crfno=$R0['mtddtl'];
}

$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$als=$row['als'];
$tp=$row['tp'];
$adrs=$row['adrs'];
$ssn=$row['ssn'];
$stat=$row['stat'];
$brncd=$row['brncd'];
$brand=$row['brand'];
}
$price_lock="";	
if($tp==2 and strtoupper($user_currently_loged)!='ADMIN')
{
$data11= mysqli_query($conn,"SELECT * FROM main_spl where sl>0 and FIND_IN_SET(brand, '$brand')>0 and brncd='$brncd'");
$readon=mysqli_num_rows($data11);
if($readon>0)
{
$price_lock="readonly";	
}
}


$edit_count=get_permission($dt,$bill_edt);
?>
<html>
    
    
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

function isNumber(evt) 
{
var iKeyCode = (evt.which) ? evt.which : evt.keyCode
if(iKeyCode < 48 || iKeyCode > 57)
{
return false;
}
return true;
} 
function isNumber1(evt) 
{
var iKeyCode = (evt.which) ? evt.which : evt.keyCode
if(iKeyCode < 45 || iKeyCode > 57)
{
return false;
}
return true;
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
/*function getb()
{
prnm=document.getElementById('prnm').value;
brncd=document.getElementById('brncd').value;
$("#gbet").load("getbe.php?pcd="+prnm+"&brncd="+brncd).fadeIn('fast');
}
*/
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
				 var aa = stra.shift()
                var fst = stra.shift()
                var sale_per = stra.shift()
                var credit_limit = stra.shift()
				var tcs = stra.shift()
    $('#addr').val(addr);
    $('#mob').val(mob);
    $('#mail').val(mail);
    $('#pbal').val(bal);
    
       $('#sale_per').val(sale_per);
	$('#sale_per').trigger('chosen:updated');
	if(fst!='')
	{
    $('#tst').val(fst);
	$('#tst').trigger('chosen:updated');
	}
	$('#tcs').val(tcs);
 v();
}); 


	}
}
function gtt_unt()
 {
	prnm=document.getElementById('prnm').value;
	unit_nm=document.getElementById('unit_nm').value;
	 $("#g_unt").load("get_unt_sale.php?prnm="+prnm+"&unit_nm="+unit_nm).fadeIn('fast');
 }
function addspnm()
{
	var ctyp=encodeURIComponent(document.getElementById('ctyp').value);
	var nm=encodeURIComponent(document.getElementById('nm').value);
	var addr1=encodeURIComponent(document.getElementById('addr1').value);
	var email=encodeURIComponent(document.getElementById('email').value);
	var mob1=encodeURIComponent(document.getElementById('mob1').value);

$('#adpnm').load("sentrysadd.php?nm="+nm+"&addr="+addr1+"&email="+email+"&mob1="+mob1+"&ctyp="+ctyp).fadeIn('fast');
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

		var tam= parseFloat(document.form1.tamm1.value);if(document.form1.tamm1.value==""){tam=0;}
		var tcs= parseFloat(document.form1.tcs.value);if(document.form1.tcs.value==""){tcs=0;}	
	
		tt=tam;	
		tcsam=(tt*tcs)/100;
		tt=tt+tcsam;
		document.getElementById('tcsam').value=tcsam.round(2);
		document.getElementById('pay').value=Math.round(tt);	
}
function cal()
{
var pcs=parseFloat(document.getElementById('pcs').value);if(document.getElementById('pcs').value==''){pcs=0;}
var prc=parseFloat(document.getElementById('prc').value);if(document.getElementById('prc').value==''){prc=0;}
var total=parseFloat(document.getElementById('total').value);if(document.getElementById('total').value==''){total=0;}
var disp=parseFloat(document.getElementById('disp').value);if(document.getElementById('disp').value==''){disp=0;}
var disa=parseFloat(document.getElementById('disa').value);if(document.getElementById('disa').value==''){disa=0;}
var lttl=parseFloat(document.getElementById('lttl').value);if(document.getElementById('lttl').value==''){lttl=0;}
var cgst_rt=parseFloat(document.getElementById('cgst_rt').value);if(document.getElementById('cgst_rt').value==''){cgst_rt=0;}
var sgst_rt=parseFloat(document.getElementById('sgst_rt').value);if(document.getElementById('sgst_rt').value==''){sgst_rt=0;}
var igst_rt=parseFloat(document.getElementById('igst_rt').value);if(document.getElementById('igst_rt').value==''){igst_rt=0;}
var sgst=0;
var cgst=0;
var igst=0;
var lttl1=0;
var total1=0;
var disa1=0;
total1=(pcs*prc).round(2);
if(disp>0)
{
disa1=(total1*disp/100).round(2);
}
lttl=(total1-disa1).round(2);
/*if(sgst_rt>0)
	{
	var sgst=((lttl*sgst_rt)/100).round(2);
	}
	if(cgst_rt>0)
	{
	var cgst=((lttl*cgst_rt)/100).round(2);
	}
	if(igst_rt>0)
	{
	var igst=((lttl*igst_rt)/100).round(2);
	}
	
*/
	if(sgst_rt>0 && cgst_rt>0)
	{
		
	var Tsgst=((lttl*(sgst_rt+cgst_rt))/(100+sgst_rt+cgst_rt)).round(2);
	sgst=(Tsgst/2).round(2);
	cgst=(Tsgst/2).round(2);
	}
	if(cgst_rt>0)
	{
	/*var cgst=((lttl*cgst_rt)/(100+cgst_rt)).round(2);*/
	}
	if(igst_rt>0)
	{
	var igst=((lttl*igst_rt)/(100+igst_rt)).round(2);
	}
	document.getElementById('sgst_am').value=sgst.round(2);
	document.getElementById('cgst_am').value=cgst.round(2);
	document.getElementById('igst_am').value=igst.round(2);
	net_amm=sgst+cgst+igst+lttl;
	document.getElementById('total').value=total1;	
	document.getElementById('disa').value=disa1;
	document.getElementById('lttl').value=lttl;
	document.getElementById('net_amm').value=lttl.round(2);	
	

}

function cal_back()
{
var total=parseFloat(document.getElementById('total').value);if(document.getElementById('total').value==''){total=0;}
var lttl=parseFloat(document.getElementById('lttl').value);if(document.getElementById('lttl').value==''){lttl=0;}	

var disa=total-lttl;

var disp=((disa*100)/total).round(2);
document.getElementById('disa').value=disa;
document.getElementById('disp').value=disp;
cal();
}
/* function get_cat()  
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;
$("#scat_div").load("get_cat_pur.php?cat="+cat).fadeIn('fast');
$("#prod_div").load("get_product_bill.php").fadeIn('fast');
}
 function get_prod()
 {
$("#prod_div").load("get_product_bill.php").fadeIn('fast');	
}
*/
function get_stock()
{
var prnm=document.getElementById('prnm').value;
var brncd=document.getElementById('bcd').value;
var unit=document.getElementById('unit').value;
var reffno=document.getElementById('reffno').value;
var betno=encodeURIComponent(document.getElementById('betno').value);

$("#gbet").load("getbe.php?pcd="+prnm+"&brncd="+brncd+"&unit="+unit+"&betno="+betno+"&reffno="+reffno).fadeIn('fast');
}


	function add1(stk='')
	{
		
		var prnm=document.getElementById('prnm').value;
		var unit=document.getElementById('unit').value;
		var pcs=document.getElementById('pcs').value;
		var prc=document.getElementById('prc').value;
		var total=document.getElementById('total').value;
		var disp=document.getElementById('disp').value;
		var disa=document.getElementById('disa').value;
		var lttl=document.getElementById('lttl').value;
		var cgst_rt=document.getElementById('cgst_rt').value;
		var sgst_rt=document.getElementById('sgst_rt').value;
		var igst_rt=document.getElementById('igst_rt').value;
		var cgst_am=document.getElementById('cgst_am').value;
		var sgst_am=document.getElementById('sgst_am').value;
		var igst_am=document.getElementById('igst_am').value;
		var brncd=document.getElementById('brncd').value;
		var refno=document.getElementById('refno').value;
		var  fst=document.getElementById('fst').value;
		 var tst=document.getElementById('tst').value;
		 var usl=document.getElementById('usl').value;
		 var net_amm=document.getElementById('net_amm').value;
		 var betno=encodeURIComponent(document.getElementById('betno').value);
		 var bcd=document.getElementById('bcd').value;
		 var tsl=document.getElementById('tsl').value;
		 var blno=encodeURIComponent(document.getElementById('blno').value);
		var bill_typ=document.getElementById('bill_typ').value;
	
		if(prnm=='')
		{
		alert("Product Can't be blank");
		}
		else if(lttl=='')
		{
		alert("Amount Can't be blank");	
		}
		else if(net_amm=='')
		{
		alert("Net Amount Can't be blank");	
		}
		else if(bill_typ=='')
		{
		alert("Please Select Bill Type ...");
		}
		else
		{
		
	//$('#wb_Text13').load('adtmppr.php?prnm='+prnm+'&pcs='+pcs+'&prc='+prc+'&lttl='+lttl+'&brncd='+brncd+'&fst='+fst+'&tst='+tst+'&cgst_rt='+cgst_rt+'&sgst_rt='+sgst_rt+'&igst_rt='+igst_rt+'&cgst_am='+cgst_am+'&sgst_am='+sgst_am+'&igst_am='+igst_am+'&refno='+encodeURIComponent(refno)+'&unit='+unit+'&usl='+usl).fadeIn('fast');
	$('#wb_Text13').load('adtmppr_edt.php?prnm='+prnm+'&unit='+unit+'&pcs='+pcs+'&prc='+prc+'&total='+total+'&disp='+disp+'&disa='+disa+'&lttl='+lttl+'&brncd='+brncd+'&fst='+fst+'&tst='+tst+'&cgst_rt='+cgst_rt+'&sgst_rt='+sgst_rt+'&igst_rt='+igst_rt+'&cgst_am='+cgst_am+'&sgst_am='+sgst_am+'&igst_am='+igst_am+'&refno='+encodeURIComponent(refno)+'&usl='+usl+'&bcd='+bcd+'&betno='+betno+'&tsl='+tsl+'&blno='+blno+'&bill_typ='+bill_typ+'&stk='+stk).fadeIn('fast');
		}
	
		
	}
	function reset()
	{
	    document.getElementById('prc').value=0;
		/*document.getElementById('unit').value='';
		document.getElementById('pcs').value='';
		document.getElementById('prc').value='';
		document.getElementById('total').value='';
		document.getElementById('disp').value='';
		document.getElementById('disa').value='';
		document.getElementById('lttl').value='';
		document.getElementById('cgst_rt').value='';
		document.getElementById('sgst_rt').value='';
		document.getElementById('igst_rt').value='';
		document.getElementById('cgst_am').value='';
		document.getElementById('sgst_am').value='';
		document.getElementById('igst_am').value='';
		document.getElementById('net_amm').value='';
		document.getElementById('usl').value='';
		
		$('#refno option').each(function() {
        $(this).remove();}); 
		*/
		document.getElementById('betno').value='';
		document.getElementById('tsl').value='';
		document.getElementById('unit_nm').value='';
		document.getElementById('reffno').value='';
		document.getElementById('betnoo').value='';
		
			document.getElementById('total').value='';
		document.getElementById('disp').value='';
		document.getElementById('disa').value='';
		document.getElementById('lttl').value='';
		document.getElementById('cgst_rt').value='';
		document.getElementById('sgst_rt').value='';
		document.getElementById('igst_rt').value='';
		document.getElementById('cgst_am').value='';
		document.getElementById('sgst_am').value='';
		document.getElementById('igst_am').value='';
		document.getElementById('net_amm').value='';


	}
	
function temp()
	{
var blno=encodeURIComponent(document.getElementById('blno').value);
$('#wb_Text13').load("tmppr_bill_edt.php?blno="+blno).fadeIn('fast');
$('#fst_div').load("fst_get1_edt.php?blno="+blno).fadeIn('fast');
$('#tst_div').load("tst_get1_edt.php?blno="+blno).fadeIn('fast');

}
function deltpr(un,sl)
{
$('#wb_Text13').load("deltpr_edt.php?sl="+sl+"&tsl="+un).fadeIn('fast');
}
function t()
	{
	var blno=encodeURIComponent(document.getElementById('blno').value);
	$('#billamm').load('stotal-gst-edt.php?blno='+blno).fadeIn('fast');
	$('#gst_am').load('gst-am-edt.php?blno='+blno).fadeIn('fast');
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
function get_gst()
{
var fst=document.getElementById('fst').value;	
var tst=document.getElementById('tst').value;
if(fst==tst)	
{
document.getElementById("sgst_am").readOnly = false;	
document.getElementById("cgst_am").readOnly = false;	
document.getElementById("igst_am").readOnly = true;
}
else
{
document.getElementById("sgst_am").readOnly = true;	
document.getElementById("cgst_am").readOnly = true;	
document.getElementById("igst_am").readOnly = false;
	
}
get_gstval();
} 
function get_gstval()
{
dt=document.getElementById('dt').value;	
prnm=document.getElementById('prnm').value;	
var fst=document.getElementById('fst').value;	
var tst=document.getElementById('tst').value;
$.get('get_gst.php?&dt='+dt+'&prnm='+prnm, function(data) 
{
        
                var str= data
				var stra = str.split("@")
				var cgst = stra.shift()
				var sgst = stra.shift()  
                var igst = stra.shift() 
if(fst==tst)	
{
igst=0;	
}	
else
{
cgst=0;	
sgst=0;	
}	
    $('#cgst_rt').val(cgst);
    $('#sgst_rt').val(sgst);
	
    $('#igst_rt').val(igst);
     cal();
}); 

}
   Number.prototype.round = function(places) {
  return +(Math.round(this + "e+" + places)  + "e-" + places);
}
function get_prc()
{
var prnm=document.getElementById('prnm').value;	
var unit=document.getElementById('unit').value;	
var cust_typ=document.getElementById('cust_typ').value;	
var prc=document.getElementById('prc1').value;	
var spl=document.getElementById('spl').value;	
$("#getp").load("getp.php?prnm="+prnm+'&unit='+unit+'&cust_typ='+cust_typ+'&prc='+prc+'&spl='+spl).fadeIn('fast');	

}
function get_betno()
{
    
prnm=document.getElementById('prnm').value;	
bcd=document.getElementById('bcd').value;	
betnoo=document.getElementById('betnoo').value;	
$("#g_betno").load("get_betno.php?prnm="+prnm+'&bcd='+bcd+'&betnoo='+betnoo).fadeIn('fast');	
}
function check()
{
if (confirm("Are Sure To Sale ?")) 
{	
document.forms["form1"].submit();
} 
}
function getgwn()
{
var brncd=document.getElementById('brncd').value;
var cat=document.getElementById('cat1').value;
brncd=document.getElementById('brncd').value;		
$("#g_gwn").load("get_gwn_sale.php?brncd="+brncd+"&brncd="+brncd+"&cat="+cat).fadeIn('fast');
}
function godown()
{
 var brncd=document.getElementById('brncd').value;
var cat=document.getElementById('cat1').value;   
prnm=document.getElementById('prnm').value;	
$("#g_gwn").load("get_gwn_sale.php?prnm="+prnm+"&brncd="+brncd+"&cat="+cat).fadeIn('fast');	
}

function get_scat(scat='')  
{
var cat= document.getElementById('cat1').value;
$("#scatdiv").load("get_scat_sale.php?cat="+cat+"&scat="+scat).fadeIn('fast');
}

function get_prod(psl='')
{
var scat=document.getElementById('scat1').value;
var cat=document.getElementById('cat1').value;
var brnd=document.getElementById('brnd1').value;
$("#prod_div").load("get_product_sale.php?cat="+cat+"&scat="+scat+"&psl="+psl+"&brnd="+brnd).fadeIn('fast');	
}

function view(blno)
{
var damm=document.getElementById('damm').value;
var disl=document.getElementById('disl').value;
window.open('bill_new_gst_temp.php?blno='+encodeURIComponent(blno)+'&disl='+disl+'&damm='+damm, '_blank');
window.focus();
}
function cust_srch(tp)
{
var cs=encodeURIComponent(document.getElementById('cs').value);
var brncd=document.getElementById('brncd').value;
var brand=document.getElementById('brnd1').value;
$("#cust_src").load("get_cust_src.php?cs="+cs+"&brncd="+brncd+"&brand="+brand+"&tp="+tp).fadeIn('fast');	
}
function cust_srch1(tp)
{
var cs=encodeURIComponent(document.getElementById('cs1').value);
if((!isNaN(cs) && cs.length>9) || (isNaN(cs) && cs.length>2)){
$("#cust_src1").load("get_cust_src1_edit.php?cs="+cs+"&tp="+tp).fadeIn('fast');	
}
}
</script>
</head>
<body onload="temp()" >
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">
                <!-- Content Header (Page header) -->
              

                <!-- Main content -->
                <section class="content">
                   
<form method="post" target="" name="form1" id="form1"  action="<?php if($edit_count>0){?>billing_edits.php<?php }else{echo "#";}?>">
<input type="hidden" class="form-control" value="<?=$bill_typ;?>"  tabindex="1"  name="bill_typ" id="bill_typ" >  	
<input type="hidden"  class="form-control" name="blno" id="blno" value="<?php echo $blno;?>">
<input type="hidden"  class="form-control" name="prc1" id="prc1" value="">
<input type="hidden" class="form-control" value="<?=$brand;?>"  tabindex="1"  name="brnd1" id="brnd1" >  
<input type="hidden" class="form-control" value="<?php echo $price_lock;?>"  tabindex="1"  name="spl" id="spl" >  
 <div class="box box-success" >
<b>Invoice Details : </b>
  <center>
 <table border="0" width="860px" class="table table-hover table-striped table-bordered">
  <tr>
  <td align="left" style="padding-top:15px;" width="35%"><b>Ledger Name :</b>
  <input type="text" id="cs" name="cs" value="cash" onblur="cust_srch('<?php echo $tp;?>')" placeholder="Contact No/Name">
   <div id="cust_src">
	<select id="custnm" name="custnm" tabindex="1"  class="form-control"  onchange="gtid()" >
	
	<?
	if($tp=='2'){$qury=" and find_in_set(brand,'$brand')>0 ";}
		$query="select * from main_cust  WHERE sl>0 and brncd='$brncd' and sl='$cid' $qury order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			$typ1=$rw['typ'];
			
		?>
		<option value="<?=$rw['sl'];?>" <?if($cid==$rw['sl']){?> selected <? } ?>><?=$rw['nm'];?> <?if($rw['cont']!=""){?>( <?=$rw['cont'];?> )<?}?></option>
		<?
		}
	?>
	</select>
</div>
  </td>
	<td align="right" style="padding-top:15px;display:none;" ><b>Contact No. :</b></td>
	<td style="display:none;">
	<input type="text" id="mob" class="form-control" style="font-weight: bold;" readonly="true" name="mob" value=""  tabindex="1" size="35" placeholder="Customer Contact No.">
	</td>
	
	<td align="left" style="padding-top:15px;" width="35%" ><b>Customer Name : </b>
		<input type="text" id="cs1" name="cs1" size="40" value="" onkeyup="cust_srch1('<?php echo $tp;?>')"  placeholder="Enter 3 Digit Name / 10 Digit Mobile No.">
		<div id="cust_src1">
	<select id="invto" name="invto" tabindex="1"  class="form-control"   >
	<option value="">---Select---</option>
	<?
	$query="select * from main_cust  WHERE sl>0  and typ='1' and sl='$invto' order by nm";
	$result=mysqli_query($conn,$query);
	while($rw=mysqli_fetch_array($result))
	{
	$typ1=$rw['typ'];				
	?>
	<option value="<?=$rw['sl'];?>" <?if($rw['sl']==$invto){?> selected <? } ?>><?=$rw['nm'];?> <?if($rw['cont']!=""){?>( <?=$rw['cont'];?> )<?}?> <?if($rw['addr']!=""){?>( <?=$rw['addr'];?> )<?}?></option>
	<?
	}
	?>
	</select>
	</div>
	<input type="hidden"  class="form-control" style="font-weight: bold;" id="addr" readonly="true" name="addr" value="" tabindex="3" placeholder="Customer Address">
	</td>
	
	
	<td align="left" style="padding-top:15px;display:none;" width="35%" ><b>Address : </b> 
	<input type="text"  class="form-control" style="font-weight: bold;" id="addr" readonly="true" name="addr" value="<?php echo $caddr;?>" tabindex="3" placeholder="Customer Address">
	</td>
	<td align="left" style="padding-top:15px"><b>Branch : </b>
	<select name="brncd" class="form-control" tabindex="1" size="1" id="brncd">
	<?

	$query="Select * from main_branch where sl='$brncd'";

	   $result = mysqli_query($conn,$query);
	while ($R = mysqli_fetch_array ($result))
	{
	$sl=$R['sl'];
	$bnm=$R['bnm'];

	?>
	<option value="<? echo $sl;?>"  <?if($brncd==$sl){?> selected <? } ?>><? echo $bnm;?></option>
	<?
	}
	?>
	</select>
	</td>
	
</tr>
<tr style="display:none;">

   <td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

	<td colspan="">
	<input type="text" id="mail" class="form-control" style="font-weight: bold;" readonly="true" name="mail" value="" tabindex="1" size="35" placeholder="Customer E-Mail">
	</td>
</tr>

<tr style="display:none;">
<td align="right" style="padding-top:15px;"> <b>From State : </b>


</td>
	<td >
	<div id="fst_div">
	<select id="fst" data-placeholder="Choose Your Supplier" name="fst"  tabindex="1" class="form-control" onchange="get_gst()" >

	<?
	$sql="SELECT * FROM main_state WHERE sl='1' ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	?>
	<option value="<?=$row['sl'];?>"<?if($fst==$row['sl']){?> selected <? } ?>><?=$row['sn'];?> - <?=$row['cd'];?></option>
	<?}?>
	</select>
	</div>
	</td>
	<td align="right" style="padding-top:15px;"> <b>To State : </b>
	
		<div id="tst_div">
	<select id="tst" data-placeholder="Choose Your Supplier" name="tst"  tabindex="1" class="form-control" onchange="get_gst()"  >

	<?
	$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	?>
	<option value="<?=$row['sl'];?>"<?if($tst==$row['sl']){?> selected <? } ?>><?=$row['sn'];?> - <?=$row['cd'];?></option>
	<?}?>
	</select>
	</div>
	</td>
	<td>

	</td>
</tr>
<tr>
	<td align="left" style="padding-top:15px;"> <b>Date : </b>
	<input type="text" class="form-control"  id="dt"  name="dt" value="<? echo $dt;?>" tabindex="1" size="35" placeholder="Enter Date">
	</td>
	<td align="left" style="padding-top:15px;"> <b>Bill Type : </b>
	<select id="cust_typ" name="cust_typ" class="form-control" onchange="get_prc()" tabindex="1">
	<?
	$p=mysqli_query($conn,"select * from main_cus_typ where sl='$tp'") or die (mysqli_error($conn));
	while($rw2=mysqli_fetch_array($p))
	{
	?>
	<option value="<?=$rw2['sl'];?>" <?if($cust_typ==$rw2['sl']){echo 'selected';}?>><?=$rw2['tp'];?></option>
	<?
	}
	?>
	</select>
	</td>
	<?if($tp!=1){?>
	<td align="left" style="padding-top:15px;"><b>Transportation Mode : </b>
	<input type="text"  class="form-control" style="font-weight: bold;" id="tmod" name="tmod" value="<?=$tmod;?>" tabindex="1" >
	</td>
	<?}?>
</tr>
<?if($tp!=1){?>
<tr>
	<td align="left" style="padding-top:15px;"><b>Place Of Supply :</b>
	<input type="text" id="psup" class="form-control" style="font-weight: bold;" name="psup" value="<?=$psup;?>" tabindex="1" size="35" >
	</td>
	<td align="left" style="padding-top:15px;"><b>Vehicle Number : </b>
	<input type="text"  class="form-control" style="font-weight: bold;" id="vno" name="vno" value="<?=$vno;?>" tabindex="1" >
	</td>
	<td align="left" style="padding-top:15px;"><b>Last Payment Days</b>
	<input type="text"  class="form-control" style="font-weight: bold;" id="lpd" name="lpd" value="<?=$lpd;?>" tabindex="1" onkeypress="return isNumber(event)" >
	</td>
</tr>
<?}?>
<tr>

<?if($tp!=2){?>

	<td align="left" style="padding-top:15px;"><b>No. of Service : </b>
	<input type="text"  class="form-control" style="font-weight: bold;" id="no_servc" name="no_servc" value="<?=$no_servc;?>" tabindex="1" onkeypress="return isNumber(event)" >
	</td>
	<td align="left" style="padding-top:15px;"><b>Month Duration</b>
	<input type="text"  onkeypress="return isNumber(event)" maxlength="4" class="form-control" style="font-weight: bold;" value="<?=$dur_mnth;?>" id="dur_mnth" name="dur_mnth" tabindex="1" onkeypress="return isNumber(event)">
	</td>
<?}?>
	<td align="left" style="padding-top:15px;" width="35%"><b>Sales Person :</b></br>
	<select id="sale_per" name="sale_per" tabindex="1"  class="form-control">
	<option value="">---Select---</option>
	<?
		$queryss="select * from main_sale_per  WHERE sl>0 order by spid";
		$resultss=mysqli_query($conn,$queryss);
		while($rwss=mysqli_fetch_array($resultss))
		{
			$spid=$rwss['spid'];
			$spnm=$rwss['nm'];
		?>
			<option value="<?=$spid;?>"<?if($spid==$sale_per){?> selected <? } ?>><?=$spid;?></option>
			<?
		}
	?>
	</select>

  </td>
   <?
if($tp==2)
{
?>
<td><b>Shipping Address</b><br>
<input type="text" id="ship_addr" class="form-control" style="font-weight: bold;" name="ship_addr" value="<?php echo $ship_addr;?>" tabindex="1" size="35" >
</td>
<td><b>Mobile</b><br>
<input type="text" id="ship_mob" class="form-control" style="font-weight: bold;" name="ship_mob" value="<?php echo $ship_mob;?>" tabindex="1" size="35" >
</td>
<?}?> 
</tr>
<?php
if($tp!=2)
{
?>
<tr>
<td><b>Shipping Address</b><br>
<input type="text" id="ship_addr" class="form-control" style="font-weight: bold;" name="ship_addr" value="<?php echo $ship_addr;?>" tabindex="1" size="35" >
</td>
<td><b>Mobile</b><br>
<input type="text" id="ship_mob" class="form-control" style="font-weight: bold;" name="ship_mob" value="<?php echo $ship_mob;?>" tabindex="1" size="35" >
</td>
<td>
    </td>
</tr>
<?php } ?>

</table>
</div>

<div class="box box-success"><b>Model Details :</b>
<table  width="100%">
<tr>
<td width="15%">

<select name="cat1" class="form-control" size="1" id="cat1" tabindex="1" onchange="get_scat();get_prod()">
<Option value="">---Brand---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_catg where stat='0' and find_in_set(sl,'$brand')>0 order by cnm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['cnm'];
echo "<option value='".$sl."' selected>".$cnm."</option>";
}
?>
</select>
</td>
<td  width="15%">
<div id="scatdiv">
<select name="scat1" class="form-control" size="1" id="scat1" tabindex="1" onchange="get_prod()">
<Option value="">---Category---</option>
<?
$data2 = mysqli_query($conn,"Select * from main_scat where stat='0' and find_in_set(cat,'$brand')>0 order by nm");
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
<td align="right" style="padding-right:8px;">
<a href="javascript:onclick=view('<?=$blno;?>')" class="btn btn-info btn-sm">Print</a>
</td>
</tr>
</table>
<table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td  colspan="21">
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="11%"><b>Model</b></td>
<td  align="left" width="6%"><b>Godown</b></td>
<td align="center" width="10%"><b>Serial No.</b></td>
<td  align="center" width="5%"><b>Unit</b></td>
<td align="center" width="6%"><b>Stock In Hand</b></td>
<td align="center" width="3%" ><b>Quantity</b></td>
<td align="center" width="4%" ><b>Sale Rate</b></td>
<td align="center" width="6%"><b>Total</b></td>
<td align="center" width="4%"><b>Dis.%</b></td>
<td align="center" width="5%"><b>Dis. Am.</b></td>
<td align="center" width="5%"><b>Taxable Val.</b></td>
<td align="center" width="3%"><B>C-GST%</B></td>
<td align="center" width="5%"><B>C-GST Am.</B></td>
<td align="center" width="3%"><B>S-GST%</B></td>
<td align="center" width="5%"><B>S-GST Am.</B></td>
<td align="center" width="3%"><B>I-GST%</B></td>
<td align="center" width="5%"><B>I-GST Am.</B></td>
<td align="center" width="7%" ><b>Net Amount</b></td>
<td align="center" width="4%"><b>Action</b></td>
</tr>
<tr>

<input type="hidden" class="sc" autocomplete="off" id="kg" name="kg" readonly style="text-align:center" onblur="cal()"  value="" tabindex="11" size="15"  >
<input type="hidden" id="grm" class="sc" autocomplete="off"  name="grm" readonly value="" style="text-align:center" onblur="cal()" maxlength="3" tabindex="12" size="15" >

<input type="hidden" id="scat" class="sc" name="scat" readonly>
<input type="hidden" id="cat" class="sc" name="cat" readonly>
<input type="hidden" id="tsl" class="sc" name="tsl" readonly>
<input type="hidden" id="unit_nm" class="sc" name="unit_nm" readonly>
<input type="hidden" id="reffno" class="sc" name="reffno" readonly>
<input type="hidden" id="betnoo" class="sc" name="betnoo" readonly>


<td>
<div id="prod_div">
<select id="prnm" name="prnm" class="form-control"  tabindex="1" onchange="get_betno();gtt_unt();get_gstval();godown()">
<option value="">---Select---</option>
</select>
</div>
</td>
<td align="left" >
<div id="g_gwn">
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" onchange="gtt_unt()">
<?
$datag= mysqli_query($conn,"SELECT * FROM main_a_sale_chln where sl>0 and branch='$brncd' and stat='0'") or die(mysqli_error($conn));
$count1=mysqli_num_rows($datag);
if($branch_code==3)
{
$geti=mysqli_query($conn,"select * from main_godown where sl='4'") or die(mysqli_error($conn));
    
}
else
{
$geti=mysqli_query($conn,"select * from main_godown order by gnm") or die(mysqli_error($conn));
}
while($rowi=mysqli_fetch_array($geti))
{
$sl=$rowi['sl'];
$gnm=$rowi['gnm'];
$bnm=$rowi['bnm'];
$datag= mysqli_query($conn,"SELECT * FROM main_a_sale_chln where sl>0 and branch='$brncd' and  FIND_IN_SET('$sl', bill_godown)>0  and stat='0'") or die(mysqli_error($conn));
$count=mysqli_num_rows($datag);
$disabled="";
if($count1>0){$disabled=" selected";}
if($count==0 and $count1>0){$disabled=" disabled";}
?>
<option value="<? echo $sl;?>"<?php  echo $disabled;?>><? echo $gnm;?></option>
<?
}
?>
</select>
</div>
</td>

<td>
<div id="g_betno">
<input type="text" class="sc" autocomplete="off" id="betno"  name="betno" style="text-align:left" onblur="spaces(this.value)" value="" tabindex="1" size="15"  >
</div>
</td>

<td>
<div id="g_unt">
<select id="unit" name="unit" class="sc1" style="width:100%"  tabindex="1" onchange="get_stock()">
<option value="">---Select---</option>
</select>
</div>
</td>
<td>
<div id="gbet">
<input type="text" class="sc" autocomplete="off" id="sih" readonly name="sih" style="text-align:center"  value="" tabindex="1" size="15"  >
</div>
</td>


<td>
<input type="text" id="pcs" class="sc" autocomplete="off"  name="pcs" style="text-align:center" onblur="cal()" tabindex="1" onkeypress="return isNumber(event)"  >
</td>
<input type="hidden" class="sc" id="adp"  name="adp" value="0"  style="text-align:center" onblur="cal()" tabindex="1">

<td> 
<div id="getp">
<input type="text" class="sc" id="prc"  name="prc" value=""  style="text-align:right" onblur="cal()" <?php echo $price_lock;?> tabindex="1" onkeypress="return isNumber1(event)">
</div>
</td>
<td> 
<input type="text" class="sc" id="total" readonly name="total" value="" style="text-align:right" tabindex="1" onkeypress="return isNumber1(event)">
</td>
<td> 
<input type="text" class="sc" id="disp"  name="disp" value="" style="text-align:right" onblur="cal()" <?php echo $price_lock;?> tabindex="1" onkeypress="return isNumber1(event)">
</td>
<td> 
<input type="text" class="sc" id="disa"  name="disa" value="" style="text-align:right" tabindex="1" <?php echo $price_lock;?> onkeypress="return isNumber1(event)">
</td>
<td> 
<input type="text" class="sc" id="lttl"  name="lttl" value="" style="text-align:right" tabindex="1" onblur="cal_back()" onkeypress="return isNumber1(event)">
</td>
<td align="center">
<input type="text" name="cgst_rt" id="cgst_rt" class="sc" tabindex="1" readOnly class="sc" onfocus="this.select();"  style="text-align:center" onkeypress="return isNumber1(event)">
</td>
<td  align="center">
<input type="text" name="cgst_am" id="cgst_am" class="sc" tabindex="1" class="sc" onfocus="this.select();"  style="text-align:right" onkeypress="return isNumber1(event)">
</td>
<td  align="center">
<input type="text" name="sgst_rt" id="sgst_rt" class="sc" tabindex="1" readOnly class="sc" onfocus="this.select();"  style="text-align:center" onkeypress="return isNumber1(event)">
</td>
<td  align="center">
<input type="text" name="sgst_am" id="sgst_am" class="sc" tabindex="1" class="sc" onfocus="this.select();"  style="text-align:right" onkeypress="return isNumber1(event)">
</td>
<td  align="center">
<input type="text" name="igst_rt" id="igst_rt" class="sc" tabindex="1" readOnly class="sc" onfocus="this.select();"  style="text-align:center" onkeypress="return isNumber1(event)">
</td>
<td align="center">
<input type="text" name="igst_am" id="igst_am" class="sc" readOnly tabindex="1" class="sc" onfocus="this.select();"  style="text-align:right" onkeypress="return isNumber1(event)">
</td>
<td>
<input type="text" class="sc" id="net_amm" name="net_amm" value="" tabindex="1" readonly  autocomplete="off"  style="text-align:right" onkeypress="return isNumber1(event)">
</td>
<td class="upd">
<input type="button" class="btn btn-primary" id="Button1" name="" value="Add"  onclick="add1()" tabindex="1" style="width:100%;padding:2px" >
</td>
</tr>
</table>
   </td>
	   </tr>
	       <tr height="180px">
	   <td colspan="21">
	<div id="wb_Text13" >
x
		</div>
	  	</td>
	   </tr>


<tr>
<input type="hidden" name="dis" id="dis"  readOnly onblur="v()" value=""  tabindex="1" class="form-control"  style="text-align:right">
<input type="hidden" name="car" id="car"  readOnly onblur="v()" value=""  tabindex="1" class="form-control"  style="text-align:right">
<input type="hidden" name="vat" id="vat" onblur="v()" readOnly class="form-control"  tabindex="1" style="text-align:right" >
<input type="hidden" name="vatamm" id="vatamm" class="form-control"  tabindex="1" style="background-color:#f3f4f5;text-align:right" readonly="true" >
<td>
<b>Reference :</b>
<input type="text" id="reference" class="form-control"  name="reference" list="reflist" value="<?php echo $refnm1;?>">
<datalist id="reflist">
<?php 
$geti12=mysqli_query($conn,"select * from main_reference order by sl") or die(mysqli_error($conn));
while($rowi12=mysqli_fetch_array($geti12))
{
	$refnm=$rowi12['nm'];
?>
<option value="<?php echo $refnm;?>">

<?php }?>
</datalist>
</td>
<td align="left" ><b>Bill Amount :</b><br>
<font >
<b>
<div id="billamm">
<input type="text" name="tamm" id="tamm" class="form-control" value="<?php echo $tamm;?>"  tabindex="1" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true" onkeypress="return isNumber1(event)"> 
</div>
</b>
</font>
</td>
<td align="left" ><b>Tax Amount : GST :</b><br>
<div id="gst_am">
<input type="text" name="gst" id="gst"  readOnly  value="<?php echo $gstam;?>"   tabindex="1" class="form-control"  style="text-align:right" onkeypress="return isNumber1(event)">
</div>
</td>
<td align="left" hidden><b>Previous Balance :</b><br>
<font>
<b>
<input type="text" name="pbal" id="pbal" class="form-control"  tabindex="1" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 
</b>
</font>
</td>
<td align="left" ><b>TCS@% :</b><br>
<div id="gst_am">
<input type="text" name="tcs" id="tcs"  readOnly  value="<?php echo $tcs;?>"  tabindex="1" class="form-control"  style="text-align:right" onkeypress="return isNumber1(event)">
</div>
</td>
<td align="left" ><b>TCS Amount :</b><br>
<div id="gst_am">
<input type="text" name="tcsam" id="tcsam"     value="<?php echo $tcsam;?>"  tabindex="1" class="form-control"  style="text-align:right" onkeypress="return isNumber1(event)">
</div>
</td>

<td align="left" ><b>Pay Amount :</b><br>
<font>
<b>
<input type="text" name="pay" id="pay" class="form-control" value="<?php echo $payam;?>" tabindex="1" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true" onkeypress="return isNumber1(event)"> 
</b>
</font>
</td>
</tr>
<tr>
<td align="left" colspan="6">
<b>Note : </b>
<textarea id="mr" name="mr" class="form-control"><?php echo $mr;?></textarea>
</td>
</tr>

</table>
</div>

<div class="box box-success" >
   <?
if($tp!=2)
{
?>
<b>Payment Details :</b>
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="left" width="33%">
<font color="red">*</font><b>Cash Or Bank Ac. :</b>
<select  name="dldgr" id="dldgr"   class="form-control"  tabindex="1">
<?php 
$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>"<?=$row['sl'] == $dldgr ? 'selected' : '' ?>><?=$row['nm']?></option>
<?php 
} 
?>
</select>
</td>

<td width="33%"><b>Payment Mode: </b>
<select name="mdt" size="1" id="mdt" tabindex="1" onchange="pmod(this.value)" class="form-control">
<?
$data2 = mysqli_query($conn,"select * from ac_paymtd ");

while ($row2 = mysqli_fetch_array($data2))
{
$mtd = $row2['mtd'];
$msl = $row2['sl'];
?>
<option value="<?=$msl;?>"<?=$msl == $crdtp ? 'selected' : '' ?>><?=$mtd;?></option>
<?php 
}
?>
</select>
</td>
<td width="33%"><b>Payment Amount:</b> 
<input type="text" class="form-control" id="pamm" name="pamm" value="<?php echo $paid;?>"  tabindex="1" placeholder ="Enter Payment Amount"  onkeypress="return isNumber1(event)">
</td>
</tr>

<tr id="gtdl1" style="display:none">
<td>
<b>Reference No: </b>
<input type="text" class="form-control" id="crfno"  name="crfno" value="<?php echo $crfno;?>"  tabindex="1" value="" >
</td>
<td>
<b>Date: </b>
<input type="text" class="form-control" id="idt" name="idt" value="<?php echo $idt;?>"  tabindex="1" readonly >
</td>

<td>
<b>Issued By:</b>
<input type="text" class="form-control" id="cbnm"  name="cbnm" value="<?php echo $cbnm;?>"  tabindex="1" >
</td>
</tr>

<tr>
<td><b>	Discount Ledger :</b> <br>
<select  name="disl" id="disl" class="form-control" >
<option value="">-- Select --</option>
<?php 
$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='17'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>"<?if($disl==$row['sl']){echo 'selected';}?>><?=$row['nm']?></option>
<?php 
} 
?>
</select>
</td>
<td><b>Discount Remark :</b> <br>
<input  type="text" name="remk" id="remk" value="<?=$remk;?>" class="form-control">
</td>
<td><b>	Discount Am. :</b> <br>
<input  type="text" name="damm" id="damm" value="<?=$damm;?>" class="form-control"onkeypress="return isNumber1(event)">
</td>

</tr>

<tr >
<td align="left" colspan="3" style="background-color:#f1f19b;"><font color="black" size="4"><b>Finance Details : -</b></font></td>
</tr>

<tr>
<td>
<b>Do Number :</b>
<input type="text" class="form-control" id="dealId" name="dealId"  value="<?php echo $vat;?>"> 
</td>    
<td><b>Ref / SF No.:</b> 
<input type="text" class="form-control" id="sfno" name="sfno" value="<?php echo $sfno;?>">
</td>
<td><b>Down payment:</b> 
<input type="text" class="form-control" id="dpay" name="dpay" value="<?php echo $dpay;?>"  tabindex="1" style="text-align:right;" onkeypress="return isNumber1(event)">
</td>


</tr>
<tr>
    <td><b>Finance Amount :</b> 
<input type="text" class="form-control" id="finam" name="finam" value="<?php echo $finam;?>"  tabindex="1" style="text-align:right;" onkeypress="return isNumber1(event)">
</td>
<td><b>EMI Amount.:</b> 
<input type="text" class="form-control" id="emiam" name="emiam" value="<?php echo $emiam;?>"  tabindex="1" style="text-align:right;" onkeypress="return isNumber1(event)">
</td>
<td><b>EMI Month:</b> 
<input type="text" class="form-control" id="emi_mnth" name="emi_mnth" value="<?php echo $emi_mnth;?>" onkeypress="return isNumber(event)">
</td>

</tr>
<tr>
<td colspan="3" align="right"><br>
<?php if($edit_count>0){?>
<input type="button" class="btn btn-success btn-sm" id="Button2" onclick="check()" name="bt1" tabindex="1" value="Submit"  >
<?php } ?>
</td>
</tr>
</table>
<?}
else
{
?>
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right"><br>
<?php if($edit_count>0){?>
<input type="button" class="btn btn-success btn-sm" id="Button2" onclick="check()" name="bt1" tabindex="1" value="Submit"  >
<?php } ?>
</td>
</tr>
</table>
<?
	
}
?>
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

$('#prnm').chosen({no_results_text: "Oops, nothing found!",});	
$('#custnm').chosen({no_results_text: "Oops, nothing found!",});
$('#fst').chosen({no_results_text: "Oops, nothing found!",}); 
$('#tst').chosen({no_results_text: "Oops, nothing found!",});
$('#bcd').chosen({no_results_text: "Oops, nothing found!",});
$('#sale_per').chosen({no_results_text: "Oops, nothing found!",});
$('#invto').chosen({no_results_text: "Oops, nothing found!",});
$('#disl').chosen({no_results_text: "Oops, nothing found!",});
$('#cat1').chosen({
no_results_text: "Oops, nothing found!",
});
$('#scat1').chosen({
no_results_text: "Oops, nothing found!",
});
get_prod(); 
get_scat(); 

</script>
<script>
function get_data(tsl,bcd,prsl,betno,unit,refno,pcs,prc,total,disp,disa,ttl,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,cat,scat,pnm)
{ 
		document.getElementById('tsl').value=tsl;
		
$('#prnm').append('<option value="'+prsl+'">'+pnm+'</option>');
document.getElementById('cat1').value=cat;
$('#cat1').trigger("chosen:updated");	
get_scat(scat);

		document.getElementById('prnm').value=prsl;
		//$('#prnm').trigger("chosen:updated");
		$("#prnm").attr("disabled","disabled").trigger('chosen:updated');
		document.getElementById('bcd').value=bcd;		
		//$('#bcd').trigger("chosen:updated");
	//	$("#bcd").attr("disabled","disabled").trigger('chosen:updated');		
		document.getElementById('betnoo').value=betno;
		document.getElementById('unit_nm').value=unit;
		document.getElementById('reffno').value=refno;
		$('#g_betno').html('<input type="text" class="sc" value="'+betno+'" autocomplete="off" id="betno" name="betno" style="text-align:left;"  value="" tabindex="15" size="15">');
		document.getElementById('pcs').value=pcs;
		document.getElementById('pcs').readOnly = true;
		document.getElementById('prc').value=prc;
		document.getElementById('prc1').value=prc;
		//document.getElementById('prc').readOnly = true;
		document.getElementById('total').value=total;
		document.getElementById('total').readOnly = true;
		document.getElementById('disp').value=disp;
		
		document.getElementById('disa').value=disa;
		document.getElementById('disa').readOnly = true;
		document.getElementById('lttl').value=ttl;
		document.getElementById('lttl').readOnly = true;
		document.getElementById('cgst_rt').value=cgst_rt;
		document.getElementById('cgst_rt').readOnly = true;
		document.getElementById('cgst_am').value=cgst_am;
		document.getElementById('cgst_am').readOnly = true;
		document.getElementById('sgst_rt').value=sgst_rt;
		document.getElementById('sgst_rt').readOnly = true;
		document.getElementById('sgst_am').value=sgst_am;
		document.getElementById('sgst_am').readOnly = true;
		document.getElementById('igst_rt').value=igst_rt;
		document.getElementById('igst_rt').readOnly = true;
		document.getElementById('igst_am').value=igst_am;
		document.getElementById('igst_am').readOnly = true;
		document.getElementById('net_amm').value=net_am;
		document.getElementById('net_amm').readOnly = true;
		

		
$('.upd').html('<input type="button" value="Update" onclick="add1()" style="padding:2px;width:100%" class="btn btn-warning">');
//get_betno();
gtt_unt();

get_stock();
get_betno();
}
</script>
    </body>

</html>