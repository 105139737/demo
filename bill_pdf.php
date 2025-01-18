<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");

ini_set("memory_limit","80M");
require('code128.php');
$myPDF=new PDF_Code128();
require_once('PEAR.php');
include("config.php");
$dt=date('d-m-Y');

date_default_timezone_set('Asia/Kolkata');
$cdt = date('Y-m-d');
$fdt=rawurldecode($_REQUEST['fdt']);
$tdt=rawurldecode($_REQUEST['tdt']);
$invto11=rawurldecode($_REQUEST[invto]);
$tp=rawurldecode($_REQUEST['tp'] ?? "");
$typ="BUYER'S COPY";
$vat=rawurldecode($_REQUEST[vat]);

if($invto11!='')
	{			
	$invto1=" and invto='$invto11'";
	}
else
	{
	$invto1="";
	}

if($fdt!="" and $tdt!="")
{
	$fdt=date("Y-m-d", strtotime($fdt));
$tdt=date("Y-m-d", strtotime($tdt));
$dtt=" and invdt between '$fdt' and '$tdt'";
}
else
{
	$dtt="";
}
if($tp==0)
{
	$tp1=" order by invdt desc";
	$gg="";
		$gg1=" group by invto";
}
else
{
	$tp1=" order by invto";
	$gg=" group by invto";
	
}

$or="order by invdt,blno";


$gbt=mysqli_query($conn,"select * from main_ship where sl='$invto11'");
while($GB=mysqli_fetch_array($gbt))
{
$bto=$GB['spn'];
$baddr=$GB['addr'];
$baddr1=$GB['addr1'];
$baddr2=$GB['addr2'];
$mlid=$GB['email'].'1';
$bmob="Mob : ".$GB['mob1'];
$bvat="VAT : ".$GB['vatno'];
}
if($mlid==""){
echo "Please Update Your E-Mail.";
}
else
{
    $file_name=$invto11."_".$dt.".pdf";
$query111 = "SELECT * FROM main_billing where sl>0 and invto='$invto11' and gst='1' ".$gg1.$dtt.$or;
$result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
	$blno=$R111['blno'];
	$invdt=$R111['invdt'];
$ttamm=$R111['ttamm'];
$vat=$R111['vat'];
$vatamm=$R111['vatamm'];
$inet=$R111['inet'];
$rtype=$R111['rtype'];
$roff=$R111['roff'];
$iamm=$R111['iamm'];
$vno=$R111['vno'];
$cno=$R111['cno'];
$sto=$R111['sto'];
$cdt=$R111['cdt'];
$invto=$R111['invto'];
$pinv=$R111['pinv'];
$fst=$R111['fst'];
$tst=$R111['tst'];
$tmode=$R111['tmode'];
$psup=$R111['psup'];
$tp=$R111['tp'];
$pf=$R111['pf'];
$invdt=date("d-m-Y", strtotime($invdt));	
$gbt=mysqli_query($conn,"select * from main_ship where sl='$invto'")or die (mysqli_error($conn));
while($GB=mysqli_fetch_array($gbt))
{
$bto=$GB['spn'];
$baddr0=$GB['addr'];
$baddr10=$GB['addr1'];
$baddr=substr($baddr0, 0,46);
$taddrr=$baddr0.' '.$baddr10;
$cnl=strlen($baddr0);
if(($cnl-46)>46)
{
	$baddr1=(substr($taddrr, 46,53)).'..';
}
else
{
	$baddr1=substr($taddrr, 46,55);
}
$baddr2=$GB['addr2'];
$bmob=$GB['mob1'];
$bvat=$GB['vatno'];
$bpan=$GB['pan'];
$bgstin=$GB['gstin'];
$mlid=$GB['email'];
}
$gbit=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$statcd=$GBi['cd'];
}
$invdt=date("d-m-Y", strtotime($invdt));	
$btoa=explode("(",$bto);
if(count($btoa)>0)
{
$bto=$btoa[0];
}

//$sl=1;


