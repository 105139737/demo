<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include("function.php");
$brncd1="";
$gstdt1="";

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$all=rawurldecode($_REQUEST['all']??"");
$brand=$_REQUEST['brand'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";
$typ=$_REQUEST['typ'];
$sale_per=rawurldecode($_REQUEST['sale_per']);
$al="%".$all."%";
if($all!="")
{
$all1=" and nm LIKE '$al' or addr LIKE '$al' or cont LIKE '$al' or mail LIKE '$al' or gstin LIKE '$al' or nmp LIKE '$al'";
}
else
{
$all1="";	
}
$brand1="";
if($brand!='')
{
$brand1=" and brand='$brand'";
}
if($brncd!='')
{
$brncd1=" and brncd='$brncd'";
}

$typ1="";
if($typ!='')
{
$typ1=" and typ='$typ'";
}
$sale_per1="";
if($sale_per!='')
{
	
$cust=get_value('main_cust_asgn','spid',$sale_per,'cust','');	
$sale_per1="  and FIND_IN_SET(sl, '$cust')>0 ";		
	
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


?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?php  echo $ps;?>" size="7" onblur="pagnt1(this.value)">
</div>

<table class="table table-hover table-striped table-bordered">	
<tr>
<th>Sl</th>
<th>Type</th>
<th>Branch</th>
<th>Name</th>
<th>Map</th>
<th>Action</th>
</tr>
<?php 
$sl=$start;
$sln=0;
$datatt=mysqli_query($conn,"select * from main_cust where sl>0".$all1.$brand1.$typ1.$sale_per1.$brncd1)or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar=mysqli_query($conn,"select * from main_cust where  sl>0".$all1.$brand1.$typ1.$sale_per1.$brncd1)or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data=mysqli_query($conn,"select * from main_cust where  sl>0 $all1 $brand1 $typ1 $sale_per1 $brncd1 order by nm limit $start,$ps ")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$x=$row['sl'];
	$nm=$row['nm'];
	$nmp=$row['nmp'];
	$lat=$row['lat'];
	$lon=$row['lng'];

	$brncd=$row['brncd'];
	$brncd_nm=get_value('main_branch','sl',$brncd,'bnm','');
	if($gstdt1=='0000-00-00')
	{
	$gstdt="00-00-0000";	
	}
	else
	{
	$gstdt=date('d-m-Y',strtotime($gstdt1));
	}

	$sln++;   
	$sl++; 
	$sll=base64_encode($x);
	$err="";
if($gstin!='')
{
if(!preg_match("/[0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9A-Za-z]{1}[Zz1-9A-Ja-j]{1}[0-9a-zA-Z]{1}/", $gstin))
{
$err = "<font color='red'>Invalid GST number</font>";
} 
}
?>
<tr>
<td align="center"><?php  echo $sln;?>
</td>
<td align="left"><?php  echo get_typ($typ);?></td>
<td align="left"><?php  echo $brncd_nm;?></td>
<td align="left"><?php  echo $nm;?></td>
<td  align="left" >
<a href="map.php?lat=<?php  echo $lat?>&lng=<?php  echo $lon;?>&nm=<?php echo rawurlencode($nm);?>" target="_balnk"><font color="blue"><?php  echo $lat?>,<?php  echo $lon;?></font></a>
</td>		
<td align="center"><input type="button" class="btn btn-primary btn-xs" value="Reset" onclick="if(confirm('Are you sure to reset....')){rst('<?php  echo $x;?>')}"></td>
</tr>	 
<?php 
}
?>
</table>
<div style="text-align:left">
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
<div align="left"><input type="text" size="10" id="pgn" name="pgn" value="<?php  echo $pno;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>
<div class="pagination pagination-left">
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
		</div>					