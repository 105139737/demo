<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";

if ($user_current_level < 0 and $super_user=='1'){
}
else
{
    die('Sorry, Only supper user asccess this page.');
}
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<style type="text/css">
th{
text-align:center;
font-weight: 900;
color:#000;
border:1px solid #37880a;

}


a{
cursor:pointer;
}
</style>
<script type="text/javascript" src="prdcedt.js"></script>
 	<script>
	   $(document).ready(function()
{

	 $('#overlay').fadeOut('fast');
	    });
 function show()
 {

 var all= document.getElementById('all').value;
 var actnum=document.getElementById('actnum').value;
var userlevel=document.getElementById('userlevel').value;
var lastlogin=document.getElementById('lastlogin').value;
var brncd=document.getElementById('brncd').value;
var logstat=document.getElementById('logstat').value;
 $('#sgh').load('user_list.php?all='+encodeURIComponent(all)+"&actnum="+actnum+"&userlevel="+userlevel+"&lastlogin="+lastlogin+"&brncd="+brncd+"&logstat="+logstat).fadeIn('fast');

 }




function pagnt(pno){
        var ps=document.getElementById('ps').value;
        var src=document.getElementById('all').value;
        var actnum=document.getElementById('actnum').value;
        var userlevel=document.getElementById('userlevel').value;
        var lastlogin=document.getElementById('lastlogin').value;
        var brncd=document.getElementById('brncd').value;
        var logstat=document.getElementById('logstat').value;
    $('#sgh').load("user_list.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(src)+"&actnum="+actnum+"&userlevel="+userlevel+"&lastlogin="+lastlogin+"&brncd="+brncd+"&logstat="+logstat).fadeIn('fast');
	$('#pgn').val=pno;
    }
	function pagnt1(pno){
	pno=document.getElementById('pgn').value;
	pagnt(pno);
	}







function edit(sl)
{
document.location='user_edt.php?sl='+sl;
}
function act(sl,val)
{
 $('#sgh').load('user_act.php?sl='+sl+'&val='+val).fadeIn('fast');
}
function rst(sl)
{
 $('#sgh').load('pass_rst.php?sl='+sl).fadeIn('fast');
}
function chngpass(pass,sl)
{
 $('#cp').load('pass.php?pass='+pass+'&sl='+sl).fadeIn('fast');
}
function days_udt(pass,fld,sl)
{
 $('#cp').load('pass.php?pass='+pass+'&sl='+sl+'&fld='+fld).fadeIn('fast');
}
</script>

	</head>
 <body onload="show()" >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" >
                    <h1 align="center">
               <font > User List </font>

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">User List</li>
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
 	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">





<input type="hidden">
  <center>
        <div class="box box-success" >
      <table border="0" width="860px" class="table table-hover table-striped table-bordered">

<tr>
<td align="left" >
<b>	Branch :</b>
<select name="brncd" class="form-control" size="1" id="brncd"   >
    <option value="">---All---</option>
<?php 
if($user_current_level<0)
{
$query="Select * from main_branch";
?>

<?php 
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
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
</td>
<td align="left" >
<b>	Status :</b>
<select name="actnum" class="form-control" size="1" id="actnum"   >
<option value="">---ALL---</option>
<option value="0">Active</option>
<option value="1">Deactive</option>
</select>
</td>   
<td align="left" >
<b>	Current Status :</b>
<select name="logstat" class="form-control" size="1" id="logstat"   >
<option value="">---ALL---</option>
<option value="1">Online</option>
<option value="0">Offline</option>
</select>
</td>
<td align="left" >
<b>	Designation :</b>
<select name="userlevel" class="form-control" size="1" id="userlevel">
<option value="">---ALL---</option>
<?php 
$query1="Select * from main_deg";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$sl1=$R1['lvl'];
$deg=$R1['deg'];
?>
<option value="<?php  echo $sl1;?>"><?php  echo $deg;?></option>
<?php 
}
?>
</select>
</td>
<td align="left" >
<b>	Last Login   :</b>
<select name="lastlogin" class="form-control" size="1" id="lastlogin"   >
<option value="">---ALL---</option>
<option value="1">1 Month</option>

</select>
</td>   
<td align="left">
<b>Search :</b>
<input type="text" name="all" id="all" class="form-control">
</td>
</tr>
<tr>
<td colspan="6" align="right" >
<input type="button" value=" Show " class="btn btn-info" onclick="show()">
</td>
</tr>


</tbody>
</table>
<div id="sgh" style="overflow: scroll;">
</div>
<div id="cp">
</div>

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



    </body>
</html>
