<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
			

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
	width: 450px;
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
	width: 450px;
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

<script type="text/javascript">



function getb(pcd)
{
$("#gbet").load("getbe.php?pcd="+pcd).fadeIn('fast');

}
function gett(pcd)
{
    
    
    $.get('sprcp.php?pcd='+pcd, function(data) {
				var str= data;
				var stra = str.split("@")
				var pnm = stra.shift()
				var pcd = stra.shift()  
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
	document.getElementById('prid').value=pcd;

	//document.getElementById('betno').value=bet;
	//document.getElementById('expdt').value=exp;

	$('.un').html('<select name="unt" id="unt" onchange="lttla()" class="sc1"><option value="'+ppkg+'">'+ppkg+'</option><option value="'+upkg+'">'+upkg+'</option></select>');
	

getb(pcd);
  
}); 


}
function ep(sl)
{
	

$("#e").load("gete.php?sl="+sl).fadeIn('fast');
prid=document.getElementById('prnm').value;
betno=document.getElementById('betno').value;
 $.get('stk.php?pcd='+prid+'&betno='+betno, function(data) {
	
document.getElementById('stk').value=data;
  
}); 
}

function chk(q)
{
	stk=document.getElementById('stk').value;
	
}
</script>
		

 </script>
 <script type="text/javascript" src="light1.js" ></script>

	</head>
<body >	
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" >
                <!-- Content Header (Page header) -->
                <section class="content-header" >
                    <h1 align="center">
                  <font> Stock Transfer</font>
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Stock Transfer</li>
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
                          
<form name="form1" id="form1" method="post" action="stk_trns.php">
                              
							
								



  <center>
        <div class="box box-success"  >
       <table border="0"   class="table table-hover table-striped table-bordered" >
	
      
		     

		  <tr >
            <td  align="right">Product Name :</td>
            <td  align="left" >
    <select id="prnm" name="prnm" class="sc1"  tabindex="2"  onchange="gett(this.value)" >
		<option value="">---Select---</option>
		<?php 
			$query6="select * from  ".$DBprefix."product order by pname";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
				?>
			<option value="<?php  echo $row['sl'];?>"><?php  echo $row['pname'];?></option>
				<?php 
				}
				?>
			</select> 
            </td>
			   
<td  align="right"> Unit :</td>
            <td  align="left">
			
<div class="un">
<select name="unt" size="1" id="unt" onchange="lttla()" class="sc1" >
<option selected value="0">---Select---</option>
</select>
</div>

            </td>

          </tr>

		
		   <tr >
		   			<td  align="right">
      Batch No.:
			</td>
			<td>
		
<div id="gbet">
<select name="betno" size="1" id="betno" class="sc1">
<option selected value="">---Select---</option>
</select>
</div>
			</td>

			     <td  align="right">Stock In Hand:</td>
            <td  align="left">
		<input type="text" id="stk" class="form-control" style="width:450px" name="stk" value=""  readonly="true" Placeholder="Stock In Hand">

            </td>
          </tr>
		  
		  		   <tr >
		   			<td  align="right">
Expiry Date :
			</td>
			<td>
		
<div id="e">
<input type="text" class="form-control" id="expdt"  style="width:450px" name="expdt" value=""  >
</div>
			</td>

			     <td  align="right">Quantity:</td>
            <td  align="left">
		<input type="text" id="qunt" class="form-control" style="width:450px" name="qunt" value=""  onkeyup="chk(this.value)" Placeholder="Please Enter Quantity">

            </td>
          </tr>

		  		 <tr >
   
<td  align="right"> From :</td>
            <td  align="left">
	
<select name="from"  id="from" class="sc" >

<?php 
if ($user_current_level < 0)
{
?>
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
<?php 	
}
else
{
?>
<option value="<?php  echo $branch_sl;?>"><?php  echo $branch_nm;?></option>
<?php 
}
?>
</select>

            </td>
			     <td  align="right">To :</td>
            <td  align="left">
	<select name="to"  id="to" class="sc">
<?php 
if ($user_current_level < 0)
{
	$query="Select * from main_branch";
}
else
{	
$query="Select * from main_branch where sl!='$branch_sl'";
}
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

            </td>
          </tr>
	
	

		  		  	   <tr >
      
             <td colspan="4" align="right"  style="padding-right: 100px;">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Submit" >
<input type="reset" class="btn btn-primary" id="Button2" name="" value="Reset" >

            </td>
          </tr>

		  </table>
	 <input type="hidden" id="prid" name="prid"  >

                                </div>
								</form><!-- /.box-body -->
								
								
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