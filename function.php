<?php 
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

function get_stock($pcd,$conn)
{
    ini_set('max_execution_time', 3000);
    include("config.php");	
    $stck=0;    
    $query4="Select sum(opst+stin-stout) as stck1 from main_stock where pcd='$pcd'";
    $result4 = mysqli_query($conn,$query4);
    while ($R4 = mySqli_fetch_array ($result4))
    {
        $stck=$R4['stck1'];
    }
    return $stck;
}

function get_value($table,$srcfild,$srcval,$rtrnfild,$morecond)
{
    ini_set('max_execution_time', 3000);
	include("config.php");
	$rtrnval=0;
	$sql=mysqli_query($conn,"SELECT $rtrnfild FROM $table WHERE $srcfild='$srcval' $morecond");
	while($R=mysqli_fetch_array($sql))
	{
		$rtrnval=$R[$rtrnfild];
	}
	return $rtrnval; 
}

function get_val($table,$sl,$nm,$ufld)
{
    ini_set('max_execution_time', 3000);
	include("config.php");
    $data= mysqli_query($conn,"select $nm from $table where $ufld='$sl'")or die(mysqli_error($conn));
    $val="";
    while ($row= mysqli_fetch_array($data))
    {
        $val=$row[$nm];
    }	
    return $val;
}

function get_typ($value)
{
    ini_set('max_execution_time', 3000);
	include("config.php");
    $p=mysqli_query($conn,"select * from main_cus_typ where sl='$value'") or die (mysqli_error($conn));
    while($rw2=mysqli_fetch_array($p))
    {
    	$value1=$rw2['tp'];
    }
    return $value1;
}

function reformat($str)
{
	
$result = str_split($str);
$fstr="";
$chkint=false;
for($i=0;$i<count($result);$i++)
{
	if($i>0)
	{
	if(is_numeric($result[$i]))
	{
	if(!$chkint)
	{	
	$chkint=true;
	$fstr.=" ".$result[$i];
	}
	else
	{
	$fstr.=$result[$i];	
	}
	}
	else
	{
	$chkint=false;	
	$fstr.=$result[$i];	
	}	
	}
	else
	{
	if(is_numeric($result[$i]))
	{
	$chkint=true;
	$fstr=$result[$i];
	}
	else
	{	
	$fstr=$result[$i];	
	}
	}
}

return $fstr;
}
function get_branch_name_($current_branch_code){
	include("config.php");	 
  $query1111 = "SELECT * FROM main_branch where sl='$current_branch_code'";
	$result1111 = mysqli_query($conn,$query1111);
 while($rw1111=mysqli_fetch_array($result1111))
 {
	 $current_branch_name=$rw1111['bnm'];
 
 }  
 return $current_branch_name;
}
function get_avg_rate($conn, $pcd, $tdt)
{

	$query4 = "Select * from main_purchasedet where prsl='$pcd' and  dt<='$tdt'  order by sl desc limit 1";
	$result4 = mysqli_query($conn, $query4);
	while ($R4 = mysqli_fetch_array($result4)) {
		$fsl = $R4['sl'];
	}

	$query4 = "Select * from main_purchasedet where prsl='$pcd' and  dt<='$tdt'  order by sl desc  limit 2";
	$result4 = mysqli_query($conn, $query4);
	while ($R4 = mysqli_fetch_array($result4)) {
		$lsl = $R4['sl'];
	}
	$close_rt = 0;


	$query4 = "Select sum(amm)/sum(qty) as stck1 from main_purchasedet where prsl='$pcd' and  dt<='$tdt' and sl between '$lsl' and '$fsl' order by sl";
	$result4 = mysqli_query($conn, $query4);
	while ($R4 = mysqli_fetch_array($result4)) {
		$close_rt = round($R4['stck1'], 2);
	}
	return $close_rt;
}
function lgBetnoModify($betno)
{
$betno_len=strlen($betno);
$betno_sync ="";
if($betno_len>5 && $betno_len<14)
{
$betno_sync=$betno;
}
elseif($betno_len==18)
{
 $betno_sync = substr($betno, 3, -2);
}
elseif($betno_len==19)
{
 $betno_sync = substr($betno, 4, -2);
}
else
{
 $betno_sync ="";
}
return $betno_sync;
}
?>