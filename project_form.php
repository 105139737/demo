<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />


<style type="text/css">
#sfdtl
{
	border : none;
	border-radius: 15px;
	background-image: url(images/bg1.png);
	width : 850px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 350px;
	top : 250px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
}
#underlay{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background-color:#000;
    -moz-opacity:0.5;
    opacity:.50;
    filter:alpha(opacity=50);
}
</style>

<script>
 function mnu()
 {
 $('#pmnu').load('mnu.php').fadeIn("slow");
  $('#tmnu').load('mnu2.php').fadeIn("slow");
 }
 </script>
<style type="text/css"> 
a
{
   color: black;
   outline: none;
   text-decoration: none;
}

</style>
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css"> 

#jQueryDatePicker1
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}

</style>


<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<script type="text/javascript"> 
$(document).ready(function()
{
   var jQueryDatePicker1Opts =
   {
      dateFormat: 'dd-M-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   $("#dt").datepicker(jQueryDatePicker1Opts);
});

	
</script>




<link rel="shortcut icon" href="favicon.ico"/>
</head>


<body >
 <aside class="right-side">
  <section class="content-header">
                    <h1 align="center">
                 Project
                        <small>Entery</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Project</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="project_forms.php" id="Form1">
<input type="hidden" name="flnm" id="flnm" value="income.php" >

 <div class="box box-success" >
          <table width="860px" class="table table-hover table-striped table-bordered">
        

    
        
   <tr class="odd">
    <td align="right" width="30%"><font color="red">*</font>Project Name :</td>
    <td align="left" width="70%"><input class="form-control" type="text" name="pnm" id="pnm" size="40"></td>

  </tr>
  
  
  
  
  <tr >
    <td colspan="4" align="right"><input type="submit" value="Submit" class="btn btn-success"></td>
  </tr>

</table>

</div>

<?php 
$data= mysqli_query($conn,"SELECT * FROM main_project order by sl desc");

?>
 <div class="box box-success" >
  <table width="860px" class="table table-hover table-striped table-bordered">
 <thead>
          <tr style="height: 30px;">
          <th align="center" width="10%">
          Sl.
          </th>
		  <th align="center" width="40%">
         Project Name
          </th>
		 
		  
		  <th align="center" width="10%">
          Edit
          </th>
		  </tr>
          </thead>
          <tbody>
		<?php 
		$f=0;
		while ($row = mysqli_fetch_array($data))
		{
		$sl= $row['sl'];
		$pnm=$row['nm'];
	
				
		$f++;
		if($f%2==0)
		{$cls="odd";
		}
		else
		{$cls="even";
		}
		$dt=date('d-M-Y', strtotime($dt));
		?>
  <tr class="<?php echo $cls;?>" style="height: 20px;">
  <td align="left" valign="top"><?php echo $f;?></td>
    <td align="left" valign="top"><?php echo $pnm;?></td>
	<td align="center" valign="top"><a href="project_form_edit.php?sl=<?php  echo $sl;?>" title="Edit"><img src="images/edit.png" width="20"/></a></td>
	 </tr>
  <?php 
  }
  ?>
  </tbody>
</table>
</div>

<div id="show">

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
