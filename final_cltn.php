<?
$reqlevel=3;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$sa=date('d-m-Y');
$saa="01-".date('m-Y');
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
color:red;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<script>


function gpro()
{
	var cat=document.getElementById('cat').value;
	var bnm=document.getElementById('bnm').value;
	$('#gpro').load('get_pro.php?bnm='+bnm+'&cat='+cat).fadeIn('fast');
}

function show1()
{
	var cid=encodeURIComponent(document.getElementById('cid').value);
	var salper=encodeURIComponent(document.getElementById('salper').value);
	var brncd=encodeURIComponent(document.getElementById('brncd').value);
	var fdt=encodeURIComponent(document.getElementById('fdt').value);
	var tdt=encodeURIComponent(document.getElementById('tdt').value);
	var stat=encodeURIComponent(document.getElementById('stat').value);
	var als=encodeURIComponent(document.getElementById('als').value);
	var blno=encodeURIComponent(document.getElementById('blno').value);
	
	var ledg=document.getElementById('ledg').value;
	var mdt=document.getElementById('mdt').value;
	
	$('#data8').load('final_cltns.php?cid='+cid+'&salper='+salper+'&brncd='+brncd+'&fdt='+fdt+'&tdt='+tdt+'&stat='+stat+'&ledg='+ledg+'&mdt='+mdt+'&als='+als+'&blno='+blno).fadeIn('fast');
}

function exprt()
{
	var cid=encodeURIComponent(document.getElementById('cid').value);
	var salper=encodeURIComponent(document.getElementById('salper').value);
	var brncd=encodeURIComponent(document.getElementById('brncd').value);
	var fdt=encodeURIComponent(document.getElementById('fdt').value);
	var tdt=encodeURIComponent(document.getElementById('tdt').value);
	var stat=encodeURIComponent(document.getElementById('stat').value);
	var als=encodeURIComponent(document.getElementById('als').value);
	var blno=encodeURIComponent(document.getElementById('blno').value);
	var ledg=document.getElementById('ledg').value;
	var mdt=document.getElementById('mdt').value;
	
	document.location='final_cltns1.php?cid='+cid+'&salper='+salper+'&brncd='+brncd+'&fdt='+fdt+'&tdt='+tdt+'&stat='+stat+'&ledg='+ledg+'&mdt='+mdt+'&als='+als+'&blno='+blno;
}

function cncl(sl)
{
	$('#data8').load('cncl.php?sl='+sl).fadeIn('fast');
}

function view(blno)
{
	window.open('bill_typ.php?blno='+encodeURIComponent(blno), '_blank');
	window.focus();
}
</script>
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
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
   $(document).ready(function()
{
   var jQueryDatePicker2Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };	

$("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

$("#fdt").datepicker(jQueryDatePicker2Opts);
$("#tdt").datepicker(jQueryDatePicker2Opts);
});
</script>

</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">Final Collection</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Final Collection</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="sale_xls.php" name="form1"  id="form1">
<div class="box box-success" >
<table class="table table-hover table-striped table-bordered">
<thead>
<tr>
<td width="25%;"><b>Customer:</b><br>
	<select id="cid" name="cid" class="form-control">
	<option value="">--- All ---</option>
	<?
	$get=mysqli_query($conn,"SELECT * FROM main_cust ORDER BY nm");
	while($R=mysqli_fetch_array($get))
	{
		$sid=$R['sl'];
		$nm=$R['nm'];
		$cont=$R['cont'];
		?>
		<option value="<? echo $sid;?>"><? echo $nm;?> - <? echo $cont;?></option>
		<?
	}
	?>
	</select>
</td>
<td width="25%;"><b>Sales Person:</b><br>
	<select name="salper" id="salper" class="form-control">
	<option value="">---All---</option>
	<?
	$get=mysqli_query($conn,"SELECT * FROM main_sale_per ORDER BY nm");
	while($row=mysqli_fetch_array($get))
	{
		$sid=$row['spid'];
		$spid=$row['spid'];
		?>
		<option value="<? echo $sid;?>"><?php echo $spid;?></option>
		<?
	}
	?>
	</select>
