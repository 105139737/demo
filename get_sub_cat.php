<?php
$reqlevel = 1;
include("membersonly.inc.php");
$sscat=$_REQUEST['sscat'];
<script>
$('#scat').chosen({
no_results_text: "Oops, nothing found!",
});
get_igst();
</script>