<?
$reqlevel=3;
include("membersonly.inc.php");
include "header.php";
?>
<html>

<head>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?
include "left_bar.php";
?>

        <script>

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
		<div class="box-footer ">
            <b>Customer:</b><br>
            <select id="cid" name="cid" class="form-control">
                <option value="">--- All ---</option>
                <?
	$get=mysqli_query($conn,"SELECT * FROM main_cust ORDER BY nm limit 10");
	while($row=mysqli_fetch_array($get))
	{
		$csl=$row['sl'];
		$pnm=$row['nm'];
		
		?>
                <Option value="<?php echo $csl;?>"><?php echo $pnm;?></option>
                <?
	}
	?>
            </select>

          

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
    $('#cid').chosen({
        no_results_text: "Oops, nothing found!",
    });
    
    $('#cid_chosen .chosen-search input').autocomplete({
        minLength: 3,
        source: function( request, response ) {
    		
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
                        $('#cid').append('<option value="' + item.sl + '">' + item.nm + ' ( '+item.nm +' ) </option>');
					  
                    }));

                   $("#cid").trigger("chosen:updated");

				   $("#cid_chosen .chosen-search input").val(request.term);
				   $("#cid_chosen .ui-helper-hidden-accessible").html('');
            });
        }
    });
    

 /*   $("#cid_chosen .chosen-search input").on('keyup', function(e) {
        console.log("test", $("#cid_chosen .chosen-search input").val());
        $.ajax({
            url: "get_customer_for_choosen.php?val=",
            dataType: "json",
            beforeSend: function() {
                $('ul.chosen-results').empty();
                $("#cid").empty();
            }
        }).done(function(data) {

            response($.map(data, function(item) {
                console.log("test", data);
                // $('#cid').append('<option value="blah">' + item.name + '</option>');
            }));

            $("#cid").trigger("chosen:updated");
        });
    })*/
    </script>
</body>

</html>