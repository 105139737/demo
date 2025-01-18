<?php 
$reqlevel = 3;
include("membersonly.inc.php");


$pnog=rawurldecode($_REQUEST['pnog'] ?? "");

//echo $src;
$ps=rawurldecode($_REQUEST['ps'] ?? "");
if($ps=="")
{
$ps=10;
}
if($pnog==""){$pnog=1;}
$start=($pnog-1)*$ps;
$brncd=$_REQUEST['brncd'];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$fdt1=$_REQUEST['fdt'];
$tdt1=$_REQUEST['tdt'];

$custid=$_REQUEST['custid'];
if($custid==""){$custid1="";}else{$custid1=" and cid='$custid'";}
if($fdt1=="" && $tdt1=="")
{
$todt="";
}
else
{
$fdt=date('Y-m-d',strtotime($fdt1));
$tdt=date('Y-m-d',strtotime($tdt1));
$todt=" and dt between '$fdt' and '$tdt'";
}

?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?php  echo $ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
          <table width="100%" border="1" class="table table-hover table-striped table-bordered">
  
          <tr style="height: 30px;">
          <th align="center" width="5%">
          Sl.
          </th>
		  <th align="center" width="15%">
         Date & JF No.
          </th>
		  <th align="center" width="25%">
          Credit Ledger &<br>Debit Ledger
          </th>
		  <th align="center" width="15%">
          Amount 
          </th>
		   <th align="center" width="15%">
          Payment Details
          </th>
		  <th align="center" >
          Narration
          </th>
		  
		  <th align="center" width="5%">
          Edit
          </th>
		  </tr>
     
          <tbody>
		<?php 
		$f=0;
	
$sl=$start;
$sln=0;
$datatt= mysqli_query($conn,"SELECT * FROM main_drcr where typ='99' and stat='1' $brncd1 $custid1 $todt")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"SELECT * FROM main_drcr where typ='99' and stat='1' $brncd1 $custid1 $todt")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
 $data= mysqli_query($conn,"SELECT * FROM main_drcr where typ='99' and stat='1' $brncd1 $custid1 $todt order by dt Desc,sl desc limit $start,$ps")or die(mysqli_error($conn));
 
	
		while ($row = mysqli_fetch_array($data))
		{
		$sl1= $row['sl'];
		$dt= $row['dt'];
		$pno= $row['pno'];
		$vno= $row['vno'];
		$cldgr= $row['cldgr'];
		$dldgr= $row['dldgr'];
		$mtd= $row['mtd'];
		$mtddtl= $row['mtddtl'];
		$amm= $row['amm'];
		$nrtn= $row['nrtn'];
		$eby= $row['eby'];
		$cid= $row['cid'];
		$brncd= $row['brncd'];
		$cbill= $row['cbill'];
		
		
		if($mtddtl=='')
		{$mtddtl='NA';
		}
		if($nrtn=='')
		{$nrtn='NA';
		}
		
								$data1= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$cldgr'");
								while ($row1 = mysqli_fetch_array($data1))
								{
									$cldgr= $row1['nm'];
								}
								
								$data2= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$dldgr'");
								while ($row2 = mysqli_fetch_array($data2))
								{
									$dldgr= $row2['nm'];
								}
								
								$data3= mysqli_query($conn,"SELECT * FROM ac_paymtd where sl='$mtd'");
								while ($row3 = mysqli_fetch_array($data3))
								{
									$mtd= $row3['mtd'];
								}
								$bnm="";
								$data21= mysqli_query($conn,"SELECT * FROM main_branch where sl='$brncd'");
								while ($row21 = mysqli_fetch_array($data21))
								{
									$bnm= $row21['bnm'];
								}
							
								$query6="select * from  main_cust where sl='$cid'";
								$result5 = mysqli_query($conn,$query6);
								while($row=mysqli_fetch_array($result5))
								{
								$nm=$row['nm'];
								}
								
		$f++;
		if($f%2==0)
		{$cls="odd";
		}
		else
		{$cls="even";
		}
		$dt=date('d-M-Y', strtotime($dt));
		if($dldgr==7){$cbill="ADVANCE-PAYMENT";}
		?>
  <tr class="<?php echo $cls;?>" style="height: 20px;">
  <td align="left" valign="top"><a href="#" title="By : <?php  echo $eby;?> | On :<?php  echo $edt;?>"><b><?php echo $f;?></b></td>
    <td align="left" valign="top"><b>Date :</b> <?php echo $dt;?><br><b>Branch :</b> <?php echo $bnm;?></td>
    <td align="left" valign="top"><b>C.Ledger :</b> <?php echo $cldgr;?><br><b>D.Ledger :</b> <?php  echo $nm;?></td>

	 <td align="center" valign="top" align="right">
	 <b> Bill No. <?php  echo $cbill;?></b><br>
	 <font color="red">Rs. <b><?php echo $amm;?></b>
	 
	 </font></td>
	 <td align="left" valign="top"><b>Mode :</b> <?php echo $mtd;?><br><b>Ref. : </b><?php echo $mtddtl;?></td>
	    <td align="left" valign="top"><?php echo $nrtn;?></td>
	<td align="center" valign="top">
	<a href="#" onclick="sfdtlrecvrefund('<?php  echo $sl1; ?>')" title="Edit"><img src="images/edit.png" width="30"/></a>
	
	</td>
	 </tr>
  <?php 
  }
  ?>
  </tbody>
</table>
<?php 
$tp=$rcnt/$ps;
if(($rcnt%$ps)>0)
{
    $tp=floor($tp)+1;
}
if($pnog==1)
{
    $prev=1;
}
else
{
$prev=$pnog-1;    
}
if($pnog==$tp)
{
 $next=$tp;   
}
else
{
$next=$pnog+1;
}
$flt="";
if($rcnt!=$rcntttl)
{
    $flt="(filtered from ".$rcntttl." total entries)";
}
echo "<font color=\"#FFF\">Showing ".($start+1)." to ".($sl)." of ".$rcnt." entries".$flt."</font>";
?>
<div align="left"><input type="text" size="10" id="pgn" name="pgn" value="<?php  echo $pnog;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>
<div class="pagination pagination-centered">
                            <ul class="pagination pagination-sm inline">
							<li <?php  if($pnog==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>
                            <li <?php  if($pnog==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>
                            <?php 
                            
                            if($tp<=5)
                            {
                              $n=1;  
                              while($n<=$tp)
                              {
                                ?>
                             <li <?php  if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }  
                            }
                            else
                            {
                                if($pnog<4)
                                {
                                  $n=1;
                                  while($n<=5)
                              {
                                ?>
                             <li <?php  if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }     
                                }
                                elseif($pnog>$tp-3)
                                {
                                    $n=$tp-5;
                                    while($n<=5)
                              {
                                ?>
                             <li <?php  if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }   
                                }
                                else
                                {
                                $n=$pnog-2; 
                                 while($n<=$pnog+2)
                              {
                                ?>
                             <li <?php  if($pnog==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }     
                                }
                               
                                
                                
                            }
                            ?>
                            <li <?php  if($pnog==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>
                            <li <?php  if($pnog==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>
                            </ul>
                            </div>
							