$nw = new Numbers_Words();
$aiw=$nw->toWords($iamm);
$str = strtoupper($aiw);


		 			 	$myPDF->AddPage();
			$myPDF->Image('img/HGGLASS.jpg','0','0',210,298);
   			/*$myPDF->SetFont('Arial','',10);
			$myPDF->SetTextColor(0,0,0);
			$myPDF->Code128(162,38,$blno,39,7);*/
   			$myPDF->SetFont('Arial','',10);
			$myPDF->SetXY(172,17);
			$myPDF->Write(10,$typ);
   			$myPDF->SetFont('Arial','B',8);
			$myPDF->SetXY(40,30.9);
			$myPDF->Write(10,$blno);
			$myPDF->SetXY(40,35.7);
			$myPDF->Write(10,$invdt);
			$myPDF->SetXY(40,40.3);
			$myPDF->Write(10,'West Bengal');
			$myPDF->SetXY(101,40.3);
			$myPDF->Write(10,'19');
			$myPDF->SetXY(147,30.9);
			$myPDF->Write(10,$tmode);
			$myPDF->SetXY(147,35.7);
			$myPDF->Write(10,$vno);
			$myPDF->SetXY(147,40.3);
			$myPDF->Write(10,$psup);
			$myPDF->SetFont('Arial','',8);
			$myPDF->SetXY(30.5,51.5);
			$myPDF->Write(10,$bto);
			$myPDF->SetXY(30.5,56.2);
			$myPDF->Write(10,$baddr);
			$myPDF->SetXY(30.5,60);
			$myPDF->Write(10,$baddr1);
			$myPDF->SetXY(30.5,69.1);
			$myPDF->Write(10,$bgstin);
			$myPDF->SetXY(30.5,64.7);
			$myPDF->Write(10,$bmob);
			$myPDF->SetXY(30.5,74.1);
			$myPDF->Write(10,$bpan);
			$myPDF->SetXY(78,69.1);
			$myPDF->Write(10,$statnm);
			$myPDF->SetXY(85,74.1);
			$myPDF->Write(10,$statcd);
			$myPDF->SetXY(124.2,51.5);
			$myPDF->Write(10,$bto);
			$myPDF->SetXY(124.2,56.2);
			$myPDF->Write(10,$baddr);
			$myPDF->SetXY(124.2,60);
			$myPDF->Write(10,$baddr1);
			$myPDF->SetXY(124.2,69.1);
			$myPDF->Write(10,$bgstin);
			$myPDF->SetXY(124.2,64.7);
			$myPDF->Write(10,$bmob);
			$myPDF->SetXY(124.2,74.1);
			$myPDF->Write(10,$bpan);
			$myPDF->SetXY(167,69.1);
			$myPDF->Write(10,$statnm);
			$myPDF->SetXY(174,74.1);
			$myPDF->Write(10,$statcd);
		
