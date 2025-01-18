<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
$dt = date('d-M-Y');
$cy=date('Y');

$brnch=$_REQUEST['brnch'];
$sper=$_REQUEST['sper'];
$brand=$_REQUEST['brand'];
$party1=base64_decode(urldecode($_REQUEST['party']));
$party="";
if(!empty($party1)){
$str=explode("@",$party1);
$party=$str[1];
$partysl=$str[0];
}

if($brnch!=""){$brnch1=" and brncd='$brnch'";}else{$brnch1="";}
if($sper!=""){$sper1=" and SALES_PERSON='$sper'";}else{$sper1="";}
if($brand!=""){$brand1=" and BRAND='$brand'";}else{$brand1="";}
if($party!=""){$party1=" and Party_Name like '$party'";}else{$party1="";}


$pno=$_REQUEST['pno'] ?? "";

//echo $src;
$ps=$_REQUEST['ps'] ?? "";
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;


$sl=$start;
$sln=0; 
$datatt= mysqli_query($conn,"select * from  bills_receivable where sl>0 $brnch1 $sper1 $brand1 $party1")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from bills_receivable where sl>0 $brnch1 $sper1 $brand1 $party1")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data= mysqli_query($conn,"select * from  bills_receivable where sl>0 $brnch1 $sper1 $brand1 $party1 limit $start,$ps ")or die(mysqli_error($conn));
$ccnt=mysqli_num_rows($data);
if($ccnt>0)
{
?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?php  echo $ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
  <table  class="table table-hover table-striped table-bordered"  >
		
		<tr>
		<!-- <th width="5%">Action</font></th>-->
		<th width="5%">Sl</font></th>
		<th  style="text-align:left">Date</font></th>
	    <th width="15%" style="text-align:left">Brand</font></th>
	    <th width="10%" style="text-align:left">Reference No</font></th>
	    <th width="10%" style="text-align:left">Party Name</font></th>
	    <th width="10%" style="text-align:left">Sales Person </font></th>
	    <th width="10%" style="text-align:left">Branch </font></th>
	    <th width="10%" style="text-align:left">Pending Amount</font></th>
	    <th width="10%" style="text-align:left">Overdue</font></th>
	    <th width="5%" style="text-align:center">Edit</font></th>
	   
		</tr>
<?php 


while ($row = mysqli_fetch_array($data))
{
								
$x=$row['sl'];
$BRAND=$row['BRAND'];
$dt=$row['Date'];
$Ref_No=$row['Ref_No'];
$Party_Name=$row['Party_Name'];
$Pending=$row['Pending'];
$Overdue=$row['Overdue'];
$SALES_PERSON=$row['SALES_PERSON'];
$brncd=$row['brncd'];
$dsl=$row['dsl'];

$sln++;
$sl++; 

		$spid2="";
		$data1 = mysqli_query($conn,"Select * from main_branch where sl='$brncd'");
		while ($row1 = mysqli_fetch_array($data1))
		{

		$bnm1=$row1['bnm'];
		}

	
?>
	<tr>
		<td><?php  echo $sl;?>
		</td>
		<td><?php  echo $dt;?></td>
	    <td><?php  echo $BRAND;?></td>
	    <td><?php  echo $Ref_No;?></td>
	    <td><?php  echo $Party_Name;?></td>
	    <td><?php  echo $SALES_PERSON;?></td>
	    <td><?php  echo $bnm1;?></td>
	    <td><?php  echo $Pending;?></td>
	    <td><?php  echo $Overdue;?></td>
	    <td align="center">
		<?php 
		if($dsl!="")
		{?>
		<a href="#" onclick="bill_recv_edit('<?php  echo $x;?>')"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
		<?php }?>
		
		</td>
	</tr>	 
<?php 
}
?>
</table>
<?php 
$tp=$rcnt/$ps;
if(($rcnt%$ps)>0)
{
    $tp=floor($tp)+1;
}
if($pno==1)
{
    $prev=1;
}
else
{
$prev=$pno-1;    
}
if($pno==$tp)
{
 $next=$tp;   
}
else
{
$next=$pno+1;
}
$flt="";
if($rcnt!=$rcntttl)
{
    $flt="(filtered from ".$rcntttl." total entries)";
}
echo "Showing ".($start+1)." to ".($sl)." of ".$rcnt." entries".$flt;
?>
<div align="center"><input type="text" size="10" id="pgn" name="pgn" value="<?php  echo $pno;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>
<div class="pagination pagination-centered">
                            <ul class="pagination pagination-sm inline">
							<li <?php  if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>
                            <li <?php  if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>
                            <?php 
                            
                            if($tp<=5)
                            {
                              $n=1;  
                              while($n<=$tp)
                              {
                                ?>
                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }  
                            }
                            else
                            {
                                if($pno<4)
                                {
                                  $n=1;
                                  while($n<=5)
                              {
                                ?>
                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }     
                                }
                                elseif($pno>$tp-3)
                                {
                                    $n=$tp-5;
                                    while($n<=5)
                              {
                                ?>
                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }   
                                }
                                else
                                {
                                $n=$pno-2; 
                                 while($n<=$pno+2)
                              {
                                ?>
                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }     
                                }
                               
                                
                                
                            }
                            ?>
                            <li <?php  if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>
                            <li <?php  if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>
                            </ul>
                            </div>
<?php 
}
else
{
	?>
	<center><font color="red" size="4"><b>No Data Available...</b></font></center>
	<?php 
}
?>