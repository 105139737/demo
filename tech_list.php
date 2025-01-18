<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$all=rawurldecode($_REQUEST['all']??"");
$al="%".$all."%";
if($all!="")
{
	$all1=" and cnm LIKE '$al'";
}
else
{
$all1="";	
}


$pno=rawurldecode($_REQUEST['pno'] ?? "");

//echo $src;
$ps=rawurldecode($_REQUEST['ps'] ?? "");
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;




$sl=$start;
$sln=0;

$datatt= mysqli_query($conn,"select * from  ".$DBprefix."catg where sl>0")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from ".$DBprefix."catg where sl>0 $all1")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data= mysqli_query($conn,"select * from  ".$DBprefix."catg where sl>0 $all1 order by cnm limit $start,$ps ")or die(mysqli_error($conn));
$rcntt=mysqli_num_rows($data);
if($rcntt>0)
{
?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?php  echo $ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
  <table  class="table table-hover table-striped table-bordered"  >
		
		<tr>
		<th width="10%">Action</font></th>
		<th width="5%">Sl</font></th>
	    <th width="75%" style="text-align:left">Brand</font></th>
	    <th width="10%" style="text-align:left">Delete</font></th>
	  <!--  <th width="10%" style="text-align:left">HSN ACS</font></th>
	    <th width="10%" style="text-align:left">Small Unit</font></th>
	    <th width="10%" style="text-align:left">Small Value</font></th>
	    <th width="10%" style="text-align:left">Midle Unit</font></th>
	    <th width="10%" style="text-align:left">Midle Value</font></th>
	    <th width="10%" style="text-align:left">Big Unit </font></th>
	    <th width="10%" style="text-align:left">Big Value</font></th>-->
		</tr>
<?php 

while ($row = mysqli_fetch_array($data))
{
$x=$row['sl'];
$cnm=$row['cnm'];
$hsn=$row['hsn'];
$sln++;
$sl++; 
$sun="";
$mun="";
$bun="";
$smvlu="";
$mdvlu="";
$bgvlu="";
/*
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$x'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	$sun=$row['sun'];
	$mun=$row['mun'];
	$bun=$row['bun'];
	$smvlu=$row['smvlu'];
	$mdvlu=$row['mdvlu'];
	$bgvlu=$row['bgvlu'];
}*/
?>
		<tr>
		<td  align="center" style="cursor:pointer" onclick="edit('<?php  echo $x;?>')" >
		<i class="fa fa-pencil-square-o"></i>
		</td>
		<td align="center"><?php  echo $sln;?></td>
		<td align="left"><?php  echo $cnm;?></td>
		<td style="text-align:center;">
		<?php 
		$sqle  = mysqli_query($conn,"select * from main_scat where cat='$x'") or die(mysqli_error($conn));
		$cnts = mysqli_num_rows($sqle);

		if($cnts == 0)
		{
		?>
		<input type="button" title="Click Here To Delete" class="btn btn-block btn-danger btn-xs" value="Delete" onclick="dlts('<?php  echo $x; ?>')" name="B2">
		<?php 	
		}
		?>


		</td>
       <!-- <td align="left"><?php  echo $hsn;?></td>
        <td align="left"><?php  echo $sun;?></td>
        <td align="left"><?php  echo $smvlu;?></td>
        <td align="left"><?php  echo $mun;?></td>
        <td align="left"><?php  echo $mdvlu;?></td>
        <td align="left"><?php  echo $bun;?></td>
        <td align="left"><?php  echo $bgvlu;?></td>-->
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
	<center><font size="4" color="red"><b>No Data Available...</b></font></center>
	<?php 
}
?>							