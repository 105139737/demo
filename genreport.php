<?php 
$reqlevel = 3;
include("config.php");
include("Numbers/Words.php");
ini_set("memory_limit","80M");
require('code128.php');
$myPDF=new PDF_Code128();

include("config.php");
$dt=date('d-m-Y');

date_default_timezone_set('Asia/Kolkata');
$cdt = date('Y-m-d');
$blno=rawurldecode($_REQUEST['blno'] ?? "");
$typ="BUYER'S COPY";
$filenm=str_replace('/','',$blno);
    $file_name=$filenm.".pdf";
 $query111 = "SELECT * FROM ".$DBprefix."billing where blno='$blno'";
$result111 = mysqli_query($conn,$query111)or die (mysqli_error($conn));
 $count=mysqli_num_rows($result111);
 if($count>0)
 {
while ($R111 = mysqli_fetch_array ($result111))
{
$invdt=$R111['dt'];
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
$tmode=$R111['tmod'];
$psup=$R111['psup'];
$tp=$R111['tp'];
$pf=$R111['pf'];
$cid=$R111['cid'];

}
$invdt=date("d-m-Y", strtotime($invdt));	
$gbt=mysqli_query($conn,"select * from main_cust where sl='$cid'")or die (mysqli_error($conn));
while($GB=mysqli_fetch_array($gbt))
{
$bto=$GB['nm'];
$baddr=$GB['addr'];
$baddr1=$GB['addr1'];
$baddr2=$GB['addr2'];
$bmob=$GB['cont'];
$bvat=$GB['vatno'];
$bpan=$GB['pan'];
$bgstin=$GB['gstin'];
}
$gbit=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$statcd=$GBi['cd'];
}
$btoa=explode("(",$bto);
if(count($btoa)>0)
{
$bto=$btoa[0];
}

$nw = new Numbers_Words();
$aiw=$nw->toWords($iamm);
$str = strtoupper($aiw);
if($psup=="")
{
$psup="Krishnagar";
}
$query1="Select * from main_cnm ";		 
 $result1 = mysqli_query($conn,$query1);
while ($R = mysqli_fetch_array ($result1))
{
$comp_nm=$R['cnm'];
$comp_addr=$R['addr'];
$cont=$R['cont'];
$gstin=$R['gstin'];
$branch1=$R['branch1'];
$branch2=$R['branch2'];
$ifsc1=$R['ifsc1'];
$ifsc2=$R['ifsc2'];
$ac1=$R['ac1'];
$ac2=$R['ac2'];
$acnm1=$R['acnm1'];
$acnm2=$R['acnm2'];
}

//$sl=1;





		 			 	$myPDF->AddPage();
			$myPDF->Image('blank-invoice.jpg','0','0',210,298);
   			$myPDF->SetFont('Arial','',10);
			/*$myPDF->SetXY(172,17);
			$myPDF->Write(10,$typ);*/
			$myPDF->SetFont('Arial','B',14);
			$myPDF->SetXY(80,16);
			$myPDF->Write(10,$comp_nm);
			$myPDF->SetFont('Arial','B',10);
			$myPDF->SetXY(60,20);
			$myPDF->Write(10,$comp_addr);
			$myPDF->SetXY(80,24);
			$myPDF->Write(10,"GSTIN : ".$gstin);
   			$myPDF->SetFont('Arial','B',8);
			$myPDF->SetXY(40,33);
			$myPDF->Write(10,$blno);
			$myPDF->SetXY(40,38);
			$myPDF->Write(10,$invdt);
			$myPDF->SetXY(40,42.3);
			$myPDF->Write(10,'West Bengal');
			$myPDF->SetXY(101,42.3);
			$myPDF->Write(10,'19');
			$myPDF->SetXY(147,33);
			$myPDF->Write(10,$tmode);
			$myPDF->SetXY(147,38);
			$myPDF->Write(10,$vno);
			$myPDF->SetXY(147,42.3);
			$myPDF->Write(10,$psup);
			$myPDF->SetFont('Arial','',8);
			$myPDF->SetXY(30.5,53.5);
			$myPDF->Write(10,$bto);
			$myPDF->SetXY(30.5,58.5);
			$myPDF->Write(10,$baddr);
			$myPDF->SetXY(30.5,61);
			$myPDF->Write(10,$baddr1);
			$myPDF->SetXY(30.5,68);
			$myPDF->Write(10,$bgstin);
			$myPDF->SetXY(30.5,63);
			$myPDF->Write(10,$bmob);
			$myPDF->SetXY(30.5,72.5);
			$myPDF->Write(10,$bpan);
			$myPDF->SetXY(88.5,67.7);
			$myPDF->Write(10,$statnm);
			$myPDF->SetXY(101,72.6);
			$myPDF->Write(10,$statcd);
			$myPDF->SetXY(124.4,53.7);
			$myPDF->Write(10,$bto);
			$myPDF->SetXY(124.2,58.3);
			$myPDF->Write(10,$baddr);
			$myPDF->SetXY(124.2,60);
			$myPDF->Write(10,$baddr1);
			$myPDF->SetXY(124.2,68.1);
			$myPDF->Write(10,$bgstin);
			$myPDF->SetXY(124.2,62.9);
			$myPDF->Write(10,$bmob);
			$myPDF->SetXY(124.2,72.8);
			$myPDF->Write(10,$bpan."11222");
			$myPDF->SetXY(182,67.8);
			$myPDF->Write(10,$statnm);
			$myPDF->SetXY(194,72.6);
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
$sln=0;
$pcs1=0;
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

