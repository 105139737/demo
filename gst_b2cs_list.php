<?
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

$tiamm=0;
$tttamm=0;
$tigst=0;
$tcess=0;
$ttcgst=0;
$ttsgst=0;
?>
 <table  width="100%" class="advancedtable"  >
		
		<tr bgcolor="#e8ecf6">
          <td  align="right" style="padding-top:15px" colspan="2"><b>Type</b></td>
            <td  align="right" style="padding-top:15px" colspan="2"><b>Place Of Supply</b></td>
            <td  align="right" style="padding-top:15px"><b>Rate (%)</b></td>
			<td  align="center" style="padding-top:15px"><b>CGST Rate</b></td>
			<td  align="center" style="padding-top:15px"><b>SGST Rate</b></td>
			<td  align="center" style="padding-top:15px"><b>IGST Rate</b></td>
			<td  align="right" style="padding-top:15px"><b>Taxable Value</b></td>
            <td  align="right" style="padding-top:15px"><b>Cess Amount</b></td>
</tr>

<?
$inv_ret="and ( blno='a'";
$query9 = "SELECT * FROM main_billing_ret where gstin='' and (fst=tst or (amm<250000 and fst!=tst)) and  dt between '$fdt' and '$tdt' and cstat='0'";
$result9 = mysqli_query($conn,$query9) or die(mysqli_error($conn));

while ($R9 = mysqli_fetch_array ($result9))
{
$invno=$R9['blno'];
if($inv_ret=="( blno='a'")
{
$inv_ret="( or blno='$invno'";	
}
else
{
$inv_ret.=" or blno='$invno'"; 
}
}

$inv_ret.=")";
$invno="";
//echo $tdt;
$tcgst=0;
$tsgst=0;
$net_am=0;
$cgst_rt=0;   
$cgst_am=0;   
$sgst_rt=0;   
$sgst_am=0; 
$igst_rt=0; 
$log=0;
$inv="and ( blno='a'";
$query9 = "SELECT * FROM main_billing where gstin='' and (fst=tst or (amm<250000 and fst!=tst)) and  dt between '$fdt' and '$tdt' and cstat='0'";
$result9 = mysqli_query($conn,$query9) or die(mysqli_error($conn));
while ($R9 = mysqli_fetch_array ($result9))
{
$invno=$R9['blno'];
if($inv=="( blno='a'")
{
$inv="( or blno='$invno'";	
}
else
{
$inv.=" or blno='$invno'"; 
}
}
$inv.=")";
$data= mysqli_query($conn,"select cgst_rt,sgst_rt,igst_rt,sum(tamm) as amm,tst from main_billdtls where sl>0 $inv group by cgst_rt,igst_rt,tst order by cgst_rt,igst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$amm=$row['amm'];
$cgst_rt=$row['cgst_rt'];   
$sgst_rt=$row['sgst_rt'];    
$igst_rt=$row['igst_rt'];  
$tst=$row['tst'];
$gbit4=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi4=mysqli_fetch_array($gbit4))
{
$statnm=$GBi4['sn'];
$statcd=$GBi4['cd'];
} 
$amm_ret=0;
$data_ret= mysqli_query($conn,"select cgst_rt,sgst_rt,igst_rt,sum(tamm) as amm,tst from main_billdtls_ret where sl>0 and cgst_rt='$cgst_rt' and sgst_rt='$sgst_rt' and igst_rt='$igst_rt' $inv_ret group by cgst_rt,igst_rt,tst order by cgst_rt,igst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data_ret))
{
$amm_ret+=$row['amm'];

}
?>
<tr class="even">
            <td  align="right" style="padding-top:15px" colspan="2">Other than E-Commerce</td>
            <td  align="right" style="padding-top:15px" colspan="2"><?=$statcd.'-'.$statnm;?></td>
            <td  align="right" style="padding-top:15px"><?=$cgst_rt+$sgst_rt+$igst_rt?>%</td>
            <td  align="right" style="padding-top:15px"><?=$cgst_rt?>%</td>
            <td  align="right" style="padding-top:15px"><?=$sgst_rt?>%</td>
            <td  align="right" style="padding-top:15px"><?=$igst_rt?>%</td>
            <td  align="right" style="padding-top:15px"><?=number_format($amm-$amm_ret,2);?></td>
            <td  align="right" style="padding-top:15px">0.00</td>
</tr>
<?
}
?>


