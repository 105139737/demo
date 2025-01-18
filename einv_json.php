<?php 
include 'config.php';
//include "../function.php";
require("function.php");
$blno=$_REQUEST['blno'];
$query1="Select * from main_cnm ";		 
 $result1 = mysqli_query($conn,$query1);
while ($R = mysqli_fetch_array ($result1))
{
$comp_nm=$R['cnm'];
$comp_addr=$R['addr'];
$cont=$R['cont'];
$comp_gstin=$R['gstin'];
$branch1=$R['branch1'];
$branch2=$R['branch2'];
$ifsc1=$R['ifsc1'];
$ifsc2=$R['ifsc2'];
$ac1=$R['ac1'];
$ac2=$R['ac2'];
$acnm1=$R['acnm1'];
$acnm2=$R['acnm2'];
}

$total_am=0;
$i=0;


$result5 = mysqli_query($conn,"select * from main_billing where  blno='$blno' ");
$count6=mysqli_num_rows($result5);
if($count6>0)
{
while ($row1 = mysqli_fetch_array($result5))
{
	$sl=$row1['sl'];
	$refsl=$row1['refsl'];
	$bill_typ=$row1['bill_typ'];
	$als=$row1['als'];
	$tp=$row1['tp'];
	$adrs=$row1['adrs'];
	$ssn=$row1['ssn'];
	$start_no=$row1['start_no'];
	$blno=$row1['blno'];
	$bill_no=$row1['bill_no'];
	$fst=$row1['fst'];
	$tst=$row1['tst'];
	$gst=$row1['gst'];
	$cid=$row1['cid'];
	$invto=$row1['invto'];
	$amm=$row1['amm'];
	$billing_tamm=$row1['tamm'];
	$gstam=$row1['gstam'];
	$roff=$row1['roff'];
	$payam=$row1['payam'];
	$tpoint=$row1['tpoint'];
	$paid=$row1['paid'];
	$due=$row1['due'];
	$dldgr=$row1['dldgr'];
	$crdtp=$row1['crdtp'];
	$crfno=$row1['crfno'];
	$cbnm=$row1['cbnm'];
	$dt=$row1['dt'];
	$ddt=$row1['ddt'];
	$edt=$row1['edt'];
	$pdts=$row1['pdts'];
	$vat=$row1['vat'];
	$vatamm=$row1['vatamm'];
	$car=$row1['car'];
	$dis=$row1['dis'];
	$bcd=$row1['bcd'];
	$tmod=$row1['tmod'];
	$psup=$row1['psup'];
	$vno=$row1['vno'];
	$lpd=$row1['lpd'];
	$dur_mnth=$row1['dur_mnth'];
	$no_servc=$row1['no_servc'];
	$sfno=$row1['sfno'];
	$dpay=$row1['dpay'];
	$finam=$row1['finam'];
	$emiam=$row1['emiam'];
	$emi_mnth=$row1['emi_mnth'];
	$cust_typ=$row1['cust_typ'];
	$sale_per=$row1['sale_per'];
	$gstin=$row1['gstin'];
	$eby=$row1['eby'];
	$rstat=$row1['rstat'];
	$cstat=$row1['cstat'];
	$order_no=$row1['order_no'];
	$rv=$row1['rv'];
	$blno1=$row1['blno1'];
	$disl=$row1['disl'];
	$dstat=$row1['dstat'];
	$remk=$row1['remk'];
	$damm=$row1['damm'];
	$blnon=$row1['blnon'];
	$download=$row1['download'];
	$tcsam=$row1['tcsam'];
$file_name=$bill_no."_".date('d_m_Y', strtotime($dt))."_".date('his');
	$cnt_sl=0;
	$i2=0;
	
$select_q1=mysqli_query($conn,"select sum(cgst_am) as cgst_t,sum(sgst_am) as sgst_t,sum(igst_am) as igst_t,prsl from main_billdtls where blno='$blno'")or die (mysqli_error($conn));
while($row2=mysqli_fetch_array($select_q1))
		{
		
		$cgst_t=$row2['cgst_t'];
		$sgst_t=$row2['sgst_t'];
		$igst_t=$row2['igst_t'];
		$prsl=$row2['prsl'];
		}			
$select_q34=mysqli_query($conn,"select * from main_product where sl='$prsl'");
while($row34=mysqli_fetch_array($select_q34))
{
$hsn=$row34['hsn'];
/*$hsn=substr($hsn, 0, 4);*/

}

if($invto!='')
{
$cid=$invto;	
}
else
{
$cid=$cid;	
}

$select_q3=mysqli_query($conn,"select * from main_cust where sl='$cid'");
while($row3=mysqli_fetch_array($select_q3))
{
	$cnm=$row3['nm'];
	$nmp=$row3['nmp'];
	$caddr=$row3['addr'];
	$cpin=$row3['pin'];
	$distn=$row3['distn'];

}
if($nmp!='')
{
$cnm=$nmp;	
}
$gbit=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$tst=$GBi['cd'];
}	
$err_log="";
if($gstin==""){$err_log="GSTIN Not found.";}
if($cpin==""){$err_log="Customer Pin Not found.";}
//if($distn==""){$err_log="Customer Distance  Not found.";}
//if($vno==""){$err_log="Vehicle Number  Not found.";}

$dt=date('d/m/Y', strtotime($dt));

$myObj='[
  {
    "Version": "1.1",
    "TranDtls": {
      "TaxSch": "GST",
      "SupTyp": "B2B",
      "IgstOnIntra": "N",
      "RegRev": "N",
      "EcmGstin": null
    },
    "DocDtls": {
      "Typ": "INV",
      "No": "'.$blno.'",
      "Dt": "'.$dt.'"
    },
    "SellerDtls": {
      "Gstin": "'.$comp_gstin.'",
      "LglNm": "'.$comp_nm.'",
      "Addr1": "'.$adrs.'",
      "Addr2": null,
      "Loc": "Krishnangar",
      "Pin": 741101,
      "Stcd": "19",
      "Ph": null,
      "Em": null
    },
    "BuyerDtls": {
      "Gstin": "'.$gstin.'",
      "LglNm": "'.$cnm.'",
      "Addr1": "'.$caddr.'",
      "Addr2": null,
      "Loc": "'.$caddr.'",
      "Pin": '.$cpin.',
      "Pos": "'.$tst.'",
      "Stcd": "'.$tst.'",
      "Ph": null,
      "Em": null
    },
    "ValDtls": {
      "AssVal": '.round($billing_tamm,2).',
      "IgstVal": '.round($igst_t,2).',
      "CgstVal": '.round($cgst_t,2).',
      "SgstVal": '.round($sgst_t,2).',
      "CesVal": 0,
      "StCesVal": 0,
      "Discount": 0,
      "OthChrg": 0,
      "RndOffAmt": 0,
      "TotInvVal": '.round($billing_tamm+$igst_t+$cgst_t+$sgst_t,2).'
    },   
    "RefDtls": {
      "InvRm": "NICGEPP2.0"
    },';

   $myObj.='
   "ItemList": [';
   
$item_list="";
$select_q=mysqli_query($conn,"select * from main_billdtls where blno='$blno'");
while($row2=mysqli_fetch_array($select_q))
		{
			$cnt_sl++;
			$bcd=$row2['bcd'];
			$cat=$row2['cat'];
			$scat=$row2['scat'];
			$prsl=$row2['prsl'];
			$imei=$row2['imei'];
			$unit=$row2['unit'];
			$usl=$row2['usl'];
			$betno=$row2['betno'];
			$uval=$row2['uval'];
			$kg=$row2['kg'];
			$grm=$row2['grm'];
			$pcs=$row2['pcs'];
			$srt=$row2['srt'];
			$adp=$row2['adp'];
			$prc=$row2['prc'];
			$total=$row2['total'];
			$disp=$row2['disp'];
			$disa=$row2['disa'];
			$ttl=$row2['ttl'];
			$tamm=$row2['tamm'];
			$fst=$row2['fst'];
			$tst=$row2['tst'];
			$cgst_rt=$row2['cgst_rt'];
			$cgst_am=$row2['cgst_am'];
			$sgst_rt=$row2['sgst_rt'];
			$sgst_am=$row2['sgst_am'];
			$igst_rt=$row2['igst_rt'];
			$igst_am=$row2['igst_am'];
			$net_am=$row2['net_am'];
			//$blno=$row2['blno'];
			$refno=$row2['refno'];
			$bill_typ=$row2['bill_typ'];
			$retno=$row2['retno'];
			$rate=$row2['rate'];
			$stk_rate=$row2['stk_rate'];
			$rdt=$row2['rdt'];
			$dt=$row2['dt'];
			$cust=$row2['cust'];
			$eby=$row2['eby'];
			$rqty=$row2['rqty'];
			$disa1=$row2['disa'];


$select_q34=mysqli_query($conn,"select * from main_product where sl='$prsl'");
while($row34=mysqli_fetch_array($select_q34))
{
$hsn=$row34['hsn'];
$pnm=$row34['pnm'];
/*$hsn=substr($hsn, 0, 4);*/
}
$pgst=$cgst_am+$sgst_am+$igst_am;
if($disp==0)
{
 if($disa1>0)  
{
$disp=round(($disa1*100)/$total,2);
}
}
$gst=$cgst_rt+$sgst_rt+$igst_rt;
$gst_rate=round($prc/($gst+100),4);
$rate=round($gst_rate*100,2);
$total=round($rate*$pcs,2);

$disa=round(($total*$disp)/100,2);

$ttl=round($total-$disa,2);
$net_am=$ttl+$pgst;
if($item_list=='')
{
$item_list=' 
		{
        "SlNo": "'.$cnt_sl.'",
        "PrdDesc": "'.$pnm.'",
        "IsServc": "N",
        "HsnCd": "'.$hsn.'",
        "Qty": '.$pcs.',
        "FreeQty": 0,
        "Unit": "PCS",
        "UnitPrice": '.round($rate,2).',
        "TotAmt": '.round($total,2).',
        "Discount": '.round($disa,2).',
        "PreTaxVal": 0,
        "AssAmt": '.round($ttl,2).',
        "GstRt": '.$gst.',
        "IgstAmt": '.round($igst_am,2).',
        "CgstAmt": '.round($cgst_am,2).',
        "SgstAmt": '.round($sgst_am,2).',
        "CesRt": 0,
        "CesAmt": 0,
        "CesNonAdvlAmt": 0,
        "StateCesRt": 0,
        "StateCesAmt": 0,
        "StateCesNonAdvlAmt": 0,
        "OthChrg": 0,
        "TotItemVal": '.round($net_am,2).'
		}';
	}
	else
	{
		$item_list.=', 
		{
        "SlNo": "'.$cnt_sl.'",
        "PrdDesc": "'.$pnm.'",
        "IsServc": "N",
        "HsnCd": "'.$hsn.'",
        "Qty": '.$pcs.',
        "FreeQty": 0,
        "Unit": "PCS",
        "UnitPrice": '.round($rate,2).',
        "TotAmt": '.round($total,2).',
        "Discount": '.round($disa,2).',
        "PreTaxVal": 0,
        "AssAmt": '.round($ttl,2).',
        "GstRt": '.$gst.',
        "IgstAmt": '.round($igst_am,2).',
        "CgstAmt": '.round($cgst_am,2).',
        "SgstAmt": '.round($sgst_am,2).',
        "CesRt": 0,
        "CesAmt": 0,
        "CesNonAdvlAmt": 0,
        "StateCesRt": 0,
        "StateCesAmt": 0,
        "StateCesNonAdvlAmt": 0,
        "OthChrg": 0,
        "TotItemVal": '.round($net_am,2).'
		}';
	}
		}
 $myObj.=$item_list.'     
    ]
  }
]
';

	$err =false;
	$message="Data Available";
$i++;
}
}
else{
$err =true;
$message="Data Not Available";
}
//echo $myObj;
//$items = json_decode($myObj);

if($err_log=="")
{
$resultup = mysqli_query($conn,"update main_billing set colorStatus=1 where blno='$blno' ");
header('Content-disposition: attachment; filename='.$file_name.'.json');
header('Content-type: application/json');	
//$myJSON = json_encode($myObj, true);
echo $myObj;  
}
else
{
?>
<center> <font size="7" color="red"><?php  echo $err_log;?></font></center>
<?php 	
}
	