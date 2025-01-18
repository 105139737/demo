<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";
$sa=date('d-m-Y');
$saa="01-".date('m-Y');
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
        var cat = document.getElementById('cat').value;
        $('#data8').load('priceUpload_shows.php?fdt=' + fdt + '&tdt=' + tdt+ '&cat=' + cat).fadeIn('fast');
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
            Price List
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Price List</li>
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
                                    <b>Brand</b><br>

<select  class="form-control" size="1" id="cat" tabindex="1"  name="cat">
<option value="">---ALL---</option>
<?php 
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
                                    <td align="left" width="25%">
                                        <b>Form : </b>
                                        <input type="text" id="fdt" name="fdt" value="<?php echo $saa;?>"
                                            class="form-control" placeholder="Please Enter From Date">
                                    </td>

                                    <td align="left" width="25%">
                                        <b>To : </b>
                                        <input type="text" id="tdt" name="tdt" value="<?php echo $sa;?>"
                                            class="form-control" placeholder="Please Enter To Date">
                                    </td>

                            </tr>
                            </thead>
                            <tr>                              
                                    <td align="right" colspan="4">
                                    <input type="button" id="show" class="btn btn-info" value="Show" onclick="show1()">
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