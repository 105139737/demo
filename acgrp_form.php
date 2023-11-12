<?php$reqlevel = 3;include("membersonly.inc.php");include "header.php";$sl1=$_REQUEST[sl];$data= mysqli_query($conn,"SELECT * FROM main_project where sl='$sl1'");	while ($row = mysqli_fetch_array($data))		{		$sl= $row['sl'];		$nm=$row['nm'];		}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><div class="wrapper row-offcanvas row-offcanvas-left">            <?            include "left_bar.php";            ?><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title></title><link href="advancedtable.css" rel="stylesheet" type="text/css" /><style type="text/css">#sfdtl{	border : none;	border-radius: 15px;	background-image: url(images/bg1.png);	width : 850px;	display : none;	color: #fff;	position : absolute;	left : 350px;	top : 250px;	font-family: Verdana, Geneva, sans-serif;	font-size: 10px;}#underlay{    display:none;    position:fixed;    top:0;    left:0;   width:100%;    height:100%;    background-color:#000;    -moz-opacity:0.5;    opacity:.50;    filter:alpha(opacity=50);}</style><script>function mnu() { $('#pmnu').load('mnu.php').fadeIn("slow"); $('#tmnu').load('mnu2.php').fadeIn("slow"); }</script><style type="text/css"> a{   color: black;   outline: none;   text-decoration: none;}</style><link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css"><style type="text/css"> #jQueryDatePicker1{   border: 1px #C0C0C0 solid;   background-color: #FFFFFF;   color :#000000;   font-family: Arial;   font-size: 13px;   text-align: left;   vertical-align: middle;}.ui-datepicker{   font-family: Arial;   font-size: 13px;   z-index: 1003 !important;   display: none;}</style><script type="text/javascript" src="jquery.ui.core.min.js"></script><script type="text/javascript" src="jquery.ui.widget.min.js"></script><script type="text/javascript" src="jquery.ui.datepicker.min.js"></script><script type="text/javascript"> $(document).ready(function(){   var jQueryDatePicker1Opts =   {      dateFormat: 'dd-M-yy',      changeMonth: true,      changeYear: true,      showButtonPanel: false,      showAnim: 'show'   };   $("#dt").datepicker(jQueryDatePicker1Opts);});function dlt(sl){document.location='acgrp_form_dlt.php?sl='+sl;}</script><link rel="shortcut icon" href="favicon.ico"/></head><body ><aside class="right-side"><section class="content-header"><h1 align="center">Account Group<small>Entery</small></h1>                    <ol class="breadcrumb">                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>                        <li class="active">Account Group</li>                    </ol>                </section>				   <section class="content"><form name="Form1" method="post" action="acgrp_forms.php" id="Form1"><input type="hidden" name="flnm" id="flnm" value="income.php" ><div class="box box-success" >          <table width="860px" class="table table-hover table-striped table-bordered">  <tr class="odd">    <td align="right" width="20%"><font color="red">*</font>Primary Account :</td>
    <td align="left" width="30%"><select  name="pac" style="width:300px" class="form-control">
							<option value="">-- Select --</option>
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM main_primary order by nm") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>" <?=$row['sl'] == $rowpages['pcd'] ? 'selected' : '' ?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select></td>
	<td align="right" width="20%"><font color="red">*</font>Account Group :</td>
    <td align="left" width="30%">
      <input type="text" name="acgrp" id="acgrp" size="40" class="form-control">
	</td>   
  </tr>
  
  
  
  
  <tr >
    <td colspan="4" align="right"><input type="submit" value="Submit" class="btn btn-success"></td>
  </tr>

</table>

</div>



<?
$data= mysqli_query($conn,"SELECT * FROM main_group order by pcd");

?>
        <div class="box box-success" >
  <table width="860px" class="table table-hover table-striped table-bordered">
          <thead>
          <tr style="height: 30px;">
          <th align="center" width="10%">
          Sl.
          </th>
		  <th align="center" width="40%">
         Primary Account
          </th>
		  <th align="center" width="40%">
          Account Group
          </th>
		  
		  <th align="center" width="10%">
          Edit
          </th>
		  </tr>
          </thead>
          <tbody>
		<?
		$f=0;
		while ($row = mysqli_fetch_array($data))
		{
		$sl= $row['sl'];
		$p=$row['pcd'];
								$data1= mysqli_query($conn,"SELECT * FROM main_primary where sl='$p'");
								while ($row1 = mysqli_fetch_array($data1))
								{
									$p= $row1['nm'];
								}
		$nm = $row['nm'];
        $stat = $row['stat'];
				
		$f++;
		if($f%2==0)
		{$cls="odd";
		}
		else
		{$cls="even";
		}
		$dt=date('d-M-Y', strtotime($dt));
		?>
  <tr class="<?echo $cls;?>" style="height: 20px;">
  <td align="left" valign="top"><?echo $f;?></td>
    <td align="left" valign="top"><?echo $p;?></td>
    <td align="left" valign="top"><?echo $nm;?></td>
	<td align="center" valign="top">    <?if($stat==1)    {    ?>    <a href="acgrp_form_edit.php?sl=<?=$sl;?>" title="Edit"><img src="images/edit.png" width="20"/></a><br/>   <?    }    ?>  </td>
	 </tr>
  <?
  }
  ?>
  </tbody>
</table>

  </div>





<div id='sfdtl' align='center' style="z-index:1000;">
Loding.....<br>
<img src="images/loading.gif">
</div> 
</form>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</body>


<div id="underlay" style="z-index:200;">
</div>
</div>
</html>
