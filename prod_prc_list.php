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

function pdf()
{
var all= document.getElementById('all').value;
window.open('prod_prc_list_pdf.php?all='+encodeURIComponent(all));
}

function show()
{
var all= document.getElementById('all').value;
$('#sgh').load('prod_prc_lists.php?all='+encodeURIComponent(all)).fadeIn('fast');
}

function pagnt(pno)
{

var ps=document.getElementById('ps').value;
var src=document.getElementById('all').value;

$('#sgh').load("prod_prc_lists.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(src)).fadeIn('fast');
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
 $('#sgh').load('user_act.php?sl='+sl+'&val='+val).fadeIn('fast');
}
function deactive()
{
    $('#deactive').load('deactive_price.php').fadeIn('fast');   
}
</script>
</head>
<body onload="show()" >
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">Product Rate List</h1>
                    <ol class="breadcrumb">
                       <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Product Rate List</li>
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
<td align="right" width="30%" style="padding-top:15px"> <font size="3"><b>Search :</b></font></td>
<td align="left" width="40%">
<input type="text" name="all" id="all" class="form-control">
</td>
<td align="left" width="30%">
<input type="button" value=" Show " class="btn btn-primary" onclick="show()">
<input type="button" value=" Export to PDF " class="btn btn-success" onclick="pdf()">

</td>
</tr>
</tbody>
</table>
<input type="button" value="Deactivated Product's Price will aslo be Deactivated " class="btn btn-danger" onclick="deactive()">
<div id="deactive">
</div>
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