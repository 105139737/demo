<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$sl=$_REQUEST['tm'];
$data= mysqli_query($conn,"select * from  main_task where sl='$sl' ")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$x=$row['sl'];
$spid=$row['spid'];
$catsl=$row['cust'];
$day=$row['day'];
$dt=$row['dt'];
}
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
color:#000;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 
<script>
function getcust()
{
var spid= document.getElementById('spid').value;
$('#custdv').load('getcust.php?spid='+encodeURIComponent(spid)).fadeIn('fast');
}
function getday(sl)
{
var day=document.getElementById('day').value;
$.get('nxtdate.php?day='+day, function(data) {
var str= data;
$('#dt').val(str);
})
}
</script>


            <!-- Right side column. Contains the navbar and content of the page -->
           
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Task Asign 
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Task Asign </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="show()">
<div class="box box-success " >
<form method="post" action="task_assign_edts.php" id="form1" onSubmit="return check1()" name="form1">                    
<input type="hidden" id="sl" name="sl" value="<?php echo $sl;?>"> 
<table border="0" class="table table-hover table-striped table-bordered" >
<tr>
<td align="right" style="padding-top:15px;" width="15%"><b>Sales Person :</b></td>
<td  align="left" width="35%">
<select name="spid" class="form-control" size="1" id="spid" tabindex="8"  required onchange="getcust()">

<?
$data1 = mysqli_query($conn,"Select * from main_sale_per where spid='$spid' order by spid");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$spidd=$row1['spid'];
?>
<Option value="<?=$spidd;?>" <?if($spidd==$spid){echo 'Selected';}?>><?=$spidd;?></option>
<?}?>
</select>
</td>
<td align="right" style="padding-top:15px;"  width="15%"><b>Day :</b></td>
<td  align="left" width="35%">
<select id="day" name="day" class="form-control"  onchange="getday()" required> 
<option value="">----Select----</option>       
<option value="sunday" <?if($day=='sunday'){echo 'Selected';}?>>Sunday</option>       
<option value="monday" <?if($day=='monday'){echo 'Selected';}?>>Monday</option>       
<option value="tuesday" <?if($day=='tuesday'){echo 'Selected';}?>>Tuesday</option>       
<option value="wednesday" <?if($day=='wednesday'){echo 'Selected';}?>>Wednesday</option>       
<option value="thursday" <?if($day=='thursday'){echo 'Selected';}?>>Thursday</option>       
<option value="friday" <?if($day=='friday'){echo 'Selected';}?>>Friday</option>       
<option value="saturday" <?if($day=='saturday'){echo 'Selected';}?>>Saterday</option>       
</select>
</td>
</tr>
<tr>
<td align="right" width="11%" style="padding-top:15px;" ><b>Customer :</b></td>
<td  align="left" width=""><div id="custdv">
<select name="cust[]" multiple class="form-control" size="1" id="cust" tabindex="8" >
<?
$data13 = mysqli_query($conn,"Select * from main_cust where sl>0 and find_in_set(sl,'$catsl')>0 ");
while ($row13 = mysqli_fetch_array($data13))
{
$sl3=$row13['sl'];
$cnm=$row13['nm'];
?>
<Option value="<?=$sl3;?>" selected ><?=$cnm;?></option>
<?}?>
<?
$data2 = mysqli_query($conn,"Select * from main_cust where sl>0 and find_in_set(sl,'$catsl')=0 ");
while ($row1 = mysqli_fetch_array($data2))
{
$sl3=$row1['sl'];
$cnm=$row1['nm'];
?>
<option value="<?=$sl3;?>"><?=$cnm;?></option>
<?
}?>	
</select>
</div></td>
<td align="right" style="padding-top:15px;" ><b>Date :</b></td>
<td  align="left">
<input type="text" id="dt" name="dt" value="<?php echo $dt;?>" class="form-control" readonly required> 
</td>			
</tr>
<tr>
<td align="right" colspan="4">
<input type="submit" class="btn btn-success" value="Update" name="B1" >
</td>
</tr>
</table>
</div>
</form>
<div class="box box-success" id="sgh">
</div>	
</body>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
$('#spid').chosen({no_results_text: "Oops, nothing found!",});	
$('#cust').chosen({no_results_text: "Oops, nothing found!",});	
$('#custm').chosen({no_results_text: "Oops, nothing found!",});	
</script>