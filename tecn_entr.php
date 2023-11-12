<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
?>
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
 <script>
 function check1()
{
 if(document.form1.nm.value=='')
{
alert("Please Name !");
document.form1.nm.focus();
 return false;
	  }
 if(document.form1.cnt.value=='')
{
alert("Please Enter Contact No. !");
document.form1.cnt.focus();
 return false;
	  }
	   if(document.form1.adrs.value=='')
{
alert("Please Enter Address !");
document.form1.adrs.focus();
 return false;
	  }

else
{
 document.forms["form1"].submit();
}
}



function readURL(input)
{
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(90)
                        .height(90);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

		


function check(evt)
{
evt =(evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;						// ONLY NUMBER FOR NUMBER FIELD
if(charCode > 31 && (charCode < 48 || charCode > 57))
{
return false;
}
 return true;	
}

function show()
{
	$("#list").load("tecn_list.php").fadeIn("fast");
}		
 </script>
  <body onload="show()">          <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                    Technician
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Technician Entry</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
					<HR> 	<form method="post" action="tecn_entrs.php" id="form1" onSubmit="return check1()" name="form1"  enctype="multipart/form-data">
  <center>
        <div class="box box-success" >
        <table border="0" class="table table-hover table-striped table-bordered">
          <tr>
            <td align="right" >Name :</td>
            <td align="left" >
            <input type="text" class="form-control" name="nm" id="nm" placeholder="Enter Name" ></td>
                      <td align="right" >Contact :</td>
            <td align="left" >
            <input type="text" name="cnt" id="cnt" class="form-control" onkeypress="return check(event)"  maxlength="10" placeholder="Enter Contact"></td>

		  </tr>
     <tr>
	             <td align="right" >Address :</td>
            <td align="left" >
            <textarea name="adrs" id="adrs" class="form-control" value=""  placeholder="Enter Address" style="height:90px;"></textarea></td>

            <td align="right" >Picture :</td>
            <td align="left" >
<label for="fileToUpload" title="Click To Chose Picture">
<img id="blah" src="images/blnk.png" alt="Sub Product Category Image" style="width:90px; height:90px; cursor:pointer;"/>
</label>
<input type="file" name="fileToUpload" id="fileToUpload" class="hidden" onchange="readURL(this);" accept="image/x-png, image/gif, image/jpeg">
          </tr>
		  <tr >
            <td colspan="4" align="right"  style="padding-right: 8px;">
             <input type="submit" value="Submit" class="btn btn-primary" name="B1">
			  </td>
          </tr>
          </table>
  </form>
<div id="list"></div>
  </div>
							<!-- /.box-body -->
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