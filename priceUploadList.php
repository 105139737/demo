<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
include "function.php";

ini_set('display_errors',0);
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$prnm=$_REQUEST['prnm'];
$godown=$_REQUEST['godown'];
$vstat=$_REQUEST['vstat']??"";
$pstat=$_REQUEST['pstat'];

if($pstat==""){$pstat1="";}else{$pstat1=" and pstat='$pstat'";}
if($catsl==""){$catsl1="";}else{$catsl1=" and cat='$catsl'";}
if($scatsl==""){$scatsl1="";}else{$scatsl1=" and scat='$scatsl'";}
if($prnm==""){$prnm1="";}else{$prnm1=" and prsl='$prnm'";}
if($godown==""){$godown1="";}else{$godown1=" and bcd='$godown'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
if($snm!=""){$snm1=" and sup='$snm'";}else{$snm1="";}
?>
<script>
function cal(sl)
{
var rate=document.getElementById('rate'+sl).value;
	if(rate==""){rate=0;}else{rate=parseFloat(rate);}
var dp=document.getElementById('dp'+sl).value;
	if(dp==""){dp=0;}else{dp=parseFloat(dp);}
var pldnlc=document.getElementById('pldnlc'+sl).value;
	if(pldnlc==""){pldnlc=0;}else{pldnlc=parseFloat(pldnlc);}
var dpdisp=document.getElementById('dpdisp'+sl).value;
	if(dpdisp==""){dpdisp=0;}else{dpdisp=parseFloat(dpdisp);}	
var dpdisam=document.getElementById('dpdisam'+sl).value;
	if(dpdisam==""){dpdisam=0;}else{dpdisam=parseFloat(dpdisam);}	
var invprc=document.getElementById('invprc'+sl).value;
	if(invprc==""){invprc=0;}else{invprc=parseFloat(invprc);}	
var rprft=document.getElementById('rprft'+sl).value;
	if(rprft==""){rprft=0;}else{rprft=parseFloat(rprft);}	
var retoff=document.getElementById('retoff'+sl).value;
	if(retoff==""){retoff=0;}else{retoff=parseFloat(retoff);}
var offprc=document.getElementById('offprc'+sl).value;
	if(offprc==""){offprc=0;}else{offprc=parseFloat(offprc);}
var offless=document.getElementById('offless'+sl).value;
	if(offless==""){offless=0;}else{offless=parseFloat(offless);}	
var lprc=document.getElementById('lprc'+sl).value;
	if(lprc==""){lprc=0;}else{lprc=parseFloat(lprc);}	
	

var dnlc=rate+((rate*dp)/100);
$("#dnlc"+sl).val(dnlc.round(2));

pldnlc=dnlc/(100-dpdisp)*100;
$("#pldnlc"+sl).val(pldnlc.round(2));

dpdisam=pldnlc-dnlc;
$("#dpdisam"+sl).val(dpdisam.round(2));

invprc=pldnlc-(pldnlc*dpdisp)/100;
$("#invprc"+sl).val(invprc.round(2));

var retoff=rate+((rate*rprft)/100);
$("#retoff"+sl).val(retoff.round(2));

offprc=retoff/(100-offless)*100;
$("#offprc"+sl).val(offprc.round(2));

lprc=offprc-(offprc*offless)/100;
$("#lprc"+sl).val(lprc.round(2));
}
Number.prototype.round = function(places) {
  return +(Math.round(this + "e+" + places)  + "e-" + places);
}

$(document).ready(function(){
    $('.check:button').toggle(function(){
        $('input:checkbox').attr('checked','checked');
        
    },function(){
        $('input:checkbox').removeAttr('checked');
              
    })
})
</script>
<table  class="advancedtable" width="100%" >
	<tr  bgcolor="#e8ecf6">	
	<td  align="center" ><b>Date</b></td>	
	<td  align="center" ><b>CompanyName</b></td>	
	<td  align="center" ><b>ModelName</b></td>
	<td  align="center" ><b>QTY</b></td>
	<td  align="center" ><b><input type="button" class="check" value="All" ></b></td>
	<td  align="center" ><b>Rate</b></td>
	<td  align="center" ><b>DPROFIT%</b></td>
	<td  align="center" ><b>DLRCAL</b></td>
	<td  align="center" ><b>OLD-DLR-NLC</b></td>
	<td  align="center" ><b>DLR-NLC</b></td>
	<td  align="center" ><b>Dis%</b></td>
	<td  align="center" ><b>DisAm</b></td>
	<td  align="center" ><b>InvPrc</b></td>
	<td  align="center" ><b>RPROFIT%</b></td>
	<td  align="center" ><b>RTLCal</b></td>
	<td  align="center" ><b>OfferPrice</b></td>
	<td  align="center" ><b>OFFERLESS%</b></td>
	<td  align="center" ><b>OLD-LastPrice</b></td>
	<td  align="center" ><b>LastPrice</b></td>
	</tr>
	<?php 
$sln=0;
$sln1=0;
//echo "select *,sum(qty) as qty from  main_purchasedet where sl>0  $catsl $scatsl1 $prnm1 $godown1 $todt $snm1 $pstat1 group by prsl,mrp,sup";
$data= mysqli_query($conn,"select *,sum(qty) as qty from  main_purchasedet where sl>0  $catsl $scatsl1 $prnm1 $godown1 $todt $snm1 $pstat1 group by prsl,rate,sup order by sl")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$sl=$row['sl'];
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$qty=$row['qty'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$mrp=$row['mrp'];
$blno1=$row['blno'];
$amm=$row['amm'];
$net_am=$row['net_am'];
$betno=$row['betno'];
$rate=$row['rate'];
$sup=$row['sup'];
$dt=$row['dt'];
$dt=date('d-m-Y', strtotime($dt));
$sln++;
$spn="";
$nm="";
$datad= mysqli_query($conn,"select * from main_suppl where sl='$sup'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$spn=$rowd['spn'];
$nm=$rowd['nm'];
}

$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
}
$datad111= mysqli_query($conn,"select * from main_purchase where blno='$blno1'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad111))
{
$inv=$rowd['inv'];
}
$olddnlc=0;
$oldlprc=0;
$query7="select * from  main_product_prc where psl='$pcd' order by sl desc limit 0,1";
$result5 = mysqli_query($conn,$query7);
while($row=mysqli_fetch_array($result5))
{
$olddnlc=$row['prc'];
$oldlprc=$row['lprc'];
}
$sln1++;
	?>
	<tr title="<?php  echo $sl;?>">	
	<td align="left" ><b><font size="1" ><?php  echo $dt;?></font></b></td>
	<td  align="left" ><b><font size="1" ><?php  echo $spn;?></font></b><br/>
    <b><font size="1" color="red"><?php  echo $inv;?></font></b></td>
	<td  align="left" ><b><?php  echo $pnm;?></b> </td>
	<td  align="right" ><?php  echo $qty;?></td>	
	<td  align="center">    
	<input type="checkbox" value="<?php  echo $sl?>" checked id="sl<?php  echo $sl?>" name="sl[]">
	<input type="hidden"  value="<?php  echo $pnm;?>"  size="5" id="pnm<?php  echo $sl?>" name="pnm<?php  echo $sl?>">
	</td>
	<td  align="right" ><input type="text"  value="<?php echo round($rate,2);?>" onblur="cal('<?php  echo $sl?>')" size="5" id="rate<?php  echo $sl?>" name="rate<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="2" onblur="cal('<?php  echo $sl?>')" id="dp<?php  echo $sl?>" name="dp<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="5" id="dnlc<?php  echo $sl?>" readonly name="dnlc<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="5" id="olddnlc<?php  echo $sl?>" readonly name="olddnlc<?php  echo $sl?>" value="<?php  echo $olddnlc;?>" style="background-color : #F1F692;"></td>
	<td  align="right" ><input type="text" size="5" id="pldnlc<?php  echo $sl?>" readonly name="pldnlc<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="2" onblur="cal('<?php  echo $sl?>')" id="dpdisp<?php  echo $sl?>" name="dpdisp<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="3" id="dpdisam<?php  echo $sl?>" readonly name="dpdisam<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="3" id="invprc<?php  echo $sl?>" readonly name="invprc<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="2" onblur="cal('<?php  echo $sl?>')" id="rprft<?php  echo $sl?>" name="rprft<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="3" id="retoff<?php  echo $sl?>" readonly name="retoff<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="3" id="offprc<?php  echo $sl?>" readonly name="offprc<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="2" onblur="cal('<?php  echo $sl?>')" id="offless<?php  echo $sl?>" name="offless<?php  echo $sl?>"></td>
	<td  align="right" ><input type="text" size="3" id="oldlprc<?php  echo $sl?>" readonly name="oldlprclprc<?php  echo $sl?>" value="<?php  echo $oldlprc;?>" style="background-color : #F1F692;"></td>
	<td  align="right" ><input type="text" size="3" id="lprc<?php  echo $sl?>" readonly name="lprc<?php  echo $sl?>"></td>
	</tr>
	<script>
	 cal('<?php  echo $sl?>');
	</script>
<?php  if($sln1==15){?>
	<tr  bgcolor="#e8ecf6">	
	<td  align="center" ><b>Date</b></td>	
	<td  align="center" ><b>CompanyName</b></td>	
	<td  align="center" ><b>ModelName</b></td>
	<td  align="center" ><b>QTY</b></td>
	<td  align="center" ><b>ALL</b></td>
	<td  align="center" ><b>Rate</b></td>
	<td  align="center" ><b>DPROFIT%</b></td>
	<td  align="center" ><b>DLRCAL</b></td>
	<td  align="center" ><b>OLD-DLR-NLC</b></td>
	<td  align="center" ><b>DLR-NLC</b></td>
	<td  align="center" ><b>Dis%</b></td>
	<td  align="center" ><b>DisAm</b></td>
	<td  align="center" ><b>InvPrc</b></td>
	<td  align="center" ><b>RPROFIT%</b></td>
	<td  align="center" ><b>RTLCal</b></td>
	<td  align="center" ><b>OfferPrice</b></td>
	<td  align="center" ><b>OFFERLESS%</b></td>
	<td  align="center" ><b>OLD-LastPrice</b></td>
	<td  align="center" ><b>LastPrice</b></td>
	</tr>
<?php 
$sln1=0;
}

}
?>
</table>

<style>.no-print{
display: none;
}</style>
