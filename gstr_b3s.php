<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$mnth=$_REQUEST['mnth'];
$yr=$_REQUEST['yr'];
$fdt=date('Y-m-d', strtotime($yr."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-01"));
$tdt=date('Y-m-d', strtotime($yr."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-".date('t',strtotime($fdt))));
$query9 = "SELECT * FROM main_billing where dt between '$fdt' and '$tdt' order by gstin, dt";
$result9 = mysqli_query($conn,$query9)or die(mysqli_error($conn));
$ttcgst=0;
$ttsgst=0;
$ttigst=0;
$tval=0;
while ($R9 = mysqli_fetch_array ($result9))
{
$gstin_cu=$R9['gstin'];
$invno=$R9['blno'];
$invdt=$R9['dt'];	

$amm=0;
$net_am=0;
$cgst_rt=0;   
$cgst_am=0;   
$sgst_rt=0;   
$sgst_am=0; 
$igst_am=0; 
$log=0;
$data1= mysqli_query($conn,"select sum(net_am) as net_am,sum(ttl) as amm1,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am,sum(igst_am) as igst_am from  main_billdtls where  blno='$invno' group by sgst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data1))
{
$amm=$row['amm1'];
$net_am=$row['net_am'];
$cgst_rt=$row['cgst_rt'];   
$tcgst=$row['cgst_am'];   
$sgst_rt=$row['sgst_rt'];   
$tsgst=$row['sgst_am'];   
$tigst=$row['igst_am'];   
	
$tiamm+=$net_am;
$tttamm+=$amm;
$ttcgst+=$tcgst;
$ttsgst+=$tsgst;
$ttigst+=$tigst;
$tval+=$amm;
}

}
$query91 = "SELECT * FROM main_purchase where dt between '$fdt' and '$tdt' order by sid, dt";
$result91 = mysqli_query($conn,$query91)or die(mysqli_error($conn));
$tcgst1=0;   
$tsgst1=0;   
$tigst1=0; 
$tttamm1=0;
$tiamm1=0;
while ($R91 = mysqli_fetch_array ($result91))
{
$cgst=0;
$sgst=0;
$igst=0;
$blno=$R91['blno'];
$invdt=$R91['dt'];	

$amm1=0;
$net_am1=0;
$cgst_rt1=0;   
$cgst_am1=0;   
$sgst_rt1=0;   
$sgst_am1=0; 
$data= mysqli_query($conn,"select sum(net_am) as net_am,sum(ttl) as amm1,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am,sum(igst_am) as igst_am from  main_purchasedet where blno='$blno' group by sgst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$amm1=$row['amm1'];
$net_am1=$row['net_am'];
$cgst_rt1=$row['cgst_rt'];   
$sgst_rt1=$row['sgst_rt'];   
$igst_rt1=$row['igst_rt'];  
$cgst1=$row['cgst_am'];    
$sgst1=$row['sgst_am'];   
$igst1=$row['igst_am'];   
$tcgst1+=$cgst1;    
$tsgst1+=$sgst1;   
$tigst1+=$igst1;
$ttamm1=$amm1;		
$tiamm1+=$net_am1;
$tttamm1+=$ttamm1;
}

}
?>
  <table width="100%" class="table table-hover table-striped table-bordered"  >
<tbody>
<tr>
<td colspan="12" width="732">Form GSTR-3B</td>
</tr>
<tr>
<td colspan="12">[See Rule 61(5)]</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Year</td>
<td><?php  echo $yr;?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Month</td>
<td><?php  echo $mnth;?></td>
</tr>
<tr>
<td colspan="12">1.&nbsp; GSTIN : <?php  echo $gstin;?></td>
</tr>
<tr>
<td colspan="12">2. Legal name of the registered person : <?php  echo $comp_nm;?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">3.1&nbsp; Detail of Outward supplies and inward supplies liable to reverse charges</td>
</tr>
<tr>
<td colspan="3" width="183">Nature of Supplies</td>
<td colspan="2" width="122">Total Taxable Value</td>
<td colspan="2" width="122">Integrated Tax</td>
<td colspan="2" width="122">Central Tax</td>
<td colspan="2" width="122">State/UT Tax</td>
<td width="61">Cess</td>
</tr>
<tr>
<td colspan="3" width="183">1</td>
<td colspan="2" width="122">2</td>
<td colspan="2" width="122">3</td>
<td colspan="2" width="122">4</td>
<td colspan="2" width="122">5</td>
<td width="61">6</td>
</tr>
<tr>
<td colspan="3" width="183">(a) Outward taxable supplies (other than zero rated,nil rated and exempted)</td>
<td colspan="2"><?php echo number_format($tval,2);?></td>
<td colspan="2"><?php echo number_format($ttigst,2);?></td>
<td colspan="2"><?php echo number_format($ttcgst,2);?></td>
<td colspan="2"><?php echo number_format($ttsgst,2);?></td>
<td>0.00</td>
</tr>
<tr>
<td colspan="3" width="183">(b) Outward taxable supplies (zero rated)</td>
<td colspan="2">0.00</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(c) Other outward supplies, (Nil rated,exempted)</td>
<td colspan="2">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(d) Inward supplies (liable to reverse charge)</td>
<td colspan="2">0.00</td>
<td colspan="2">0.00</td>
<td colspan="2">0.00</td>
<td colspan="2">0.00</td>
<td>0.00</td>
</tr>
<tr>
<td colspan="3" width="183">(e)&nbsp; Non Gst outward supplies</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">3.2 of the supplies show in 3.1(a) above,details of inter-state supplies made to unregistered persons, composition taxable persons and UIN holders</td>
</tr>
<tr>
<td colspan="3" width="183">&nbsp;</td>
<td colspan="2" width="122">Place of Supply(State/UT)</td>
<td colspan="2" width="122">Total Taxable Value</td>
<td colspan="2" width="122">Amount of Integrated Tax</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">1</td>
<td colspan="2" width="122">2</td>
<td colspan="2" width="122">3</td>
<td colspan="2" width="122">4</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">4&nbsp; Eligible ITC</td>
</tr>
<tr>
<td colspan="3" width="183">Details</td>
<td colspan="2" width="122">Integrated Tax</td>
<td colspan="2" width="122">Central Tax</td>
<td colspan="2" width="122">State/UT Tax</td>
<td colspan="2" width="122">Cess</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">1</td>
<td colspan="2" width="122">2</td>
<td colspan="2" width="122">3</td>
<td colspan="2" width="122">4</td>
<td colspan="2" width="122">5</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(A) ITC available(whether in full or part)</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(1)&nbsp; Import of goods</td>
<td colspan="2" width="122">0.00</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td colspan="2" width="122">0.00</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(2) Import of Services</td>
<td colspan="2" width="122">0.00</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td colspan="2" width="122">0.00</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(3) Inward Supplies liable to reverse charge (other than 1 &amp; 2 above)</td>
<td colspan="2" width="122">0.00</td>
<td colspan="2" width="122">0.00</td>
<td colspan="2" width="122">0.00</td>
<td colspan="2" width="122">0.00</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(4) Inward supplies from ISD</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(5) All other ITC</td>
<td colspan="2" width="122"><?php echo number_format($tigst1,2);?></td>
<td colspan="2" width="122"><?php echo number_format($tcgst1,2);?></td>
<td colspan="2" width="122"><?php echo number_format($tsgst1,2);?></td>
<td colspan="2" width="122">0.00</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(B)&nbsp; ITC reversed</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(1)&nbsp; As per rules 42 &amp; 43 of CGST Rules</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(2)&nbsp; Others</td>
<td colspan="2" width="122">0.00</td>
<td colspan="2" width="122">0.00</td>
<td colspan="2" width="122">0.00</td>
<td colspan="2" width="122">0.00</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(C)&nbsp; Net ITC Available (A)-(B)</td>
<td colspan="2" width="122"><?php echo number_format($tigst1,2);?></td>
<td colspan="2" width="122"><?php echo number_format($tcgst1,2);?></td>
<td colspan="2" width="122"><?php echo number_format($tsgst1,2);?></td>
<td colspan="2" width="122">0.00</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(d)&nbsp; Ineligible ITC</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(1)&nbsp; As Per section 17(5)</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">(2)&nbsp; Others</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">5&nbsp; Values of exempt,nil-rated and non-gst inward supplies</td>
</tr>
<tr>
<td colspan="3" width="183">Nature of Supplies</td>
<td colspan="2" width="122">Inter-state supplies</td>
<td colspan="2" width="122">Intra-State supplies</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">1</td>
<td colspan="2" width="122">2</td>
<td colspan="2" width="122">3</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">From a supplier under composition scheme,exempt and nil rated supply</td>
<td colspan="2" width="122">0.00</td>
<td colspan="2" width="122">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">Non GST Supply</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">6.1&nbsp; Payment of Tax</td>
</tr>
<tr>
<td colspan="3" rowspan="2" width="183">Description</td>
<td rowspan="2" width="61">Tax payble</td>
<td colspan="4" width="244">Paid through ITC</td>
<td rowspan="2" width="61">Tax paid TDS/TCS</td>
<td rowspan="2" width="61">Tax/cess paid in cash</td>
<td rowspan="2" width="61">interest</td>
<td rowspan="2" width="61">Late fee</td>
</tr>
<tr>
<td width="61">Integrated Tax</td>
<td width="61">Central Tax</td>
<td width="61">State/UT Tax</td>
<td width="61">Cess</td>
</tr>
<tr>
<td colspan="3" width="183">1</td>
<td width="61">2</td>
<td width="61">3</td>
<td width="61">4</td>
<td width="61">5</td>
<td width="61">6</td>
<td width="61">7</td>
<td width="61">8</td>
<td width="61">9</td>
<td width="61">10</td>
</tr>
<tr>
<td colspan="3">Integrated Tax</td>
<td><?php echo number_format($ttigst,2);?></td>
<td><?php echo number_format($tigst1,2);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">Central Tax</td>
<td><?php echo number_format($ttcgst,2);?></td>
<td>&nbsp;</td>
<td><?php echo number_format($tcgst1,2);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">State/UT Tax</td>
<td><?php echo number_format($ttsgst,2);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><?php echo number_format($tsgst1,2);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">Cess</td>
<td>0.00</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>0.00</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">6.2&nbsp; TDS/TCS Credit</td>
</tr>
<tr>
<td colspan="3" width="183">Details</td>
<td colspan="2" width="122">Integrated Tax&nbsp;</td>
<td colspan="2" width="122">Central Tax</td>
<td colspan="2" width="122">State/UT Tax</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3" width="183">1</td>
<td colspan="2" width="122">2</td>
<td colspan="2" width="122">3</td>
<td colspan="2" width="122">4</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">TDS</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">TCS</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">Verification (by Authorised signatory)</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">I hereby solemnly affirm and declare that the information given herein above is true and&nbsp;</td>
</tr>
<tr>
<td colspan="12">correct to the best of my knowledge and belief and nothing has been concealed there from.</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2">Instructions :</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">1) Value of Taxable Supplies = Value of invoices + value of Debit Notes - value of credit notes&nbsp;</td>
</tr>
<tr>
<td colspan="12">+ value of advances received for which invoices have not been issued in the same&nbsp;</td>
</tr>
<tr>
<td colspan="12">month - value of advances adjusted against invoices</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">2) Details of advances as well as adjustment of same against invoices to be adjusted and not shown separately</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="12">3) Amendment in any details to be adjusted and not shown separately.</td>
</tr>
</tbody>
</table>