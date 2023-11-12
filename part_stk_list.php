<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$pnm=$_REQUEST[pnm];
$brncd=$_REQUEST[brncd];
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$al=$pnm;
if($pnm!=""){$pnm1=" and sl = '$al'";}else{$pnm1="";}	



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
			  <td  align="center" >
			<b>Sl</b>
			</td>
			 <td  align="center" >
			<b>Part Name</b>
			</td>
			<td  align="center" >
			<b>Category</b>
			</td>
			<td  align="center" >
			<b>Brand Name</b>
			</td>
        
		
			<td  align="center" >
			<b>Opening</b>
			</td>
			<td  align="center" >
			<b>In</b>
			</td>
			<td  align="center" >
			<b>Out</b>
			</td>
		   <td  align="center" >
			<b>Current</b>
			</td>
		
		     </tr>
<?

$sl=$start;
$c1='odd';
$c3=0;
$sln=0;
$open1=0;
$stkf=0;
$stin1=0;
$stout1=0;
$to=0;

$datatt= mysqli_query($conn,"select * from  main_parts where sl!=''")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from  main_parts where sl!='' $pnm1 " )or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
 $data= mysqli_query($conn,"select * from  main_parts where sl!='' $pnm1 order by pnm limit $start,$ps ")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
$c3++;

$pcd=$row['sl'];
$cat=$row['cat'];
$bnm=$row['bnm'];
$pnm=$row['pnm'];
$wiamm=$row['wiamm'];
$woamm=$row['woamm'];
$ret=$row['pamm'];
$cnm="";
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row15 = mysqli_fetch_array($data1))
{
$cnm=$row15['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}


$sln++;
         
  $sl++; 

$ptu=1;
    $query4="Select sum(opst+stin-stout) as stck1 from main_pstock where pcd='$pcd'".$brncd1;

$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
if($stck!=0)
{
$stkf=$stck/$ptu;
$to=$stck*$ret;

}

  $query6="Select sum(opst) as open from main_pstock where pcd='$pcd'".$brncd1;

  
$result6 = mysqli_query($conn,$query6);
  while ($R6 = mysqli_fetch_array ($result6))
{
$open=$R6['open'];
}
if($open!=0)
{
$open1=$open/$ptu;
}

  $query7="Select sum(stin) as stin from main_pstock where pcd='$pcd'".$brncd1;

  
$result7 = mysqli_query($conn,$query7);
  while ($R7 = mysqli_fetch_array ($result7))
{
$stin=$R7['stin'];
}
if($stin!=0)
{
$stin1=$stin/$ptu;
}
 $query8="Select sum(stout) as stout from main_pstock where pcd='$pcd'".$brncd1;

  
$result8 = mysqli_query($conn,$query8);
  while ($R8 = mysqli_fetch_array ($result8))
{
$stout=$R8['stout'];
}
if($stout!=0)
{
$stout1=$stout/$ptu;
}

	 
		
			 ?>
		   <tr  >
		   
		    <td  align="center" >
			<?=$sln;?>
			</td>
			 <td  align="center" >
			<?=$pnm;?>
			</td>
		
			 <td  align="center" >
			<?echo $cnm;?>
			</td>
			 <td  align="center" >
			<?echo $brand;?>
			</td>
        
			
			<td  align="center" >
		<?=$open1;?>
			</td>
			<td  align="center" >
		<?=$stin1;?>
			</td>
			<td  align="center" >
		<?=$stout1;?>
			</td>
			<td  align="center" >
		<b><?=$stkf;?></b>
			</td>
	
		
		     </tr>	 
<?
$to1=$to+$to1;
$stkf=0;
$stout1=0;
$stin1=0;
$open1=0;
}?>


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
							