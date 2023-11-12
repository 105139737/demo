<?
$reqlevel = 1; 

include("membersonly.inc.php");
$all=rawurldecode($_REQUEST['sby']);
$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$al='%'.$sby.'%';
if($all!="")
{
	$all1=" and nm LIKE '$al'";
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
   <table border="0" width="860px" class="table table-hover table-striped table-bordered">
   <thead>
<tr style="background-color:#2396d6;">
<th align="center">Sl.</th>

<th align="center">Shop Name</th>
<th align="center">Customer Name</th>
<th align="center">Customer Address</th>
<th align="center">Customer Contact No.</th>
</tr></thead>
<?
$sl=$start;
$c1='odd';
$c3=0;
$sln=0;
$datatt= mysqli_query($conn,"select * from main_billing where sl>0".$brncd1)or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from main_billing where sl>0".$all1.$brncd1)or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
 $data= mysqli_query($conn,"select * from main_billing where sl>0 $all1 $brncd1 group by cid limit $start,$ps")or die(mysqli_error($conn));
 
while ($r = mysqli_fetch_array($data))
{
$cid=$r['cid'];


 $data4= mysqli_query($conn,"select * from  main_suppl where sid='$cid' and (tp='Debtors' or tp='Both')")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data4))
{
	$c3++;
$spn=$row['spn'];
$cnm=$row['nm'];
$addr=$row['addr'];
$mob1=$row['mob1'];
}

        
  $sl++; 



$sln++;

?>
<tr style="cursor:pointer" onclick="openOfferslDialog('<?=$cid;?>')">
<td align="center"><?=$sln;?></td>

<td align="center"><?=$spn;?></td>
<td align="center"><?=$cnm;?></td>
<td align="center"><?=$addr;?></td>
<td align="center"><?=$mob1;?></td>


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