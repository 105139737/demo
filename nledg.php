<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
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
select.sc1 {
	width: 300px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#tp{
	padding:3px;
	border:1px #CCC solid;
	font-size:17px;
}
.suggestionsBox {
	position: absolute;
	left: 0px;
	top:10px;
	margin: 26px 0px 0px 0px;
	width: 300px;
	padding:0px;
	background-color: #9F1301;
	border-top: 3px solid #FFFF66;
	color: #fff;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
.ul1 {
	font-family:Arial, Helvetica, sans-serif;
	font-size:18px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}

</style>

</style> 
<script type="text/javascript" src="validate.js"></script>

<script type="text/javascript" src="prdcedt.js"></script>
<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#tp').addClass('load');
			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#tp').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#tp').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}

</script>
	
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                  Ledger 
                        <small>Create</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Account Group </li>
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
                          
							
							
							
							
	<body onload="ledg('','')">						
							
					<HR> 	<form method="post" action="#" id="form1"  name="form1">
                              
							
								



  <center>
        <div class="box box-success" style="width:900px" >
        <table border="0"   align="center" class="table table-hover table-striped table-bordered">
	
        
    
		
          <tr>
            <td align="right" style="padding-top:15px" >Group :</td>
            <td align="left" >
                  <div id="suggest">
            <input type="text" name="tp" id="tp" size="20" class="form-control" onkeyup="suggest(this.value);" onblur="fill();" class="">
      <div class="suggestionsBox" id="suggestions" style="display: none;z-index:1000;"> <img src="arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
      </div></div>
    </td>     
            <td align="right" style="padding-top:15px" >Ledger :</td>
            <td align="left" >
        	<input type="text" name="sn" id="sn" class="form-control" size="30">
			</td>
          </tr>
   		
		
		  <tr >

            <td colspan="4" align="right"  style="padding-right: 8px;">
             <input type="button" value="Submit" onclick="ledg('','')" class="btn btn-primary" name="B1">
			  <input type="reset" class="btn btn-primary" value="Reset" name="B2">
			  </td>
          </tr>
		  

          </table>
	 
                                </div>
								<div class="box box-success" style="width:900px"  >
								<div id="sdtl">
								
								</div>
								</div>
								<input type="hidden" id="edtbx"/>
								</form><!-- /.box-body -->.
								    </body>
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                            </div>
							
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     


</html>