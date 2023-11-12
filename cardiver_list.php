<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$all=rawurldecode($_REQUEST[all]);
$al="%".$all."%";
if($all!="")
{
	$all1=" and cno LIKE '$al' or cdet LIKE '$al' or dnm LIKE '$al' or addr LIKE '$al' or mob1 LIKE '$al' or mob2 LIKE '$al' or lno LIKE '$al' or ltyp LIKE '$al'";
}
else
{
$all1="";	
}


$pno=rawurldecode($_REQUEST[pno]);

//echo $src;
$ps=rawurldecode($_REQUEST[ps]);
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;




?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?=$ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
  <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
			  <th >Action</font></th>
			  <th >Sl</font></th>
            <th >Car No.</font></th>
	    <th >Car Details</font></th>
		<th >Driver Name</font></th>
		<th >Address</font></th>
		<th >Mobile No. 1</font></th>
		<th >Mobile No. 2</font></th>
		<th >Driving license No.</font></th>
		<th >License Type</font></th>
	    </tr>
<?

$sl=$start;
$sln=0;
$datatt= mysqli_query($conn,"select * from main_dirver where sl>0")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from main_dirver where  sl>0".$all1)or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
 $data= mysqli_query($conn,"select * from main_dirver where  sl>0 $all1 order by dnm limit $start,$ps ")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
$x=$row['sl'];
$cno=$row['cno'];
$cdet=$row['cdet'];
$dnm=$row['dnm'];
$addr=$row['addr'];
$mob1=$row['mob1'];
$mob2=$row['mob2'];
$lno=$row['lno'];
$ltyp=$row['ltyp'];

$sln++;   
  $sl++; 
 ?>
		   <tr  >
		  
		   <td  align="center" style="cursor:pointer" onclick="edit('<?=$x;?>')" >
			<i class="fa fa-pencil-square-o"></i>
			</td>
		
      	    <td align="center"><? echo $sln;?></td>
            <td align="center"><? echo $cno;?></td>
            <td align="center"><? echo $cdet;?></td>
			<td align="center"><? echo $dnm;?></td>
			<td align="center"><? echo $addr;?></td>
			<td align="center"><? echo $mob1;?></td>
			<td align="center"><? echo $mob2;?></td>
			<td align="center"><? echo $lno;?></td>
			<td align="center"><? echo $ltyp;?></td>
			
		     </tr>	 
<?
}
?>
 </table>
<?
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
<div align="center"><input type="text" size="10" id="pgn" name="pgn" value="<? echo $pno;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>
<div class="pagination pagination-centered">
                            <ul class="pagination pagination-sm inline">
							<li <? if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>
                            <li <? if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>
                            <?
                            
                            if($tp<=5)
                            {
                              $n=1;  
                              while($n<=$tp)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
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
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }     
                                }
                                elseif($pno>$tp-3)
                                {
                                    $n=$tp-5;
                                    while($n<=5)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }   
                                }
                                else
                                {
                                $n=$pno-2; 
                                 while($n<=$pno+2)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }     
                                }
                               
                                
                                
                            }
                            ?>
                            <li <? if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>
                            <li <? if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>
                            </ul>
                            </div>
							