$pcs1=0;
$y=88;
$sln=1;
$sl=1;
$y1=85.5;
$cgst_rt1=0;   
$cgst_am1=0;   
$sgst_rt1=0;   
$sgst_am1=0;   
$igst_rt1=0;   
$igst_am1=0;  
$rsmm1=0;
$tamm1=0;
$gttl=0;
$gttl2=0;
$pcs1=0;
$tasqm=0;
$query100 = "SELECT * FROM ".$DBprefix."billdtls where blno='$blno' and stat=0";
   $result100 = mysqli_query($conn,$query100) or die (mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
  //cgst_rt	cgst_am	sgst_rt	sgst_am	igst_rt	igst_am	net_am
$cgst_rt=$R100['cgst_rt'];   
$cgst_am=$R100['cgst_am'];   
$sgst_rt=$R100['sgst_rt'];   
$sgst_am=$R100['sgst_am'];   
$igst_rt=$R100['igst_rt'];   
$igst_am=$R100['igst_am'];   
$net_am=$R100['net_am'];     
$t=$R100['t'];    
$l=$R100['l'];
$w=$R100['w'];
$pcs=$R100['pcs'];
$asqmt=$R100['asqmt']*$t;
$rsmm=$R100['rsmm'];
$tamm=$R100['tamm'];
$pnm=$R100['psl'];  
$query6="select * from  main_product where sl='$pnm'";
$result5 = mysqli_query($conn,$query6) or die (mysqli_error($conn));
while($row=mysqli_fetch_array($result5))
{
$des=$row['des'];	
$csl=$row['csl'];	
}
$data1 = mysqli_query($conn,"select * from main_cas where sl='$csl'");
while ($row1 = mysqli_fetch_array($data1))
{
$cat=$row1['catsl'];
}
$rest5 = mysqli_query($conn,"select * from  main_ca where sl='$cat'") or die (mysqli_error($conn));
while($roow=mysqli_fetch_array($rest5))
{
$hsn=$roow['hsn'];	
}
$cgst_rt1=$cgst_rt1+$cgst_rt;   
$cgst_am1=$cgst_am1+$cgst_am;   
$sgst_rt1=$sgst_rt1+$sgst_rt;   
$sgst_am1=$sgst_am1+$sgst_am;   
$igst_rt1=$igst_rt1+$igst_rt;   
$igst_am1=$igst_am1+$igst_am; 
$rsmm1=$rsmm1+$rsmm;
$tamm1=$tamm1+$tamm;
$pcs1=$pcs1+$pcs;
$height=$height-21; 
$gttl=$igst_am+$sgst_am+$cgst_am+$tamm;


$tasqm+=$asqmt;
	if($sln>$sl)
	{
		$y=$y+5;
		$y1=$y1+5;
	}
	$sl=$sln;

			$myPDF->SetXY(12.5,$y1);
			$myPDF->Write(15,$sln.".");
			$myPDF->SetXY(20.2,$y);
			$myPDF->Write(10,$des);
			$myPDF->SetXY(70.5,$y);
			$myPDF->Write(10,$hsn);
			$myPDF->SetXY(87.5,$y);
			$myPDF->Write(10,$t);
			$myPDF->SetXY(99,$y);
			$myPDF->Write(10,$l);
			$myPDF->SetXY(112,$y);
			$myPDF->Write(10,$w);
			$myPDF->SetXY(125.5,$y);
			$myPDF->Write(10,$pcs);
			$myPDF->SetXY(136,$y);
			$myPDF->Write(10,number_format($asqmt,4));
			$myPDF->SetXY(160,$y);
			$myPDF->Write(10,number_format($rsmm,2));
			$myPDF->SetXY(175.5,$y);
			$myPDF->Write(10,number_format(round($tamm,2),2));
	$sln++;
			
}
$tgst=round($igst_am1,2)+round($sgst_am1,2)+round($cgst_am1,2);
$gttl2=round($tamm1,2)+$tgst;

			$myPDF->SetXY(125,197.9);
			$myPDF->Write(10,$pcs1);
			$myPDF->SetXY(136,197.9);
			$myPDF->Write(10,$tasqm);
			$myPDF->SetFont('Arial','B',8);			
			
			$myPDF->SetXY(175.5,203);			
			$myPDF->Write(10,number_format(round($tamm1,2),2));
			$myPDF->SetXY(168.5,207.5);			
			$myPDF->Write(10,$cgst_rt.'%');
			$myPDF->SetXY(168.5,212);			
			$myPDF->Write(10,$sgst_rt.'%');
			$myPDF->SetXY(169.7,216.5);			
			$myPDF->Write(10,$igst_rt.'%');
			$myPDF->SetXY(175.5,207.5);			
			$myPDF->Write(10,number_format(round($cgst_am1,2),2));
			$myPDF->SetXY(175.5,212);			
			$myPDF->Write(10,number_format(round($sgst_am1,2),2));
			$myPDF->SetXY(175.5,216.5);			
			$myPDF->Write(10,number_format(round($igst_am1,2),2));
			$myPDF->SetXY(175.5,221);			
			$myPDF->Write(10,number_format(round($tgst,2),2));
			$myPDF->SetXY(175.5,225.5);			
			$myPDF->Write(10,number_format(round($gttl2,2),2));
			$myPDF->SetXY(170.5,229.5);			
			$myPDF->Write(10,'('.$rtype.')');
			$myPDF->SetXY(175.5,230);			
			$myPDF->Write(10,number_format(round($roff,2),2));
			$myPDF->SetXY(175.5,239);			
			$myPDF->Write(10,'N.A.');
			$myPDF->SetXY(13.5,209.5);			
			$myPDF->Write(10,$str);
			//Bank
			$myPDF->SetXY(32.5,221.5);			
			$myPDF->Write(10,$acnm1);
			$myPDF->SetXY(32.5,226.2);			
			$myPDF->Write(10,$ac1);
			$myPDF->SetXY(32.5,231);			
			$myPDF->Write(10,$ifsc1);
			$myPDF->SetXY(32.5,235.6);			
			$myPDF->Write(10,$branch1);
			$myPDF->SetXY(82,221.5);			
			$myPDF->Write(10,$acnm2);
			$myPDF->SetXY(82,226.2);			
			$myPDF->Write(10,$ac2);
			$myPDF->SetXY(82,231);			
			$myPDF->Write(10,$ifsc2);
			$myPDF->SetXY(82,235.6);			
			$myPDF->Write(10,$branch2);
			
			$myPDF->SetXY(175.5,234.5);			
			$myPDF->Write(10,number_format(round($iamm,2),2));
}

$myPDF->Output($file_name,'i');

$b=$file_name;

$imgfile = $b;
 
$handle = fopen($imgfile, "r");
 
$imgbinary = fread(fopen($imgfile, "r"), filesize($imgfile));


$to = $mlid; 
$from = "Hindusthan Glass<office@hindusthanglass.com>"; 
$subject = "Billing"; 
$message = "<p>Please see the attachment.</p>";

$separator = md5(time());
// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;
// attachment name
$filename = $b.".pdf";

$attachment = chunk_split(base64_encode($imgbinary));
// main header (multipart mandatory)
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol; 

// message
$message .= "--".$separator.$eol;
$message .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$message .= "Content-Transfer-Encoding: 8bit".$eol;
$message .= $message.$eol;
// attachment
$message .= "--".$separator.$eol;
$message .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$message .= "Content-Transfer-Encoding: base64".$eol;
$message .= "Content-Disposition: attachment".$eol;
$message .= $attachment.$eol;
$message .= "--".$separator."--";
// send message
mail($to, $subject, $message, $headers);
unlink($b);
echo "Mail Sent Successfully.";
}
?>
