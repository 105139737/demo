<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$query = "SELECT * from main_cnm";
	$result = mysqli_query($conn,$query);
while($row1 = mysqli_fetch_array($result)){
	//branch1	branch2	ifsc1	ifsc2	ac1	ac2	acnm1	acnm2
$cnm=$row1['cnm'];  
 $addr=$row1['addr'];
 $cont=$row1['cont']; 
 $comp_vat=$row1['vat'];
 $comp_cst=$row1['cst']; 
 $comp_lst=$row1['lst'] ?? ""; 
 $comp_lst=$row1['lst'] ?? ""; 
 $gstin=$row1['gstin'];
 $branch1=$row1['branch1'];
 $branch2=$row1['branch2'];
 $ifsc1=$row1['ifsc1'];
 $ifsc2=$row1['ifsc2'];
 $ac1=$row1['ac1'];
 $ac2=$row1['ac2'];
 $acnm1=$row1['acnm1'];
 $acnm2=$row1['acnm2'];
 $sl=$row1['sl'];
}

?>
<html>
<div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<head>
        
<style type="text/css"> 
th{
text-align:center;
color:#FFF;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
#boxpopup{

left:100%;
position:fixed;
}

select.sc {
	width: 250px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}
</style> 
 
</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
               Company 
                        <small>Details</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Company</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">					
<HR> 	
<form name="form1" id="form1" method="post" action="mcats.php" onsubmit="return check()">
                              
<center>
<div class="box box-success" >
<table border="0"  width="100%" class="table table-hover table-striped table-bordered" >
<tr>
<td  align="right" width="20%"><b>Company Name :</b></td>
<td  align="left">
<div id="c_nm<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','cnm','<?php echo $cnm;?>','c_nm<?php  echo $sl;?>','main_cnm')"><b><?php  echo $cnm;?></font></b></a>
 </div> 
</td>
<td  align="right"><b>Contact Number :</b></td>
<td  align="left">
<div id="cont<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','cont','<?php echo $cont;?>','cont<?php  echo $sl;?>','main_cnm')"><b><?php  echo $cont;?></font></b></a>
 </div> 
</td>
</tr>
<tr>
<td  align="right"><b>Company Address :</b></td>
<td  align="left" >
<div id="addr<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','addr','<?php echo $addr;?>','addr<?php  echo $sl;?>','main_cnm')"><b><?php  echo $addr;?></font></b></a>
 </div> 
</td>
<td  align="right"><b>GSTIN :</b></td>
<td  align="left">
<div id="gstin<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','gstin','<?php echo $gstin;?>','gstin<?php  echo $sl;?>','main_cnm')"><b><?php  echo $gstin;?></font></b></a>
 </div> 
</td>
</tr>
<tr>
<td  align="center" colspan="2" width="50%"><b>Bank Details 1</b></td>
<td  align="center" colspan="2" width="50%"><b>Bank Details 2</b></td>
</tr>
<tr>
<td  align="right" width="20%"><b>Branch Name :</b></td>
<td  align="left">
<div id="branch1<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','branch1','<?php echo $branch1;?>','branch1<?php  echo $sl;?>','main_cnm')"><b><?php if($branch1!='') { echo $branch1;}else{echo "N/A";}?></font></b></a>
 </div> 
</td>
<td  align="right"><b>Branch Name :</b></td>
<td  align="left">
<div id="branch2<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','branch2','<?php echo $branch2;?>','branch2<?php  echo $sl;?>','main_cnm')"><b><?php  if($branch2!='') { echo $branch2;}else{echo "N/A";}?></font></b></a>
 </div> 
</td>
</tr>
<tr>
<td  align="right" width="20%"><b>IFSC :</b></td>
<td  align="left" >
<div id="ifsc1<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','ifsc1','<?php echo $ifsc1;?>','ifsc1<?php  echo $sl;?>','main_cnm')"><b><?php  if($ifsc1!='') { echo $ifsc1;}else{echo "N/A";}?></font></b></a>
 </div> 
</td>
<td  align="right"><b>IFSC :</b></td>
<td  align="left">
<div id="ifsc2<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','ifsc2','<?php echo $ifsc2;?>','ifsc2<?php  echo $sl;?>','main_cnm')"><b><?php  if($ifsc2!='') { echo $ifsc2;}else{echo "N/A";}?></font></b></a>
 </div> 
</td>
</tr>
<tr>
<td  align="right" width="20%"><b>A/C Number :</b></td>
<td  align="left" >
<div id="ac1<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','ac1','<?php echo $ac1;?>','ac1<?php  echo $sl;?>','main_cnm')"><b><?php  if($ac1!=''){echo $ac1;}else{echo "N/A";}?></font></b></a>
 </div> 
</td>
<td  align="right"><b>A/C Number :</b></td>
<td  align="left">
<div id="ac2<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','ac2','<?php echo $ac2;?>','ac2<?php  echo $sl;?>','main_cnm')"><b><?php  if($ac2!=''){echo $ac2;}else{echo "N/A";}?></font></b></a>
 </div> 
</td>
</tr>
<tr>
<td  align="right" width="20%"><b>Bank Name :</b></td>
<td  align="left" >
<div id="acnm1<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','acnm1','<?php echo $acnm1;?>','acnm1<?php  echo $sl;?>','main_cnm')"><b><?php  if($acnm1!=''){echo $acnm1;}else{echo "N/A";}?></font></b></a>
 </div> 
</td>
<td  align="right"><b>Bank Name :</b></td>
<td  align="left">
<div id="acnm2<?php  echo $sl;?>">
<a  onclick="sedt('<?php echo $sl;?>','acnm2','<?php echo $acnm2;?>','acnm2<?php  echo $sl;?>','main_cnm')"><b><?php  if($acnm2!=''){echo $acnm2;}else{echo "N/A";}?></font></b></a>
 </div> 
</td>
</tr>
</table>
</form>
</div>
</center>
</form>
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
    </body>
	<script>
function sedt(sl,fn,fv,div,tblnm)
{
$("#"+div).load("gisedt.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div+"&tblnm="+tblnm).fadeIn('fast');
}
function edt1(sl,fn,fv,div,tblnm)
{
	

$("#"+div).load("gisedts.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div+"&tblnm="+tblnm).fadeIn('fast');
}

</script>
	   </div>
</html>