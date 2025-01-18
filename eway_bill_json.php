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

$response=array();
$response2=array();
$billing_det=array();
$billing_det1=array();
$billing_det2=array();
$billing_det3=array();
$billing_det4=array();
$item=array();

//and blno='HD/HR/758/18-19'

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
$hsn=substr($hsn, 0, 4);

}




	$select_q3=mysqli_query($conn,"select * from main_cust where sl='$cid'");
	while($row3=mysqli_fetch_array($select_q3))
		{
			$cnm=$row3['nm'];
			$caddr=$row3['addr'];
			$cpin=$row3['pin'];
			$distn=$row3['distn'];

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
if($distn==""){$err_log="Customer Distance  Not found.";}
if($vno==""){$err_log="Vehicle Number  Not found.";}

$dt=date('d/m/Y', strtotime($dt));

$response['userGstin'] =$comp_gstin;
$response['supplyType'] ='O';
$response['subSupplyType'] ='1';
$response['docType'] ='INV';
$response['docNo'] =$blno;
$response['docDate'] =$dt;
$response['transType'] ='1';
$response['fromGstin'] =$comp_gstin;
$response['fromTrdName'] =$comp_nm;
$response['fromAddr1'] =$adrs;
$response['fromAddr2'] ="";
$response['fromPlace'] ="";
$response['fromPincode'] ="741101";
$response['fromStateCode'] ="19";
$response['actualFromStateCode'] ="19";
$response['toGstin'] =$gstin;
$response['toTrdName'] =$cnm;
$response['toAddr1'] =$caddr;
$response['toAddr2'] ="";
$response['toPlace'] ="";
$response['toPincode'] =$cpin;
$response['toStateCode'] =$tst;
$response['actualToStateCode'] =$tst;
$response['totalValue'] =round($billing_tamm,2);
$response['cgstValue'] =round($cgst_t,2);
$response['sgstValue'] =round($sgst_t,2);
$response['igstValue'] =round($igst_t,2);
$response['cessValue'] ="0.00";
$response['TotNonAdvolVal'] ="0.00";
$response['OthValue'] ="0";
$response['totInvValue'] =round($amm,2);
$response['transMode'] ="1";
$response['transDistance'] =$distn;
$response['transporterName'] ="";
$response['transporterId'] ="";
$response['transDocNo'] ="";
$response['transDocDate'] =$dt;
$response['vehicleNo'] =$vno;
$response['vehicleType'] ="R";
$response['mainHsnCode'] =$hsn;




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
		



			$select_q34=mysqli_query($conn,"select * from main_product where sl='$prsl'");
			while($row34=mysqli_fetch_array($select_q34))
				{
					$hsn=$row34['hsn'];
					$pnm=$row34['pnm'];
$hsn=substr($hsn, 0, 4);

				}


			$response2['itemNo'] =$cnt_sl;
			$response2['productName'] =$pnm;
			$response2['productDesc'] =$pnm;
			$response2['hsnCode'] =$hsn;
			$response2['quantity'] =$pcs;
			$response2['qtyUnit'] ="";
			$response2['taxableAmount'] =round($tamm,2);
			$response2['sgstRate'] =$cgst_rt;
			$response2['cgstRate'] =$sgst_rt;
			$response2['igstRate'] =$igst_rt;
			$response2['cessRate'] ="0";
			$response2['cessNonAdvol'] ="0";
			$i2++;
$item[]=$response2;

		}
		
$response['itemList']=$item;		
$billing_det1[]=$response;
/*		
$billing_det['billLists']=$billing_det1;
$billing_det3['itemList']=$item;
$billing_det2['billLists']=$billing_det1;
$billing_det2['itemList']=$item;
*/
	$err =false;
	$message="Data Available";
$i++;
}
}
else{
   	$err =true;
	$message="Data Not Available";
	}	
	
		$myObj = new StdClass;	
	

	$myObj->version = '1.0.0219';
	$myObj->billLists = $billing_det1;
if($err_log=="")
{
header('Content-disposition: attachment; filename='.$file_name.'.json');
header('Content-type: application/json');	
$myJSON = json_encode($myObj);
echo $myJSON;   
}
else
{
?>
<center> <font size="7" color="red"><?php  echo $err_log;?></font></center>
<?php 	
}
	