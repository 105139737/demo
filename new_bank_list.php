<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
<html>
<head>

        <div class="wrapper row-offcanvas row-offcanvas-left">

            <?

            include "left_bar.php";

            ?>

<style type="text/css"> 
th{
text-align:center;
font-weight: 900;
color:#000;
border:1px solid #37880a;
}
input:focus{
background-color:Aqua;
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
var brncd= document.getElementById('brncd').value;
var all= document.getElementById('all').value;
$('#sgh').load('new_bank_lists.php?all='+encodeURIComponent(all)+'&brncd='+brncd).fadeIn('fast');
}

function pagnt(pno)
{
var brncd= document.getElementById('brncd').value;
var ps=document.getElementById('ps').value;
var src=document.getElementById('all').value;

$('#sgh').load("new_bank_lists.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(src)+'&brncd='+brncd).fadeIn('fast');
$('#pgn').val=pno;
}

function pagnt1(pno)
{
pno=document.getElementById('pgn').value;
pagnt(pno);
}


function edit(sl)
{
document.location='c_update.php?sl='+sl;
}

function act(sl,val)
{
    //alert(val);
 $('#sgh').load('new_bank_act.php?sl='+sl+'&val='+val).fadeIn('fast');
}
</script>
</head>
<body onload="show()" >
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">New Bank List</h1>
                    <ol class="breadcrumb">
                       <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> New Bank List</li>
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

<HR> 	
<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">
<input type="hidden">
<center>
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>

<td align="right" style="padding-top:15px;font-weight:bold;">Branch : </td>
<td>
<select name="brncd" class="form-control"  tabindex="1"   size="1" id="brncd" >
<?
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---ALL---</option>
<?
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>
</td>
<td align="right" style="padding-top:15px"> <font size="3"><b>Search :</b></font></td>
<td align="left">
<input type="text" name="all" id="all" class="form-control">
</td>
<td align="left" width="10%">
<input type="button" value=" Show " class="btn btn-primary" onclick="show()">
</td>
</tr>
</tbody>
</table>
<div id="sgh">
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