<?
$reqlevel = 3; 
include("membersonly.inc.php");
$mnth=$_REQUEST[mnth];
$yr=$_REQUEST[yr];
$typ=$_REQUEST[typ];
$fdt=date('Y-m-d', strtotime($yr."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-01"));
$tdt=date('Y-m-d', strtotime($yr."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-".date('t',strtotime($fdt))));

if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}
$osup_det=array();
$sup_details=array();
$osup_zero=array();
$osup_nil_exmp=array();
$isup_rev=array();
$osup_nongst=array();
$itc_elg=array();
$itc_avl=array();
$IMPG=array();
$IMPS=array();
$ISRC=array();
$ISD=array();
$OTH=array();
$itc_rev=array();
$RUL=array();
$OTH1=array();
$itc_net=array();
$itc_inelg=array();
$ltfee_details=array();
$taxamm=0;
$tcgst==0;
$tsgst=0;
$tigst=0;
$data1= mysqli_query($conn,"select * from  main_billing where sl>0 ".$todts."order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$invno=$row1['blno'];
$data=mysqli_query($conn,"select sum(ttl) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am,sum(igst_am) as igst_am from  main_billdtls where blno='$invno'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
$taxamm+=$row['amm']; 
$tcgst+=$row['cgst_am'];   
$tsgst+=$row['sgst_am']; 
$tigst+=$row['igst_am']; 
}
}

$taxamm1=0;
$tcgst1==0;
$tsgst1=0;
$tigst1=0;
$data12= mysqli_query($conn,"select * from  main_purchase where sl>0 ".$todts."order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$invno=$row1['blno'];
$data=mysqli_query($conn,"select sum(ttl) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am,sum(igst_am) as igst_am from  main_purchasedet where blno='$invno'")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data))
{
$taxamm1+=$row1['amm']; 
$tcgst1+=$row1['cgst_am'];   
$tsgst1+=$row1['sgst_am']; 
$tigst1+=$row1['igst_am']; 
}
}
$osup_det['txval'] = $taxamm;
$osup_det['iamt'] = $tigst;
$osup_det['camt'] = $tcgst;
$osup_det['samt'] = $tsgst;
$osup_det['csamt'] = 0;

$osup_zero['txval'] = 0;
$osup_zero['iamt'] = 0;
$osup_zero['camt'] = 0;
$osup_zero['samt'] = 0;
$osup_zero['csamt'] = 0;


$osup_nil_exmp['txval'] = 0;
$osup_nil_exmp['iamt'] = 0;
$osup_nil_exmp['camt'] = 0;
$osup_nil_exmp['samt'] = 0;
$osup_nil_exmp['csamt'] = 0;

$isup_rev['txval'] = 0;
$isup_rev['iamt'] = 0;
$isup_rev['camt'] = 0;
$isup_rev['samt'] = 0;
$isup_rev['csamt'] = 0;


$osup_nongst['txval'] = 0;
$osup_nongst['iamt'] = 0;
$osup_nongst['camt'] = 0;
$osup_nongst['samt'] = 0;
$osup_nongst['csamt'] = 0;

$sup_details['osup_det'] = $osup_det;
$sup_details['osup_zero'] = $osup_zero;
$sup_details['osup_nil_exmp'] = $osup_nil_exmp;
$sup_details['isup_rev'] = $isup_rev;
$sup_details['osup_nongst'] = $osup_nongst;

$IMPG['ty']='IMPG';
$IMPG['iamt']=0;
$IMPG['camt']=0;
$IMPG['samt']=0;
$IMPG['csamt']=0;

$IMPS['ty']='IMPS';
$IMPS['iamt']=0;
$IMPS['camt']=0;
$IMPS['samt']=0;
$IMPS['csamt']=0;

$ISRC['ty']='ISRC';
$ISRC['iamt']=0;
$ISRC['camt']=0;
$ISRC['samt']=0;
$ISRC['csamt']=0;

$ISD['ty']='ISD';
$ISD['iamt']=0;
$ISD['camt']=0;
$ISD['samt']=0;
$ISD['csamt']=0;

$OTH['ty']='OTH';
$OTH['iamt']=$tigst1;
$OTH['camt']=$tcgst1;
$OTH['samt']=$tsgst1;
$OTH['csamt']=0;


$itc_avl[]=$IMPG;
$itc_avl[]=$IMPS;
$itc_avl[]=$ISRC;
$itc_avl[]=$ISD;
$itc_avl[]=$OTH;
$itc_elg['itc_avl']=$itc_avl;

$RUL['ty']='RUL';
$RUL['iamt']=0;
$RUL['camt']=0;
$RUL['samt']=0;
$RUL['csamt']=0;

$OTH1['ty']='OTH';
$OTH1['iamt']=0;
$OTH1['camt']=0;
$OTH1['samt']=0;
$OTH1['csamt']=0;

$itc_rev[]=$RUL;
$itc_rev[]=$OTH1;

$itc_elg['itc_rev']=$itc_rev;

$itc_net['iamt']=$tigst1;
$itc_net['camt']=$tcgst1;
$itc_net['samt']=$tsgst1;
$itc_net['csamt']=0;
$itc_elg['itc_net']=$itc_net;

$RUL1['ty']='RUL';
$RUL1['iamt']=0;
$RUL1['camt']=0;
$RUL1['samt']=0;
$RUL1['csamt']=0;

$OTH2['ty']='OTH';
$OTH2['iamt']=0;
$OTH2['camt']=0;
$OTH2['samt']=0;
$OTH2['csamt']=0;



$itc_inelg[]=$RUL1;
$itc_inelg[]=$OTH2;
$itc_elg['itc_inelg']=$itc_inelg;

$GST['ty']='GST';
$GST['inter']=0;
$GST['intra']=0;

$NONGST['ty']='NONGST';
$NONGST['inter']=0;
$NONGST['intra']=0;


$isup_details[]=$GST;
$isup_details[]=$NONGST;
$inward_sup['isup_details']=$isup_details;

$intr_details['iamt'] = 0;
$intr_details['camt'] = 0;
$intr_details['samt'] = 0;
$intr_details['csamt'] = 0;

$intr_ltfee['intr_details']=$intr_details;
$ltfee=new StdClass;
$intr_ltfee["ltfee_details"]=$ltfee;

$inter_sup['unreg_details']=$ltfee_details;
$inter_sup['comp_details']=$ltfee_details;
$inter_sup['uin_details']=$ltfee_details;
$myObj=new StdClass;
$myObj->gstin = $gstin;
$myObj->ret_period = date('mY', strtotime($fdt));
$myObj->sup_details = $sup_details;
$myObj->itc_elg = $itc_elg;
$myObj->inward_sup = $inward_sup;
$myObj->intr_ltfee = $intr_ltfee;
$myObj->inter_sup = $inter_sup;



$myJSON = json_encode($myObj);


header('Content-disposition: attachment; filename='.$gstin.'-GSTR-3B-'.date('F', strtotime($fdt)).'.json');
header('Content-type: application/json');
echo $myJSON;
mysqli_close($conn);
?>
