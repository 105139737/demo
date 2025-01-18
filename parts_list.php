<?php 

$reqlevel = 3;

include("membersonly.inc.php");



$frmnm='';

date_default_timezone_set('Asia/Kolkata');

$dt = date('d-M-Y');



$cy=date('Y');

$all=rawurldecode($_REQUEST['all']??"");
$cat=$_REQUEST['cat'] ?? "";
$bnm=$_REQUEST[bnm];
$al="%".$all."%";
$all1="";
if($all!="")
{
$all1=" and pnm LIKE '$al' or pcd LIKE '$al'";
}
$cat1="";
if($cat!="")
{
$cat1=" and cat='$cat'";
}
$bnm1="";
if($bnm!="")
{
$bnm1=" and bnm='$bnm'";
}
$pno=rawurldecode($_REQUEST['pno'] ?? "");
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

  <table  class="table table-hover table-striped table-bordered"  >
  <tr>
 <th >Action</font></th>
<th >Sl</font></th>
<th >Category</font></th>
<th >Brand Name</font></th>
<th >Parts Code</font></th>
<th >Parts Name</font></th>
<th >In Warranty Amount</font></th>
<th >Out Warranty Amount</font></th>
 </tr>

<?php 
$sl=$start;
$sln=0;
$datatt= mysqli_query($conn,"select * from main_parts where sl>0")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from main_parts where  sl>0".$all1.$cat1.$bnm1)or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data= mysqli_query($conn,"select * from main_parts where  sl>0 $all1 $cat1 $bnm1 order by pnm limit $start,$ps ")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	
$cat=$row['cat'];
$bnm=$row['bnm'];
$pnm=$row['pnm'];
$pcd=$row['pcd'];

$wiamm=$row['wiamm'];
$woamm=$row['woamm'];
$x=$row['sl'];

$cnm="";
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}
$sln++;
$sl++; 
?>
<tr>
 <td  align="center" style="cursor:pointer" onclick="edit('<?php  echo $x;?>')" >
<i class="fa fa-pencil-square-o"></i>
</td>
 <td align="center"><?php  echo $sl;?></td>
<td align="center"><?php  echo $cnm;?></td>
<td align="center"><?php  echo $brand;?></td>
<td align="center"><?php  echo $pcd;?></td>
<td align="center"><?php  echo $pnm;?></td>

<td align="center"><?php  echo $wiamm;?></td>
<td align="center"><?php  echo $woamm;?></td>
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

							