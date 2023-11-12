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
color:#FFF;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="style_sedt1.css" />
<script type="text/javascript" src="prdcedt.js"></script>

 	<script>	
	   $(document).ready(function()
{
	
	 $('#overlay').fadeOut('fast');
	    });
 function show()
 {
 
 var pnm= document.getElementById('pnm').value;
 var brncd= document.getElementById('brncd').value;
 $('#sgh').load('part_stk_list.php?pnm='+pnm+'&brncd='+brncd).fadeIn('fast');

 }


function pagnt(pno){
	 var brncd= document.getElementById('brncd').value;
        var ps=document.getElementById('ps').value;
        var pnm=document.getElementById('pnm').value;
    $('#sgh').load("part_stk_list.php?ps="+ps+"&pno="+pno+"&pnm="+pnm+'&brncd='+brncd).fadeIn('fast');
	$('#pgn').val=pno;
    }
	function pagnt1(pno){
	pno=document.getElementById('pgn').value;
	pagnt(pno);
	}

	/*function openOfferslDialog(sid)
{
 var brncd= document.getElementById('brncd').value;
$('#aaa').load('product_det.php?sl='+sid+'&brncd='+brncd).fadeIn("fast");
$('#compose-modal').modal('show');

}*/

</script>

	</head>
 <body onload="show()" >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Part Wise Stock Details
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Part Wise Stock Details</li>
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
<td align="right" width="17%" style="padding-top:15px"> 
<font size="3">
<b>Part Name :</b>
</font>
</td>
<td align="left" width="30%">

<select id="pnm" style="width:100%;" name="pnm" class="form-control" >
		<option value="">---All---</option>

		<?

   $result56 = mysqli_query($conn,"Select * from ".$DBprefix."parts");
while ($R56 = mysqli_fetch_array ($result56))
{
$psl=$R56['sl'];
$pnm=$R56['pnm'];
$bnm=$R56['bnm'];
$cat=$R56['cat'];
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

<option value="<?=$psl?>"><?=$pnm?> - <?=$cnm?> - <?=$brand?></option>
<?}?>
			</select>
			
</td>
<td align="right" style="padding-top:10px" width="15%">
<b>Branch : </b>
</td>
<td align="left" width="30%" >

    <select name="brncd" class="form-control" size="1" id="brncd"   >
<?
if($user_current_level<0)
{
	?>
	<option value="">---ALL---</option>
	<?
}
if($user_current_level<0)
{
$query="Select * from main_branch";
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
<td align="right" style="padding-right:13px"  width="8%">
<input type="button" value=" Show " class="btn btn-info" onclick="show()">
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



   <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Product Details </h4>
                    </div>
                 
                        <div class="modal-body">
						<div id="aaa">
                            
						
                   </div></div>
                </div>
            </div>
        </div>
     

    </body>
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>
$('#pnm').chosen({no_results_text: "Oops, nothing found!",});
</script>
</html>