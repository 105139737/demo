<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";
$sa=date('d-m-Y');
$saa="01-".date('m-Y');
//$saa="22-01-2022";
?>
<html>

<head>
    <style type="text/css">
    th {
        text-align: center;
        color: #FFF;
        border: 1px solid #37880a;
    }

    input:focus {
        background-color: Aqua;
    }

    a {
        cursor: pointer;
    }
    </style>
    <script>
    function show1() {
        var fdt = document.getElementById('fdt').value;
        var tdt = document.getElementById('tdt').value;
        var snm = document.getElementById('snm').value;        
        var cat = document.getElementById('cat').value;
        var scat = document.getElementById('scat').value;
        var prnm = document.getElementById('prnm').value;
        var godown = document.getElementById('godown').value;       
        var pstat = document.getElementById('pstat').value;
        $('#data8').load('priceUploadList.php?fdt=' + fdt + '&tdt=' + tdt + '&snm=' + encodeURIComponent(snm) +
            '&cat=' + cat + '&scat=' + scat + '&prnm=' + prnm + '&godown=' + godown +
            '&pstat=' + pstat).fadeIn('fast');
            //$("#show").hide();
    }

    function getgwn() {
        brncd = document.getElementById('brncd').value;
        // $("#g_gwn").load("get_gwn1.php?brncd="+brncd).fadeIn('fast');
    }
    </script>
    <link rel="stylesheet" href="dark-hive/jquery.ui.all.css" type="text/css">
    <style type="text/css">
    .ui-datepicker {
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
    $(document).ready(function() {
        var jQueryDatePicker2Opts = {
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false,
            showAnim: 'show'
        };
        $("#fdt").inputmask("dd-mm-yyyy", {
            "placeholder": "dd-mm-yyyy"
        });
        $("#tdt").inputmask("dd-mm-yyyy", {
            "placeholder": "dd-mm-yyyy"
        });
        $("#fdt").datepicker(jQueryDatePicker2Opts);
        $("#tdt").datepicker(jQueryDatePicker2Opts);
    });

    function get_scat() {
        var cat = document.getElementById('cat').value;
        $("#catdiv").load("getscat_psw.php?cat=" + cat).fadeIn('fast');
    }

    function get_model() {
        var cat = document.getElementById('cat').value;
        var scat = document.getElementById('scat').value;
        $("#moddiv").load("getmodel_psw.php?cat=" + cat + "&scat=" + scat).fadeIn('fast');
    }
    </script>
    <script type="text/javascript" src="jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
</head>

<body>
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side strech">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 align="center">
            Price Setup
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Price Setup</li>
            </ol>
        </section>
        <section class="content">
            <!-- TO DO List -->
<form method="post" action="priceUploads.php" name="form1" id="form1">
                <center>
                    <div class="box box-success">
                        <table border="0" width="860px" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td align="left" width="25%">
                                        <b>Form : </b>
                                        <input type="text" id="fdt" name="fdt" value="<?echo $saa;?>"
                                            class="form-control" placeholder="Please Enter From Date">
                                    </td>

                                    <td align="left" width="25%">
                                        <b>To : </b>
                                        <input type="text" id="tdt" name="tdt" value="<?echo $sa;?>"
                                            class="form-control" placeholder="Please Enter To Date">
                                    </td>

                                    <td align="left" width="25%">
                                        <b>Company Name :</b><br>
                                        <select name="snm" class="form-control" id="snm">
                                            <option value="">---All---</option>
                                            <?
		$query="select * from main_suppl  WHERE sl>0 order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
                                            <option value="<?=$rw['sl'];?>"><?=$rw['spn'];?>
                                                <?if($rw['nm']!=""){?>( <?=$rw['nm'];?> )
                                                <?}?>
                                            </option>
                                            <?
		}
	?>

                                        </select>
                                    </td>

<td align="left" width="25%">
<b>Godown:</b>
<div id="g_gwn">
<select name="godown" class="form-control" size="1" id="godown">
<option value="">---All---</option>

<?
$query="Select * from main_godown";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$gnm=$R['gnm'];

?>
<option value="<? echo $sl;?>">
<? echo $gnm;?>
</option>
<?
}
?>
</select>
</div>
</td>
                                </tr>
                                <tr>

                                    <td>
                                        <b>Brand:</b>
                                        <select id="cat" name="cat" style="width:100%" class="form-control"
                                            onchange="get_scat()">
                                            <option value="">---All---</option>
                                            <?
$data12 = mysqli_query($conn,"Select * from main_catg order by sl");
while ($row12 = mysqli_fetch_array($data12))
	{
	$sl=$row12['sl'];
	$cnm=$row12['cnm'];
?>
                                            <Option value="<?=$sl;?>"><?=$cnm;?></option>
                                            <?}?>
                                        </select>
                                    </td>
                                    <td>
                                        <b>Category:</b>
                                        <div id="catdiv">
                                            <select name="scat" id="scat" class="form-control" onchange="get_model()">
                                                <option value="">---All---</option>
                                                <?
$get=mysqli_query($conn,"Select * from main_scat where cat='$cat' order by sl");
while($row=mysqli_fetch_array($get))
{
	$sc_sl=$row['sl'];
	$sc_nm=$row['nm'];
	?>
                                                <option value="<?echo $sc_sl;?>">
                                                    <?echo $sc_nm;?>
                                                </option>
                                                <?
}
?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <b>Model:</b>
                                        <div id="moddiv">
                                            <select id="prnm" name="prnm" style="width:100%" class="form-control">
                                                <option value="">---All---</option>
                                                <?
$data1 = mysqli_query($conn,"Select * from main_product where typ='0' order by sl");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
	$pcd=$row1['pcd'];
?>
                                                <Option value="<?=$sl;?>"><?=reformat($pcd . " " . $pnm);?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                    </td>

<td>
<b>Status:</b>
<select name="pstat" class="form-control" size="1" id="pstat">
<option value="0">Pending</option>
<option value="1">Done</option>



</select>
</td>
                                </tr>
                            </thead>
                            <tr>                              
                                    <td align="right" colspan="4"><br />
                                    <input type="button" id="show" class="btn btn-info" value="Show" onclick="show1()">                                  
                                    <input type="submit" class="btn btn-warning" value="Upload" >
                                </td>
                            </tr>
                        </table>
                        <div style="overflow-x:auto;" id="data8">
                        </div>
                    </div>
            </form><!-- /.box-body -->
            <div class="box-footer clearfix no-border">
            </div>
            <div class="modal fade" id="compose-modal1" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" id="cnt11">
                        </div>
                    </div>
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
    $('#pnm').chosen({
        no_results_text: "Oops, nothing found!",
    });
    $('#snm').chosen({
        no_results_text: "Oops, nothing found!",
    });
    $('#prnm').chosen({
        no_results_text: "Oops, nothing found!",
    });
    </script>
</body>

</html>