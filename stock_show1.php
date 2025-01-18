<?php 

$reqlevel = 3;

include("membersonly.inc.php");



$frmnm='';

date_default_timezone_set('Asia/Kolkata');

$dt =$_REQUEST['pno'] ?? "";



$cy=date('Y');







$pno=$_REQUEST[pno];



//echo $src;

$ps=$_REQUEST['ps'] ?? "";

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

  <table border="0" width="860px" class="table table-hover table-striped table-bordered">

<thead>

  <tr style="background-color:#2396d6;">

     <th  align="center"  width="60px"  >

   Sl No.

          </th>

	   <th  align="center"   >

   Product Name

          </th>

		      <th  align="center"   >

     Current Stock

          </th>

          <th  align="center"   >

     Unit

          </th>

   	        

	

		  </tr>

		</thead>

<?php 



$sl=$start;

$c1='odd';

$c3=0;

if($user_current_level<0)

{

$datatt= mysqli_query($conn,"select * from  main_stock where sl>0 group by pcd")or die(mysqli_error($conn));

$rcntttl=mysqli_num_rows($datatt);

$datar= mysqli_query($conn,"select * from  main_stock where sl>0 group by pcd")or die(mysqli_error($conn));

$rcnt=mysqli_num_rows($datar);

 $data= mysqli_query($conn,"select * from  main_stock where sl>0 group by pcd limit $start,$ps")or die(mysqli_error($conn));



 }

 else

 {

 $datatt= mysqli_query($conn,"select * from  main_stock where sl>0 and bcd='$branch_code' group by pcd")or die(mysqli_error($conn));

$rcntttl=mysqli_num_rows($datatt);

$datar= mysqli_query($conn,"select * from  main_stock where sl>0 and bcd='$branch_code' group by pcd")or die(mysqli_error($conn));

$rcnt=mysqli_num_rows($datar);

 $data= mysqli_query($conn,"select * from  main_stock where sl>0 and bcd='$branch_code' group by pcd limit $start,$ps")or die(mysqli_error($conn));







}

 ?>



 <?php 

 

while ($row = mysqli_fetch_array($data))

{

	$c3++;

$pcd=$row['pcd'];



          $query = "SELECT * FROM ".$DBprefix."product where sl='$pcd'";

   $result = mysqli_query($conn,$query);

while ($R = mysqli_fetch_array ($result))

{

$pcd=$R['sl'];

$b=$R['pname'];

$c=$R['pkgunt'];

}

$query1="Select * from ".$DBprefix."unit where sl='$c'";

   $result1 = mysqli_query($conn,$query1);

while ($R1 = mysqli_fetch_array ($result1))

{

$punt=$R1['pkgunt'];

$upkg=$R1['untpkg'];

$ptu=$R1['tunt'];

}

if($user_current_level<0)

{

  $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd'";

  }

  else

  {

    $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and bcd='$branch_code'";

  }

  

$result4 = mysqli_query($conn,$query4);

  while ($R4 = mysqli_fetch_array ($result4))

{

$stck=$R4['stck1'];

}

$stkf=$stck/$ptu;

  

if($c1=='odd')

{

$c1='even';

}

elseif($c1=='even')

{

$c1='odd';

}

  $sl++; 

?>



	<tr class="<?php  echo $c1;?>">

	

	<td align="center">

	<b><?php  echo $sl;?></b>

	</td>

	<td align="center">

	<b><?php  echo $b;?></b>

	</td>

			<td align="center">

	<b><?php  echo $stkf;?></b>



	</td>

	<td align="center">

	<b><?php  echo $punt;?></b>

	</td>





		

</tr>

<?php }?>	



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

							