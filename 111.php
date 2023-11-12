<html>
<head>

<script type="text/javascript">
function blprnt(){
    if(confirm('Are You Sure?')){
     
        window.print();
    }
   
}
</script>
</head>
<body onload="blprnt()">
<form>
<table width="677px">
<tr>
<td><br><br>Customer Name & Address<br>
Bhakat Beej & Nursery<br>
53,G.T Road<br><br>
Dist. Burdwan<br>
713101
</td><td>Invoice No.<input type="text" id="dt" name="dt">

</td>
</tr>
</table>
</form>
</body>



$cr2=mysqli_query($conn,"select * from  main_product where sl='$prsl'");
while ($r2=mysqli_fetch_array($cr2))
{
$tech=$r2['tech'];
$co=$r2['co'];

}