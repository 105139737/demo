<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$cr_tm=date('H:i');
$ndl_tm=strtotime("+30 minute", strtotime($cr_tm));
$dl_tm=date('H:i', $ndl_tm);
?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<head>

			

<script type="text/javascript" src="atosg_2.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<link rel="stylesheet" href="atosg_2.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="popup_sedtunt.js"></script>

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

select.sc {
	width: 280px;
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
select.sc1 {
	width: 100%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 4px;
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

   <link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
</style>
<script type="text/javascript" src="light.js" ></script>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
   
   
<link rel="stylesheet" type="text/css" href="jquery.autocomplete1.css" />

<script type="text/javascript" src="jquery.autocomplete1.js"></script>

   <script type="text/javascript" language="javascript">
   /*$(document).ready(function()
{

   var jQueryDatePicker2Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
      $("#ddt").datepicker(jQueryDatePicker2Opts);
	$("#ddt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
		  	   $("#idt").datepicker(jQueryDatePicker2Opts);
	  $("#idt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
 
  $("#custnm").autocomplete("autocomplete2.php", {
		selectFirst: true
	});
cbcd();
   });
   
      function cat(cnm)
   {
	  $('#cont').load('cont2.php?cnm='+encodeURIComponent(cnm)).fadeIn('fast');
	  $('#adr').load('adr2.php?cnm='+encodeURIComponent(cnm)).fadeIn('fast');
   }*/
   </script>
      <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
   
<script type="text/javascript">
/*
function gett()
{
    pcd=document.getElementById('prnm').value;
    fbcd=document.getElementById('fbcd').value;
    $.get('sprcp_trn.php?pcd='+pcd+'&fbcd='+fbcd, function(data) {
				var str= data;
				var stra = str.split("@")
				var pnm = stra.shift()
				var pcd1 = stra.shift()  
                var ret = stra.shift() 
				var upkg = stra.shift() 
				var ppkg = stra.shift() 
				var psl = stra.shift() 
				var exp = stra.shift() 
				var bet = stra.shift() 
				var usl = stra.shift() 
				
	ret1=ret*psl;
	//document.getElementById('prnm').value=pnm;
	//document.getElementById('prc').value=ret1;
	document.getElementById('prid').value=pcd1;
	//document.getElementById('betno').value=bet;
	//document.getElementById('expdt').value=exp;
	
	$('.un').html('<select name="unt" id="unt" onchange="lttla()" class="sc1"><option value="'+ppkg+'">'+ppkg+'</option><option value="'+upkg+'">'+upkg+'</option></select>');
	
	$('.un1').html('<select name="runt" id="runt" onchange="lttla()" class="sc1"> <option value="'+ppkg+'">'+ppkg+'</option></select>');
	
getb();
  
}); 


}
*/

/*
function ep(sl)
{
	
$("#p").load("getp.php?sl="+sl).fadeIn('fast');
$("#e").load("gete.php?sl="+sl).fadeIn('fast');
}*/



</script>

<script type="text/javascript" src="jquery.ui.widget.min.js"></script>


<script type="text/javascript">




	function add()
	{
		
		prnm=document.getElementById('prnm').value;
		qty=document.getElementById('qnty').value;
		fbcd=document.getElementById('fbcd').value;
		tbcd=document.getElementById('tbcd').value;
		document.getElementById('qnty').value='';


	
		
		$('#wb_Text13').load('gorder_tmp.php?prnm='+prnm+'&qty='+qty+'&fbcd='+fbcd+'&tbcd='+tbcd).fadeIn('fast');
		
	}
			function temp()
	{
		
		$('#wb_Text13').load("gorder_tmp_lst.php").fadeIn('fast');
			
	}
		function deltpr(sl)
	{
	
	$('#wb_Text13').load("gorder_tmp_del.php?sl="+sl).fadeIn('fast');
	
	}
	
function cbcd()
	{
		fbcd=document.getElementById('fbcd').value;
		$('#bb').load('cbcd.php?fbcd='+fbcd).fadeIn('fast');
		gett();
	}
	
	function check()
	{
		  if(document.form1.fbcd.value=='')
	  {
		 alert("Please Select Send Branch !");  

		 $('#tbcd').focus();
		 return false;
		 
	  }
	  
	}
</script>

	<script type="text/javascript" src="atosgps.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<link rel="stylesheet" href="atosgps.css" type="text/css" media="screen" charset="utf-8" />	


	</head>
<body onload="temp()" >
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
             Godown Order
                    <small>Order</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Godown Order</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                   

                   

                    <!-- Main row -->
                    
                        <!-- Left col -->
                       
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        
                           

                            <!-- Chat box -->
					
                     <!-- /.box (chat box) -->

                            <!-- TO DO List -->
                          
<form method="post" target="" name="form1" id="form1"  action="gorders.php" onsubmit="return check()">
                              
							
								


        <div class="box box-success" >
<font color="#00a65a">Godown :</font>
  <table border="0" width="860px" class="table table-hover table-striped table-bordered">


<tr>
            <td align="right" style="padding-top:10px" ><font size="4" ><b>Request :</b></font></td>
            <td align="left" >
			
	<?php if($user_current_level<0)
{
			 $query100 = "SELECT * FROM ".$DBprefix."trntemp where eby='$user_currently_loged' order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$fbcd=$R100['fbcd'];
}
if($fbcd!="")
{
	
			?>
    <select name="fbcd" class="form-control" size="1" id="fbcd" style="width:300px" onchange="cbcd()" >
<?php 

$query="Select * from main_branch where sl='$fbcd'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
?>
<option value="<?php  echo $sl;?>"><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
<?php 	
}
else
{

			?>
    <select name="fbcd" class="form-control" size="1" id="fbcd" style="width:300px" onchange="cbcd()" >
<?php 

$query="Select * from main_branch";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
?>
<option value="<?php  echo $sl;?>"><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
<?php }
}?>		
			
			
			
			
			
<?php 
if($user_current_level>0)
{		
?>		
			

    <select name="fbcd" class="form-control" size="1" id="fbcd" style="width:300px"  >
<?php 

$query="Select * from main_branch where sl!='$branch_cnt'";
	

   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
?>
<option value="<?php  echo $sl;?>"><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
<?php }?>
	</td>
	            <td align="right" style="padding-top:10px" ><font size="4" ><b>Godown :</b></font></td>
            <td align="left" >
				<?php if($user_current_level<0)
{?>
					<div id="bb">
    <select name="tbcd" class="form-control" size="1" id="tbcd" style="width:300px"  >

<option value="">---Select---</option>

</select>
</div>	
<?php }?>			
			
			
			
	<?php 
if($user_current_level>0)
{		
?>		
			
    <select name="tbcd" class="form-control" size="1" id="tbcd" style="width:300px"  >

  
<?php 
$query7="Select * from main_branch where sl='$branch_cnt'";


   $result7 = mysqli_query($conn,$query7);
while ($R7 = mysqli_fetch_array ($result7))
{
$sl7=$R7['sl'];
$bnm7=$R7['bnm'];
?>
<option value="<?php  echo $sl7;?>"><?php  echo $bnm7;?></option>
<?php 
}
?>
</select>
<?php }?>

	</td>
</tr>
</table>
</div>
 <div class="box box-success" >
	  <table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td>
 <table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="60%"><b>Particulars</b></td>
<td align="center" width="30%" ><b>Quantity</b></td>
<td align="center" width="10%"><b>Action</b></td>


</tr>

</table>
</td>
</tr>
<tr>
<td>
 <table border="0" width="100%" class="advancedtable">
 <tr>
<td  width="60%"> 

<select id="prnm" name="prnm" class="sc1"  tabindex="2"    >
		<option value="">---Select---</option>
		<?php 
			$query6="select * from  ".$DBprefix."product order by pnm";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
					$pnm=$row['pnm'];
					$cat=$row['cat'];
					$bnm=$row['bnm'];
					$mnm=$row['mnm'];
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
				?>
			<option value="<?php  echo $row['sl'];?>"><?php  echo $pnm;?> - <?php  echo $cnm;?> - <?php  echo $brand;?> - <?php  echo $mnm;?></option>
				<?php 
				}
				?>
			</select>
</td>



<td width="30%">
<input type="text" id="qnty" class="sc" autocomplete="off"  name="qnty" value="" tabindex="7" size="15" >
 </td>

<td width="10%">
<input type="button" class="btn btn-success" id="Button1" name="" value="Add"  onclick="add()" tabindex="9" style="padding:3px;width:100%" >
</td>
</tr>
</table>
   </td>
	   </tr>
	   
	       <tr height="230px">
	   <td>
	   
	<div id="wb_Text13" >

		</div>
	  	</td>
	   </tr>



	   </table>



  <table border="0" width="860px" class="table table-hover table-striped table-bordered">
<td align="right"> 
<input type="submit" class="btn btn btn-success" id="Button2" name="" value="Submit" >
</td>
</tr>


</table>

<input type="hidden" id="prid"  name="prid" value="<?php  echo $cid;?>">
<input type="hidden" id="stk" >
<input type="hidden" id="fls" >
</form>






</div>
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                            </div>
							
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
		  $('#prnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
  
</script>

    </body>
</html>