</td>
<td width="25%;"><b>Form:</b><br>
<input type="text" id="fdt" name="fdt" value="<?echo $saa;?>" class="form-control">
</td>
<td width="25%;"><b>To:</b><br>
<input type="text" id="tdt" name="tdt" value="<?echo $sa;?>" class="form-control">
</td>

</tr>
<tr>
<td align="left" ><b>Ledger :</b>
<select id="ledg" name="ledg" class="form-control" >
<option value="">-- All --</option>
<?php 
$get = mysqli_query($conn,"SELECT * FROM main_ledg order by nm") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>"><?=$row['nm']?></option>
<?php 
} 
?>
</select>
</td>
<td> 
<label><b>Payment Mode :</b></label>
<select name="mdt" id="mdt"  onchange="pmod(this.value)" class="form-control">
<option value="">-- All --</option>
<?
$data2 = mysqli_query($conn,"select * from ac_paymtd");

while ($row2 = mysqli_fetch_array($data2))
{
$mtd = $row2['mtd'];
$msl = $row2['sl'];
?>
<option value="<?php echo $msl;?>"><?php echo $mtd;?></option>
<?
}
?>
</select>
</td>
<td ><b>Branch:</b><br>
	<select name="brncd" id="brncd" class="form-control">
	<?
	if($user_current_level<0)
	{
		$query="Select * from main_branch";
		?>
		<option value="">---All---</option>
		<?
	}
	else
	{
		$query="Select * from main_branch where sl='$branch_code'";
	}
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$bsl=$R['sl'];
		$bnm=$R['bnm'];

		?>
		<option value="<?php echo $bsl;?>"><?php echo $bnm;?></option>
		<?
	}
	?>
	</select>
</td>

<td width="25%;"><b>Status:</b><br>
<select name="stat" id="stat" class="form-control">
<option value="0">Done</option>
<option value="">---All---</option>
<option value="1">Canceled</option>
</select>
</td>
</tr>
<tr>
<td><b>ALS:</b><br>
<select id="als" name="als" class="form-control tb">
<option value="" >---- Select ----</option>
<?
$qr=mysqli_query($conn,"select * from main_billtype where inv_typ='77'") or die(mysqli_error($conn));
while($R=mysqli_fetch_array($qr))
{
	$ssl1=$R['sl'];
	$als1=$R['als'];
	$tp1=$R['tp'];
	$ssn1=$R['ssn'];
?>
<option value="<?php echo $als1;?>" ><?php echo $als1;?></option>
<?	
}
?>
</select></td>
<td>
<b>Advance-Payment :</b><br>
<select id="blno" name="blno" class="form-control tb">
<option value="" >---- ALL ----</option>
<option value="Advance-Payment" >Advance-Payment</option>

</select>
</td>
<td align="right" colspan="4">
<input type="button" class="btn btn-info" value="Show" onclick="show1()">
<input type="button" value=" Excel Export " class="btn btn-warning" onclick="exprt()">

</td>
</tr>
</thead>
</table>
<div id="data8" style="overflow-x:auto;"></div>
<div id="can88"></div>
	 
                                </div>
</form>
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
$('#cid').chosen({no_results_text: "",});
$('#salper').chosen({no_results_text: "Oops, nothing found!",});
$('#ledg').chosen({no_results_text: "Oops, nothing found!",});
$('#als').chosen({no_results_text: "Oops, nothing found!",});
  
function getv()
{
	var cat= document.getElementById('cat').value;
	var bnm= document.getElementById('bnm').value;
	$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
/*
$('#cid_chosen .chosen-search input').autocomplete({
        minLength: 1,
        source: function( request, response ) {
    		delay(function () { 
            $.ajax({
                url: "get_customer_for_choosen.php?val="+request.term,
                dataType: "json",
                beforeSend: function(){ 

					$('ul.chosen-results').empty();
                $("#cid").empty();
				 }
            }).done(function( data ) {    			
                    response( $.map( data, function( item ) {
						
 					console.log(item);
                        $('#cid').append('<option value="' + item.sl + '">' + item.nm + ' ( '+item.cont +' ) </option>');
					  
                    }));

                   $("#cid").trigger("chosen:updated");

				   $("#cid_chosen .chosen-search input").val(request.term);
				   $("#cid_chosen .ui-helper-hidden-accessible").html('');
            });
		}, 1000);
        }
    });
	var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})()
*/
</script>

<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
    </body>
</html>