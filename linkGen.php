<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$sa=date('d-m-Y');
$saa="01-".date('m-y');

$datas=mysqli_query($conn,"select * from global where sl=1")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($datas))
{
$sms=$row['sms'];
$linkGen=$row['linkGen'];
}

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
function show1()
{
var url=document.getElementById('url').value;
var linkGen=document.getElementById('linkGen').value;
var tp=btoa(document.getElementById('tp').value);
var x=document.getElementById("cat");
cat="";
for (var i = 0; i < x.options.length; i++) {
if(x.options[i].selected ==true){
if(cat=="")
{cat="t.brand like @"+x.options[i].value+"@"; }
else
{cat=cat+" or t.brand like @"+x.options[i].value+"@";} }}
cat=btoa(cat);
$("#datalink").html(`<center><font size="5">Link : <a target="_blank" href="${url}Price.php?tp=${tp}@${cat}@${linkGen}">${url}price.php?tp=${tp}@${cat}</a></font></center>`);

$("#data").html(`<center><font size="5"><a href="whatsapp://send?text=${url}Price.php?tp=${tp}@${cat}@${linkGen}" data-action="share/whatsapp/share">Share via Whatsapp</a></font></center>`);
}
function xls()
{
    var url=document.getElementById('url').value;
var tp=btoa(document.getElementById('tp').value);
var x=document.getElementById("cat");
cat="";
for (var i = 0; i < x.options.length; i++) {
if(x.options[i].selected ==true){
if(cat=="")
{cat="t.brand like @"+x.options[i].value+"@"; }
else
{cat=cat+" or t.brand like @"+x.options[i].value+"@";} }}
cat=btoa(cat);

window.open(`prices_xls.php?tp=${tp}&cat=${cat}`,"_blank");
}
</script>


	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
             Link
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Link</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">	

<form method="post" action="due_bals_xls.php" name="form1"  id="form1"> 
<div class="box box-success" >
    <input type="hidden" id="url" value="<?php echo "http://" . $_SERVER['SERVER_NAME'] ;?>/demo/">
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>

<tr>
<td width="35%">
<b>Brand</b><br>

<select  class="form-control" size="1" id="cat" tabindex="1" multiple name="cat[]">
<?
$data1 = mysqli_query($conn,"Select * from main_catg where stat='0' order by cnm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['cnm'];
echo "<option value='".$sl."'>".$cnm."</option>";
}
?>
</select>
</td>
<td align="left" width="35%"><b>Type :</b><br>
<select name="tp" class="form-control"  id="tp">
<option value="">---ALL---</option>		
<option value="1">Retail</option>		
<option value="2">Wholesale</option>	
</select>
</td>

<td align="left" width="30%"><br>
<input type="button" class="btn btn-info" value="Link Generate" onclick="show1()">
<input type="button" class="btn btn-success" value="Export To Excel" onclick="xls()">

</td>
</tr>
</thead>

<input type="hidden" id="linkGen" name="linkGen" value="<?php echo $linkGen?>">

</table>
<div id="datalink" style="overflow-x:auto;">
</div>
<div id="data" style="overflow-x:auto;">
</div>

                                </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                       
							</div>



<!-- Modal Box Start-->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md" style="width:60%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h4>Bill Details</h4>
			</div>
			<div class="page" id="cnt" style="overflow: auto;"></div>
		</div>
	</div>
</div>
<!-- Modal Box End -->							
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

	
$('#pnm').chosen({no_results_text: "Oops, nothing found!",});

$('#cat').chosen({no_results_text: "Oops, nothing found!",});
$('#bnm').chosen({no_results_text: "Oops, nothing found!",});
$('#prnm').chosen({no_results_text: "Oops, nothing found!",});
$('#sman').chosen({no_results_text: "Oops, nothing found!",});
$('#btyp').chosen({no_results_text: "Oops, nothing found!",});

  
function getv()
{
var cat= document.getElementById('cat').value;
var bnm= document.getElementById('bnm').value;
$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
var options = {
    url: function(phrase) { 
        if (phrase !== "") {
			return "get_med_data.php?mnm="+encodeURIComponent(phrase);
		}
	},

    getValue: "name",

    template: {
        type: "description",
        fields: {
            description: "manufacturer"
        }
    },

list: {
onSelectItemEvent: function() {
var value = $("#cust_nm").getSelectedItemData().id; //get the id associated with the selected value
$("#snm").val(value).trigger("change"); //copy it to the hidden field
}
      
},   
};

$("#cust_nm").easyAutocomplete(options);



var options = {
    url: function(phrase) { 
        if (phrase !== "") {
			return "get_med_data.php?mnm="+encodeURIComponent(phrase);
		}
	},

    getValue: "name",

    template: {
        type: "description",
        fields: {
            description: "manufacturer"
        }
    },

list: {
onSelectItemEvent: function() {
var value = $("#invto_get").getSelectedItemData().id; //get the id associated with the selected value
$("#invto").val(value).trigger("change"); //copy it to the hidden field
}
      
},   
};

$("#invto_get").easyAutocomplete(options);

</script>
    </body>
</html>