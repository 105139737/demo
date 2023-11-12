<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$year=date('Y'); 
?>
<!-- AdminLTE dashboard demo (This is only for demo purposes) --> 
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        GSTR-B3
                        <small>Report</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                   

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                    
     <div class="col-md-12">
          <div class="box box-success">
            <table width="100%" class="table table-hover table-striped table-bordered"  >
		
		  <tr class="odd">
			 <td  align="right" style="padding-top:15px"><b>Report Month :</b></td>
			 <td  align="left" >
<select id="yr" data-placeholder="Choose Report Month" name="yr" class="form-control" tabindex="2" onchange="handleSelect(this.value)"  >
<option value="">Select</option>
<?
for($i=2017;$i<=2017; $i++)
{
?>
<option value="<?=$i;?>"><?=$i;?></option>

<?
}	
?>
</select>
            </td>
            <td  align="left" >
			<select id="mnth" data-placeholder="Choose Report Month" name="mnth" class="form-control" tabindex="2"  >
<option value="">Select</option>
<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>

</select>
</td>
<td align="center"> 
<input type="button"  value="Show" onclick="show()" class="btn btn-primary" >
</td>
<td align="center"> 
<input type="button"  value="Excel Export" onclick="prnt()" class="btn btn-info" >
</td>
			</tr>
			</table>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	<div class="box box-success" id="show1" >
  </div>	  
</div>
</div><!-- /.row (main row) -->
<section class="col-lg-12 connectedSortable"> 
                </section><!-- /.content -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
	<script>
    function handleSelect(selectVal) {
		//alert(selectVal);
        if (selectVal == "2017") {
            // cannot disable all the options in select box
        
            $("#mnth option[value='1']").attr('disabled', 'disabled');
            $("#mnth option[value='2']").attr('disabled', 'disabled');
            $("#mnth option[value='3']").attr('disabled', 'disabled');
            $("#mnth option[value='4']").attr('disabled', 'disabled');
            $("#mnth option[value='5']").attr('disabled', 'disabled');
            $("#mnth option[value='6']").attr('disabled', 'disabled');
        }
    }
	 function show()
 {
      var mnth=document.getElementById('mnth').value;
      var yr=document.getElementById('yr').value;
	$('#show1').load('gstr_b3s.php?mnth='+mnth+'&yr='+yr).fadeIn('fast');
 }
function prnt()

{
	  var mnth=document.getElementById('mnth').value;
      var yr=document.getElementById('yr').value;
	document.location='gstr_b3s_xl.php?mnth='+mnth+'&yr='+yr;
	/*
var divToPrint=document.getElementById('show1');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);
  */
}	
</script>	
</body>
</html>