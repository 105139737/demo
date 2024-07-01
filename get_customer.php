<?
$reqlevel = 1;
include("membersonly.inc.php");

?>
<script type="text/javascript" src="js/datalist/jquery.easy-autocomplete.js"></script>
<link rel="stylesheet" href="js/datalist/easy-autocomplete.css" title="style-orange">
<link rel="stylesheet" href="js/datalist/easy-autocomplete.themes.css" title="style-orange">
<div class="row">
<div class="col-12">
<b>Customer : </b><br>
<input class="form-control" type="text" name="cust_nm" autocomplete="off" id="cust_nm" style="width: 588px;" size="40" onkeyup="if(this.value==''){$('#cid').val('');}" onfocus="this.select()">
<input type="hidden" id="cid" name="cid">
</div>
<div class="col-6">
<b>Bill No : </b><br>
<input type="text" name="blno" id="blno" placeholder="Type Bill No" class="form-control">
</div>
<div class="col-6">
<b>Limit  From : </b><br>
<input type="text" name="fn" id="fn" placeholder="Limit  From" value="0" class="form-control">
</div>
<div class="col-6">
<b>Limit  To : </b><br>
<input type="text" name="tn" id="tn" placeholder="Limit  To"  value="150" class="form-control">
</div>
<div class="col-12">
<br>
<input type="button" value="Unpaid To paid " class="btn btn-warning " onclick="checks('0')"><br><br>

<input type="button" value="Paid To Unpaid" class="btn btn-warning" onclick="checks('2')">
<br><br>
<input type="button" value="All Type" class="btn btn-success" onclick="checks('1')">


</div>
</div>

<script>
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
$("#cid").val(value).trigger("change"); //copy it to the hidden field
}
      
},   
};

$("#cust_nm").easyAutocomplete(options);
</script>
<style>
.easy-autocomplete
{
 width: 100%;   
}
$(".easy-autocomplete").style.width = "100%";
</style>