$data= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{

$cat=$row['cat'];
$scat=$row['scat'];	
$des=$row['des'];	
$pcd=$row['prsl'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$blno1=$row['blno'];
$unit=$row['unit'];
$pcs=$row['pcs'];
$cgst_rt=$row['cgst_rt'];   
$cgst_am=$row['cgst_am'];   
$sgst_rt=$row['sgst_rt'];   
$sgst_am=$row['sgst_am'];   
$igst_rt=$row['igst_rt'];   
$igst_am=$row['igst_am'];   
$net_am=$row['net_am'];  
$imei=$row['imei'];  
$pgst=$cgst_am+$sgst_am+$igst_am;
$pgstr=$cgst_rt+$sgst_rt+$igst_rt;
$cgst_rt1=$cgst_rt1+$cgst_rt;   
$cgst_am1=$cgst_am1+$cgst_am;   
$sgst_rt1=$sgst_rt1+$sgst_rt;   
$sgst_am1=$sgst_am1+$sgst_am;   
$igst_rt1=$igst_rt1+$igst_rt;   
$igst_am1=$igst_am1+$igst_am; 
$sln++;
$gttl=$gttl+$ttl;
$cnm="";				
$data12= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$cnm=$row1['cnm'];

}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
$hsn=$row1['hsn'];
}
$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
}
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
if($unit=='sun'){$stock_in=$pcs." ".$sun;}
if($unit=='mun'){$stock_in=$pcs." ".$mun;}
if($unit=='bun'){$stock_in=$pcs." ".$bun;}

$height=$height-21;

$tasqm+=$asqmt;


$tasqm+=$asqmt;
	if($sln>$sl)
	{
		$y=$y+5;
		$y1=$y1+5;
	}
	$sl=$sln;

			$myPDF->SetXY(12.8,$y1);
			$myPDF->Write(15,$sln.".");
			$myPDF->SetXY(30.2,$y);
			$myPDF->Write(10,$pnm);
			$myPDF->SetXY(104.5,$y);
			$myPDF->Write(10,$hsn);
			$myPDF->SetXY(145.3,$y);
			$myPDF->Write(10,$ttl);
			$myPDF->SetXY(99,$y);
			$myPDF->Write(10,$l);
			$myPDF->SetXY(112,$y);
			$myPDF->Write(10,$w);
			$myPDF->SetXY(125.5,$y);
			$myPDF->Write(10,$stock_in);
			$myPDF->SetFont('Arial','',7);
			$myPDF->SetXY(137.5,$y);
			$myPDF->Write(10,round($prc,2));
			$myPDF->SetFont('Arial','',8);
			$myPDF->SetXY(160,$y);
			$myPDF->Write(10,$pgstr."%");
			$myPDF->SetXY(172,$y);
			$myPDF->Write(10,round($pgst,2));
			$myPDF->SetXY(186.5,$y);
			$myPDF->Write(10,round($ttl+$pgst,2));
			
	$sln++;
			
}
$tgst=round($igst_am1,2)+round($sgst_am1,2)+round($cgst_am1,2);
$gttl2=round($gttl,2)+$tgst;
$rgttl=round($gttl2);
$roff=round($rgttl-$gttl2,2);

$nw = new Numbers_Words();
$aiw=$nw->toWords($rgttl);
$str = strtoupper($aiw);


$totalrs=round($gttl+$tgst,2);
if($bnknm1=='NA'){$bk1='';}else{$bk1=$bnknm1;}

			$myPDF->SetXY(145,194.9);
			$myPDF->Write(10,$gttl);
			$myPDF->SetXY(172,194.9);
			$myPDF->Write(10,$tgst);
			$myPDF->SetFont('Arial','B',8);			
		
			$myPDF->SetXY(186.5,194.7);			
			$myPDF->Write(10,(round($totalrs,2)));
			$myPDF->SetXY(172,199);
			$myPDF->Write(10,$gttl);
			$myPDF->SetXY(172.5,203.5);			
			$myPDF->Write(10,(round($cgst_am1,2)));
			$myPDF->SetXY(172.5,208.5);			
			$myPDF->Write(10,(round($sgst_am1,2)));
			$myPDF->SetXY(172.5,212.5);			
			$myPDF->Write(10,(round($igst_am1,2)));
			$myPDF->SetXY(172.5,217);			
			$myPDF->Write(10,(round($tgst,2)));
			$myPDF->SetXY(172.5,221.5);			
			$myPDF->Write(10,(round($gttl2,2)));
			//$myPDF->SetXY(170.5,225.5);			
			//$myPDF->Write(10,'('.$rtype.')');
			$myPDF->SetXY(172.5,226);			
			$myPDF->Write(10,(round($roff,2)));
			$myPDF->SetXY(172.5,231);			
			$myPDF->Write(10,(round($rgttl,2)));
			
			$myPDF->SetXY(172.5,235);			
			$myPDF->Write(10,'N.A.');
			$myPDF->SetXY(18.5,207.1);			
			$myPDF->Write(10,$str);
			
			//Bank
			$myPDF->SetXY(52.5,212.5);			
			$myPDF->Write(10,$comp_nm);
			$myPDF->SetXY(32.5,221.5);			
			$myPDF->Write(10,$bk1);
			$myPDF->SetXY(32.5,228.2);			
			$myPDF->Write(10,$ac1);
			$myPDF->SetXY(32.5,236);			
			$myPDF->Write(10,$ifsc1);
			$myPDF->SetXY(32.5,243.6);			
			$myPDF->Write(10,$branch1);

		
			
			//$myPDF->SetXY(175.5,234.5);			
			//$myPDF->Write(10,number_format(round($iamm,2),2));

$myPDF->Output($file_name,'i');

echo 'true';
}
else
{
 echo 'false';   
}
?>




